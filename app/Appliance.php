<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appliance extends Model
{
    protected $fillable = [
        'giver_id', 'finder_id', 'status', 'post_id', 'link', 'transfer_prove', 'price', 'giver_post_id',
        "content_title",
        "content_description",
        "content_image"
    ];

    public function user(){
        return $this->belongsTo('App\User', 'finder_id');
    }

    public function photo(){
        return $this->belongsTo('App\Post', 'post_id');
    }

    public function iklan(){
        return $this->belongsTo('App\Post', 'post_id');
    }

    public function userGiver(){
        return $this->belongsTo('App\User', 'giver_id');
    }

    public function userFinder(){
        return $this->belongsTo('App\User', 'finder_id');
    }

    public function iklanGiver(){
        return $this->belongsTo('App\Post', 'giver_post_id');
    }
}
