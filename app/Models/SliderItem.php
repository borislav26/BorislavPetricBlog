<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderItem extends Model {

    protected $table = 'slider_items';
    protected $fillable = ['title', 'button_name', 'url'];

    public function getPhotoUrl() {
        if (!empty($this->image)) {
            return url('/storage/slider_items/' . $this->image);
        }

        return url('https://via.placeholder.com/200');
    }

    public function deletePhoto() {

        $photoFilePath = public_path('/storage/slider_items/' . $this->image);
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
