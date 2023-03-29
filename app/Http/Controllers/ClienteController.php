<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

public function create()
{
    $clientes = Cliente::all();
    return view('cadastrarvendas', ['clientes' => $clientes]);
}

    public function store(Request $request)
{
    $cliente = new Cliente();
    $cliente->nome = $request->nome;
    $cliente->telefone = $request->telefone;
    $cliente->cpf = $request->cpf;
    $cliente->save();

    return redirect()->back()->with('success', 'Cliente cadastrado com sucesso!');
}

public function autocomplete(Request $request)
{
    $term = $request->input('term');

    $clientes = Cliente::where('nome', 'LIKE', '%'.$term.'%')->limit(10)->get();

    $response = [];
    foreach ($clientes as $cliente) {
        $response[] = [
            'id' => $cliente->id,
            'value' => $cliente->nome,
        ];
    }

    return response()->json($response);
}
public function buscarClientes(Request $request)
{
    $query = $request->get('term', '');

    $clientes = Cliente::where('nome', 'LIKE', '%'. $query .'%')->get();

    $resultados = [];
    foreach ($clientes as $cliente) {
        $resultados[] = ['id' => $cliente->id, 'value' => $cliente->nome];
    }

    return response()->json($resultados);
}
}
