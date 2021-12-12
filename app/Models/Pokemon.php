<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    // Laravel defaults to table 'pokemon' (no idea why), my table is named 'pokemons'
    // Code below is necessary to make Laravel find the correct table
    protected $table = 'pokemons';

    // Protection against mass assignment, only these fields can and will be updated in the DB
    protected $fillable = [
        'name', 'image', 'type'
    ];
}
