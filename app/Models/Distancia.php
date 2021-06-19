<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distancia extends Model
{
    use HasFactory;
    protected $fillable = ['cep_origem', 'cep_destino', 'distancia'];
}
