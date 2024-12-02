<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    use HasFactory;

    protected $table = "documentations";
    protected $primaryKey = "id";
    protected $fillable = [
        "panel",
        "section",
        "action",
    ];

    public function infos(){
        return $this->hasMany(Documentation_info::class);
    }  
}
