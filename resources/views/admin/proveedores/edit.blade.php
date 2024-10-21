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

        <h2 class="text-center mb-5">{{$proveedor->nombre_proveedor}}</h2>
        <div class="conatiner w-50 mx-auto">
            <p>Datos previos del proveedor.</p>
            <form action="{{ route('proveedor.update', $proveedor->id) }}" method="post">
                @csrf
                @method('PUT')

                <label for="">Nombre del proveedor</label>
                <input class="form-control mb-2" type="text" value="{{ $proveedor->nombre_proveedor }}" name="nombre_proveedor"
                    placeholder="Agrega un nombre">

                <label for="">Celular</label>
                <input class="form-control mb-2" type="text" value="{{ $proveedor->celular_proveedor }}"
                    name="celular_proveedor" placeholder="+52 55 1900 7750">

                <div class="row">
                    <div class="col-md-6">
                        <label for="">Teléfono</label>
                        <input class="form-control mb-2" type="text" value="{{ $proveedor->telefono_proveedor }}"
                            name="telefono_proveedor" placeholder="0047892..">
                    </div>

                    <div class="col-md-6">
                        <label for="">Correo</label>
                        <input class="form-control mb-2" type="email" value="{{ $proveedor->email_proveedor }}"
                            name="email_proveedor" placeholder="Correo del proveedor...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="">Empresa</label>
                        <input class="form-control mb-2" type="text" value="{{ $proveedor->empresa_proveedor }}"
                            name="empresa_proveedor" placeholder="Nombre de la empresa">
                    </div>

                    <div class="col-md-8">
                        <label for="">Dirección fiscal</label>
                        <textarea class="form-control mb-2" name="direccion_fiscal_proveedor"
                            placeholder="Av. alamos etc...(ejemplo)">{{ $proveedor->direccion_fiscal_proveedor }}</textarea>
                    </div>
                </div>

                <div class="container">
                    <input type="submit" class="btn btn-primary" value="Actualizar proveedor">
                    <a href="{{route('proveedor.index')}}" class="btn btn-primary">Regresar</a>
                </div>
            </form>
        </div>
    @else
        <p>No existe sesión</p>
    @endif
@endsection
