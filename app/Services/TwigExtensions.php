<?php
namespace App\Services;

use Twig_Extension;
use Twig_SimpleFunction;
use Twig_SimpleFilter;

class TwigExtensions extends Twig_Extension
{
	/**
	 * Filters
	 *
	 * @return array
	 */
	public function getFilters() {

		return [
			$this->filter('snakeCase')
		];
	}

	/**
	 * Functions
	 *
	 * @return array
	 */
	public function getFunctions()
	{
		return [
			$this->function('env'),
			$this->function('parseMentions'),
			$this->function('baseName'),
			$this->function('markdown')
		];
	}

	public function markdown($val)
	{
		$parser = new \Parsedown();

		return $parser->parse($val);
	}

	/**
	 * Returns the classes base name
	 *
	 * @param $val
	 * @return string
	 */
	public function baseName($val)
	{
		return class_basename($val);
	}

	/**
	 * Get environment variables in template
	 *
	 * @param $val - Environment variable key
	 * @return mixed
	 */
	public function env($val)
	{
		return env($val);
	}

	public function parseMentions($val, $mentions)
	{
		$words = collect(explode(' ', $val));

		$words->transform(function($word) use ($mentions) {
			if (str_contains($word, '@')) {
				foreach ($mentions as $mention) {
					if (str_contains($word, $mention->user->username)) {
						$word = '<a href="/users/' . $mention->user->username . '">' . $word . '</a>';
					}
				}
			}

			return $word;
		});

		return $words->implode(' ');
	}

	/**
	 * Converts string to snake_case
	 *
	 * @param $val
	 * @return string
	 */
	public function snakeCase($val)
	{
		return snake_case($val);
	}

	/**
	 * Creates a new twig simple filter
	 *
	 * @param $name
	 * @param null $method
	 * @return Twig_SimpleFilter
	 */
	private function filter($name, $method = null): Twig_SimpleFilter
	{
		return $this->extension(Twig_SimpleFilter::class, $name, $method);
	}

	/**
	 * Create a new twig simple function
	 *
	 * @param $name
	 * @param null $method
	 * @return Twig_SimpleFunction
	 */
	private function function($name, $method = null): Twig_SimpleFunction
	{
		return $this->extension(Twig_SimpleFunction::class, $name, $method);
	}

	/**
	 * Helper method to format new extensions
	 *
	 * @param $type
	 * @param $name
	 * @param null $method
	 * @return mixed
	 */
	private function extension($type, $name, $method = null)
	{
		return new $type($name, [
			$this,
			$method ?? $name
		]);
	}
}