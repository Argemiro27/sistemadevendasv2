<?php

namespace App\Http\Controllers;

use App\Models\Vendas;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    // Retorna a lista de vendas
    public function index()
    {
        $vendas = Vendas::with('cliente', 'usuario')->get();
        return view('vendas.index', ['vendas' => $vendas]);
    }

    // Exibe o formulário para criação de uma nova venda
    public function create()
    {
        return view('vendas.create');
    }

    // Armazena uma nova venda no banco de dados
    public function store(Request $request)
    {
        $venda = new Vendas;
        $venda->cliente_id = $request->cliente_id;
        $venda->usuario_id = auth()->user()->id;
        $venda->forma_pagamento = $request->forma_pagamento;
        $venda->save();
        return redirect()->route('vendas.edit', ['venda' => $venda]);
    }

    // Exibe o formulário para edição de uma venda existente
    public function edit(Vendas $venda)
    {
        return view('vendas.edit', ['venda' => $venda]);
    }

    // Atualiza uma venda existente no banco de dados
    public function update(Request $request, Vendas $venda)
    {
        $venda->cliente_id = $request->cliente_id;
        $venda->forma_pagamento = $request->forma_pagamento;
        $venda->status = $request->status;
        $venda->save();
        return redirect()->route('vendas.index');
    }

    // Remove uma venda do banco de dados
    public function destroy(Vendas $venda)
    {
        $venda->delete();
        return redirect()->route('vendas.index');
    }
}
