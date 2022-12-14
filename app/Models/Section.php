<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public static function section(){
        $getSections = Section::with('sectioncategory')->where('status', 1)->get()->toArray();
        return $getSections;
    }

    public function sectioncategory(){
        return $this->hasMany('App\Models\Category', 'section_id')->where([ 'status' => 1, 'parent_id' => 0 ])->with('subcategory');
    }

}
