<?php 
/*Este archivo aloja el menu lateral izquierdo*/
?>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="index.html"><img class="main-logo" src="<?php echo base_url(); ?>/assets/img/logo/logo.png" alt="" /></a>
                <strong><img src="<?php echo base_url(); ?>/assets/img/logo/logosn.png" alt="" /></strong>
            </div>
			<div class="nalika-profile">
				<div class="profile-dtl">
					<a href="#">
                        <?php if($foto <> "") {?>
                            <img src="<?php echo base_url();?>/assets/uploads/usuarios/<?php echo $foto ?>" alt="" />
                        <?php } else { ?>
                            <img src="<?php echo base_url();?>/assets/img/notification/4.jpg" alt="" />
                        <?php } ?>
                        </a>  
					<h2><?php echo $nombreusuario ?></h2>
				</div>
				<div class="profile-social-dtl">
					<ul class="dtl-social">
                        <?php if($facebook<>"") {?>
						  <li><a href="<?php echo $facebook ?>" target="_blank"><i class="icon nalika-facebook"></i></a></li>
                        <?php } ?>
                        <?php if($twitter<>"") {?>
                          <li><a href="<?php echo $twitter ?>" target="_blank"><i class="icon nalika-twitter"></i></a></li>
                        <?php } ?>
                        <?php if($LinkelIn<>"") {?>
                          <li><a href="<?php echo $LinkelIn ?>" target="_blank"><i class="icon nalika-linkedin"></i></a></li>
                        <?php } ?>						
					</ul>
				</div>
			</div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li>
                            <a class="has-arrow" href="index.html">
								   <i class="icon nalika-home icon-wrap"></i>
								   <span class="mini-click-non">Configuraciones</span>
								</a>
                            <ul class="submenu-angle" aria-expanded="true">
                                <li><a title="Roles" href="<?php echo site_url('roles'); ?>"><span class="mini-sub-pro">Roles</span></a></li>
                                <li><a title="Usuarios" href="<?php echo site_url('Usuarios'); ?>"><span class="mini-sub-pro">Usuarios</span></a></li>
                                <li><a title="categoria productos" href="<?php echo site_url('categoriasproducto'); ?>"><span class="mini-sub-pro">Categorias productos</span></a></li>
                                <li><a title="Productos" href="<?php echo site_url('productos'); ?>"><span class="mini-sub-pro">Productos</span></a></li>
                                <li><a title="Tipos de clientes" href="<?php echo site_url('tiposdeclientes'); ?>"><span class="mini-sub-pro">Tipos de clientes</span></a>
                                </li>
                                <li><a title="Clientes" href="<?php echo site_url('clientes'); ?>"><span class="mini-sub-pro">Clientes</span></a></li>
                             
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="icon nalika-mail icon-wrap"></i> <span class="mini-click-non">Pedidos</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Nuevo pedido" href="<?php echo site_url('pedidos/nuevo') ?>"><span class="mini-sub-pro">Nuevo pedido</span></a></li>
                                <li><a title="Listado de pedidos" href="<?php echo site_url('pedidos') ?>"><span class="mini-sub-pro">Listado de pedidos</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="icon nalika-diamond icon-wrap"></i> <span class="mini-click-non">Informes</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Pedidos" href="<?php echo site_url('Informes/pedidos') ?>"><span class="mini-sub-pro">Pedidos</span></a></li>
                                <li><a title="Clientes" href="<?php echo site_url('Informes/Clientes') ?>"><span class="mini-sub-pro">Clientes</span></a></li>        
                            </ul>
                        </li>                        
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
 