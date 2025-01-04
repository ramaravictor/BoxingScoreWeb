<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fighter extends Model
{
    use HasFactory;

    protected $table = 'fighters';

    protected $fillable = [
        'name',
        'birthdate',
        'weight_class',
        'champions',
        'image',
    ];
}
