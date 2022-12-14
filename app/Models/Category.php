<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function section(){
        return $this->belongsTo('App\Models\Section')->select('id', 'name', 'status');
    }

    public function parentcategory(){
        return $this->belongsTo('App\Models\Category', 'parent_id')->select('id', 'name', 'status');
    }

    public function subcategory(){
        return $this->hasMany('App\Models\Category', 'parent_id')->where('status', 1);
    }
}


// ->select(['id','status','name']), 'section_id'
