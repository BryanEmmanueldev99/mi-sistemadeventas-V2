@extends('admin.templates.body')
    @section('content')
      @if(session('session_start_usuario'))

       @if ($errors->any())
         <div class="alert alert-danger">
          <ul class="m-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
           </ul>
         </div>
       @endif

      

         <h2 class="text-center mb-5">Agregar una nueva categoria</h2>
         <div class="conatiner w-50 mx-auto">
               <p>Llene los datos con cuidado, porfavor.</p>
              <form action="{{route('categorias.store')}}" method="post">
                @csrf

                <label for="">Nombre producto</label>
                <input class="form-control mb-2" type="text" value="{{old('name')}}" name="nombre_categoria" placeholder="Agrega un nombre">

                <input type="submit" class="btn btn-primary" value="Crear categoria">
              </form>
         </div>
        @else
            <p>No existe sesión</p>
        @endif
    @endsection

