<div class="container-fluid px-4 pt-3">
    <form id="form_filtro">
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="cmb_tipo">Tipo Documento</label>
                <select id="cmb_tipo" name="cmb_tipo" class="custom-select">
                    <option value="0">Seleccionar</option>
                    <option value="1">Pedido</option>
                    <option value="2">Cotizacion</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="txt_documento">N° Documento</label>
                <input id="txt_documento" name="txt_documento"
                    type="text" class="form-control" placeholder="N° Documento"/>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="txt_referencia">Referencia</label>
                <input id="txt_referencia" name="txt_referencia"
                    type="text" class="form-control" placeholder="Referencia"/>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="txt_operador">Operador</label>
                <input id="txt_operador" name="txt_operador"
                    type="text" class="form-control" placeholder="Operador"/>
            </div>
        </div>
    </div>
    </form>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-sm" style="font-size: .9rem;">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Documento</th>
                        <th >Fecha</th>
                        <th >Referencia</th>
                        <th scope="col">Operador</th>
                    </tr>
                </thead>
                <tbody id="tbl_documentos">

                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?=base_url()?>src/auditoria.js"></script>