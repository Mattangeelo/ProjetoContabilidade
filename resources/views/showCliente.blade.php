<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastrar Cliente</title>
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
                    <h2 class="fw-bold">Cadastro de Cliente</h2>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('editarCliente', ['cnpj' => Crypt::encryptString($cliente['cnpj'])]) }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Razão Social</label>
                                    <input type="text" name="razao_social" class="form-control"
                                        value="{{ old('razao_social', $cliente['razao_social']) }}" required>
                                </div>
                                @error('razao_social')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror

                                <div class="col-md-6">
                                    <label class="form-label">CNPJ</label>
                                    <input type="text" id="cnpj" name="cnpj" class="form-control"
                                        value="{{ old('cnpj', $cliente['cnpj']) }}" required readonly>
                                </div>

                                @error('cnpj')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror

                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $cliente['email']) }}" required>
                                </div>
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror

                                <div class="col-md-6">
                                    <label class="form-label">Mensalidade (R$)</label>
                                    <input type="number" step="0.01" name="mensalidade" class="form-control"
                                        value="{{ old('mensalidade', $cliente['mensalidade']) }}" required>
                                </div>
                                @error('mensalidade')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror

                                <div class="col-md-6">
                                    <label class="form-label">CNAE</label>
                                    <input type="text" name="cnae" class="form-control"
                                        value="{{ old('cnae', $cliente['cnae']) }}" required>
                                </div>
                                @error('cnae')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror

                                <div class="col-md-6">
                                    <label class="form-label">Categoria da Empresa</label>
                                    <select name="categoria_empresa" class="form-select" required>
                                        <option value="simples_Nacional" {{ old('categoria_empresa', $cliente['categoria_empresa']) == 'simples_Nacional' ? 'selected' : '' }}>
                                            Simples Nacional</option>
                                        <option value="lucro_Presumido" {{ old('categoria_empresa', $cliente['categoria_empresa']) == 'lucro_Presumido' ? 'selected' : '' }}>Lucro
                                            Presumido</option>
                                        <option value="lucro_Real" {{ old('categoria_empresa', $cliente['categoria_empresa']) == 'lucro_Real' ? 'selected' : '' }}>Lucro Real
                                        </option>
                                        <option value="mei" {{ old('categoria_empresa', $cliente['categoria_empresa']) == 'mei' ? 'selected' : '' }}>MEI</option>
                                    </select>
                                </div>
                                @error('categoria_empresa')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror

                                <div class="col-md-6">
                                    <label class="form-label">Representante</label>
                                    <input type="text" name="representante" class="form-control"
                                        value="{{ old('representante', $cliente['representante']) }}" required>
                                </div>
                                @error('representante')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror

                                <div class="col-md-6">
                                    <label class="form-label">CPF do Representante</label>
                                    <input type="text" id="cpf" name="cpf_representante" class="form-control"
                                        value="{{ old('cpf_representante', $cliente['cpf_representante']) }}" required readonly>
                                </div>
                                @error('cpf_representante')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-end mt-4">
                                <a href="{{ route('admin') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Atualizar</button>
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

    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        toggleBtn.addEventListener('click', () => {
            sidebar.style.display = sidebar.style.display === 'none' ? 'block' : 'none';
            mainContent.style.marginLeft = sidebar.style.display === 'none' ? '0' : '250px';
        });

        document.addEventListener('DOMContentLoaded', function () {
            const cpfInput = document.getElementById('cpf');
            const cnpjInput = document.getElementById('cnpj');
            const cnaeInput = document.querySelector('input[name="cnae"]');

            // Máscara CPF
            if (cpfInput) {
                cpfInput.addEventListener('input', function () {
                    let value = cpfInput.value.replace(/\D/g, '').slice(0, 11);
                    value = value.replace(/(\d{3})(\d)/, '$1.$2');
                    value = value.replace(/(\d{3})(\d)/, '$1.$2');
                    value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                    cpfInput.value = value;
                });
            }

            // Máscara CNPJ
            if (cnpjInput) {
                cnpjInput.addEventListener('input', function () {
                    let value = cnpjInput.value.replace(/\D/g, '').slice(0, 14);
                    value = value.replace(/^(\d{2})(\d)/, '$1.$2');
                    value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                    value = value.replace(/^(\d{2})\.(\d{3})\.(\d{3})(\d)/, '$1.$2.$3/$4');
                    value = value.replace(/^(\d{2})\.(\d{3})\.(\d{3})\/(\d{4})(\d{0,2})$/, '$1.$2.$3/$4-$5');
                    cnpjInput.value = value;
                });
            }

            // Máscara CNAE
            if (cnaeInput) {
                cnaeInput.addEventListener('input', function () {
                    let value = cnaeInput.value.replace(/\D/g, '').slice(0, 7);

                    if (value.length >= 3) {
                        value = value.replace(/^(\d{2})(\d)/, '$1.$2');
                    }
                    if (value.length >= 5) {
                        value = value.replace(/^(\d{2})\.(\d{2})(\d)/, '$1.$2-$3');
                    }
                    if (value.length >= 7) {
                        value = value.replace(/^(\d{2})\.(\d{2})-(\d{2})(\d)/, '$1.$2-$3/$4');
                    }

                    cnaeInput.value = value;
                });
            }
        });
    </script>
</body>

</html>