<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItensVenda extends Model
{
    use HasFactory;

    protected $fillable = ['venda_id','produto_id', 'quantidade', 'valortotal'];

    public function produto()
    {
        return $this->belongsTo(Produtos::class);
    }
}
