<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
	protected $fillable = [
		'name',
		'slug'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function file()
	{
		return $this->hasMany(File::class);
	}
}
