<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pacote extends Model
{
    use HasFactory;
    
    protected $table = "pacotes";
    protected $primaryKey = "id";
    protected $fillable = [
        "pacote",
        "status",
        "company_id",
        "generate_images_id"
    ];

    public function company()
    {
        return $this->belongsTo(company::class);
    }

    public function package()
    {
        return $this->belongsTo(GenerateImage::class);
    }
    
}