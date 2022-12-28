<?php

namespace Database\Seeders;

use App\Models\Products_filter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productFilter = [
            ["id" => 1, 'cat_ids' => '1,2,3,6,7,8,9,10', 'filter_name' => 'Fabric', 'filter_column' => 'fabric', 'status' => 1],
            ["id" => 2, 'cat_ids' => '4,5,11', 'filter_name' => 'Ram', 'filter_column' => 'ram', 'status' => 1],
            ["id" => 3, 'cat_ids' => '4,5,11', 'filter_name' => 'Storage', 'filter_column' => 'storage', 'status' => 1]
        ];

        Products_filter::insert($productFilter);
    }
}
