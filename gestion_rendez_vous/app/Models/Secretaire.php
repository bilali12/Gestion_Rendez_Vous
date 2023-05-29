<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'matricule_secretaire',
        'nom',
        'prenom',
        'email',
        'mot_de_pass'
    ];
}
