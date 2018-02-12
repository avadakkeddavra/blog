<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';

    protected $fillable = ['name','text','img','user_id','created_at'];

    public function comments()
    {
    	return $this->hasMany(Comments::class,'post_id','id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class,'user_id','id');
    }
}
