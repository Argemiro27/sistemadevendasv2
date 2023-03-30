<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produtos::all();
        return view('produtos.index', ['produtos' => $produtos]);
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $produto = new Produtos;
        $produto->nome = $request->nome;
        $produto->preco = $request->preco;
        $produto->save();
        return redirect()->back()->with('success', 'Produto cadastrado com sucesso!');
    }

    public function edit(Produtos $produto)
    {
        return view('produtos.edit', ['produto' => $produto]);
    }

    public function update(Request $request, Produtos $produto)
    {
        $produto->nome = $request->nome;
        $produto->preco = $request->preco;
        $produto->save();
        return redirect()->route('produtos.index');
    }

    public function destroy(Produtos $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index');
    }
    public function buscar(Request $request)
{
    $termo = $request->get('termo');

    $produtos = Produtos::where('nome', 'like', "%$termo%")->get();

    return response()->json($produtos);
}

}
