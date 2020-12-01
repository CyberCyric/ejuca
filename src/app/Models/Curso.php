<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    public function alumnos()
    {
        return $this->belongsToMany('App\Models\Alumno','curso_alumno');
    }
}
