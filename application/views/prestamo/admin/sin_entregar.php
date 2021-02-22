<div class="container pt-4">
    <div class="row">
        <div class="col-md-12 text-center">
            <h6>ACTIVOS FUERA DE FECHA DE ENTREGA</h6>
        </div>
        <div class="col-md-12">
            <table class="table table-sm table-striped">
                <thead>
                    <th>#</th>    
                    <th># Prestamo</th>
                    <th>Fecha</th>
                    <th>Dias</th>
                    <th>Usuario</th>
                    <th>Telefono</th>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                </thead>
                <tbody id="tbl_prestamos"></tbody>
            </table>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="filtro_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalles Prestamo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">                
                <div class="col-md-12">
                    <table class="table table-striped table-sm">
                        <thead>
                            <th>#</th><th>CODIGO</th> <th>DESCRIPCION</th><th>CANTIDAD</th> 
                        </thead>
                        <tbody id="tbl_detalle"></tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>


</div>

<script>
    init();
    let modal = $('#filtro_modal');
    let id_ = null; 

    function init() {
        filtro();
    }

    function filtro() {
        $.ajax({
            type: 'POST',
            url: baseurl + `api/prestamo/activos_fuera_de_fecha`,
            data: {},
            beforeSend: function() {},
            success: function (res) {
                if (console_res) console.log(res);
                
                let tbl = '';
                res.forEach((item, index) => {
                    tbl += `
                    <tr>
                        <th>${index + 1}</th> 
                        <th width="10%">${item.id} </th> 
                        <td width="10%">${item.fecha}</td> <td>${item.dif}</td> 
                        <td>${item.nombre}</td>  <td>${item.telefono}</td> 
                        <td>${item.codigo}</td>  <td>${item.descripcion}</td>  <td>${item.cantidad}</td> 
                    </tr>`
                });

                $('#tbl_prestamos').html(tbl);
            }
        });
    }

    
</script>