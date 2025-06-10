<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastrar Atividade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('imagens/mini.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/cadastrar.css') }}">
</head>

<body style="background-color: #f8f9fa;">

    <div class="d-flex">

        <div id="sidebar" class="bg-dark text-white p-3 vh-100 position-fixed" style="width: 250px;">
            <h4 class="fw-bold mb-4">Menu</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="{{route('admin')}}" class="nav-link text-white">Dashboard</a></li>
                <li class="nav-item"><a href="{{route('CadastrarCliente')}}" class="nav-link text-white">Clientes</a></li>
                <li class="nav-item"><a href="{{route('cadastrarAtividade')}}" class="nav-link text-white">Atividades</a></li>
                <li class="nav-item"><a href="{{route('logout')}}" class="nav-link text-white">Sair</a></li>
            </ul>
        </div>

        <!-- Conteúdo -->
        <div class="flex-grow-1" style="margin-left: 250px;" id="main-content">
            <div class="container py-4">
                <button class="btn btn-outline-secondary mb-3" id="toggleSidebar">☰</button>

                <div class="text-center mb-4">
                    <img src="{{ asset('imagens/logo.png') }}" alt="Logo Contabilidade Angelos" class="logo mb-2">
                    <h2 class="fw-bold">Cadastrar Atividades</h2>
                </div>

                <!-- Formulário de Cadastro -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{route('cadastrarAtividadeSubmit')}}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Titulo</label>
                                    <input type="text" name="titulo" class="form-control" required>
                                </div>
                                @error('titulo')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror

                                

                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="pendente">Pendente</option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror

                                <div class="col-md-6">
                                    <label class="form-label">Descrição</label>
                                    <textarea name="descricao" class="form-control" rows="4" required></textarea>
                                </div>
                                @error('titulo')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror

                                
                            </div>

                            <div class="text-end mt-4">
                                <a href="{{ route('admin') }}" class="btn btn-secondary">Voltar</a>
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </form>

                        @if(session('cadastroError'))
                            <div class="alert alert-danger">
                                {{ session('cadastroError') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>