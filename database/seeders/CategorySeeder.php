<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryInfo = [
            ['id'=> 1,'parent_id' => 0, 'section_id' => 1, 'name' => 'Man', 'discount' => 5, 'image' => '', 'description' => 'Man description', 'url' => 'Man', 'meta_title' => 'Man', 'meta_description' => 'Man meta_description', 'meta_keywords' => '98726', 'status' => 1],

            ['id'=> 2,'parent_id' => 0, 'section_id' => 1, 'name' => 'Woman', 'discount' => 2, 'image' => '', 'description' => 'Woman description', 'url' => 'Woman', 'meta_title' => 'Woman', 'meta_description' => 'Woman meta_description', 'meta_keywords' => '23651', 'status' => 1],

            ['id'=> 3,'parent_id' => 0, 'section_id' => 1, 'name' => 'Kids', 'discount' => 0, 'image' => '', 'description' => 'Kids description', 'url' => 'Kids', 'meta_title' => 'Kids', 'meta_description' => 'Kids meta_description', 'meta_keywords' => '15468', 'status' => 1],

            ['id'=> 4,'parent_id' => 0, 'section_id' => 2, 'name' => 'Mobile', 'discount' => 10, 'image' => '', 'description' => 'Mobile description', 'url' => 'Mobile', 'meta_title' => 'Mobile', 'meta_description' => 'Mobile meta_description', 'meta_keywords' => '28611', 'status' => 1],

            ['id'=> 5,'parent_id' => 0, 'section_id' => 2, 'name' => 'Computer', 'discount' => 8, 'image' => '', 'description' => 'Computer description', 'url' => 'Computer', 'meta_title' => 'Computer', 'meta_description' => 'Computer meta_description', 'meta_keywords' => '28341', 'status' => 1],

            ['id'=> 6,'parent_id' => 1, 'section_id' => 1, 'name' => 'T-shirt', 'discount' => 8, 'image' => '', 'description' => 'T-shirt description', 'url' => 'T-shirt', 'meta_title' => 'T-shirt', 'meta_description' => 'T-shirt meta_description', 'meta_keywords' => '28340', 'status' => 1],

            ['id'=> 7,'parent_id' => 1, 'section_id' => 1, 'name' => 'Shirt', 'discount' => 8, 'image' => '', 'description' => 'Shirt description', 'url' => 'Shirt', 'meta_title' => 'Shirt', 'meta_description' => 'Shirt meta_description', 'meta_keywords' => '28537', 'status' => 1],

            ['id'=> 8,'parent_id' => 1, 'section_id' => 1, 'name' => 'Pant', 'discount' => 8, 'image' => '', 'description' => 'Pant description', 'url' => 'Pant', 'meta_title' => 'Pant', 'meta_description' => 'Pant meta_description', 'meta_keywords' => '28332', 'status' => 1],

            ['id'=> 9,'parent_id' => 2, 'section_id' => 1, 'name' => 'T-shirt', 'discount' => 8, 'image' => '', 'description' => 'T-shirt description', 'url' => 'T-shirt', 'meta_title' => 'T-shirt', 'meta_description' => 'T-shirt meta_description', 'meta_keywords' => '28304', 'status' => 1],

            ['id'=> 10,'parent_id' => 2, 'section_id' => 1, 'name' => 'Saree', 'discount' => 8, 'image' => '', 'description' => 'Saree description', 'url' => 'Saree', 'meta_title' => 'Saree', 'meta_description' => 'Saree meta_description', 'meta_keywords' => '28754', 'status' => 1],
        ];

        Category::insert($categoryInfo);
    }
}
