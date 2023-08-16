<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dulce_pedido extends Model
{
    protected $fillable = ['dulce_id', 'pedido_id']; // Ajusta los campos
    protected $table = 'dulce_pedido';
    public $timestamps = false;
}
