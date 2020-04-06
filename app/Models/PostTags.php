<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
class PostTags extends Model
{
    protected $table='post_tags';
    
    protected $fillable=['name'];
    
    public function posts(){
        
        return $this->belongsToMany(Post::class,'post_has_tags','tag_id','post_id');
    }
}
