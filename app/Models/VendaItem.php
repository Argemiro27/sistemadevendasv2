<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaItem extends Model
{
    use HasFactory;

    protected $fillable = ['nome_item', 'valor_item'];

    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }
}
