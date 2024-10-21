@extends('admin.templates.body')
    @section('content')
            
              <div class="container">
                @if (($success = Session::get('success')))
                <script>
   Swal.fire({
   position: "center",
   icon: "success",
   title: "{{$success}}",
   showConfirmButton: false,
   timer: 2500
 });
                </script>
           @endif

           @if (( $password_confirmation = Session::get('password_confirmation') ))
          <div class="alert alert-danger">
              <ul>
                <li>{{$password_confirmation}}</li>
              </ul>
           </div>
        @endif

        @if ($errors->any())
         <div class="alert alert-danger">
           <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
           </ul>
         </div>
       @endif
                 <h2>Actualizar al usuario</h2>
              </div>
                
              <form action="{{url('/admin/usuarios/update-user/'.$usuario->id)}}" method="post">
                  @csrf
                  @method('PUT')
                  <label for="">Nombre:</label>
                  <input class="mb-2 form-control" type="text" name="name" value="{{$usuario->name}}">

                  <label for="">Correo:</label>
                  <input class="mb-2 form-control" type="email" name="email" value="{{$usuario->email}}">

                   <p class="mt-4 mb-1">Para mantener la contraseña actual, deja los campos vacios.</p>
                  <label for="">Contraseña:</label>
                  <input class="mb-2 form-control" type="password" name="password">

                  <label for="">Confirmar contraseña</label>
                  <input class="form-control mb-4" type="password" name="password_confirmation">

                  <div class="col-md-12">
                    <input type="submit" class="btn btn-primary" value="Actualizar usuario">
                    <a href="{{route('usuarios')}}" class="btn btn-primary">Regresar</a>
                  </div>
              </form>

@endsection