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
        return $this->belongsTo(User::class, 'usuario_id'); // Relação belongsTo: Ele vai procurar o usuário pelo usuario_id que está na tabela vendas.
    }

    public function itensVenda()
    {
        return $this->hasMany(ItensVenda::class, 'venda_id');
    }

    public function parcelas()
    {
        return $this->hasMany(Parcelas::class, 'venda_id')
        ->select(['id', 'venda_id', 'valor', 'datavencimento', 'numParcelas']);  // Relação hasMany: Está na tabela vendas, mas tem relação. Então toda parcela faz parte de uma venda. Mas nem toda venda é parcelada.
    }
}
