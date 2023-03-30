<?php

namespace App\Http\Controllers;

use App\Models\ItensVenda;
use Illuminate\Http\Request;

class ItensVendaController extends Controller
{
    public function index()
    {
        $itensVenda = ItensVenda::with('produto')->get();
        return view('itens_venda.index', ['itensVenda' => $itensVenda]);
    }

    public function create()
    {
        return view('itens_venda.create');
    }

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

    public function edit(ItensVenda $itemVenda)
    {
        return view('itens_venda.edit', ['itemVenda' => $itemVenda]);
    }

    public function update(Request $request, ItensVenda $itemVenda)
    {
        $itemVenda->produto_id = $request->produto_id;
        $itemVenda->venda_id = $request->venda_id;
        $itemVenda->quantidade = $request->quantidade;
        $itemVenda->valortotal = $request->valortotal;
        $itemVenda->save();
        return redirect()->route('itens_venda.index');
    }
    public function destroy(ItensVenda $itemVenda)
    {
        $itemVenda->delete();
        return redirect()->route('itens_venda.index');
    }
}
