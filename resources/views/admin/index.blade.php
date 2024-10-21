@extends('admin.templates.body')
    @section('content')
            @if (( $success = Session::get('success') ))
               <div
                class="alert alert-success alert-dismissible fade show mt-3"
                role="alert"
               >
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>
                 <p>{{$success}}</p>
               </div>
               
               <script>
                var alertList = document.querySelectorAll(".alert");
                alertList.forEach(function (alert) {
                    new bootstrap.Alert(alert);
                });
               </script>
               
            @endif
        @if(session('session_start_usuario'))
           
           @foreach (session('session_start_usuario') as $data_session => $u_session)
                <h2>Hola {{$u_session['name']}}</h2>
           @endforeach

            <form action="{{route('cerrar_sesion')}}" method="POST">
                @csrf
                <input class="btn btn-primary" type="submit" value="Cerrar la sesión" />
            </form>
         @else
            <p>Lo siento no ház iniciado sesión.</p>
        @endif
    @endsection

