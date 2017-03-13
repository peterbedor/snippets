<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class SettingsController extends Controller
{
	public $files = [
		'Agate' => 'agate.min.css',
		'Androidstudio' => 'androidstudio.min.css',
		'Arduino Light' => 'arduino-light.min.css',
		'Arta' => 'arta.min.css',
		'Ascetic' => 'ascetic.min.css',
		'Atelier Cave Dark' => 'atelier-cave-dark.min.css',
		'Atelier Cave Light' => 'atelier-cave-light.min.css',
		'Atelier Dune Dark' => 'atelier-dune-dark.min.css',
		'Atelier Dune Light' => 'atelier-dune-light.min.css',
		'Atelier Estuary Dark' => 'atelier-estuary-dark.min.css',
		'Atelier Estuary Light' => 'atelier-estuary-light.min.css',
		'Atelier Forest Dark' => 'atelier-forest-dark.min.css',
		'Atelier Forest Light' => 'atelier-forest-light.min.css',
		'Atelier Heath Dark' => 'atelier-heath-dark.min.css',
		'Atelier Heath Light' => 'atelier-heath-light.min.css',
		'Atelier Lakeside Dark' => 'atelier-lakeside-dark.min.css',
		'Atelier Lakeside Light' => 'atelier-lakeside-light.min.css',
		'Atelier Plateau Dark' => 'atelier-plateau-dark.min.css',
		'Atelier Plateau Light' => 'atelier-plateau-light.min.css',
		'Atelier Savanna Dark' => 'atelier-savanna-dark.min.css',
		'Atelier Savanna Light' => 'atelier-savanna-light.min.css',
		'Atelier Seaside Dark' => 'atelier-seaside-dark.min.css',
		'Atelier Seaside Light' => 'atelier-seaside-light.min.css',
		'Atelier Sulphurpool Dark' => 'atelier-sulphurpool-dark.min.css',
		'Atelier Sulphurpool Light' => 'atelier-sulphurpool-light.min.css',
		'Atom One Dark' => 'atom-one-dark.min.css',
		'Atom One Light' => 'atom-one-light.min.css',
		'Brown Paper' => 'brown-paper.min.css',
		'Codepen Embed' => 'codepen-embed.min.css',
		'Color Brewer' => 'color-brewer.min.css',
		'Darcula' => 'darcula.min.css',
		'Dark' => 'dark.min.css',
		'Darkula' => 'darkula.min.css',
		'Default' => 'default.min.css',
		'Docco' => 'docco.min.css',
		'Dracula' => 'dracula.min.css',
		'Far' => 'far.min.css',
		'Foundation' => 'foundation.min.css',
		'Github Gist' => 'github-gist.min.css',
		'Github' => 'github.min.css',
		'Googlecode' => 'googlecode.min.css',
		'Grayscale' => 'grayscale.min.css',
		'Gruvbox Dark' => 'gruvbox-dark.min.css',
		'Gruvbox Light' => 'gruvbox-light.min.css',
		'Hopscotch' => 'hopscotch.min.css',
		'Hybrid' => 'hybrid.min.css',
		'Idea' => 'idea.min.css',
		'Ir Black' => 'ir-black.min.css',
		'Kimbie Dark' => 'kimbie.dark.min.css',
		'Kimbie Light' => 'kimbie.light.min.css',
		'Magula' => 'magula.min.css',
		'Mono Blue' => 'mono-blue.min.css',
		'Monokai Sublime' => 'monokai-sublime.min.css',
		'Monokai' => 'monokai.min.css',
		'Obsidian' => 'obsidian.min.css',
		'Ocean' => 'ocean.min.css',
		'Paraiso Dark' => 'paraiso-dark.min.css',
		'Paraiso Light' => 'paraiso-light.min.css',
		'Pojoaque' => 'pojoaque.min.css',
		'Purebasic' => 'purebasic.min.css',
		'Qtcreator Dark' => 'qtcreator_dark.min.css',
		'Qtcreator Light' => 'qtcreator_light.min.css',
		'Railscasts' => 'railscasts.min.css',
		'Rainbow' => 'rainbow.min.css',
		'School Book' => 'school-book.min.css',
		'Solarized Dark' => 'solarized-dark.min.css',
		'Solarized Light' => 'solarized-light.min.css',
		'Sunburst' => 'sunburst.min.css',
		'Tomorrow Night Blue' => 'tomorrow-night-blue.min.css',
		'Tomorrow Night Bright' => 'tomorrow-night-bright.min.css',
		'Tomorrow Night Eighties' => 'tomorrow-night-eighties.min.css',
		'Tomorrow Night' => 'tomorrow-night.min.css',
		'Tomorrow' => 'tomorrow.min.css',
		'Vs' => 'vs.min.css',
		'Xcode' => 'xcode.min.css',
		'Xt 256' => 'xt256.min.css',
		'Zenburn ' => 'zenburn.min.css'
	];

    public function getHighlightThemes()
	{
		$files = $this->files;

		return view('settings', compact('files'));
	}

	public function theme(Request $request)
	{
		$success = User::setTheme($request->input('theme'));

		if ($success) {
			return response()->json([
				'message' => 'Success',
				'theme' => $request->input('theme')
			]);
		}
	}
}
