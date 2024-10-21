@extends('admin.templates.body')
    @section('content')
        @if(session('session_start_usuario'))
        <div class="container p3 mb-3">
            <h2>Modulo usuarios</h2>
        </div>
           <div
            class="table-responsive mt-3"
           >

     @if (( $success = Session::get('success') ))
        <script>
            Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{$success}}",
            showConfirmButton: true,
            timer: 1500
          });
        </script>
     @endif

           <a class="btn btn-primary" href="{{route('vista_create_usuario')}}">Agregar nuevo usuario</a>
            <table
                class="table table-primary mt-3"
            >
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($usuarios as $usuario)
                    <tr class="">
                        <td scope="row">{{$usuario->name}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>
                            <div class="d-flex" style="gap: 7px; flex-wrap:wrap;">
                                <a class="btn btn-primary" href="{{url('/admin/usuarios/editar_usuario/'.$usuario->id)}}">Editar</a>
                             <form id="request_submit" action="{{url('/admin/usuarios/'.$usuario->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button id="confirmacion_eliminar" type="submit" class="btn btn-primary">Borrar</button>

                                <script>
                                    document.querySelector("#confirmacion_eliminar").onclick = function () {
                                         alert('¿Estas seguro de borrar?');
//                                          const request_submit = document.querySelector('#request_submit');
//                                          const res = "Si, deseo eliminar.";
//                                          request_submit.onsubmit = function(e){
//                                                 if(!res) {
//                                                     e.preventDefault();
//                                                 }else{
                                                    
//                                                 }
                                              
		                                 
// 	}
//                                          Swal.fire({
//   title: "Are you sure?",
//   text: "You won't be able to revert this!",
//   icon: "warning",
//   showCancelButton: true,
//   confirmButtonColor: "#3085d6",
//   cancelButtonColor: "#d33",
//   confirmButtonText: res
// })
                                    }
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

