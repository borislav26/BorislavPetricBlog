<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderItem extends Model
{
    protected $table='slider_items';
    
    protected $fillable=['title','button_name','url'];
}
