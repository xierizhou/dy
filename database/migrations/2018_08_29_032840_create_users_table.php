<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('dy_uid'); //dy ID
            $table->string('dy_number'); //dy 号
            $table->string('nickname');
            $table->string('avatar'); //头像
            $table->string('dy_url');
            $table->json('dy_data_json');
            $table->string('short_introduce');  //简短介绍
            $table->string('position');  //位置
            $table->string('constellation'); //星座
            $table->string('follow_count'); //关注
            $table->string('fans_count');   //粉丝
            $table->string('fabulous_count');//赞的数量
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
        Schema::dropIfExists('users');
    }
}
