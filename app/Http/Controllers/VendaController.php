<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Venda;
use App\Models\ItemVenda;
use App\Models\Parcela;

class VendaController extends Controller
{
    public function index()
    {
        // Obtém as vendas do usuário autenticado
        $vendas = Auth::user()->vendas()->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.listagemdevendas', ['vendas' => $vendas]);
    }

    public function create()
    {
        return view('dashboard.cadastrarvendas');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cliente' => 'required|string',
            'item.*' => 'required|string',
            'valor.*' => 'required|numeric',
            'forma_pagamento' => 'required|string|in:a_vista,parcelado',
            'num_parcelas' => 'required_if:forma_pagamento,parcelado|integer|min:1|max:12',
            'parcela.*.data' => 'required_if:forma_pagamento,parcelado|date',
            'parcela.*.valor' => 'required_if:forma_pagamento,parcelado|numeric',
            'parcela.*.observacao' => 'nullable|string'
        ]);

        $venda = new Venda();
        $venda->cliente = $validatedData['cliente'];
        $venda->total = array_sum($validatedData['valor']);
        $venda->forma_pagamento = $validatedData['forma_pagamento'];
        $venda->user_id = Auth::user()->id;
        $venda->save();

        for ($i = 0; $i < count($validatedData['item']); $i++) {
            $item = new ItemVenda();
            $item->item = $validatedData['item'][$i];
            $item->valor = $validatedData['valor'][$i];
            $item->venda_id = $venda->id;
            $item->save();
        }

        if ($validatedData['forma_pagamento'] === 'parcelado') {
            foreach ($validatedData['parcela'] as $parcelaData) {
                $parcela = new Parcela();
                $parcela->data = $parcelaData['data'];
                $parcela->valor = $parcelaData['valor'];
                $parcela->observacao = $parcelaData['observacao'];
                $parcela->venda_id = $venda->id;
                $parcela->save();
            }
        }

        return redirect()->route('listagemdevendas')->with('success', 'Venda cadastrada com sucesso.');
    }
}
