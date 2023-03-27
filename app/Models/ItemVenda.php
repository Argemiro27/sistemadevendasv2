<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    use HasFactory;

    protected $fillable = ['item', 'valor'];

    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }
}
