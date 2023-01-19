<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function section()
    {
        return $this->belongsTo('App\Models\Section')->select('id', 'name', 'status');
    }

    public function parentcategory()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id')->select('id', 'name', 'status');
    }

    public function subcategory()
    {
        return $this->hasMany('App\Models\Category', 'parent_id')->where('status', 1);
    }

    public static function getCatIds($url)
    {
        $categoryDetails = Category::with("subcategory")->where('url', $url)->first()->toArray();
        // dd($categoryDetails);
        $catIds = array();
        $catIds[] = $categoryDetails["id"];
        foreach ($categoryDetails["subcategory"] as $key => $subCat) {
            // echo "<pre>";
            // print_r($subCat["id"]) ;
            $catIds[] = $subCat["id"];
        }
        return array('catIds' => $catIds, 'categoryDetails' => $categoryDetails);
    }

    public static function getCatName($catIds)
    {
        $categoryName = Category::where('id', $catIds)->select('name')->first();
        return $categoryName->name;
    }


}


// ->select(['id','status','name']), 'section_id'
