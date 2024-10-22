@extends('admin.templates.body')
@section('content')
    @if (session('session_start_usuario'))
        <div class="container p3 mb-3">
            <h2>Modulo Proveedores</h2>
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

            <a class="btn btn-primary" href="{{ route('proveedor.create') }}">Agregar un nuevo proveedor</a>
            <table class="table table-primary mt-3" id="proveedores_datatables">
                <thead>
                    <tr>
                        <th scope="col">Proveedor</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $proveedor)
                        <tr class="">
                            <td scope="row">{{ $proveedor->nombre_proveedor }}</td>
                            <td scope="row">{{ $proveedor->celular_proveedor }}</td>
                            <td scope="row">{{ $proveedor->telefono_proveedor }}</td>
                            <td scope="row">{{ $proveedor->email_proveedor }}</td>
                            <td scope="row">{{ $proveedor->empresa_proveedor }}</td>
                            <td>
                                <div class="d-flex" style="gap: 7px; flex-wrap:wrap;">
                                    <a class="btn btn-primary"
                                        href="{{ route('proveedor.edit', $proveedor->id) }}">Editar</a>
                                    <form id="request_submit_proveedor_{{ $proveedor->id }}"
                                        action="{{ route('proveedor.destroy', $proveedor->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary">Borrar
                                        </button>

                                        <script>
                                            $('#request_submit_proveedor_{{ $proveedor->id }}').submit(function(e) {
                                                e.preventDefault();
                                                Swal.fire({
                                                    title: "¿Deseas eliminar a este proveedor?",
                                                    text: "Esta acción es irreversible una vez efectuada.",
                                                    icon: "warning",
                                                    showCancelButton: true,
                                                    confirmButtonColor: "#3085d6",
                                                    cancelButtonColor: "#d33",
                                                    cancelButtonText: "Cancelar",
                                                    confirmButtonText: "¡Si!"
                                                }).then((result) => {
                                                    if (!result.isConfirmed) {
                                                        
                                                    } else {
                                                        this.submit();
                                                    }
                                                });
                                            });
                                        </script>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <script>
            let table = new DataTable('#proveedores_datatables', {
                "pageLength": 5,
                layout: {
                    topStart: {
                        buttons: ['copy', 'csv', /*'excel',*/ 'pdf', 'print']
                    }
                },
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Proveedores",
                    "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
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
