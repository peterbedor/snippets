<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnippetTagTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('snippet_tag', function (Blueprint $table) {
			$table->unsignedInteger('snippet_id')
				->index();
			$table->unsignedInteger('tag_id')
				->index();

			$table->foreign('snippet_id')->references('id')->on('snippets');
			$table->foreign('tag_id')->references('id')->on('tags');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('snippet_tag');
	}
}
