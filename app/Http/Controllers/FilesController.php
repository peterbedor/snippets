<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FilesController extends Controller
{
	public function raw($slug, $id)
	{
		$file = File::find($id);

		header("Content-Type: text/plain");

		echo $file->body;

		die;
    }

	public function download($slug, $id)
	{
		$file = File::with('language')->where('id', $id)->first();

		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=' . $file->name . '.' . $file->language->extension);
		header('Content-Transfer-Encoding: binary');
		header('Connection: Keep-Alive');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');

		echo $file->body;
    }
}
