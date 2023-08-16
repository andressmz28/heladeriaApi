<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Usuario extends Model


{

    
   public $timestamps = false;
    protected $table = 'users'; // Nombre de la tabla en la base de datos
    protected $fillable = ['nombre', 'apellido', 'correo', 'contrasena'];
}