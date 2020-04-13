<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Message extends Model {

    protected $table = 'messages';
    protected $fillable = ['user_from_id', 'user_to_id', 'content', 'is_read'];

    public function userFrom() {
        return $this->belongsTo(User::class, 'user_from_id', 'id');
    }

    public function userTo() {
        return $this->belongsTo(User::class, 'user_to_id', 'id');
    }

    public function goodFormatedDate() {

        return \Carbon\Carbon::parse($this->created_at)->diffForHumans();
    }

}
