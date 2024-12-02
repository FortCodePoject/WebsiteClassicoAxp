<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    use HasFactory;
    protected $table = "contacts";
    protected $guarded = ['id'];
    protected $fillable = [
        'telefone', 
        'email', 
        'endereco', 
        'atendimento',
        'company_id'
    ];
}