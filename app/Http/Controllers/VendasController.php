<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\ItensVenda;
use App\Models\Parcelas;
use App\Models\Produtos;
use App\Models\Vendas;
use Illuminate\Http\Request;
use Carbon\Carbon;


class VendasController extends Controller
{
    public function index()
    {
        $vendas = Vendas::with(['usuario', 'parcelas', 'itensVenda'])->get();
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
        if ($request->forma_pagamento === 'Parcelado') {
            $numParcelas = $request->input('nparcelas');
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
        $produtos = Produtos::all();
        foreach ($produtos as $produto) {
            $quantidade = $request->input('quantidade.' . $produto->id);

            if ($quantidade > 0) {
                $itensvenda = new ItensVenda;
                $itensvenda->produto_id = $produto->id;
                $itensvenda->venda_id = $venda->id;
                $itensvenda->quantidade = $quantidade;
                $itensvenda->valortotal = $quantidade * $produto->preco;
                $itensvenda->save();
            }
        }
        return redirect()->back()->with('success', 'Venda cadastrada com sucesso!');
    }



    public function edit($id)
    {
        $venda = Vendas::find($id);
        $produtos = Produtos::all();
        $clientes = Clientes::orderBy('nome')->get();

        return view('dashboard.editarvenda', compact('venda', 'clientes'));
    }


    public function update(Request $request, $id)
    {
        $venda = Vendas::findOrFail($id);
        $venda->cliente_id = $request->cliente_id;
        $venda->usuario_id = auth()->user()->id;
        $venda->forma_pagamento = $request->forma_pagamento;
        $venda->save();

        $venda_id = $venda->id;
        $valorTotal = $request->input('total');

        // deleta as parcelas anteriores
        Parcelas::where('venda_id', $venda_id)->delete();

        if ($request->forma_pagamento === 'Parcelado') {
            $numParcelas = $request->input('nparcelas');
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

        // deleta os itens da venda anteriores
        ItensVenda::where('venda_id', $venda_id)->delete();

        $produtos = Produtos::all();
        foreach ($produtos as $produto) {
            $quantidade = $request->input('quantidade.' . $produto->id);

            if ($quantidade > 0) {
                $itensvenda = new ItensVenda;
                $itensvenda->produto_id = $produto->id;
                $itensvenda->venda_id = $venda->id;
                $itensvenda->quantidade = $quantidade;
                $itensvenda->valortotal = $quantidade * $produto->preco;
                $itensvenda->save();
            }
        }

        return redirect()->back()->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $venda = Vendas::findOrFail($id);

        $venda->delete($venda);

        return redirect()->back()->with('success', 'Venda excluída com sucesso!');
    }

}
