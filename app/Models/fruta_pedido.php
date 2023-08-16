<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fruta_pedido extends Model
{
    protected $fillable = ['fruta_id', 'pedido_id']; // Ajusta los campos
    protected $table = 'fruta_pedido';
    public $timestamps = false;
}
