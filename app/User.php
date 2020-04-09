<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Post;
use App\Models\UserRole;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() {

        return $this->hasMany(Post::class, 'post_author_id', 'id');
    }

    public function role() {
        return $this->hasOne(UserRole::class, 'id', 'role_id');
    }

    public function getFrontUrl() {
        return route('front.posts.author', [
            'author' => $this->id,
            'name' => \Str::slug($this->name),
        ]);
    }

    public function getPhotoUrl() {
        if (!empty($this->image)) {
            return url('/storage/authors/' . $this->image);
        }

        return url('https://via.placeholder.com/200');
    }

    public function getТhumbPhotoUrl() {
        if (!empty($this->image)) {
            return url('/storage/authors/thumbs/' . $this->image);
        }

        return url('https://via.placeholder.com/200');
    }

    public function deletePhoto() {

        $photoFilePath = public_path('/storage/authors/' . $this->image);
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

        $photoFilePath = public_path('/storage/authors/thumbs/' . $this->image);
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
