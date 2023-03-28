<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
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
                $venda->nome_venda = $nome_venda; // adicionando o valor de $nome_venda à propriedade nome_venda
                $venda->save();
            }
        }

        // Salva o valor total da venda no banco de dados
        $venda = Venda::latest()->first();
        $venda->total = $total;
        $venda->save();

        return redirect()->route('dashboard.pagamento')->with('venda_id', $venda->id);
    }



    public function destroy($id)
    {
        // Encontra a venda que deseja excluir
        $venda = Venda::findOrFail($id);

        // Busca todas as vendas com o mesmo nome
        $vendas = Venda::where('nome_venda', $venda->nome_venda)->get();

        // Exclui todas as vendas encontradas
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

}
