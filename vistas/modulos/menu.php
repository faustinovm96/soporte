<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

		<?php

		if($_SESSION["perfil"] == "Administrador"){

			echo '<li>

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>';

			echo '<li>

				<a href="usuarios">

					<i class="fa fa-user-circle"></i>
					<span>Usuarios</span>

				</a>

			</li>';

			echo '<li>

				<a href="clientes">

					<i class="fa fa-users"></i>
					<span>Clientes</span>

				</a>

			</li>';

			echo '<li>

				<a href="tecnicos">

					<i class="fa fa-wrench"></i>
					<span>Técnicos</span>

				</a>

			</li>';

			echo '<li>

				<a href="equipos">

					<i class="fa fa-desktop"></i>
					<span>Equipos</span>

				</a>

			</li>';

			echo '<li>

				<a href="servicio">

					<i class="fa fa-server"></i>
					<span>Servicios</span>

				</a>

			</li>';

			echo '<li>

				<a href="pedidos">

					<i class="fa fa-check-circle"></i>
					<span>Pedidos</span>

				</a>

			</li>';
			/*
			echo '<li>

				<a href="soporte">

					<i class="fa fa-users"></i>
					<span>Soporte Técnico</span>

				</a>

			</li>';*/

			echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-shopping-cart"></i>
					
					<span>Movimientos</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="crear-venta">
							
							<i class="fa fa-circle-o"></i>
							<span>Agregar</span>

						</a>

					</li>

					<li>

						<a href="ventas">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrar</span>

						</a>

					</li>';


					if($_SESSION["perfil"] == "Administrador"){}		

				echo '</ul>

			</li>';

			echo '<li>

				<a href="reportes">

					<i class="fa fa-book"></i>
					<span>Reportes</span>

				</a>

			</li>';

		}

/*
		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

			echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>
					
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

					if($_SESSION["perfil"] == "Administrador"){

					echo '<li>

						<a href="reportes">
							
							<i class="fa fa-circle-o"></i>
							<span>Reporte de ventas</span>

						</a>

					</li>';

					}

				

				echo '</ul>

			</li>';

		}
*/
		?>

		</ul>

	 </section>

</aside>