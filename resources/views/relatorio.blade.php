<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('imagens/mini.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Relatório de {{ $tipo === 'clientes' ? 'Clientes' : 'Atividades' }}</h2>

        <div>
            <button onclick="window.print()" class="btn btn-outline-secondary me-2">
                <i class="bi bi-printer"></i> Imprimir
            </button>

            <a href="#" class="btn btn-outline-danger">
                <i class="bi bi-file-earmark-pdf"></i> Gerar PDF
            </a>
        </div>
    </div>

    @if(session('erro'))
        <div class="alert alert-danger">
            {{ session('erro') }}
        </div>
    @endif

    @if(!empty($dados) && is_array($dados) && count($dados))
        <div class="table-responsive">
            <table class="table table-bordered table-striped shadow">
                <thead class="table-dark">
                    <tr>
                        @foreach(array_keys($dados[0]) as $coluna)
                            <th>{{ ucfirst(str_replace('_', ' ', $coluna)) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($dados as $item)
                        <tr>
                            @foreach($item as $valor)
                                <td>{{ is_array($valor) ? json_encode($valor) : $valor }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning">
            Nenhum dado encontrado para este relatório.
        </div>
    @endif

    <a href="{{ route('admin') }}" class="btn btn-secondary mt-4">Voltar</a>
</div>