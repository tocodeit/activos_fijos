
<div class="navbar-mobile">
    <a href="<?=base_url()?>visitas" class="<?=($page == 'home') ? 'active' : ''?>"><i class="fas fa-chalkboard fa-2x"></i>Home</a>
    <a href="<?=base_url()?>visitas/clientes" class="<?=($page == 'clientes') ? 'active' : ''?>"><i class="fas fa-user-friends fa-2x"></i>Clientes</a>
    <a href="<?=base_url()?>visitas/nuevo" class="<?=($page == 'nuevo') ? 'active' : ''?>"><i class="fas fa-user-plus fa-2x"></i>Nuevo Cliente</a>    
    <a href="<?=base_url()?>visitas/rutaDia" class="<?=($page == 'rutaDia') ? 'active' : ''?>"><i class="far fa-calendar fa-2x"></i>Rutas</a>
</div>

<style>
    .navbar-mobile {
        position:fixed;
        bottom:0;
        left:0;
        right:0;
        z-index:1000;
        
        //give nav it's own compsite layer
        will-change:transform;
        transform: translateZ(0);
        
        display:flex;	
        
        height:50px;
        
        box-shadow: 0 -2px 1px -2px #333;
        background-color:#fff;
    }

    /* Style the links inside the navigation bar */
    .navbar-mobile a {
        flex-grow:1;
		text-align:center;
		text-decoration: none;
        font-size: 12px;
		
		display:flex;
		flex-direction:column;
		justify-content:center;
    }

    /* Change the color of links on hover */
    .navbar-mobile a:hover {
        color: orange;
    }

    /* Add a color to the active/current link */
    .navbar-mobile a.active {
        color: white;
        background-color: orange;
    }
</style>
