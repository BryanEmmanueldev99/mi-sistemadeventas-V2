@extends('admin.templates.body')
@section('content')
    @if (session('session_start_usuario'))
        <style>
            .p_img_compra {
                width: 70px;
                height: 70px;
                aspect-ratio: 1 / 1;
                object-fit: contain;
            }
        </style>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <div class="conatiner mx-auto">

            <div class="d-flex gap-3">
                <div class="col-md-8 bg-white shadow-sm rounded p-3">

                    <h2 class="text-center mb-5">Generar nueva compra</h2>
                    <p>Llene los datos con cuidado, porfavor.</p>





                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalProductos_compra">
                        Buscar Productos
                    </button>


                    @if (session('cart_compras'))
                        <div class="table-responsive mt-4 mb-3">
                            <table class="table table-primary table-sm">
                                <thead>
                                    <tr>
                                        <th>
                                            Imagen
                                        </th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                    @php
                                       $subtotal = 0;
                                    @endphp
                                    @foreach (session('cart_compras') as $id => $producto_compra)
                                      <td scope="row">
                                          <picture class="box-producto">
                                              <img class="p_img_compra img-thumbnail" src="/storage/{{ $producto_compra['imagen_producto'] }}"
                                                  alt="{{ $producto_compra['producto'] }}">
                                          </picture>
                                      </td>
                                      <td>{{ $producto_compra['producto'] }}</td>
                                      <td>{{ $producto_compra['quantity'] }}</td>
                                      <td>${{ $producto_compra['precio_compra'] * $producto_compra['quantity']}}
                                      </td>
                                      <td>
                                    <form class="d-flex gap-2"
                                        action=""
                                        method="post">
                                        @csrf
                                        <div class="col-md-3">
                                          <input class="form-control" type="number"
                                            name="cantidad_carrito">
                                        </div>
                                        
                                          <button class="btn btn-primary w-100 rouded-100">Remover producto</button>
                                        
                                    </form>
                                      </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="mt-4">Sin productos agregados</p>
                    @endif

                    <!-- Modal de productos -->
                    <div class="modal fade" id="modalProductos_compra" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        Busca algún producto
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <!--TABLA DE PRODUCTOS!-->
                                    <div class="table-responsive mt-3">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>

                                        <table class="table table-primary mt-3" id="productos_datatables">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Imagen</th>
                                                    <th scope="col">producto</th>
                                                    <th scope="col">SKU</th>
                                                    <th scope="col">Stock</th>
                                                    <th scope="col">Precio compra</th>
                                                    <th scope="col">Categoria</th>
                                                    <th scope="col">Acciones</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach ($productos as $producto)
                                                    <tr class="">
                                                        <td scope="row">
                                                            <picture class="box-producto">
                                                                <img class="p_img_compra img-thumbnail"
                                                                    src="/storage/{{ $producto->imagen_producto }}"
                                                                    alt="{{ $producto->imagen_producto }}">
                                                            </picture>
                                                        </td>
                                                        <td scope="row">{{ $producto->nombre_producto }}</td>
                                                        <td scope="row">{{ $producto->sku }}</td>
                                                        <td scope="row">{{ $producto->stock }}</td>
                                                        <td scope="row">${{ $producto->precio_compra }}</td>
                                                        <td scope="row">{{ $producto->categoria->nombre_categoria }}
                                                        </td>
                                                        <td>
                                                            <form class="d-flex gap-2"
                                                                action="{{ route('compras.agregar_carro_compras', $producto->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <input class="form-control" type="number"
                                                                    name="cantidad_carrito">
                                                                <button class="btn btn-primary">Agregar</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <script>
                                            let table = new DataTable('#productos_datatables', {
                                                "pageLength": 3,
                                                layout: {
                                                    topStart: {
                                                        buttons: ['copy', 'csv', /*'excel',*/ 'pdf', 'print']
                                                    }
                                                },
                                                "language": {
                                                    "emptyTable": "No hay información",
                                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                                                    "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                                                    "infoFiltered": "(Filtrado de _MAX_ total Productos)",
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('categorias.store') }}" method="post">
                        @csrf
                </div>
                <div class="col-md-4 bg-white shadow-sm rounded p-3">
                    <div class="mb-4">
                        <label for="">No. de compra</label>
                        @php
                            date_default_timezone_set('America/Mexico_City');
                            $tiempo_nro_compra = date('F j, Y, g:i a');
                            $nro_compra = mt_rand() . '_' . date('Y-m-d H:i:s');
                        @endphp
                        <input class="form-control mb-2" type="text" value="{{ $nro_compra }}" name="nro_compra"
                            disabled>
                        <input class="form-control mb-2" type="text" value="{{ $nro_compra }}" name="nro_compra"
                            hidden>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Generar compra">
                </div>
            </div>
            </form>
        </div>

        <div class="container mt-3">
            <a class="btn btn-primary" href="{{ route('compras.index') }}">Regresar</a>
        </div>
    @else
        <p>No existe sesión</p>
    @endif
@endsection
