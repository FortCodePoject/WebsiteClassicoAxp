<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyStock extends Model
{
    use HasFactory;
    protected $fillable = [
        "company_id",
        "image",
        "product",
        "price",
        "quantity",
        "ipaddress",
        "availablePrice",
        "availableQuantity",
        "status"
    ];
}
