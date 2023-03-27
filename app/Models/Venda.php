<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = ['cliente', 'itens', 'total', 'forma_pagamento', 'num_parcelas', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
