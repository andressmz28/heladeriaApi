<?php

namespace App\Models;
use App\Models\Dulce;
use App\Models\Especial;
use App\Models\Fruta;
use App\Models\Helado;
use App\Models\Licor;
use App\Models\Toping;
use App\Models\Salsa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

public function dulces()
{
    return $this->belongsToMany(Dulce::class, 'dulce_pedido');
}

public function especiales()
{
    return $this->belongsToMany(Especial::class, 'especial_pedido');
}

public function frutas()
{
    return $this->belongsToMany(Fruta::class, 'fruta_pedido');
}

public function helado()
{
    return $this->belongsTo(Helado::class);
}

public function licor()
{
    return $this->belongsTo(Licor::class);
}

public function topings()
{
    return $this->belongsToMany(Toping::class, 'toping_pedido');
}

public function salsas()
{
    return $this->belongsToMany(Salsa::class, 'salsa_pedido');
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
