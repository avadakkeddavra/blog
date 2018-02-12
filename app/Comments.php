<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';

    protected $fillable = ['text','user_id','post_id','parent_id'];

    public function user()
    {
    	return $this->belongsTo(User::class,'user_id','id');
    }

    public function post()
    {
		return $this->belongsTo(Posts::class,'post_id','id');    	
    }

    public function parent()
    {
    	return $this->belongsTo(Comments::class,'parent_id','id');
    }

    public function child()
    {
    	return $this->hasMany(Comments::class,'parent_id','id');
    }
}
