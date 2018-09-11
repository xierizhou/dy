<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['dy_uid','dy_number','nickname','avatar','dy_url','dy_data_json','short_introduce','position','constellation','follow_count','fans_count','fabulous_count','dy_uid_icon'];
}
