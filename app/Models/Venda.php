<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente',
        'itens',
        'total',
        'forma_pagamento',
        'num_parcelas',
        'user_id', // campo para armazenar o id do usuário que fez a venda
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
