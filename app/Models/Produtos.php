<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'preco'];

    public function itensVenda()
    {
        return $this->hasMany(ItensVenda::class);
    }
}
