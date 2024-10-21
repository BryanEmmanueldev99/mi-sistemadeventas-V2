@extends('admin.templates.body')
@section('content')
    @if (session('session_start_usuario'))

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <h2 class="text-center mb-5">Agregar un nuevo producto</h2>
        <div class="conatiner">
            <p>Llene los datos con cuidado, porfavor.</p>
            <form action="{{ route('productos.store') }}" enctype="multipart/form-data" method="post">
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <label for="">Nombre producto</label>
                        <input class="form-control mb-2" type="text" value="{{ old('nombre_producto') }}"
                            name="nombre_producto" placeholder="Agrega un nombre">
                    </div>
                    <div class="col-md-4">
                        <label for="">SKU</label>
                        <input class="form-control mb-2" type="text" value="{{ old('sku') }}" name="sku"
                            placeholder="Codigo de barras">
                    </div>

                    <div class="col-md-4">
                        <label for="">stock</label>
                        <input class="form-control mb-2" type="number" value="{{ old('stock') }}" name="stock"
                            placeholder="Agrega un nombre">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9">
                        <label for="">Descripción</label>
                        <textarea class="form-control mb-2" value="{{ old('descripcion') }}" name="descripcion"
                            placeholder="Acerca de este producto..."></textarea>
                    </div>

                    <div class="col-md-3">
                        <label for="">Precio compra</label>
                        <input class="form-control mb-2" type="number" value="{{ old('precio_compra') }}"
                            name="precio_compra" placeholder="El $ de compra">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <label for="">Precio venta</label>
                        <input class="form-control mb-2" type="number" value="{{ old('precio_venta') }}"
                            name="precio_venta" placeholder="El $ de venta">
                    </div>

                    <div class="col-md-3">
                        <label for="">Fecha de ingreso</label>
                        <input class="form-control mb-2" type="date" value="{{ old('fecha_ingreso') }}"
                            name="fecha_ingreso" placeholder="fecha del ingreso">
                    </div>

                    <div class="col-md-3">
                        <label for="">Categoria</label>
                        <select class="form-control" name="categoria_id" id="">
                                @foreach ($categorias as $categoria)
                                    <option class="form-control" value="{{ $categoria->id }}">
                                        {{ $categoria->nombre_categoria }}
                                    </option>
                                @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="">Imagen</label>
                        <input class="form-control mb-2" type="file" value="{{ old('imagen_producto') }}"
                            name="imagen_producto" placeholder="Carga una imagen">
                    </div>
                </div>

                <input type="submit" class="btn btn-primary" value="Agregar producto">
                <a href="{{ route('productos.index') }}" class="btn btn-primary">Regresar</a>
            </form>
        </div>
    @else
        <p>No existe sesión</p>
    @endif
@endsection
