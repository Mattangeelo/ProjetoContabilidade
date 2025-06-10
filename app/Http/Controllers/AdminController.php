<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {

        $clientes = json_decode(Storage::get('clientes.json'), true);
        $atividades = json_decode(Storage::get('atividades.json'), true);

        $faturamento = 0;
        foreach ($clientes as $cliente) {
            $faturamento += $cliente['mensalidade'];
        }


        return view('admin', compact('clientes', 'faturamento', 'atividades'));
    }

    public function relatorio(Request $request)
    {
        $tipo = $request->query('tipo');

        if ($tipo === 'clientes') {
            $arquivo = 'clientes.json';
        } elseif ($tipo === 'faturamento') {
            $arquivo = 'atividades.json';
        } else {
            return redirect()->back()->with('erro', 'Tipo de relatório inválido.');
        }

        if (!Storage::exists($arquivo)) {
            return redirect()->back()->with('erro', 'Arquivo JSON não encontrado.');
        }

        $conteudo = Storage::get($arquivo);
        $dados = json_decode($conteudo, true);

        return view('relatorio', [
            'dados' => $dados,
            'tipo' => $tipo
        ]);
    }
}
