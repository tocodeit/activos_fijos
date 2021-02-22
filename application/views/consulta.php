<div class="container-fluid px-4 pt-3">
    <form id="form_filtro">
    <div class="row">
        <div class="col-md-2 col-6">
            <div class="form-group">
                <select id="cmb_canal" name="cmb_canal" class="custom-select">
                    <option value="-1">Seleccionar</option>                    
                </select>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="form-group">
                <input id="txt_referencia" name="txt_referencia"
                    type="text" class="form-control" placeholder="Referencia"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input id="txt_descripcion" name="txt_descripcion"
                    type="text" class="form-control" placeholder="Descripcion"/>
            </div>
        </div>
    </div>
    </form>

    <div class="row">
        <div class="col-md-12 col-12">
        <div id="list" class="list-group">
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading</h5>
                <small>3 days ago</small>
                </div>
                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                <small>Donec id elit non mi porta.</small>
            </a>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading</h5>
                <p class="text-muted">3 days ago</p>
                </div>
                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                <small class="text-muted">Donec id elit non mi porta.</small>
            </a>
        </div>

            <table class="table table-sm d-none" style="font-size: .9rem;">
                <thead>
                    <tr>
                        <th width="7%" class="text-center">Referencia</th>
                        <th scope="col">Descripcion</th>
                        <th width="15px">Stock</th>
                        <th width="15%" scope="col">Valor</th>
                        
                    </tr>
                </thead>
                <tbody id="tbl_documentos">

                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal Calculo -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Utilidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-6 h5" id="mod_referencia"></div>
                        <div class="col-md-6 col-6 text-right" id="mod_precio"></div>

                        <div class="col-md-12" id="mod_articulo"></div>
                        <input type="hidden" id="mod_costo">
                        <input type="hidden" id="mod_iva">
                    </div>
                    <hr/>
                    <div class="row">                        
                        <div class="col-8">
                            <div class="form-group">
                                <label for="txt_precio">Precio</label>
                                <input id="txt_precio" name="txt_precio" onkeyup="to_calc_utilidad()"
                                    type="number" class="form-control" placeholder="Precio"/>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="txt_porc_utilidad">% Utilidad</label>
                                <input id="txt_porc_utilidad" name="txt_porc_utilidad" onkeyup="to_calc_precio()"
                                    type="number" class="form-control" placeholder="% Utilidad"/>
                            </div>
                        </div>
                    </div>

                    <div id="modal_prov">
                        <hr/>
                        <div class="row">
                            <input type="hidden" id="mod_precio_proveedor">
                            <div class="col-md-6 col-6">
                                <small><strong id="mod_precio_lista">P.Lista $ ######### </strong></small>
                            </div>
                            <div class="col-md-6 col-6 text-right" id="mod_precio">
                                <small id="mod_descuento">Dcto: $#######</> %</small>                   
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>src/consulta.js"></script>