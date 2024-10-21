@extends('admin.templates.body')
@section('content')
    @if (session('session_start_usuario'))

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($success = Session::get('success'))
            <script>
                Swal.fire({
                    position: "top-right",
                    icon: "success",
                    title: "{{ $success }}",
                    showConfirmButton: false,
                    timer: 2500
                });
            </script>
        @endif

        <h2 class="text-center mb-5">{{ $producto->nombre_producto }}</h2>
        <div class="conatiner w-50 mx-auto">
            <p>Modificado por ultima vez por {{$producto->user->name}} - {{$producto->user->email}}.</p>
            <form action="{{ route('productos.update', $producto->id) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Nombre producto</label>
                        <input class="form-control mb-2" type="text" value="{{ $producto->nombre_producto }}"
                            name="nombre_producto" placeholder="Agrega un nombre">
                    </div>
                    <div class="col-md-4">
                        <label for="">SKU</label>
                        <input class="form-control mb-2" type="text" value="{{ $producto->sku }}" name="sku"
                            placeholder="Codigo de barras">
                    </div>

                    <div class="col-md-4">
                        <label for="">stock</label>
                        <input class="form-control mb-2" type="number" value="{{ $producto->stock }}" name="stock"
                            placeholder="Agrega un nombre">
                    </div>
                </div>

                <div class="row mb-2 mt-2">

                    <div class="col-md-4 shadow-sm bg-white text-center rounded">
                        <style>
                            .box-producto {
                                margin: auto;
                                width: 90%;
                                display: block;
                            }
                        </style>
                        <label for="">Imagen previa:</label>
                        <picture class="box-producto">
                            <img class="img-fluid" width="250px" src="/storage/{{ $producto->imagen_producto }}"
                                alt="{{ $producto->imagen_producto }}">
                        </picture>
                    </div>

                    <div class="col-md-5">
                        <label for="">Descripción</label>
                        <textarea class="form-control mb-2" name="descripcion"
                            placeholder="Acerca de este producto...">{{ $producto->descripcion }}</textarea>
                    </div>

                    <div class="col-md-3">
                        <label for="">Precio compra</label>
                        <input class="form-control mb-2" type="number" value="{{ $producto->precio_compra }}"
                            name="precio_compra" placeholder="El $ de compra">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <label for="">Precio venta</label>
                        <input class="form-control mb-2" type="number" value="{{ $producto->precio_venta }}"
                            name="precio_venta" placeholder="El $ de venta">
                    </div>

                    <div class="col-md-3">
                        <label for="">Fecha de ingreso</label>
                        <input class="form-control mb-2" type="date" value="{{ $producto->fecha_ingreso }}"
                            name="fecha_ingreso" placeholder="fecha del ingreso">
                    </div>

                    <div class="col-md-3">
                        <label for="">Categoria</label>
                        <select class="form-control" name="categoria_id" id="">
                            <option class="form-control" value="{{ $producto->categoria->id }}">
                                {{ $producto->categoria->nombre_categoria }}
                            </option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="">Imagen</label>
                        <input class="form-control mb-2" type="file" name="imagen_producto"
                            placeholder="Carga una imagen">
                    </div>
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Actualizar producto">
                    <a href="{{ route('productos.index') }}" class="btn btn-primary">Regresar</a>
                </div>
            </form>
        </div>
    @else
        <p>No existe sesión</p>
    @endif
@endsection
