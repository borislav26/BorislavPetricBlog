<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    protected $table = 'comments';

    protected $fillable=['name_of_visitor','email_of_visitor','content','post_id'];
    
    public function giveMeHumanFriendlyDate() {

        return date('F Y', strtotime($this->created_at));
    }
    public function post(){
        
        return $this->belongsTo(Post::class,'post_id','id');
    }

}
