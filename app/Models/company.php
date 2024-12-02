<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class company extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->hasOne(User::class, 'company_id', 'id');
    }

    public function pacote()
    {
        return $this->hasMany(pacote::class);
    }

    public function terms() {
        return $this->hasOne(Termo::class);
    }

    /**
     * The roles that belong to the company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function termsPBs(): BelongsToMany
    {
        return $this->belongsToMany(Termpb::class, 'termpb_has__companies');
    }


    

}