<?php

namespace App\Console\Commands;


use Illuminate\Support\Facades\Storage;

use Illuminate\Console\Command;

class SeedAtividadesJson extends Command
{
    protected $signature = 'json:seed-atividades';
    protected $description = 'Popula o arquivo atividades.json com dados de exemplo';

    public function handle()
    {
        $usuarios = [
            [
                "id" => 1,
                "titulo" => "Gerar folha de pagamento",
                "Descricao" => "Gerar folha de pagamentos para o dia 20/07 das empresas do simples e lucro real ou presumido",
            ],
        ];

        Storage::put('atividades.json', json_encode($usuarios, JSON_PRETTY_PRINT));
        $this->info("atividades.json populado com sucesso!");
    }
}
