<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    // ...
    protected $fillable = ['venda_id', 'numero', 'valor', 'data_vencimento'];
    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }
}
