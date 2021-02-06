<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_posts', function (Blueprint $table) {
            $table->unsignedBigInteger('post_sub_id')->unique();
            $table->unsignedBigInteger('post_main_id');
            $table->unsignedTinyInteger('post_order');
            $table->string('comment')->nullable();
            $table->string('photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_posts');
    }
}
