<aside class="main-sidebar" >

	 <section class="sidebar">

		<ul class="sidebar-menu">

			<?php

			if($_SESSION["perfil"] == "Administrador"){

				echo '<li class="">

					<a href="inicio">
						<i class="fa fa-home"></i>
						<span>Inicio</span>
					</a>

				</li>

				<li>

					<a href="usuarios">
						<i class="fa fa-user"></i>
						<span>Usuarios</span>
					</a>

				</li>';

			}

			if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){

				echo '<li>

					<a href="categorias">
						<i class="fa fa-th"></i>
						<span>Categorías</span>
					</a>

				</li>

				<li>

					<a href="productos">
						<i class="fa fa-product-hunt"></i>
						<span>Productos</span>
					</a>

				</li>';

			}

			if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

				echo '<li>

					<a href="clientes">
						<i class="fa fa-users"></i>
						<span>Clientes</span>
					</a>

				</li>';

			}

			if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

				echo '<li class="treeview">

					<a href="#">
						<i class="fa fa-money"></i>
						<span>Proforma</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>

					</a>

					<ul class="treeview-menu">

						<li>

							<a href="proforma">
								<i class="fa fa-circle-o"></i>
								<span>Administrar proforma</span>
							</a>

						</li>

						<li>

							<a href="crear-proforma">
								<i class="fa fa-circle-o"></i>
								<span>Crear proforma</span>
							</a>

						</li>

					</ul>

				</li>
				
				
				<li class="treeview">

					<a href="#">
					

						<i class="fa fa-cart-plus"></i>
						
						<span>Ventas</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>

					</a>

					<ul class="treeview-menu">
						
						<li>

							<a href="ventas">
								<i class="fa fa-circle-o"></i>
								<span>Administrar ventas</span>
							</a>

						</li>

						<li>

							<a href="crear-venta">	
								<i class="fa fa-circle-o"></i>
								<span>Crear venta</span>
							</a>

						</li>';

						

					

					echo '</ul>

				</li>';
				

			}

				if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){

					echo '<li>
	
						<a href="proveedores">
							<i class="fa fa-users"></i>
							<span>Proveedores</span>
						</a>
	
					</li>';
	
				}

			if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){

				echo '<li class="treeview">

				<a href="#">
					<i class="fa fa-truck"></i>
					<span>Compras</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>

				</a>

				<ul class="treeview-menu">


					<li>

						<a href="compras">
							<i class="fa fa-circle-o"></i>
							<span>Realizar compras</span>
						</a>

					</li>

					<li>

						<a href="administrar-Compras">
							<i class="fa fa-circle-o"></i>
							<span>Administrar compras</span>
						</a>

					</li>

				</ul>

			</li>';

			


			echo '<li class="treeview">

				<a href="#">
					<i class="fa fa-folder-open"></i>
					<span>Gastos</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>

				</a>

				<ul class="treeview-menu">


					<li>

						<a href="categoriaGastos">
							<i class="fa fa-circle-o"></i>
							<span>Categoria de Gastos</span>
						</a>

					</li>

					<li>

						<a href="administrar-Gastos">
							<i class="fa fa-circle-o"></i>
							<span>Administrar gastos</span>
						</a>

					</li>

				</ul>

			</li>';
		}

		if($_SESSION["perfil"] == "Administrador"){
			echo '<li class="treeview">

				<a href="#">
					<i class="fa fa-line-chart"></i>
					<span>Reportes</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>

				</a>

				<ul class="treeview-menu">';

				

					echo '<li>

						<a href="reportes">	
							<i class="fa fa-circle-o"></i>
							<span>Reporte de ventas</span>
						</a>

					</li>
					
					<li>

						<a href="reporte-compras">
							<i class="fa fa-circle-o"></i>
							<span>Reporte de compras</span>
						</a>

					</li>
					
					<li>

						<a href="administrar-Compras">
							<i class="fa fa-circle-o"></i>
							<span>Reporte de general</span>
						</a>

					</li>';

					}

				echo '</ul>

			</li>';
			?>
			

		</ul>

	</section>

</aside>



