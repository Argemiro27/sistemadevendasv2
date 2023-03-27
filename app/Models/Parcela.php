<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    use HasFactory;

    protected $fillable = ['data', 'valor', 'observacoes'];

    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }
}
