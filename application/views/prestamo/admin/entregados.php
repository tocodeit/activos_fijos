<div class="container pt-4">
    <div class="row">
        <div class="col-md-12 text-center">
            <h6>PRESTAMOS ENTREGADOS</h6>
        </div>

        <div class="col-md-9"></div>
        <div class="col-md-3">
            <a class="btn btn-block btn-sm btn-outline-success" target="blank_" href="<?=base_url()?>imprimir/responsables_activos">Imprimir Listado responsables</a>
        </div>
        <div class="col-md-12">
            <table class="table table-sm table-striped">
                <thead>
                    <th>#</th>    
                    <th># Prestamo</th>
                    <th>Fecha</th>
                    <th>Tercero</th>
                    <th>Activos</th>
                    <th>Observacion</th>
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
            url: baseurl + `api/prestamo/list/5`,
            data: {},
            beforeSend: function() {},
            success: function (res) {
                if (console_res) console.log(res);
                
                let tbl = '';
                res.list.forEach((item, index) => {
                    tbl += `
                    <tr>
                        <th>${index + 1}</th> 
                        <th width="10%">
                            <button type="button" class="btn btn-block btn-sm-tbl btn-outline-secondary"
                                    onclick="detalle_prestamo(${item.id})">${item.id}</button>
                        </th> 
                        <td width="10%">${item.fecha}</td> <td id="tercero_${item.id}">${item.nombre}</td> 
                        <td width="15%" class="text-right">${Number(item.tot)}</td> 
                        <td>${(item.observacion) ? item.observacion : ''}</td>
                    </tr>`
                });

                $('#tbl_prestamos').html(tbl);
            }
        });
    }

    function detalle_prestamo(id_prestamo) {
        $.ajax({
            type: 'GET',
            url: baseurl + `api/prestamo/detalle_prestamo/${id_prestamo}`,
            data: {},
            beforeSend: function() {},
            success: function (res) {
                if (console_res) console.log(res);
                
                let tbl = '';
                let block_aceptar = false;
                res.forEach((item, index) => {
                    tbl += `
                    <tr>
                        <th>${index + 1}</th> 
                        <td class="text-right">${item.codigo}</td>
                        <td>${item.descripcion}</td>
                        <td class="text-right ${(Number(item.cantidad) > Number(item.stock)) ? 'text-danger': ''}">${item.cantidad}</td>
                    </tr>`

                    if (!block_aceptar) {
                        block_aceptar = (Number(item.cantidad) > Number(item.stock)) ? true : false
                    }
                });

                id_ = id_prestamo

                $('#tbl_detalle').html(tbl);
                modal.modal('show')
            }
        });
    }

    
</script>