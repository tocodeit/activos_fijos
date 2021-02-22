<div class="container pt-4">
    <form id="form">
    <div class="card">
        <div class="card-header text-center">Solicitar prestamo</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-control-label" for="txt_id_prestamo">Cod Prestamo</label>
                        <input  id="txt_id_prestamo" name="txt_id_prestamo" readonly
                                type="text" class="form-control" placeholder=""/>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-control-label" for="dc_fecha">Fecha Prestamo</label>  
                        <input  id="dc_fecha" name="dc_fecha" value="<?=date('Y-m-d')?>"
                                type="date" class="form-control"/>
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label class="form-control-label" for="txt_observacion">Observacion</label>
                        <input  id="txt_observacion" name="txt_observacion"
                                type="text" class="form-control" placeholder="Observacion"/>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control col-md-3" placeholder="Codigo" onfocus="focus_()"
                                id="txt_codigo" name="txt_codigo">
                        <button type="button" class="btn btn-outline-success" onclick="show_modal()"><i class="fa fa-search"></i></button>
                        <input type="text" class="form-control" placeholder="Activo" readonly 
                                id="txt_descripcion">
                    </div>
                </div>

                
                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control text-right" placeholder="Stock" id="txt_stock" readonly>
                        <input type="number" class="form-control text-right" placeholder="Cantidad" 
                                id="txt_cantidad" name="txt_cantidad">
                        <button type="button" class="btn btn-outline-success" onclick="add()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>

                <div class="col-md-1">
                    <button type="button" class="btn btn-block btn-danger" onclick="focus_()"><i class="fa fa-minus"></i></button>
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-block btn-outline-primary" onclick="terminar_prestamo()">Terminar</button>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-sm table-striped">
                        <thead> 
                            <th>#</th> <th>CODIGO</th> <th>DESCRIPCION</th> <th>CANTIDAD</th> <th></th>
                        </thead>
                        <tbody id="tbl_detalle"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </form>

    <!-- modal -->
    <div class="modal fade" id="filtro_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Filtro activos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <input type="text" id="txt_filtro" name="txt_filtro" class="form-control" placeholder="¿Que Buscas?">
                </div>
                <div class="col-md-12">
                    <table class="table table-striped table-sm">
                        <thead>
                            <th>#</th><th>CODIGO</th> <th>DESCRIPCION</th><th>CANTIDAD</th> 
                        </thead>
                        <tbody id="tbl_filtro"></tbody>
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
    let detalle_prestamo = []
    let delayTimer;
    
    function init() {
        filtro_activos();

        document.getElementById('txt_filtro').addEventListener('keyup', evt => {
            
            clearTimeout(delayTimer);
            delayTimer = setTimeout(filtro_activos, 500);
        });

        document.getElementById('txt_codigo').addEventListener('keyup', evt => {
            if (evt.key == 'Enter') {
                one();
            } if (evt.key == 'F2') {
                show_modal();
            }
        });
    }

    function show_modal() {
        modal.modal('show')
    }

    function filtro_activos() {
        const filtro = document.getElementById('txt_filtro').value
        console.log(filtro);

        $.ajax({
            type: 'POST',
            url: baseurl + `api/activo/list`,
            data: {filtro},
            beforeSend: function() {},
            success: function (res) {
                if (console_res) console.log(res);
                let tbl = '';

                res.forEach((item, index) => {
                    tbl += `<tr>
                                <td>${index + 1}</td>
                                <td><button type="button" class="btn btn-sm-tbl btn-outline-secondary" onclick="this_one('${item.codigo}', '${item.descripcion}', ${item.cantidad})">${item.codigo}</button></td>
                                <td>${item.descripcion}</td>
                                <td class="text-right">${format_number(item.cantidad)}</td>
                            </tr>`
                });

                $('#tbl_filtro').html(tbl);
            }
        });
    }

    function this_one(codigo, descripcion, cantidad) {
        console.log(codigo, descripcion, cantidad);

        document.getElementById('txt_codigo').readOnly = true
        document.getElementById('txt_codigo').value = codigo;
        document.getElementById('txt_descripcion').value = descripcion;
        document.getElementById('txt_stock').value = cantidad;
        
        document.getElementById('txt_cantidad').value = 1
        document.getElementById('txt_cantidad').setAttribute("max",cantidad); 

        modal.modal('hide');
        document.getElementById('txt_cantidad').focus();
    }

    function one() {
        const codigo = document.getElementById('txt_codigo').value
        $.ajax({
            type: 'GET',
            url: baseurl + `api/activo/one/${codigo}`,
            data: {},
            beforeSend: function() {},
            success: function (res) {
                if (console_res) console.log(res);
                
                if (res) {
                    this_one(res.codigo, res.descripcion, res.cantidad)
                }
            }
        });
    }

    function focus_() {
        document.getElementById('txt_codigo').select();
        document.getElementById('txt_codigo').readOnly = false
        document.getElementById('txt_descripcion').value = '';
        document.getElementById('txt_stock').value = '';

        document.getElementById('txt_cantidad').value = '';
    }

    function add() {
        const cantidad = document.getElementById('txt_cantidad');
        console.log(cantidad, cantidad.value, cantidad.max);
        if (Number(cantidad.value) > Number(cantidad.max)) {
            Swal.fire('',`La cantidad no puede ser mayor a ${cantidad.max}`, 'warning')
        } else {

            const data = {
                id      : Number(document.getElementById('txt_id_prestamo').value),
                fecha   : document.getElementById('dc_fecha').value,

                codigo      : document.getElementById('txt_codigo').value,
                descripcion : document.getElementById('txt_descripcion').value,
                cantidad    : document.getElementById('txt_cantidad').value,
            }

            $.ajax({
                type: 'POST',
                url: baseurl + `api/prestamo/add`,
                data,
                beforeSend: function() {},
                success: function (res) {
                    if (console_res) console.log(res);
                    
                    if (res.res.id_prestamo > 0) {
                        Swal.fire({title: 'Linea agregadass', icon: 'success', onDestroy: () => {focus_()}});

                        document.getElementById('txt_id_prestamo').value = res.res.id_prestamo;
                        document.getElementById('txt_observacion').readOnly = true
                        load_detalle(res.res.detalle)
                    }
                }
            });
        }
    }

    function delete_row(id_prestamo, id) {
        $.ajax({
            type: 'POST',
            url: baseurl + `api/prestamo/delete_detalle/${id_prestamo}/${id}`,
            data: {},
            beforeSend: function() {},
            success: function (res) {
                if (console_res) console.log(res);
                
                if (res) {
                    Swal.fire({ title: 'Linea eliminado', icon: 'info', onDestroy: () => {focus_()} });
                    load_detalle(res.detalle)
                }
            }
        });
    }

    function load_detalle(detalle) {
        detalle_prestamo = detalle

        let tbl = '';
        detalle.forEach((item, index) => {
            tbl += `<tr>
                        <th>${index + 1}</th> <td>${item.codigo}</td> <td>${item.descripcion}</td>
                        <td class="text-right">${format_number(item.cantidad)}</td> 
                        <td> 
                            <button type="button" class="btn btn-outline-danger btn-sm-tbl"
                                    onclick="delete_row(${item.id_prestamo}, ${item.id})">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>`
        });

        $('#tbl_detalle').html(tbl);
    }

    function terminar_prestamo() {
        detalle_prestamo = []
        $('#form')[0].reset();
        $('#tbl_detalle').html('');
        
        document.getElementById('txt_observacion').readOnly = false
        focus_()
    }
</script>