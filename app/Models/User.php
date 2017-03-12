<?php
namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Searchable;

    protected $with = [
    	'notifications'
	];

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
		'username',
		'email',
		'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
		'remember_token',
    ];

	/**
	 * Get the index for the model.
	 *
	 * @return string
	 */
    public function searchableAs()
	{
		return 'users_index';
	}

	/**
	 * Get the indexable data array for the model.
	 *
	 * @return array
	 */
	public function toSearchableArray()
	{
		return $this->toArray();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function snippets()
	{
		return $this->hasMany(Snippet::class);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function comments()
	{
		return $this->hasMany(Comment::class);
    }

	/**
	 * Get the full name attribute on the user model
	 *
	 * @return string
	 */
	public function getFullNameAttribute()
	{
		return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

	public static function getByUsername($username)
	{
		return self::where('username', $username)->first();
    }

    public static function getByUsernames($usernames)
	{
		return self::whereIn('username', $usernames)->get();
	}
}
