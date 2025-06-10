<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index(){
        return view('cadastrarCliente');
    }

    public function cadastrarSubmit(Request $request){
        $request->validate(
                [
                'razao_social'        => 'required|string|max:255',
                'cnpj'                => 'required|string|regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/',
                'email'               => 'required|email|max:255',
                'mensalidade'         => 'required|numeric|min:0',
                'cnae'                => 'required|string|max:20',
                'categoria_empresa'   => 'required|string|max:100',
                'representante'       => 'required|string|max:255',
                'cpf_representante'   => 'required|string|regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/',
                ],
                [
                'razao_social.required'      => 'O campo razão social é obrigatório.',
                'razao_social.string'        => 'O campo razão social deve ser um texto.',
                'razao_social.max'           => 'O campo razão social deve ter no máximo 255 caracteres.',

                'cnpj.required'              => 'O campo CNPJ é obrigatório.',
                'cnpj.string'                => 'O campo CNPJ deve ser um texto.',
                'cnpj.size'                  => 'O CNPJ deve ter exatamente 14 números (sem pontos ou traços).',
                'cnpj.regex'                => 'O CNPJ deve estar no formato 00.000.000/0000-00.',

                'email.required'            => 'O campo e-mail é obrigatório.',
                'email.email'               => 'Informe um e-mail válido.',
                'email.max'                 => 'O campo e-mail deve ter no máximo 255 caracteres.',

                'mensalidade.required'      => 'O campo mensalidade é obrigatório.',
                'mensalidade.numeric'       => 'A mensalidade deve ser um número.',
                'mensalidade.min'           => 'A mensalidade não pode ser negativa.',

                'cnae.required'             => 'O campo CNAE é obrigatório.',
                'cnae.string'               => 'O CNAE deve ser um texto.',
                'cnae.max'                  => 'O CNAE deve ter no máximo 20 caracteres.',

                'categoria_empresa.required'=> 'O campo categoria da empresa é obrigatório.',
                'categoria_empresa.string'  => 'A categoria da empresa deve ser um texto.',
                'categoria_empresa.max'     => 'A categoria da empresa deve ter no máximo 100 caracteres.',

                'representante.required'    => 'O campo representante é obrigatório.',
                'representante.string'      => 'O nome do representante deve ser um texto.',
                'representante.max'         => 'O nome do representante deve ter no máximo 255 caracteres.',

                'cpf_representante.required'=> 'O campo CPF do representante é obrigatório.',
                'cpf_representante.string'  => 'O CPF do representante deve ser um texto.',
                'cpf_representante.size'    => 'O CPF deve ter exatamente 11 números (sem pontos ou traços).',
                'cpf_representante.regex'   => 'O CPF deve estar no formato 000.000.000-00.',
            ]
        );

        $clientes =  json_decode(Storage::get('clientes.json'),true);
        foreach($clientes as $cliente){
            if($cliente['cnpj'] === $request->cnpj){
                return redirect()->back()->withInput()->with('cadastroError', 'Esse cliente já se encontra cadastrado!.'); 
            }
        }
        $tiposCategoriaPermitidos = ['simples_Nacional','lucro_Presumido','lucro_Real','mei'];

        if(!in_array($request->categoria_empresa,$tiposCategoriaPermitidos)){
            return redirect()->back()->withInput()->with('cadastroError', 'Esse tipo de empresa não é permitido!.'); 
        }



        $novoCliente = [
            'id' => count($cliente) + 1,
            'razao_social' => $request->razao_social,
            'cnpj' => $request->cnpj,
            'email' => $request->email,
            'mensalidade' => $request->mensalidade,
            'cnae' => $request->cnae,
            'categoria_empresa' => $request->categoria_empresa,
            'representante' => $request->representante,
            'cpf_representante' => $request->cpf_representante,
        ];

        $clientes [] = $novoCliente;

        Storage::put('clientes.json',json_encode($clientes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route('admin')->with('success','Cliente cadastrado sucesso!');

    }

    public function show($cnpjCrip){
        $cnpj = Crypt::decryptString($cnpjCrip);

        $clientes = json_decode(Storage::get('clientes.json'),true);

        foreach($clientes as $cliente){
            if($cnpj === $cliente['cnpj']){
                return view('showCliente',['cliente'=>$cliente]);
            }
        }
        return redirect()->route('admin')->with('cadastroError', 'Cliente não encontrado!');
    }

    public function editarCliente(Request $request,$cnpjCrip){
        $request->validate(
                [
                'razao_social'        => 'required|string|max:255',
                'cnpj'                => 'required|string|regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/',
                'email'               => 'required|email|max:255',
                'mensalidade'         => 'required|numeric|min:0',
                'cnae'                => 'required|string|max:20',
                'categoria_empresa'   => 'required|string|max:100',
                'representante'       => 'required|string|max:255',
                'cpf_representante'   => 'required|string|regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/',
                ],
                [
                'razao_social.required'      => 'O campo razão social é obrigatório.',
                'razao_social.string'        => 'O campo razão social deve ser um texto.',
                'razao_social.max'           => 'O campo razão social deve ter no máximo 255 caracteres.',

                'cnpj.required'              => 'O campo CNPJ é obrigatório.',
                'cnpj.string'                => 'O campo CNPJ deve ser um texto.',
                'cnpj.size'                  => 'O CNPJ deve ter exatamente 14 números (sem pontos ou traços).',
                'cnpj.regex'                => 'O CNPJ deve estar no formato 00.000.000/0000-00.',

                'email.required'            => 'O campo e-mail é obrigatório.',
                'email.email'               => 'Informe um e-mail válido.',
                'email.max'                 => 'O campo e-mail deve ter no máximo 255 caracteres.',

                'mensalidade.required'      => 'O campo mensalidade é obrigatório.',
                'mensalidade.numeric'       => 'A mensalidade deve ser um número.',
                'mensalidade.min'           => 'A mensalidade não pode ser negativa.',

                'cnae.required'             => 'O campo CNAE é obrigatório.',
                'cnae.string'               => 'O CNAE deve ser um texto.',
                'cnae.max'                  => 'O CNAE deve ter no máximo 20 caracteres.',

                'categoria_empresa.required'=> 'O campo categoria da empresa é obrigatório.',
                'categoria_empresa.string'  => 'A categoria da empresa deve ser um texto.',
                'categoria_empresa.max'     => 'A categoria da empresa deve ter no máximo 100 caracteres.',

                'representante.required'    => 'O campo representante é obrigatório.',
                'representante.string'      => 'O nome do representante deve ser um texto.',
                'representante.max'         => 'O nome do representante deve ter no máximo 255 caracteres.',

                'cpf_representante.required'=> 'O campo CPF do representante é obrigatório.',
                'cpf_representante.string'  => 'O CPF do representante deve ser um texto.',
                'cpf_representante.size'    => 'O CPF deve ter exatamente 11 números (sem pontos ou traços).',
                'cpf_representante.regex'   => 'O CPF deve estar no formato 000.000.000-00.',
            ]
        );

        $cnpjDescriptado = Crypt::decryptString($cnpjCrip);

        $clientes = json_decode(Storage::get('clientes.json'),true);

        $tiposCategoriaPermitidos = ['simples_Nacional','lucro_Presumido','lucro_Real','mei'];


        foreach($clientes as &$cliente){
            if($cliente['cnpj'] === $cnpjDescriptado){
                $cliente['razao_social'] = $request->input('razao_social');
                $cliente['email'] = $request->input('email');
                $cliente['mensalidade'] = $request->input('mensalidade');
                $cliente['cnae'] = $request->input('cnae');
                if(in_array($request->categoria_empresa,$tiposCategoriaPermitidos)){
                    $cliente['categoria_empresa'] = $request->input('categoria_empresa'); 
                }
                $cliente['representante'] = $request->input('representante');
                break;
            }
        }

         Storage::put('clientes.json', json_encode($clientes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route('admin')->with('success','Cliente atualizado com sucesso!');
    }
}
