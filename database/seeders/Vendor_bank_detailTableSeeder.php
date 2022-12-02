<?php

namespace Database\Seeders;

use App\Models\Vendor_bank_detail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Vendor_bank_detailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bankDetails = [
            ['id' => 1,'vendor_id' => 1,'account_holder_name' => 'Demo Roy','bank_name' => 'Sonali Bank','account_number' => '141235','bank_ifsc_code' => '121214']
        ];

        Vendor_bank_detail::insert($bankDetails);
    }
}
