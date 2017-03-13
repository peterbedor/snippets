<?php
namespace App\Traits;

use Auth;
use App\Models\Like;
use App\Models\User;

trait Likeable
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function likes()
	{
		return $this->morphMany(Like::class, 'likeable');
	}

	/**
	 * Check to see if the resource has been liked by the logged in user
	 *
	 * @return bool
	 */
	public function isLiked()
	{
		return !! $this->likes()
			->where('user_id', Auth::id())
			->count();
	}

	/**
	 * Unlike a resource
	 */
	public function unlike()
	{
		return $this->likes()->where('user_id', Auth::id())->delete();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function likers()
	{
		return $this->hasMany(User::class, 'id', 'user_id');
	}

	/**
	 * Like a resource
	 *
	 * @return bool
	 */
	public function like()
	{
		if ($this->isLiked()) {
			$this->unlike();
		} else {
			$like = new Like([
				'user_id' => Auth::id()
			]);

			return $this->likes()->save($like);
		}

		return false;
	}

	public function scopeLikedBy($query, User $user)
	{
		return $query->whereHas('likes', function ($query) use ($user) {
			$query->where('user_id', $user->id);
		});
	}

	/**
	 * Toggle liked state
	 *
	 * @return bool|void
	 */
	public function toggleLike()
	{
		if ($this->isLiked()) {
			return $this->unlike();
		}

		return $this->like();
	}

	/**
	 * Return like count
	 *
	 * @return mixed
	 */
	public function getLikesCountAttribute()
	{
		return $this->likes()->count();
	}
}