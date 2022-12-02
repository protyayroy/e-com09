<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorTableSeeder extends Seeder
{

    public function run()
    {
        $vendorData = [
            ['id' => 1,'name' => 'demo','email' => 'demo@gmail.com','address' => 'Kaliganj','city' => 'Jhenaidah','state' => 'Khulna','country' => 'Bangladesh','pincode' => '123456','mobile' => '01700121212','status' => '1',]
        ];

        Vendor::insert($vendorData);
    }
}
