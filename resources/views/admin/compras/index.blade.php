@extends('admin.templates.body')
@section('content')
    @if (session('session_start_usuario'))
        <div class="container p3 mb-3">
            <h2>Modulo categorias</h2>
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

            <a class="btn btn-primary" href="{{ route('categorias.create') }}">Agregar categoria</a>
            <table class="table table-primary mt-3" id="categorias_datatables">
                <thead>
                    <tr>
                        <th scope="col">Nombre de la categoria</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr class="">
                            <td scope="row">{{ $categoria->nombre_categoria }}</td>
                            <td>
                                <div class="d-flex" style="gap: 7px; flex-wrap:wrap;">
                                    <a class="btn btn-primary"
                                        href="{{ url('/admin/categorias/edit/' . $categoria->id) }}">Editar</a>
                                    <form id="request_submit_categoria_{{ $categoria->id }}"
                                        action="{{ url('/admin/categorias/' . $categoria->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary">Borrar
                                        </button>

                                        <script>
                                            $('#request_submit_categoria_{{ $categoria->id }}').submit(function(e) {
                                                e.preventDefault();


                                                Swal.fire({
                                                    title: "¿Deseas eliminar esta categoria?",
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
            let table = new DataTable('#ventas_datatables', {
                "pageLength": 5,
                layout: {
                    topStart: {
                        buttons: ['copy', 'csv', /*'excel',*/ 'pdf', 'print']
                    }
                },
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Compras",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Compras",
                    "infoFiltered": "(Filtrado de _MAX_ total Compras)",
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
        </script>
    @else
        <p>No existe sesión</p>
    @endif
@endsection
