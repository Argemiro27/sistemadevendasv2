<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="css/layoutDashboard.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;1,200;1,300&display=swap" rel="stylesheet">
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-md navbar-light">
            <img src="img/logo.png" style="width: 50px; height: auto"/>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/cadastrarcliente">Cadastrar clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cadastrarproduto">Cadastrar produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cadastrarvenda">Cadastrar Vendas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/listadevendas">Listagem de Vendas</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" style="background-color: #495570; border: none"><img src="img/logout.png" style=" width: 30px; height: auto"/></button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/buscaCliente.js') }}"></script>
    <script src="{{ asset('js/carrinho.js') }}"></script>
    <script src="{{ asset('js/formaPagamento.js') }}"></script>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
</body>
</html>
