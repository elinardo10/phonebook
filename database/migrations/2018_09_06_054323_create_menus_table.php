<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
              $table->increments('id');
            $table->unsignedInteger('restaurant_id');
            $table->string('name');
            $table->double('price', 10, 2)->default(0);
            $table->timestamps();

            $table->foreign('restaurant_id')
                            ->references('id')
                            ->on('restaurants')
                            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
