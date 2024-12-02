<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentation_info extends Model
{
    use HasFactory;

    protected $table = "documentation_infos";
    protected $primaryKey = "id";
    protected $fillable = [
        "description",
        "documentation_id",
    ];

    public function documentation(){
        return $this->belongsTo(Documentation::class);
    } 
}
