<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpiderPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('spider_posts', function(Blueprint $table)
		{
			$table->string('id')->unique();
            $table->string('title');
            $table->text('content');
            $table->string('url');
            $table->dateTime('post_at');
            $table->string('category');
            $table->string('from'); // 来源
            $table->string('is_send'); // 是否已发邮件出去
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('spider_posts');
	}

}
