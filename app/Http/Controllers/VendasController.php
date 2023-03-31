<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Parcelas;
use App\Models\Vendas;
use Illuminate\Http\Request;
use Carbon\Carbon;


class VendasController extends Controller
{
    public function index()
    {
        $vendas = Vendas::with(['produto', 'user', 'cliente'])
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy('nome_venda');
        $totalGeral = Vendas::sum('total');

        return view('dashboard.listadevendas', compact('vendas'));
    }

    public function create()
    {
        $clientes = Clientes::all();
        return view('vendas.create', ['clientes' => $clientes]);
    }

    public function store(Request $request)
    {

        $venda = new Vendas;
        $venda->cliente_id = $request->cliente_id;
        $venda->usuario_id = auth()->user()->id;
        $venda->forma_pagamento = $request->forma_pagamento;
        $venda->save();

        $venda_id = $venda->id;
        $valorTotal = $request->input('total');
        if ($request->forma_pagamento === 'parcelado') {
            $numParcelas = $request->input('parcelado-quantidade');
            $valorParcela = $valorTotal / $numParcelas;
            for ($i = 1; $i <= $numParcelas; $i++) {
                $parcelas = new Parcelas;
                $parcelas->venda_id = $venda_id;
                $parcelas->datavencimento = Carbon::now()->addMonths($i)->endOfMonth()->toDateString();
                $parcelas->valor = $valorParcela;
                $parcelas->numParcelas = $numParcelas;
                $parcelas->save();
            }
        }
        return redirect()->back()->with('success', 'Venda cadastrada com sucesso!');
    }



    public function edit(Vendas $venda)
    {
        $vendaComParcelas = Vendas::with('parcelas')->find($venda->id);
        return view('vendas.edit', ['venda' => $vendaComParcelas]);
    }

    public function update(Request $request, Vendas $venda)
    {
        $venda->cliente_id = $request->cliente_id;
        $venda->forma_pagamento = $request->forma_pagamento;
        $venda->status = $request->status;
        $venda->save();
        return redirect()->route('vendas.index');
    }

    public function destroy(Vendas $venda)
    {
        $venda->delete();
        return redirect()->route('vendas.index');

    }
}
