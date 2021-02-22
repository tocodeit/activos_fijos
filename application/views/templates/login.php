<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Metropolis</title>        
        <link rel="icon" type="image/png" href="<?php echo base_url();?>asset/img/icono.jpg">
        <script src="<?php echo base_url();?>asset/js/bootstrap/jquery-3.3.1.min.js"></script>
        <script src="<?php echo base_url();?>asset/js/bootstrap/jquery-1.12.0.min.js"></script>
        <!-- <script src="<?php echo base_url();?>asset/js/jquery-1.12.4.min.js"></script> -->
        <!--<script src="<?php echo base_url();?>asset/js/login.js"></script>-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="<?php echo base_url();?>asset/css/signin.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script type="text/javascript">
            var baseurl = "<?php echo base_url(); ?>";
        </script>
    </head>
    <body>
        <div class="container">

            <form id="login" class="form-signin" method="POST" action="<?php echo base_url();?>index.php/login/ingresar">
                <h2 class="form-signin-heading text-center">Iniciar Sesión</h2>
                <label for="usuario" class="sr-only">Cedula</label>
                <input type="text" id="txtUsuario" name="txtUsuario" class="form-control" placeholder="Cedula" required autofocus>
                <label for="pass" class="sr-only">Password</label>
                <input type="password" id="txtPassword" name="txtPassword" class="form-control" placeholder="Contraseña" required>
                <button id="btnLogin" class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
                <small id="emailHelp" class="form-text text-right">Puedes <a href="<?=base_url()?>login/registro">Registrarte</a></small>
            </form>

        </div> <!-- /container -->
        <div class="container" id="resultado"></div>

    </body>
</html>
