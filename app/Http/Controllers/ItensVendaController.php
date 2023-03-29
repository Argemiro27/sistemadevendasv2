<?php

namespace App\Http\Controllers;

use App\Models\ItensVenda;
use Illuminate\Http\Request;

class ItensVendaController extends Controller
{
    // Retorna a lista de itens de venda
    public function index()
    {
        $itensVenda = ItensVenda::with('produto')->get();
        return view('itens_venda.index', ['itensVenda' => $itensVenda]);
    }

    // Exibe o formulário para criação de um novo item de venda
    public function create()
    {
        return view('itens_venda.create');
    }

    // Armazena um novo item de venda no banco de dados
    public function store(Request $request)
    {
        $itemVenda = new ItensVenda;
        $itemVenda->produto_id = $request->produto_id;
        $itemVenda->venda_id = $request->venda_id;
        $itemVenda->quantidade = $request->quantidade;
        $itemVenda->valortotal = $request->valortotal;
        $itemVenda->save();
        return redirect()->route('itens_venda.edit', ['itemVenda' => $itemVenda]);
    }

    // Exibe o formulário para edição de um item de venda existente
    public function edit(ItensVenda $itemVenda)
    {
        return view('itens_venda.edit', ['itemVenda' => $itemVenda]);
    }

    // Atualiza um item de venda existente no banco de dados
    public function update(Request $request, ItensVenda $itemVenda)
    {
        $itemVenda->produto_id = $request->produto_id;
        $itemVenda->venda_id = $request->venda_id;
        $itemVenda->quantidade = $request->quantidade;
        $itemVenda->valortotal = $request->valortotal;
        $itemVenda->save();
        return redirect()->route('itens_venda.index');
    }

    // Remove um item de venda do banco de dados
    public function destroy(ItensVenda $itemVenda)
    {
        $itemVenda->delete();
        return redirect()->route('itens_venda.index');
    }
}
