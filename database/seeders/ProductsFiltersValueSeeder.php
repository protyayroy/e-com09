<?php

namespace Database\Seeders;

use App\Models\Products_filters_value;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsFiltersValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsFiltersValues = [
            ['id' => 1, 'filter_id' => '1', 'filter_value' => 'cotton', 'status' => 1],
            ['id' => 2, 'filter_id' => '1', 'filter_value' => 'polester', 'status' => 1],
            ['id' => 3, 'filter_id' => '2', 'filter_value' => '4 GB', 'status' => 1],
            ['id' => 4, 'filter_id' => '2', 'filter_value' => '8 GB', 'status' => 1],
            ['id' => 5, 'filter_id' => '3', 'filter_value' => '64 GB', 'status' => 1],
            ['id' => 6, 'filter_id' => '3', 'filter_value' => '128 GB', 'status' => 1],
        ];

        Products_filters_value::insert($productsFiltersValues);
    }
}
