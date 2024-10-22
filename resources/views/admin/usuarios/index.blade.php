@extends('admin.templates.body')
@section('content')
    @if (session('session_start_usuario'))
        <div class="container p3 mb-3">
            <h2>Modulo usuarios</h2>
        </div>
        <div class="table-responsive mt-3">

            @if ($success = Session::get('success'))
                <script>
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "{{ $success }}",
                        showConfirmButton: true,
                        timer: 1500
                    });
                </script>
            @endif

            <a class="btn btn-primary" href="{{ route('vista_create_usuario') }}">Agregar nuevo usuario</a>
            <table class="table table-primary mt-3" id="usuarios">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr class="">
                            <td scope="row">{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                <div class="d-flex" style="gap: 7px; flex-wrap:wrap;">
                                    <a class="btn btn-primary"
                                        href="{{ url('/admin/usuarios/editar_usuario/' . $usuario->id) }}">Editar</a>
                                    <form id="request_submit" action="{{ url('/admin/usuarios/' . $usuario->id) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button id="confirmacion_eliminar" type="submit"
                                            class="btn btn-primary">Borrar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
            let table = new DataTable('#usuarios', {
                "pageLength": 5,
                layout: {
                    topStart: {
                        buttons: ['copy', 'csv', /*'excel',*/ 'pdf', 'print']
                    }
                },
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                    "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Generar Reportes",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscador:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        //   "next": "Siguiente",
                        //   "previous": "Anterior"
                    }
                },
                
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
            });
            // $("#usuarios").DataTable({
            //   "pageLength": 5,
            //   "language": {
            //     "emptyTable": "No hay información",
            //     "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
            //     "infoEmpty": "Mostrando 0 a 0 de 0 Proveedores",
            //     "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
            //     "infoPostFix": "",
            //     "thousands": ",",
            //     "lengthMenu": "Mostrar _MENU_ Generar Reportes",
            //     "loadingRecords": "Cargando...",
            //     "processing": "Procesando...",
            //     "search": "Buscador:",
            //     "zeroRecords": "Sin resultados encontrados",
            //     "paginate": {
            //       "first": "Primero",
            //       "last": "Ultimo",
            //       "next": "Siguiente",
            //       "previous": "Anterior"
            //     }
            //   },
            //   "responsive": true,
            //   "lengthChange": true,
            //   "autoWidth": false,
            //   "buttons": ["copy", "csv", "excel", "pdf", "print"]
            // }).buttons().container().appendTo('#usuarios .col-md-6:eq(0)');
        </script>
    @else
        <p>No existe sesión</p>
    @endif
@endsection
