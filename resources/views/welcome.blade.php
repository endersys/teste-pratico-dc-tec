<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciador de pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    @vite(['public/css/app.css'])
</head>
<body>
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>LOGO</h3>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Dashboard</span>
                    </a>
                </li>
                <li class="active">
                    <a href="#homeSubmenu" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle"><i class="fas fa-chart-bar fa-fw me-3"></i> Pedidos</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#"><i class="fas fa-plus me-2"></i>Novo Pedido</a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-list me-2"></i>Todos os pedidos</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fas fa-money-bill fa-fw me-3"></i> Vendas</a>
                </li>
            </ul>
        </nav>
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                    </button>
                </div>
            </nav>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script>
         $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>
</html>
