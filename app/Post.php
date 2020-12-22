<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        "user_id",
        "title",
        "description",
        "limit",
        "price",
        "share_type",
        "content_title",
        "content_description",
        "content_image",
        "role",
        "post_id"
    ];

    public function appliances(){
        return $this->belongsTo('App\Appliance', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    

}
