<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Parcelas;
use App\Models\Vendas;
use Illuminate\Http\Request;
use Carbon\Carbon;


class VendasController extends Controller
{
    // Retorna a lista de vendas
    public function index()
    {
        $vendas = Vendas::with(['produto', 'user', 'cliente'])
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy('nome_venda');
        $totalGeral = Vendas::sum('total');

        return view('dashboard.listadevendas', compact('vendas'));
    }

    // Exibe o formulário para criação de uma nova venda
    public function create()
    {
        $clientes = Clientes::all();
        return view('vendas.create', ['clientes' => $clientes]);
    }

    // Armazena uma nova venda no banco de dados
    public function store(Request $request)
    {

        $venda = new Vendas;
        $venda->cliente_id = $request->cliente_id;
        $venda->usuario_id = auth()->user()->id;
        $venda->forma_pagamento = $request->forma_pagamento;
        $venda->save();

        // recuperar o ID da venda recém-criada
        $venda_id = $venda->id;
        $valorTotal = $request->input('total');
        // criar registros na tabela parcelas, se a forma de pagamento for parcelado
        if ($request->forma_pagamento === 'parcelado') {
            $numParcelas = $request->input('parcelado-quantidade');
            $valorParcela = $valorTotal / $numParcelas;
            for ($i = 1; $i <= $numParcelas; $i++) {
                $parcela = new Parcelas;
                $parcela->venda_id = $venda_id;
                $parcela->datavencimento = Carbon::now()->addMonths($i)->endOfMonth()->toDateString();
                $parcela->valor = $valorParcela;
                $parcela->numParcelas = $numParcelas;
                $parcela->save();
            }
        }
        return redirect()->back()->with('success', 'Venda cadastrada com sucesso!');
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
