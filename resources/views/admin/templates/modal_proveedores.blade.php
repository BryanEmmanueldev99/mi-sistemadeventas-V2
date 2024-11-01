<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProveedor_compra">
    Buscar Proveedor
</button>


<div class="row mt-3">
    <div class="col-md-12">
        <input class="form-control" type="text" id="nombre_proveedor" name="nombre_proveedor">
    </div>

    <div class="col-md-1">
        <input class="form-control" type="text" id="id_proveedor" name="id_proveedor" hidden>
    </div>
</div>


<!-- Modal de proveedores -->
<div class="modal fade" id="modalProveedor_compra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">
                    Busca algún proveedor
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!--TABLA DE PROVEEDORES!-->
                <div class="table-responsive mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                    <table class="table table-primary mt-3" id="proveedores_datatables">
                        <thead>
                            <tr>
                                <th scope="col">Proveedor</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Empresa</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($proveedores as $proveedor)
                                <tr class="">
                                    <td scope="row">
                                        {{ $proveedor->nombre_proveedor }}
                                        <input type="text" value="{{$proveedor->id}}" hidden>
                                        <input type="text" value="{{$proveedor->nombre_proveedor}}" hidden>
                                    </td>
                                    <td scope="row">{{ $proveedor->celular_proveedor }}</td>
                                    <td scope="row">{{ $proveedor->email_proveedor }}</td>
                                    <td scope="row">{{ $proveedor->empresa_proveedor }}</td>
                                    <td scope="row">
                                        <button id="btn_selecionar_proveedor{{ $proveedor->id }}" class="btn btn-primary">Seleccionar</button>

                                        <script>
                                            $('#btn_selecionar_proveedor{{ $proveedor->id }}').click(function() {
                                        
                                                const id_proveedor = "{{$proveedor->id}}";
                                                $('#id_proveedor').val(id_proveedor);
                                        
                                                const nombre_proveedor = "{{$proveedor->nombre_proveedor}}";
                                                $('#nombre_proveedor').val(nombre_proveedor);

                                    
                                                //cierra el modal al seleccionar un proveedor
                                                $('#modalProveedor_compra').modal('toggle');
                                            });
                                        </script>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script>
                        let table = new DataTable('#proveedores_datatables', {
                            "pageLength": 3,
                            layout: {
                                topStart: {
                                    buttons: ['copy', 'csv', /*'excel',*/ 'pdf', 'print']
                                }
                            },
                            "language": {
                                "emptyTable": "No hay información",
                                "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                                "infoEmpty": "Mostrando 0 a 0 de 0 Proveedores",
                                "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                                "infoPostFix": "",
                                "thousands": ",",
                                "lengthMenu": "Mostrar _MENU_ Generar Reportes",
                                "loadingRecords": "Cargando...",
                                "processing": "Procesando...",
                                "search": "Buscador:",
                                "zeroRecords": "Sin resultados encontrados",
                                "paginate": {
                                    "first": "Primero",
                                    "last": "Ultimo",
                                    //   "next": "Siguiente",
                                    //   "previous": "Anterior"
                                }
                            },

                            "responsive": true,
                            "lengthChange": true,
                            "autoWidth": true,
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
