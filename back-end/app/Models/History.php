<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table ="history";
    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    public function city(){
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
