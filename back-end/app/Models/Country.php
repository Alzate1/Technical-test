<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    // Define la tabla asociada al modelo
    protected $table = "country";

    // Define una relación de uno a muchos con el modelo City
    public function cities()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }

    // Define una relación de uno a muchos con el modelo History
    public function history()
    {
        return $this->hasMany(History::class, 'country_id', 'id');
    }
}
