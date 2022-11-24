<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandInfo = [
            ['id'=> 1, 'name' => 'MI', 'status' => 1],
            ['id'=> 2, 'name' => 'OPPO', 'status' => 1],
            ['id'=> 3, 'name' => 'Sumgsang', 'status' => 1],
            ['id'=> 4, 'name' => 'Easy', 'status' => 1],
            ['id'=> 5, 'name' => 'Bloom', 'status' => 1],
            ['id'=> 6, 'name' => 'Washe', 'status' => 1]
        ];

        Brand::insert($brandInfo);
    }
}
