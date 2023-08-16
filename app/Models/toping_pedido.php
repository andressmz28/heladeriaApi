<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class toping_pedido extends Model
{
    protected $fillable = ['toping_id', 'pedido_id']; // Ajusta los campos
    protected $table = 'toping_pedido';
    public $timestamps = false;
}
