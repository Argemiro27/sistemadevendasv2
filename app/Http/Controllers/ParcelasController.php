<?php

namespace App\Http\Controllers;

use App\Models\Parcelas;
use Illuminate\Http\Request;

class ParcelaController extends Controller
{
    public function index()
    {
        $parcelas = Parcelas::all();

        return view('parcelas.index', compact('parcelas'));
    }

    public function create()
    {
        // Obtém o ID da venda para a qual a parcela será criada
        $venda_id = request('venda_id');

        return view('parcelas.create', compact('venda_id'));
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'venda_id' => 'required',
            'datavencimento' => 'required|date',
            'valor' => 'required|numeric',
            'numParcelas' => 'required|string'
        ]);

        // Criação da parcela no banco de dados
        $parcela = new Parcelas();
        $parcela->venda_id = $request->venda_id;
        $parcela->datavencimento = $request->datavencimento;
        $parcela->valor = $request->valor;
        $parcela->numParcelas = $request->numParcelas;
        $parcela->save();

        // Redirecionamento para a página de detalhes da venda
        return redirect()->route('vendas.show', $request->venda_id)->with('success', 'Parcela criada com sucesso.');
    }

    public function show(Parcelas $parcela)
    {
        return view('parcelas.show', compact('parcela'));
    }

    public function edit(Parcelas $parcela)
    {
        return view('parcelas.edit', compact('parcela'));
    }

    public function update(Request $request, Parcelas $parcela)
    {
        // Validação dos dados do formulário
        $request->validate([
            'datavencimento' => 'required|date',
            'valor' => 'required|numeric',
            'numParcelas' => 'required|string',
        ]);

        // Atualização da parcela no banco de dados
        $parcela->datavencimento = $request->datavencimento;
        $parcela->valor = $request->valor;
        $parcela->numParcelas = $request->numParcelas;
        $parcela->save();

        // Redirecionamento para a página de detalhes da venda
        return redirect()->route('vendas.show', $parcela->venda_id)->with('success', 'Parcela atualizada com sucesso.');
    }

    public function destroy(Parcelas $parcela)
    {
        // Exclusão da parcela do banco de dados
        $parcela->delete();

        // Redirecionamento para a página de detalhes da venda
        return redirect()->route('vendas.show', $parcela->venda_id)->with('success', 'Parcela excluída com sucesso.');
    }
}
