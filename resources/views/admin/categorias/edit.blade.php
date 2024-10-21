@extends('admin.templates.body')
    @section('content')
      @if(session('session_start_usuario'))

       @if ($errors->any())
         <div class="alert alert-danger">
           <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
           </ul>
         </div>
       @endif

       @if (($success = Session::get('success')))
       <script>
Swal.fire({
position: "top-right",
icon: "success",
title: "{{$success}}",
showConfirmButton: false,
timer: 2500
});
       </script>
  @endif
       
         <h2 class="text-center mb-5">{{$categoria->nombre_categoria}}</h2>
         <div class="conatiner w-50 mx-auto">
               <p>Llene los datos con cuidado, porfavor.</p>
              <form action="{{url('/admin/categorias/'.$categoria->id)}}" method="post">
                @csrf
                @method('PUT')
                <label for="">Nombre de la categoria</label>
                <input class="form-control mb-2" type="text" value="{{$categoria->nombre_categoria}}" name="nombre_categoria" placeholder="Agrega un nombre">

                <input type="submit" class="btn btn-primary" value="Actualizar categoria">
              </form>
         </div>
        @else
            <p>No existe sesión</p>
        @endif
    @endsection

