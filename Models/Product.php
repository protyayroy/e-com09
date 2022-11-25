<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function section(){
        return $this->belongsTo('App\Models\Section')->select('id', 'name')->where('status', 1);
    }

    public function category(){
        return $this->belongsTo('App\Models\Category')->select('id', 'name')->where('status', 1);
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand')->select('id', 'name')->where('status', 1);
    }
}
