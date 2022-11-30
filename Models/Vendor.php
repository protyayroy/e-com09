<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    public function bank(){
        return $this->hasOne(Vendor_bank_detail::class);
    }

    public function business(){
        return $this->hasOne(Vendor_business_detail::class);
    }
}
