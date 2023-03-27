<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\VendaItem;

class CadastraVendaController extends Controller
{
    public function index()
    {
        $cadastravenda = Venda::with('itens')->where('user_id', auth()->user()->id)->get();
        return view('cadastravenda.index', compact('cadastravenda'));
    }

    public function create()
    {
        return view('cadastravenda.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cliente' => 'required',
            'itens.*.nome' => 'required',
            'itens.*.valor' => 'required|numeric',
            'pagamento' => 'required',
        ]);

        $user = auth()->user();
        $venda = new Venda();
        $venda->cliente = $validatedData['cliente'];
        $venda->pagamento = $validatedData['pagamento'];
        $venda->user_id = $user->id;
        $venda->save();

        foreach ($validatedData['itens'] as $item) {
            $vendaItem = new VendaItem();
            $vendaItem->nome = $item['nome'];
            $vendaItem->valor = $item['valor'];
            $vendaItem->venda_id = $venda->id;
            $vendaItem->save();
        }

        return redirect()->route('cadastravenda.index')->with('success', 'Venda cadastrada com sucesso.');
    }

    public function show(Venda $venda)
    {
        return view('cadastravenda.show', compact('venda'));
    }

    public function edit(Venda $venda)
    {
        return view('cadastravenda.edit', compact('venda'));
    }

    public function update(Request $request, Venda $venda)
    {
        $validatedData = $request->validate([
            'cliente' => 'required',
            'itens.*.nome' => 'required',
            'itens.*.valor' => 'required|numeric',
            'pagamento' => 'required',
        ]);

        $venda->cliente = $validatedData['cliente'];
        $venda->pagamento = $validatedData['pagamento'];
        $venda->save();

        $venda->itens()->delete();

        foreach ($validatedData['itens'] as $item) {
            $vendaItem = new VendaItem();
            $vendaItem->nome = $item['nome'];
            $vendaItem->valor = $item['valor'];
            $vendaItem->venda_id = $venda->id;
            $vendaItem->save();
        }

        return redirect()->route('cadastravenda.index')->with('success', 'Venda atualizada com sucesso.');
    }

    public function destroy(Venda $venda)
    {
        $venda->itens()->delete();
        $venda->delete();

        return redirect()->route('cadastravenda.index')->with('success', 'Venda excluída com sucesso.');
    }
}
