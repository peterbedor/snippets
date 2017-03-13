<?php

namespace App\Models;

use App\Traits\UniqueSlug;
use App\Traits\Likeable;
use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
	use UniqueSlug;
	use Likeable;

	protected $appends = [
		'commentCount'
	];

    protected $fillable = [
    	'name',
		'slug',
		'description'
	];

    public static function boot()
	{
		parent::boot();

		static::creating(function($snippet) {
			self::uniqueifySlug(self::class, $snippet);
		});
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function files()
	{
		return $this->hasMany(File::class);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
	{
		return $this->belongsToMany(Tag::class);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function comments()
	{
		return $this->hasMany(Comment::class);
    }

	public function getCommentCountAttribute()
	{
		return $this->comments()->whereNull('parent_id')->get()->count();
    }

	/**
	 * @param $slug
	 * @return Snippet
	 */
	public static function getBySlug($slug): Snippet
	{
		$snippet = self::withRelations()
			->where('slug', $slug)
			->first();

		return $snippet;
    }

    public static function byLanguage($slug)
	{
		$language = Language::getBySlug($slug);

		return self::withRelations()
			->whereHas('files.language', function($query) use ($language) {
				$query->where('language_id', $language->id);
			});
	}

	public static function withRelations()
	{
		return self::with('files.language',
			'author',
			'likes',
			'likers',
			'comments.mentions.user',
			'comments.author',
			'comments.replies.author'
		);
	}
}
