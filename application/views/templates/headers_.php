<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Activos Fijos</title>
        <!--<link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>img/logo.ico"/>-->

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo base_url();?>asset/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>asset/css/animated.css">
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
        <link rel="stylesheet" href="<?= base_url();?>asset/css/font-awesome5.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>asset/estilos.css">

        <!-- Optional theme -->
        <!-- <link rel="stylesheet" href="<?php echo base_url();?>asset/bootstrap/css/signin.css"> -->

        <script src="<?php echo base_url();?>asset/js/bootstrap/jquery-3.3.1.min.js"></script>
        <!-- <script src="<?php echo base_url();?>asset/js/bootstrap/popper.min.js"></script> -->
        <script src="<?php echo base_url();?>asset/js/bootstrap/bootstrap.min.js"></script>

        <!--<script src="<?php echo base_url()?>asset/js/say-cheese.js"></script>-->
        <script type="text/javascript">
            var baseurl = "<?php echo base_url();?>";
            var console_res = true;
            var id_usuario = "<?php echo $this->session->userdata('s_idUsuario');?>";
            function format_number(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                //return x;
            }

            function icon_is_active(estado) {      
                if (estado == 1 || estado == true) {
                    return `<i style="font-size: 14pt" class="fas fa-check-square"></i>`;
                } else {
                    return '<i style="font-size: 14pt" class="far fa-square"></i>';
                }
            }
        </script>
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="<?=base_url().'modulos'?>"><?php echo (isset($modulo)) ? $modulo : 'Modulos';?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">                
                <?php if(isset($modulo)) {?>
                    <?php if($modulo == 'Precio' && $this->session->userdata('s_precio')) {?>
                        <li class="nav-item <?=($page == 'consulta'? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>precios/consulta">Precios</a>
                        </li>
                    <?php }?>

                    <?php if($modulo == 'Inventario' && $this->session->userdata('s_costo')) {?>
                        <li class="nav-item dropdown <?=($page == 'inventario'? 'active' : '') ?>">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Inventario
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" 
                                href="<?=base_url();?>inventario/consulta">Stock</a>
                            <a class="dropdown-item" 
                                href="<?=base_url();?>inventario/diferencias">Diferencias</a>
                            <?php if($this->session->userdata('s_costo') and $this->session->userdata('s_administrador')) {?>
                                <div class="dropdown-divider"></div>                        
                                    <a class="dropdown-item" href="<?=base_url();?>inventario/confirmacion">Confirmacion</a>                        
                            <?php }?>
                            
                            <?php if($this->session->userdata('s_costo') and $this->session->userdata('s_supervisor')) {?>
                                <a class="dropdown-item" 
                                    href="<?=base_url();?>inventario/historial">Historial</a>                   
                            <?php }?>
                        </li>
                    <?php }?>

                    <?php if($modulo == 'Cartera' && $this->session->userdata('s_cartera')) {?>
                        <!-- <li class="nav-item dropdown <?=($page == 'inventario'? 'active' : '') ?>">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Cartera
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" 
                                href="<?=base_url();?>cartera/consulta">Consulta</a>
                            <?php if($this->session->userdata('s_costo') and $this->session->userdata('s_administrador')) {?>
                                <div class="dropdown-divider"></div>                        
                                <a class="dropdown-item" href="<?=base_url();?>cartera/calificaciones">Calificaciones</a>                        
                            <?php }?>
                        </li> -->
                    <?php }?>

                    <?php if($modulo == 'Visitas' && $this->session->userdata('s_visita_clientes') && $this->session->userdata('s_administrador')) {?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url();?>visitas">Inicio</a>
                        </li>
                        <li class="nav-item <?=($page == 'consulta'? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>visitas/consulta">Consulta</a>
                        </li>
                        <li class="nav-item <?=($page == 'motivo'? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>visitas/motivo">Motivos</a>
                        </li>
                        <li class="nav-item <?=($page == 'rutero'? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>visitas/rutero">Asignar Rutero</a>
                        </li>
                    <?php }?>

                    <?php if($modulo == 'Logistica') {?>
                        <li class="nav-item <?=($page == 'estado' ? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>logistica">Estado</a>
                        </li>
                        <li class="nav-item <?=($page == 'registro' ? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>logistica/registro">Registro</a>
                        </li>
                        <li class="nav-item <?=($page == 'despacho' ? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>logistica/despacho">Despacho</a>
                        </li>
                        
                    <?php }?>

                    <?php if($modulo == 'Traslados') {?>
                        <li class="nav-item <?=($page == 'enviar' ? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>traslados/enviar">Enviar</a>
                        </li>
                        <li class="nav-item <?=($page == 'recibir' ? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>traslados/recibir">Recibir</a>
                        </li>
                        
                    <?php }?>
                    <?php if($modulo == 'Bodega' && $this->session->userdata('s_administrador') == 1 && $this->session->userdata('s_supervisor') == 1) {?>
                        <li class="nav-item <?=($page == 'index' ? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>bodega">Bodega</a>
                        </li>
                        <li class="nav-item <?=($page == 'asignar' ? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>bodega/asignar">Asignar</a>
                        </li>
                    <?php }?>
                <?php  } else { ?> 
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url();?>bodega">Bodega</a>
                    </li>
                <?php  } ?> 
            </ul>

            <form class="form-inline my-2 my-lg-0">
                <a class="mr-sm-2 col-form-label col-form-label-sm text-white" for="txt_referencia">Usuario:</a>
                <button class="mr-sm-2 btn btn-primary" type="button"
                        onclick="setPassword()"><?=$this->session->userdata('s_nombre')?></button>
                <a class="btn btn-danger my-2 my-sm-0" href="<?=base_url();?>login/salir">Salir</a>
            </form>
        </div>
    </nav>