<div class="container pt-4">
    <div class="row">
        <div class="col-md-12 text-center">
            <h6>LISTADO DE ACTIVOS</h6>
        </div>  
        <div class="col-md-10">
            <input type="text" id="txt_filtro" name="txt_filtro" class="form-control" placeholder="¿Que Buscas?">
        </div>
        <div class="col-md-2">
            <a class="btn btn-block btn-outline-success" href="<?=base_url()?>imprimir/activos" target="blank_">Imprimir</a>
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

<script>
    init();
    let delayTimer;

    function init() {
        filtro_activos();

        document.getElementById('txt_filtro').addEventListener('keyup', evt => {
            
            clearTimeout(delayTimer);
            delayTimer = setTimeout(filtro_activos, 500);
        });
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
                                <th>${index + 1}</th>
                                <td>${item.codigo}</td>
                                <td>${item.descripcion}</td>
                                <td class="text-right">${format_number(item.cantidad)}</td>
                            </tr>`
                });

                $('#tbl_filtro').html(tbl);
            }
        });
    }
</script>