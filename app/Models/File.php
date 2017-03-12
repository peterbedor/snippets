<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	protected $fillable = [
		'name',
		'slug',
		'extension',
		'body'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function snippet()
	{
		return $this->belongsTo(Snippet::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function language()
	{
		return $this->belongsTo(Language::class);
	}
}
