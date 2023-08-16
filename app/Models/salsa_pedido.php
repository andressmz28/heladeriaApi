<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salsa_pedido extends Model
{
    protected $fillable = ['salsa_id', 'pedido_id']; // Ajusta los campos
    protected $table = 'salsa_pedido';
    public $timestamps = false;
}
