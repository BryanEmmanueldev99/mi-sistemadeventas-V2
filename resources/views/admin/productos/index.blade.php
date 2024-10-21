@extends('admin.templates.body')
@section('content')
    @if (session('session_start_usuario'))
        <div class="container p3 mb-3">
            <h2>Modulo productos</h2>
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

            <a class="btn btn-primary" href="{{ route('productos.create') }}">Agregar producto</a>
            <table class="table table-primary mt-3">
                <thead>
                    <tr>
                        <th scope="col">producto</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Precio compra</th>
                        <th scope="col">Precio venta</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr class="">
                            <td scope="row">{{ $producto->nombre_producto }}</td>
                            <td scope="row">{{ $producto->sku }}</td>
                            <td scope="row">{{ $producto->stock }}</td>
                            <td scope="row">${{ $producto->precio_compra }}</td>
                            <td scope="row">${{ $producto->precio_venta }}</td>
                            <td scope="row">{{ $producto->categoria->nombre_categoria }}</td>
                            <td>
                                <div class="d-flex" style="gap: 7px; flex-wrap:wrap;">
                                    <a class="btn btn-primary"
                                        href="{{ url('admin/productos/recuperar-producto/' . $producto->id) }}">Editar
                                    </a>
                                    <form id="request_submit_producto_{{ $producto->id }}"
                                        action="{{ route('productos.destroy' ,$producto->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary">Borrar
                                        </button>

                                        <script>
                                            $('#request_submit_producto_{{ $producto->id }}').submit(function(e) {
                                                e.preventDefault();

                                                Swal.fire({
                                                    title: "¿Deseas eliminar esta producto?",
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
    @else
        <p>No existe sesión</p>
    @endif
@endsection
