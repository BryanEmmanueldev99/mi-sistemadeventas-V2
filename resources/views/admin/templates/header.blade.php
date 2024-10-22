<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Sistema de ventas</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!--Sweet Alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Include jQuery CDN Link -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <!--Datatables-->
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/3.1.2/js/dataTables.buttons.min.js" integrity="sha512-QryCmK0Wa3Z39ENpuGWLnm50JgyuqoabrElWoprdAy9hwaqOnXrl+FhipaB2iCHRseSwIpmxzThgZsn7n2cp7Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/3.1.2/js/buttons.print.min.js" integrity="sha512-2Z5DG21Mo9I7ETDi1R4T5yK24NDuxcRCD6smo47+kImienWgFdBU5mg0cyLGaMwDitjb9UskfUEtji67if3Xnw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.12/pdfmake.min.js" integrity="sha512-axXaF5grZBaYl7qiM6OMHgsgVXdSLxqq0w7F4CQxuFyrcPmn0JfnqsOtYHUun80g6mRRdvJDrTCyL8LQqBOt/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.12/vfs_fonts.min.js" integrity="sha512-EFlschXPq/G5zunGPRSYqazR1CMKj0cQc8v6eMrQwybxgIbhsfoO5NAMQX3xFDQIbFlViv53o7Hy+yCWw6iZxA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/3.1.2/js/buttons.html5.min.js" integrity="sha512-ggVZyunC6fdldMB1GOvn7LPoMN9EeLoy9xrwmbfKAiM1y/CHSVwy6OaE2EbI1NkChg1ti0t6Dpv4FWZ9Md8xYQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/3.1.2/js/buttons.colVis.min.js" integrity="sha512-Aco2AZMfg/w1xDL6ym1XZa0ghs/l66pUEOmmhQJ0Pd5BmgDgNWUncB1wyUO6dRm7MDf5WvO7AhKGtBfb+sYmgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
</head>

<style>
    body {
        background-color: #fafafa;
    }
</style>


<body>
    <header>
        <!-- place navbar here -->
        <nav class="nav shadow-sm bg-white p-2">
            <a class="nav-link" href="{{ route('logueado') }}" aria-current="page">Inicio</a>
            <a class="nav-link" href="{{ route('usuarios') }}">Usuarios</a>
            <a class="nav-link" href="{{ route('categorias.index') }}">Categorias</a>
            <a class="nav-link" href="{{ route('productos.index') }}">Productos</a>
            <a class="nav-link" href="{{ route('proveedor.index') }}">Proveedores</a>
        </nav>

    </header>

    <main class="container mt-5 mb-2">
