<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table="city";
    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    public function history()
    {
        return $this->hasMany(History::class, 'city_id', 'id');
    }
}
