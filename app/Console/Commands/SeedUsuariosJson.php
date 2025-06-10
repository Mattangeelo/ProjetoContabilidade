<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SeedUsuariosJson extends Command
{
    protected $signature = 'json:seed-usuarios';
    protected $description = 'Popula o arquivo usuarios.json com dados de exemplo';

    public function handle()
    {
        $usuarios = [
            [
                "id" => 1,
                "nome" => "Matheus Angelo",
                "email" => "admin@admin.com",
                "senha" => bcrypt("123456"),
                "admin" => true
            ],
        ];

        Storage::put('usuarios.json', json_encode($usuarios, JSON_PRETTY_PRINT));
        $this->info("usuarios.json populado com sucesso!");
    }
}