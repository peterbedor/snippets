<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    protected $fillable = [
    	'body'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function snippet()
	{
		return $this->belongsTo(Snippet::class);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function replies()
	{
		return $this->hasMany(Comment::class, 'parent_id');
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function reply()
	{
		return $this->belongsTo(Comment::class, 'parent_id');
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function mentions()
	{
		return $this->hasMany(Mention::class);
    }

	/**
	 * @param $body
	 * @param $slug
	 * @param $parentId
	 * @return Comment
	 */
    public static function createComment($body, $slug, $parentId, $mentions): Comment
	{
		$snippet = Snippet::getBySlug($slug);

		$comment = new Comment();

		$comment->user_id = Auth::id();
		$comment->body = $body;
		$comment->parent_id = $parentId;

		$snippet->comments()->save($comment);

		if ($mentions) {
			Mention::saveMentions($mentions, $comment->id, $slug);
		}

		//return $comment->with('mentions.user')->where('id', $comment->id)->first();
		return $comment;
	}
}
