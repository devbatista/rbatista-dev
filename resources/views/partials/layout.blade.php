<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $seo->descricao }}">
    <meta name="author" content="{{ $seo->autor }}">
    <meta name="keywords" content="{{ $seo->keywords }}">
    <meta property="og:title" content="{{ $perfil->nome }}">
    <meta property="og:image" content="{{ $seo->og_imagem }}">
    <meta property="og:description" content="{{ $seo->og_descricao }}">
    <title>{{ $perfil->nome }}</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/aos.css?ver=1.1.0') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css?ver=1.1.0') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css?ver=1.1.0') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <noscript>
        <style type="text/css">
            [data-aos] {
                opacity: 1 !important;
                transform: translate(0) scale(1) !important;
            }

        </style>
    </noscript>
</head>

<body id="top">
    <header>
        <div class="profile-page sidebar-collapse">
            <nav class="navbar navbar-expand-lg fixed-top navbar-transparent bg-personalizado" color-on-scroll="400">
                <div class="container">
                    <div class="navbar-translate"><a class="navbar-brand" href="/"
                            rel="tooltip">{{ $perfil->nome }}</a>
                        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navigation" aria-controls="navigation" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link smooth-scroll" href="#about">Sobre</a></li>
                            <li class="nav-item"><a class="nav-link smooth-scroll" href="#skill">Skills</a></li>
                            <li class="nav-item"><a class="nav-link smooth-scroll" href="#portfolio">Portfolio</a></li>
                            <li class="nav-item"><a class="nav-link smooth-scroll" href="#experience">Experiência</a>
                            </li>
                            <li class="nav-item"><a class="nav-link smooth-scroll" href="#contact">Contato</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div class="page-content">
        <div>
            @yield('content')
        </div>
    </div>

    <footer class="footer">
        <div class="container text-center">
            @foreach ($redesSociais as $redeSocial)
                <a class="cc-{{ $redeSocial->nome }} btn btn-link" href="{{ $redeSocial->link }}" target="_blank">
                    <i class="fa fa-{{ $redeSocial->nome }} fa-2x " aria-hidden="true"></i>
                </a>
            @endforeach
        </div>
        <div class="h4 title text-center">{{ $perfil->nome }}</div>
        <div class="text-center text-muted">
            <p><?= date('Y') ?> &copy; {{ $perfil->nome }}. Todos os direitos reservados.<br>Desenvolvido por <a
                    class="credit" href="https://www.devbatista.com" target="_blank">DevBatista</a></p>
        </div>
    </footer>
    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js?ver=1.1.0') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js?ver=1.1.0') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js?ver=1.1.0') }}"></script>
    <script src="{{ asset('assets/js/now-ui-kit.js?ver=1.1.0') }}"></script>
    <script src="{{ asset('assets/js/aos.js?ver=1.1.0') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-mask.js') }}"></script>
    <script src="{{ asset('assets/scripts/main.js?ver=1.1.0') }}"></script>
</body>

</html>
