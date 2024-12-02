<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerateImage extends Model
{
    use HasFactory;
    protected $table = "generate_images";
    protected $primaryKey = "id";
    protected $fillable = [
        "packgename",
        "packgeqtd",
        "packgeprice",
        "packgedescription"
    ];

    public function packages()
    {
        return $this->hasOne(pacote::class);
    }
    
}
