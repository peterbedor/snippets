<?php
namespace App\Http\ViewComposers;

use App\Models\Language;
use Illuminate\View\View;

class LanguagesComposer
{
	/**
	 * The user repository implementation.
	 *
	 */
	protected $languages;

	/**
	 * Create a new Language Composer
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->languages = Language::all();
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view)
	{
		$view->with('languages', $this->languages);
	}
}