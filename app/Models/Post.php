<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\PostCategory;
use App\Models\Comment;

class Post extends Model {

    protected $table = 'posts';
    protected $fillable = ['title', 'shortDescription', 'mainContent', 'status_important', 'enable','post_category_id'];

    public function author() {
        return $this->hasOne(User::class, 'id', 'post_author_id');
    }

    public function category() {

        return $this->hasOne(PostCategory::class, 'id', 'post_category_id');
    }

    public function tags() {
        return $this->belongsToMany(PostTags::class, 'post_has_tags', 'post_id', 'tag_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function giveMeHumanFriendlyDate() {

        return date('d F | Y', strtotime($this->created_at));
    }

    public function goodFormatedDate() {
        $year = date('Y', strtotime($this->created_at));
        $month = date('n', strtotime($this->created_at));
        $day = date('d', strtotime($this->created_at));
        $currentMonth = date('n', strtotime(time()));
        if ($currentMonth - $month < 1) {
            return \Carbon\Carbon::createFromDate($year, $month, $day)->diff(\Carbon\Carbon::now())->format('%d days ago');
        }
        return \Carbon\Carbon::createFromDate($year, $month, $day)->diff(\Carbon\Carbon::now())->format('%m months ago');
    }

    public function giveMePreviousPost() {
        $previousPost = Post::find($this->id - 1);
        return $previousPost;
    }

    public function giveMeNextPost() {
        $nextPost = Post::find($this->id + 1);
        return $nextPost;
    }

    public function getPhotoUrl() {
        if (!empty($this->image)) {
            return url('/storage/posts/' . $this->image);
        }

        return url('https://via.placeholder.com/600');
    }
    public function getThumbPhotoUrl() {
        if (!empty($this->image)) {
            return url('/storage/posts/thumbs/' . $this->image);
        }

        return url('https://via.placeholder.com/200');
    }

    public function deletePhoto() {

        $photoFilePath = public_path('/storage/posts/' . $this->image);
        if (empty($this->image)) {

            return $this;
        }
        if (!is_file($photoFilePath)) {
            return $this;
        }
        unlink($photoFilePath);
        return $this;
    }

    public function deleteThumbPhoto() {

        $photoFilePath = public_path('/storage/posts/thumbs/' . $this->image);
        if (empty($this->image)) {

            return $this;
        }
        if (!is_file($photoFilePath)) {
            return $this;
        }
        unlink($photoFilePath);
        return $this;
    }

}
