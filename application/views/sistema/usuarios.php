<div class="container pt-4">
    <form id="form">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center">INFORMACION USUARIO</div>
                <div class="card-body">
                    <div class="row">

                        <input type="hidden" name="is_admin" id="is_admin" value="<?=(empty($this->session->userdata('s_is_admin')) ? '0' : '1')?>">

                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-control-label" for="txt_nit">Nit *</label>
                                <input  id="txt_nit" name="txt_nit"
                                        type="number" class="form-control" placeholder="Nit"/>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="form-group">
                                <label class="form-control-label" for="txt_pass">Password</label>
                                <input  id="txt_pass" name="txt_pass"
                                        type="password" class="form-control" placeholder="Contraseña"/>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="txt_nombre">Nombre</label>
                                <input  id="txt_nombre" name="txt_nombre"
                                        type="text" class="form-control" placeholder="Nombre"/>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="txt_direccion">Direccion</label>
                                <input  id="txt_direccion" name="txt_direccion"
                                        type="text" class="form-control" placeholder="Direccion"/>
                            </div>
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label class="form-control-label" for="txt_telefono">Telefono</label>
                                <input  id="txt_telefono" name="txt_telefono"
                                        type="text" class="form-control" placeholder="Telefono"/>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <button type="button" class="btn btn-block btn-outline-primary" onclick="to_save()">Guardar</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-block btn-danger">Cancelar</button>
                        </div>

                    </div> <!-- end row -->
                </div>
            </div>
        </div>

        <div class="col-md-7 <?=$this->session->userdata('s_is_admin') ? '' : 'd-none'?>">
            <table class="table table-sm table-striped">
                <thead>
                    <th>#</th> <th>Nit</th> <th>Nombre</th> <th></th>
                </thead>
                <tbody id="tbl_usuarios"></tbody>
            </table>
        </div>
    </div>
    </form>
</div>

<script>
    init();
    function init() {

    }

    function to_save() {
        const data = {
            nit : document.getElementById('txt_nit').value,
            nombre : document.getElementById('txt_nombre').value,
            pass : document.getElementById('txt_pass').value,
            direccion : document.getElementById('txt_direccion').value,
            telefono : document.getElementById('txt_telefono').value,
            administrador : document.getElementById('is_admin').value,
        }

        console.log(data);
        $.ajax({
            type: 'POST',
            url: baseurl + `api/usuario/new`,
            data,
            beforeSend: function() {},
            success: function (res) {
                if (console_res) console.log(res);
                
                if (res.res) {
                    Swal.fire('usuario se registro correctamente', '', 'success');
                    clean();
                } else {
                    Swal.fire('usuario ya existe', '', 'error') 
                }
            }
        });
    }

    function clean() {
        let form = $('#form');
        form[0].reset();
    }

</script>