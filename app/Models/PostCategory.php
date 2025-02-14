<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model {

    protected $table = 'post_categories';
    protected $fillable = ['name', 'description'];

    public function posts() {

        return $this->hasMany(Post::class, 'post_category_id', 'id');
    }

    public function getFrontUrl() {
        return route('front.posts.category', [
            'category' => $this->id,
            'name' => \Str::slug($this->name),
            'description' => \Str::slug($this->description),
        ]);
    }

}
