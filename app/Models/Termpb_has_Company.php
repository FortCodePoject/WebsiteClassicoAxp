<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Termpb_has_Company extends Model
{
    use HasFactory;

    public function termsPBs()
    {
        return $this->belongsTo(Termpb::class, 'termpb_id', 'id');
    }
   
}
