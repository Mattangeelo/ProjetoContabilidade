<?php

namespace App\Console\Commands;


use Illuminate\Support\Facades\Storage;

use Illuminate\Console\Command;

class SeedClientesJson extends Command
{
   protected $signature = 'json:seed-clientes';
    protected $description = 'Popula o arquivo clientes.json com dados de exemplo';

    public function handle()
    {
        $usuarios = [
            [
                "id" => 1,
                "razao_social" => "Exemplo empresa ltda",
                "cnpj" => "99.189.469/0001-88",
                "email" => "empres@email.com",
                "mensalidade" => 250,
                "cnae" => "8211-3/00",
                "categoria_empresa" => "Simples Nacional",
                "representante" => "Ze da silva",
                "cpf_representante" => "782.472.600-26"
            ],
        ];

        Storage::put('clientes.json', json_encode($usuarios, JSON_PRETTY_PRINT));
        $this->info("clientes.json populado com sucesso!");
    }
}
