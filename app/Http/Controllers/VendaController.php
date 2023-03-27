<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Venda;

class VendaController extends Controller
{
    public function create()
    {
        return view('vendas.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $venda = new Venda();
        $venda->cliente = $request->input('cliente');
        $venda->itens = $request->input('itens');
        $venda->valor_total = $request->input('total');
        $venda->forma_pagamento = $request->input('forma_pagamento');
        if ($venda->forma_pagamento == 'parcelado') {
            $venda->num_parcelas = $request->input('num_parcelas');
        }
        $venda->user_id = $user->id;
        $venda->save();

        return redirect()->route('vendas.index')->with('success', 'Venda cadastrada com sucesso!');
    }

    public function index()
    {
        $user = Auth::user();
        $vendas = Venda::where('user_id', $user->id)->get();
        return view('vendas.index', compact('vendas'));
    }

    public function edit($id)
    {
        $venda = Venda::find($id);
        return view('vendas.edit', compact('venda'));
    }

    public function update(Request $request, $id)
    {
        $venda = Venda::find($id);
        $venda->cliente = $request->input('cliente');
        $venda->itens = $request->input('itens');
        $venda->valor_total = $request->input('total');
        $venda->forma_pagamento = $request->input('forma_pagamento');
        if ($venda->forma_pagamento == 'parcelado') {
            $venda->num_parcelas = $request->input('num_parcelas');
        }
        $venda->save();

        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $venda = Venda::find($id);
        $venda->delete();

        return redirect()->route('vendas.index')->with('success', 'Venda excluída com sucesso!');
    }
}
