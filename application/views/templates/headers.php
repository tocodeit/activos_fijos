<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
if(empty($this->session->userdata('s_idUsuario'))){
    redirect('/', 'location');
}  ?>
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
        <a class="navbar-brand" href="#"><?php echo (isset($modulo)) ? $modulo : 'Modulos';?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">                
                <?php if(isset($modulo)) {?>
                    <?php if($this->session->userdata('s_is_admin') == 1) {?>
                        <li class="nav-item <?=($page == 'solicitudes' ? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>prestamo/solicitudes">Solicitudes</a>
                        </li>
                        <li class="nav-item <?=($page == 'entrega' ? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>prestamo/entrega">Entregar</a>
                        </li>
                        <li class="nav-item <?=($page == 'entregados' ? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>prestamo/entregados">Entregados</a>
                        </li>
                        <li class="nav-item <?=($page == 'sin_entregar' ? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>prestamo/sin_entregar">Sin entregar</a>
                        </li>
                        <li class="nav-item <?=($page == 'activo' ? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>activo">Activos</a>
                        </li>
                        <li class="nav-item <?=($page == 'activo' ? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url()?>login/registro">Usuarios</a>
                        </li>
                    <?php } else {?>
                        <li class="nav-item <?=($page == 'solicitar' ? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>prestamo/solicitar">Solicitar</a>
                        </li>
                        <li class="nav-item <?=($page == 'mis_solicitudes' ? 'active' : '') ?>">
                            <a class="nav-link" href="<?=base_url();?>prestamo/mis_solicitudes">Mis Solicitudes</a>
                        </li>
                    <?php }?>
                <?php  } ?> 
            </ul>

            <form class="form-inline my-2 my-lg-0">
                <a class="mr-sm-2 col-form-label col-form-label-sm text-white " for="txt_referencia">Usuario:</a>
                <button class="mr-sm-2 btn btn-primary" type="button"
                        onclick="setPassword()"><?=$this->session->userdata('s_nombre')?></button>
                <a class="btn btn-danger my-2 my-sm-0" href="<?=base_url();?>login/salir">Salir</a>
            </form>
        </div>
    </nav>