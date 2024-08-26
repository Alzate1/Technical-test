<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    // Define la tabla asociada al modelo
    protected $table = "city";

    // Define una relación de muchos a uno con el modelo Country
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    // Define una relación de uno a muchos con el modelo History
    public function history()
    {
        return $this->hasMany(History::class, 'city_id', 'id');
    }
}
