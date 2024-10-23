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

      

         <div class="conatiner mx-auto">
              <form action="{{route('categorias.store')}}" method="post">
                @csrf

                   <div class="d-flex gap-3">
                       <div class="col-md-8 bg-white shadow-sm rounded p-3">
                        <h2 class="text-center mb-5">Generar nueva compra</h2>
                        <p>Llene los datos con cuidado, porfavor.</p>
                           contenido carrrito
                       </div>
                       <div class="col-md-4 bg-white shadow-sm rounded p-3">
                           <div class="mb-4">
                            <label for="">No. de compra</label>
                            @php
                                date_default_timezone_set('America/Mexico_City');
                                $tiempo_nro_compra = date("F j, Y, g:i a"); 
                                $nro_compra = mt_rand()."_" . date("Y-m-d H:i:s");
                            @endphp
                            <input class="form-control mb-2" type="text" value="{{$nro_compra}}" name="nro_compra" disabled>
                            <input class="form-control mb-2" type="text" value="{{$nro_compra}}" name="nro_compra" hidden>
                           </div>
                        <input type="submit" class="btn btn-primary" value="Generar compra">
                       </div>
                   </div>
              </form>
         </div>
        @else
            <p>No existe sesión</p>
        @endif
    @endsection

