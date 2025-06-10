<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class AtividadesController extends Controller
{

    public function cadastrarAtividade(){
        return view('cadastrarAtividade');
    }
    public function cadastrarAtividadeSubmit(Request $request){
        $request->validate(
            [
                'titulo' => 'required|string|max:60',
                'descricao' => 'required|string|max:255',
                'status' => 'required|string|max:60',
            ],
            [
                'titulo.required'      => 'O campo titulo é obrigatório.',
                'titulo.string'        => 'O campo titulo deve ser um texto.',
                'titulo.max'           => 'O campo titulo deve ter no máximo 60 caracteres.',

                'descricao.required'      => 'O campo descrição é obrigatório.',
                'descricao.string'        => 'O campo descrição deve ser um texto.',
                'descricao.max'           => 'O campo descrição deve ter no máximo 255 caracteres.',

                'status.required'      => 'O campo status é obrigatório.',
                'status.string'        => 'O campo status deve ser um texto.',
                'status.max'           => 'O campo status deve ter no máximo 60 caracteres.',
            ]
        );

        $atividades = json_decode(Storage::get('atividades.json'),true);

        $tiposStatusPermitidos = ['pendente'];

        if(!in_array($request->status,$tiposStatusPermitidos)){
            return redirect()->back()->withInput()->with('cadastroError', 'Esse status não é permitido!.'); 
        }

        $novaAtividade = [
            'id' => count($atividades)+1,
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'status' => $request->status,
        ];

        $atividades [] = $novaAtividade;

        Storage::put('atividades.json',json_encode($atividades, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route('admin')->with('success','Atividade cadastrada sucesso!');
    }
    public function showAtividade($id)
    {
        $idDescript = Crypt::decryptString($id);

        $atividades = json_decode(Storage::get('atividades.json'), true);

        foreach ($atividades as $atividade) {
            if ($idDescript == $atividade['id']) {
                return view('showAtividade', ['atividade' => $atividade]);
            }
        }
        return redirect()->route('admin')->with('cadastroError', 'Atividade não encontrada!');
    }

    public function editarAtividade(Request $request, $id)
    {
        $request->validate(
            [
                'titulo' => 'required|string|max:60',
                'descricao' => 'required|string|max:255',
                'status' => 'required|string|max:60',
            ],
            [
                'titulo.required'      => 'O campo titulo é obrigatório.',
                'titulo.string'        => 'O campo titulo deve ser um texto.',
                'titulo.max'           => 'O campo titulo deve ter no máximo 60 caracteres.',

                'descricao.required'      => 'O campo descrição é obrigatório.',
                'descricao.string'        => 'O campo descrição deve ser um texto.',
                'descricao.max'           => 'O campo descrição deve ter no máximo 255 caracteres.',

                'status.required'      => 'O campo status é obrigatório.',
                'status.string'        => 'O campo status deve ser um texto.',
                'status.max'           => 'O campo status deve ter no máximo 60 caracteres.',
            ]
        );

        $idDescriptado = Crypt::decryptString($id);

        $atividades = json_decode(Storage::get('atividades.json'), true);

        $tiposStstusPermitidos = ['pendente', 'concluido', 'cancelado'];

        foreach ($atividades as &$atividade) {
            if ($atividade['id'] == $idDescriptado) {
                $atividade['titulo'] = $request->input('titulo');
                $atividade['descricao'] = $request->input('descricao');
                if (in_array($request->status, $tiposStstusPermitidos)) {
                    $atividade['status'] = $request->input('status');
                }
                break;
            }
        }
        Storage::put('atividades.json', json_encode($atividades, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route('admin')->with('success', 'Atividade atualizada com sucesso!');
    }
}
