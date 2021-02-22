
<div class="navbar-mobile">
    <a href="<?=base_url()?>cartera/dashboard" class="<?=($page == 'dashboard') ? 'active' : ''?>"><i class="fas fa-chalkboard fa-2x"></i>Dashboard</a>
    <a href="<?=base_url()?>cartera/consulta" class="<?=($page == 'cartera') ? 'active' : ''?>"><i class="fas fa-user-friends fa-2x"></i>Consulta</a>
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
