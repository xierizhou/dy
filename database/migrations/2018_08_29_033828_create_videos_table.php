<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('video_url');
            $table->string('dy_video_url');
            $table->string('dy_uri');
            $table->json('dy_cover'); //dy的封面图数据
            $table->string('dy_cover_url'); //dy的封面连接
            $table->string('cover_url'); //下载到本地封面图
            $table->string('dy_dynamic_cover'); //dy的动图
            $table->string('dynamic_cover'); //下载到本地的
            $table->string("width");  //视频的宽度
            $table->string("height");   //视频高度
            $table->string('media_type'); //应该是dy 媒体类型 暂时先存着
            $table->string('aweme_id'); //应该是分享的一个id 暂时先存着
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
        Schema::dropIfExists('videos');
    }
}
