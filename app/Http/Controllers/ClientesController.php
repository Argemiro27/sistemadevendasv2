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

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $cliente = new Clientes;
        $cliente->nome = $request->nome;
        $cliente->save();
        return redirect()->back()->with('success', 'Produto cadastrado com sucesso!');
    }

    public function edit(Clientes $cliente)
    {
        return view('clientes.edit', ['cliente' => $cliente]);
    }

    public function update(Request $request, Clientes $cliente)
    {
        $cliente->nome = $request->nome;
        $cliente->save();
        return redirect()->route('clientes.index');
    }
    public function destroy(Clientes $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index');
    }
    public function buscar(Request $request)
    {
        $termo = $request->input('termo');
        $clientes = Clientes::where('nome', 'LIKE', '%'.$termo.'%')->get();

        return response()->json($clientes);
    }
}
