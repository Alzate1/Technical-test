<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    // Define la tabla asociada al modelo
    protected $table = "history";

    // Define una relación de muchos a uno con el modelo Country
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    // Define una relación de muchos a uno con el modelo City
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    // Define una relación de muchos a uno con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
