<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_shares', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('video_id');
            $table->string('share_title');
            $table->string('share_url');
            $table->text('share_desc');
            $table->string('share_weibo_desc');
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
        Schema::dropIfExists('video_shares');
    }
}
