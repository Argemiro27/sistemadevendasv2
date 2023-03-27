<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = ['cliente', 'valor_total', 'forma_pagamento', 'quantidade_parcelas'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
