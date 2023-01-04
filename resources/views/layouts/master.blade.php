<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path={{ asset('sneat-1.0.0/assets/') }} data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Pedidos</title>
    <meta name="description" content="" />
    @vite(['public/css/app.css'])
    <link rel="stylesheet" href={{ asset('sneat-1.0.0/assets/vendor/css/core.css') }}
        class="template-customizer-core-css" />
    <link rel="stylesheet" href={{ asset('sneat-1.0.0/assets/vendor/css/theme-default.css') }}
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href={{ asset('sneat-1.0.0/assets/css/demo.css') }} />
    <link rel="stylesheet" href={{ asset('sneat-1.0.0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }} />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href={{ asset('sneat-1.0.0/assets/vendor/fonts/boxicons.css') }} />
    <script src={{ asset('sneat-1.0.0/assets/vendor/js/helpers.js') }}></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="" class="app-brand-link">
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">LOGO</span>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <li class="menu-item active">
                        <a href="" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Páginas</span>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="mbi bi-bar-chart m-right-10"></i>
                            <div data-i18n="Tables">Pedidos</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="" class="menu-link text-decoration-none menu-item-table ms-0"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="bi bi-box m-right-10"></i>
                                    <div data-i18n="Basic">Novo Produto</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('orders.create') }}"
                                    class="menu-link text-decoration-none menu-item-table ms-0">
                                    <i class="bi bi-cart-plus m-right-10"></i>
                                    <div data-i18n="Basic">Novo Pedido</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('orders.index') }}" class="menu-link menu-item-table ms-0">
                                    <i class="bi bi-list m-right-10"></i>
                                    <div data-i18n="Basic">Todos os pedidos</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="cards-basic.html" class="menu-link">
                            <i class="bi bi-cash m-right-10"></i>
                            <div data-i18n="Basic">Vendas</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <form action="/" method="get">
                            <div class="navbar-nav align-items-center">
                                <div class="nav-item d-flex align-items-center">
                                    <i class="bx bx-search fs-4 lh-0"></i>
                                    <input type="text" class="form-control border-0 shadow-none"
                                        placeholder="Buscar..." aria-label="Search..." name="term" value="" />
                                </div>
                            </div>
                        </form>
                    </div>
                </nav>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-center py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                            </div>
                        </div>
                    </footer>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Produto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 m-auto">
                        <form action="{{ route('products.store') }}" method="POST">
                            @csrf
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="name" class="form-label">Nome</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="price" class="form-label">Preço</label>
                                                <input type="number" class="form-control" name="price"
                                                    value="" min="0" step="any" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-4 mx-4 mt-0">
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src={{ asset('sneat-1.0.0/assets/vendor/libs/jquery/jquery.js') }}></script>
    <script src={{ asset('sneat-1.0.0/assets/vendor/js/bootstrap.js') }}></script>
    <script src={{ asset('sneat-1.0.0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}></script>
    <script src={{ asset('sneat-1.0.0/assets/vendor/js/menu.js') }}></script>
    <script src={{ asset('sneat-1.0.0/assets/js/main.js') }}></script>
</body>

</html>
