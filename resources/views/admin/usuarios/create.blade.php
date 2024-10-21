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

       @if (( $password_confirmation = Session::get('password_confirmation') ))
          <div class="alert alert-danger">
              <ul>
                <li>{{$password_confirmation}}</li>
              </ul>
           </div>
        @endif

       
         <h2 class="text-center mb-5">Agregar un nuevo usuario</h2>
         <div class="conatiner w-50 mx-auto">
               <p>Llene los datos con cuidado, porfavor.</p>
              <form action="{{route('new_user')}}" method="post">
                @csrf
                <label for="">Nombre</label>
                <input class="form-control mb-2" type="text" value="{{old('name')}}" name="name" placeholder="Agrega un nombre">

                <label for="">Correo</label>
                <input class="form-control mb-4" type="email" name="email" value="{{old('email')}}" placeholder="Agrega un correo">

                <label for="">Contraseña</label>
                <input class="form-control mb-4" type="password" name="password" placeholder="Agrega una contraseña">

                <label for="">Confirmar contraseña</label>
                <input class="form-control mb-4" type="password" name="password_confirmation" placeholder="confirmar contraseña">

                <input type="submit" class="btn btn-primary" value="Agregar usuario">
              </form>
         </div>
        @else
            <p>No existe sesión</p>
        @endif
    @endsection

