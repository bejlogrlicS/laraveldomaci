<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mec extends Model
{
    use HasFactory;

    protected $fillable = ['prviTimID', 'drugiTimID', 'rezultat', 'sportID'];

    protected $table = 'mecevi';
}
