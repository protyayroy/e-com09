<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Products_filter extends Model
{
    use HasFactory;

    public static function filterName($filterId){
        $filter = Products_filter::select('filter_name')->where('id', $filterId)->first();
        return $filter->filter_name;
    }

    public function getFilterValue(){
        return $this->hasMany('App\Models\Products_filters_value', 'filter_id');
    }

    public static function productFilters(){
        $productFilters = Products_filter::with('getFilterValue')->where('status', 1)->get();
        return $productFilters;
    }

    public static function filterAvailable($filter_id, $category_id){
        $filterAvailable = Products_filter::select('cat_ids')->where(['id' => $filter_id, 'status' => 1])->first()->toArray();
        $catIdsArr = explode(",", $filterAvailable['cat_ids']);

        if(in_array($category_id, $catIdsArr)){
            $available = "Yes";
        }else{
            $available = "No";
        }
        return $available;
    }
    
}
