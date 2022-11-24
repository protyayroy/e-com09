<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            ['id'=>1, 'name'=>'Protyay Roy', 'type'=>'Super-Admin', 'vendor_id'=>'0', 'mobile'=>'01869535334', 'email'=>'r.protyay@yahoo.com', 'password'=>'$2a$12$MJBYgkrmi0uHXQV7N.jOUe8HF1VkZE0vimjAuBG85JXjB6Ob/lhxi', 'image'=>'', 'status'=>'1'],
            ['id'=>2, 'name'=>'Demo Roy', 'type'=>'Vendor', 'vendor_id'=>'1', 'mobile'=>'01700121212', 'email'=>'demo@gmail.com', 'password'=>'$2a$12$MJBYgkrmi0uHXQV7N.jOUe8HF1VkZE0vimjAuBG85JXjB6Ob/lhxi', 'image'=>'', 'status'=>'1']
        ];
        // $adminRecords = [
        //     ['id'=>2, 'name'=>'Demo Roy', 'type'=>'Vendor', 'vendor_id'=>'1', 'mobile'=>'01700121212', 'email'=>'demo@gmail.com', 'password'=>'$2a$12$MJBYgkrmi0uHXQV7N.jOUe8HF1VkZE0vimjAuBG85JXjB6Ob/lhxi', 'image'=>'', 'status'=>'1']
        // ];

        Admin::insert($adminRecords);
    }
}
