<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Parcela;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendaController extends Controller
{
    public function index()
    {
        $vendas = Venda::with(['produto', 'user', 'cliente'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('nome_venda');
        $totalGeral = Venda::sum('total');

        return view('dashboard.listagemdevendas', compact('vendas'));
    }



    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        return view('dashboard.cadastrarvendas', compact('clientes', 'produtos'));
    }

    public function store(Request $request)
    {
        $cliente_id = $request->input('cliente_id');
        $produtos = $request->input('produtos');
        $nome_venda = $request->input('nome_venda');
        $forma_pagamento = $request->input('forma_pagamento');
        $qtd_parcelas = $request->input('qtd_parcelas');
        $total = 0;

        foreach ($produtos as $produto_id => $quantidade) {
            if ($quantidade > 0) {
                $produto = Produto::find($produto_id);
                $total += $produto->preco * $quantidade;

                $venda = new Venda;
                $venda->cliente_id = $cliente_id;
                $venda->produto_id = $produto_id;
                $venda->quantidade = $quantidade;
                $venda->user_id = Auth::id();
                $venda->nome_venda = $nome_venda;
                $venda->forma_pagamento = $forma_pagamento;
                $venda->qtd_parcelas = $qtd_parcelas;
                $venda->total = $total;
                $venda->save();
            }
        }

        if ($forma_pagamento == 'parcelado') {
            $qtd_parcelas = intval(request('qtd_parcelas'));
            $valorParcela = $total / $qtd_parcelas;
            $vendaId = $venda->id;
            for ($i = 1; $i <= $qtd_parcelas; $i++) {
                $dataVencimento = date('Y-m-d', strtotime("+{$i} month"));
                $parcelas = new Parcela();
                $parcelas->venda_id = $vendaId;
                $parcelas->numero = $i;
                $parcelas->valor = $valorParcela;
                $parcelas->data_vencimento = $dataVencimento;
                $parcelas->save();
            }
        }

        return redirect()->route('vendas.index')->with('success', 'Venda cadastrada com sucesso!');
    }



    public function destroy($id)
    {

        $venda = Venda::findOrFail($id);

        $vendas = Venda::where('nome_venda', $venda->nome_venda)->get();

        foreach ($vendas as $v) {
            $v->delete();
        }

        return redirect()->route('vendas.index')->with('success', 'Venda excluída com sucesso.');
    }

    public function update(Request $request)
    {
        $venda = Venda::findOrFail($request->input('pk'));
        $venda->{$request->input('name')} = $request->input('value');
        $venda->save();

        return response()->json(['status' => 'success']);
    }
    public function pagamento(Venda $venda)
    {
        return view('dashboard.vendas.pagamento', compact('venda'));
    }

}
