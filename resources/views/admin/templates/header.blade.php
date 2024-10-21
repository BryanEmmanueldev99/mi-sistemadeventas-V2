<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Sistema de ventas</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <!--Sweet Alert-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
<!-- Include jQuery CDN Link -->
<script src=
"https://code.jquery.com/jquery-3.7.1.min.js" 
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
        crossorigin="anonymous">
    </script>
</head>
        
        <style>
            body{
                background-color: #fafafa;
            }
        </style>
    </head>

    <body>
        <header>
            <!-- place navbar here -->
            <nav
                class="nav shadow-sm bg-white p-2"
            >
                <a class="nav-link" href="{{route('logueado')}}" aria-current="page"
                    >Inicio</a
                >
                <a class="nav-link" href="{{route('usuarios')}}">Usuarios</a>
                <a class="nav-link" href="{{route('categorias.index')}}">Categorias</a>
                <a class="nav-link" href="{{route('productos.index')}}">Productos</a>
                <a class="nav-link" href="{{route('proveedor.index')}}">Proveedores</a>
            </nav>
            
        </header>

        <main class="container mt-5 mb-2">