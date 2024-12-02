<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsCompany extends Model
{
    use HasFactory;
    protected $table = "terms_companies";
    protected $primaryKey = "id";
    protected $fillable = [
        "term",
        "privacity",
        "company_id"
    ];
}