<?php
namespace App\Models;

use Auth;
use App\Notifications\Mentioned;
use Illuminate\Database\Eloquent\Model;

class Mention extends Model
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users()
	{
		return $this->belongsToMany(User::class, 'mentions');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function comments()
	{
		return $this->belongsToMany(Comment::class, 'mentions')
			->withTimestamps();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public static function saveMention($username, $commentId, $snippetSlug)
	{
		$user = User::getByUsername($username);

		$mention = new Mention();

		$mention->user_id = $user->id;
		$mention->comment_id = $commentId;

		$mention->save();

		$user->notify(new Mentioned(
			$mention,
			Auth::user()->fullName,
			$snippetSlug
		));
	}

	public static function saveMentions($mentions, $commentId, $slug)
	{
		foreach ($mentions as $mention) {
			self::saveMention($mention, $commentId, $slug);
		}
	}
}
