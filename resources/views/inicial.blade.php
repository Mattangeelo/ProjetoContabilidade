<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contabilidade Angelos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('imagens/mini.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/inicial.css') }}">
    <style>
        .conteudo {
            display: none;
        }

        .conteudo.ativo {
            display: block;
        }
    
        
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #404040;">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('imagens/logoAtualizada.png') }}" alt="Logo do Escritório" style="width: 95px; height: 95px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" onclick="mostrarSecao('inicio')">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" onclick="mostrarSecao('servicos')">Serviços</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" onclick="mostrarSecao('localizacao')">Localização</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" onclick="mostrarSecao('contato')">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">Área Administrativa</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <section id="inicio" class="conteudo ativo py-5 bg-light">
        <div class="container">
            <div class="carousel-container">
                <div id="serviceCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('imagens/imposto.png') }}" class="d-block w-100" alt="Contabilidade Geral">  
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('imagens/empresa.png') }}" class="d-block w-100" alt="Assessoria Fiscal">                           
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('imagens/consultoria.png') }}" class="d-block w-100"
                                alt="Consultoria Financeira">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#serviceCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#serviceCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </section>


    <section id="servicos" class="conteudo services-section py-5">
        <div class="container">
            <h2 class="section-title text-primary-theme">Nossos Serviços</h2>


            <div class="row align-items-center mb-5">
                <div class="col-md-6">
                    <p class="text-secondary-theme fs-5">
                        Na <strong>Contabilidade Angelos</strong>, estamos prontos para te ajudar com excelência,
                        comprometimento e a melhor equipe especializada.
                        Atuamos com dedicação para entender a fundo as necessidades do seu negócio e oferecer soluções
                        contábeis personalizadas, eficientes e seguras.
                        Nosso objetivo é garantir tranquilidade e crescimento para você e sua empresa.
                    </p>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{asset('imagens/contador.png')}}" alt="Contador da Contabilidade Angelos"
                        class="img-fluid rounded shadow" style="width: 400px; height: 400px;">
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="service-item">
                        <h3>Abertura de Empresas</h3>
                        <p class="text-secondary-theme">Abrir uma nova empresa é tarefa para um contador experiente!</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="service-item">
                        <h3>Assessoria Contábil</h3>
                        <p class="text-secondary-theme">A contabilidade da sua empresa vai muito além da obrigação.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="service-item">
                        <h3>Assessoria Fiscal</h3>
                        <p class="text-secondary-theme">Reduzir a carga tributária e garantir o cumprimento de todas as
                            obrigações!</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="service-item">
                        <h3>Planejamento Tributário</h3>
                        <p class="text-secondary-theme">Planejar e enquadrar a sua empresa no regime tributário correto.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="service-item">
                        <h3>Consultoria Contábil</h3>
                        <p class="text-secondary-theme">Se você tem dúvida sobre a contabilidade da sua empresa...</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="service-item">
                        <h3>Revisão e Recuperação</h3>
                        <p class="text-secondary-theme">Créditos tributários prescrevem ao final de cinco anos.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="localizacao" class="conteudo location-section bg-secondary-theme py-5">
        <div class="container">
            <h2 class="section-title text-accent-theme" style="color:white">Onde Estamos</h2>
            <div class="row align-items-center">

                <div class="col-md-6 mb-4 mb-md-0">
                    <p class="fs-5" style="color:#8fbc8f">
                        Nosso escritório está de portas abertas para receber você com toda a atenção que merece.
                        Venha tomar um café conosco e conhecer mais sobre como podemos ajudar seu negócio!
                    </p>
                    <address class="fw-bold" style="color:#8fbc8f">
                        R. Laurindo Borges, 1984<br>
                        Campo Mourão – PR, 87303-240
                    </address>
                    <p style="color:#8fbc8f">Será um prazer atendê-lo pessoalmente!</p>
                </div>

                <div class="col-md-6">
                    <div class="mapa-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3643.9468181288057!2d-52.374914324655286!3d-24.03294047847871!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ed75257b5be55f%3A0xf39b0e89869f68a2!2sR.%20Laurindo%20Borges%2C%201984%20-%20Centro%2C%20Campo%20Mour%C3%A3o%20-%20PR%2C%2087303-240!5e0!3m2!1spt-BR!2sbr!4v1747657876195!5m2!1spt-BR!2sbr"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="contato" class="conteudo contact-section py-5">
        <div class="container">
            <h2 class="section-title text-primary-theme">Entre em Contato</h2>
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <p class="lead text-secondary-theme">Estamos prontos para ajudar o seu negócio a prosperar.</p>
                    <a href="https://wa.me/44997361375" class="btn btn-success mt-3 mb-5">Fale Conosco no WhatsApp</a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form class="custom-form">
                        <div class="form-group mb-4">
                            <input type="text" class="form-control custom-input" id="nome" placeholder="Seu nome">
                        </div>
                        <div class="form-group mb-4">
                            <input type="email" class="form-control custom-input" id="email" placeholder="Seu e-mail">
                        </div>
                        <div class="form-group mb-4">
                            <textarea class="form-control custom-input" id="mensagem" rows="4"
                                placeholder="Descreva como podemos te ajudar..."></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary-custom px-5 py-2">Enviar Mensagem</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="footer-logo">
                        <img src="{{ asset('imagens/logoAtualizada.png') }}" alt="Contabilidade Angelos">
                    </div>
                    <p>Soluções contábeis completas para o seu negócio prosperar.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://wa.me/44997361375"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-links">
                        <h5>Contato</h5>
                        <ul>
                            <li><i class="fas fa-map-marker-alt me-2"></i> R. Laurindo Borges, 1984 - Campo Mourão/PR</li>
                            <li><i class="fas fa-phone me-2"></i> (44) 99736-1375</li>
                            <li><i class="fas fa-envelope me-2"></i> contato@angeloscontabilidade.com.br</li>
                            <li><i class="fas fa-clock me-2"></i> Seg-Sex: 08:00 - 18:00</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2023 Contabilidade Angelos. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <script>
        function mostrarSecao(id) {
            const secoes = document.querySelectorAll('.conteudo');
            secoes.forEach(secao => secao.classList.remove('ativo'));
            document.getElementById(id).classList.add('ativo');
        }
    </script>

    <!-- Font Awesome para ícones -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>