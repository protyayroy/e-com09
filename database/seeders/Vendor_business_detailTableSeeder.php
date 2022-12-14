<?php

namespace Database\Seeders;

use App\Models\Vendor_business_detail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Vendor_business_detailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $businessDetails = [
            [
                'id' => 1,'vendor_id' => 1,'shop_name' => 'Demo Enterprise','shop_email' => 'DemoEnterprise@gmail.com','shop_address' => 'Jessore','shop_city' => 'Jessore','shop_state' => 'Khulna','shop_country' => 'Bangladesh','shop_pincode' => '458697','shop_mobile' => '01900000000','shop_website' => 'www.DemoEnterprise.com','address_proof' => '253331','address_proof_image' => '','business_license_number' => '65412623','gst_number' => '2254','pan_number' => '7895',
            ]

        ];

        Vendor_business_detail::insert($businessDetails);
    }
}
