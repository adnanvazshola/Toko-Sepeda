<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create(
			'favorites',
			function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('user_id');
				$table->unsignedBigInteger('produk_id');
				$table->timestamps();

				$table->foreign('user_id')->references('id')->on('users');
				$table->foreign('produk_id')->references('id')->on('produks');
				$table->index(['user_id', 'produk_id']);
			}
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('favorites');
	}
}
