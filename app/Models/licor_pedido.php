<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class licor_pedido extends Model
{
    protected $fillable = ['licor_id', 'pedido_id']; // Ajusta los campos
    protected $table = 'licor_pedido';
    public $timestamps = false;
}
