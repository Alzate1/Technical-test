<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table="country";
    public function cities()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }
    public function history()
    {
        return $this->hasMany(History::class, 'country_id', 'id');
    }

}
