@php
    $pagina = request()->get('pagina', 1);
    $clientesPorPagina = 5;
    $totalClientes = count($clientes);
    $clientesPaginados = array_slice($clientes, ($pagina - 1) * $clientesPorPagina, $clientesPorPagina);
    $totalPaginas = ceil($totalClientes / $clientesPorPagina);
@endphp

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

<body style="background-color: #f8f9fa;">

    <div class="d-flex">
        <div id="sidebar" class="bg-dark text-white p-3 vh-100 position-fixed" style="width: 250px;">
            <h4 class="fw-bold mb-4">Menu</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="{{route('admin')}}" class="nav-link text-white">Dashboard</a></li>
                <li class="nav-item"><a href="{{route('CadastrarCliente')}}" class="nav-link text-white">Clientes</a>
                </li>
                <li class="nav-item"><a href="{{route('cadastrarAtividade')}}"
                        class="nav-link text-white">Atividades</a></li>
                <li class="nav-item"><a href="{{route('logout')}}" class="nav-link text-white">Sair</a></li>
            </ul>
        </div>


        <div class="flex-grow-1" style="margin-left: 250px; transition: margin-left 0.3s;" id="main-content">
            <div class="container py-4">
                <button class="btn btn-outline-secondary mb-3" id="toggleSidebar">
                    ☰
                </button>

                <div class="text-center mb-4">
                    <img src="{{ asset('imagens/logo.png') }}" alt="Logo Contabilidade Angelos" class="logo mb-2">

                </div>

                <div class="row g-4">

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Clientes</h5>
                            <ul class="list-group list-group-flush">
                                @foreach ($clientes as $cliente)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $cliente['razao_social'] }} - {{ $cliente['cnpj'] }}
                                        <div>
                                            <a href="{{ route('showCliente', ['cnpj' => Crypt::encryptString($cliente['cnpj'])]) }}"
                                                class="btn btn-sm btn-primary">
                                                Visualizar
                                            </a>
                                            <button class="btn btn-sm btn-danger">Excluir</button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="mt-3">
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item disabled"><a class="page-link" href="#">Anterior</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Próxima</a></li>
                                    </ul>
                                    <div class="text-end mt-3">
                                        <a href="{{route('CadastrarCliente')}}" class="btn btn-success">Cadastrar
                                            Cliente</a>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Faturamento Mensal</h5>
                            <p class="display-6 text-success">
                                R$ {{ number_format($faturamento, 2, ',', '.') }}
                            </p>
                            <small class="text-muted">Atualizado em {{ date('d/m/Y') }}</small>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Atividades</h5>
                            <ul class="list-group list-group-flush">
                                @forelse ($atividades as $atividade)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $atividade['titulo'] }}</strong><br>
                                            {{ $atividade['descricao'] }}
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge me-2 
                                                    @if($atividade['status'] === 'concluido')
                                                        bg-success
                                                    @elseif($atividade['status'] === 'cancelado')
                                                        bg-danger
                                                    @else
                                                        bg-warning
                                                    @endif">
                                                {{ ucfirst($atividade['status']) }}
                                            </span>
                                            <a href="{{ route('showAtividade', ['id' => Crypt::encryptString($atividade['id'])]) }}"
                                                class="btn btn-sm btn-primary">
                                                Ver
                                            </a>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item text-muted">Sem atividades cadastradas.</li>
                                @endforelse
                            </ul>
                            <div class="text-end mt-3">
                                <a href="{{route('cadastrarAtividade')}}" class="btn btn-success">Cadastrar
                                    Atividade</a>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Gerar Relatório</h5>
                            <form method="GET" action="{{route('relatorio')}}">
                                <div class="mb-3">
                                    <label for="relatorioTipo" class="form-label">Tipo de Relatório:</label>
                                    <select class="form-select" id="relatorioTipo" name="tipo">
                                        <option value="clientes">Relatório de Clientes</option>
                                        <option value="faturamento">Relatório de Atividades</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Gerar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        toggleBtn.addEventListener('click', () => {
            if (sidebar.style.display === 'none') {
                sidebar.style.display = 'block';
                mainContent.style.marginLeft = '250px';
            } else {
                sidebar.style.display = 'none';
                mainContent.style.marginLeft = '0';
            }
        });
    </script>
</body>

</html>