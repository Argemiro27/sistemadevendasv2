<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'usuario_id', 'forma_pagamento', 'status'];

    public function cliente()
    {
        return $this->belongsTo(Clientes::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function itensVenda()
    {
        return $this->hasMany(ItensVenda::class);
    }

    public function parcelas()
    {
        return $this->hasMany(Parcelas::class);
    }
}
