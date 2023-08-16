<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especial_pedido extends Model
{
    protected $fillable = ['especial_id', 'pedido_id']; // Ajusta los campos
    protected $table = 'especial_pedido';
    public $timestamps = false;
}

