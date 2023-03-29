<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    // Retorna a lista de clientes
    public function index()
    {
        $clientes = Clientes::all();
        return view('clientes.index', ['clientes' => $clientes]);
    }

    // Exibe o formulário para criação de um novo cliente
    public function create()
    {
        return view('clientes.create');
    }

    // Armazena um novo cliente no banco de dados
    public function store(Request $request)
    {
        $cliente = new Clientes;
        $cliente->nome = $request->nome;
        $cliente->save();
        return redirect()->back()->with('success', 'Produto cadastrado com sucesso!');
    }

    // Exibe o formulário para edição de um cliente existente
    public function edit(Clientes $cliente)
    {
        return view('clientes.edit', ['cliente' => $cliente]);
    }

    // Atualiza um cliente existente no banco de dados
    public function update(Request $request, Clientes $cliente)
    {
        $cliente->nome = $request->nome;
        $cliente->save();
        return redirect()->route('clientes.index');
    }

    // Remove um cliente do banco de dados
    public function destroy(Clientes $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index');
    }
}
