<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/servicios.controlador.php";
require_once "../../../modelos/servicios.modelo.php";

class imprimirReporteClientes{

//public $codigo;


public function traerImpresionFactura(){

date_default_timezone_set('America/Asuncion');

$fecha = date('Y-m-d');
$hora = date('H:i:s');
$fechaActual = $fecha.' '.$hora;

$tabla = "ventas";

if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

}else{

$item = null;
$valor = null;

$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

}

//TRAEMOS LA INFORMACIÓN DE LA VENTA
/*
$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],0);
$impuesto = number_format($respuestaVenta["impuesto"],0);
$total = number_format($respuestaVenta["total"],0);
*/
//TRAEMOS LA INFORMACIÓN DEL CLIENTE
/*
$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);
*/
//TRAEMOS LA INFORMACIÓN DEL VENDEDOR
/*
$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

$condicionVenta = '';

if ($respuestaVenta["metodo_pago"] == "Efectivo") {
	$condicionVenta = '<center>Condición de Venta: </center>
				<label for="contado">Contado</label>
				<input type="checkbox" id="contado" name="contado" value="Contado" checked="checked">
				<label for="credito">Crédito</label>
				<input type="checkbox" id="credito" name="credito" value="Crédito">';
} else {
	$condicionVenta = '<center>Condición de Venta: </center>
				<label for="contado">Contado</label>
				<input type="checkbox" id="contado" name="contado" value="Contado">
				<label for="credito">Crédito</label>
				<input type="checkbox" id="credito" name="credito" value="Crédito" checked="checked">';
}

*/

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
		
		<tr>

			<td style="border: 1px solid white; background-color:white; width:540px; font-family=Times New Roman">
				
				<div style="font-size:12px; font-family: Times New Roman; text-align:center; line-height:13px;">
					
					<h1>ALEX INFORMATICA</h1>
					de Claudio Gayoso Palacio

					<div style="font-size:11px; font-family: Times New Roman; text-align:center; line-height:16px;">
						Impresiones en General, Fotocopias, 
						Soporte Técnico de Equipos Informáticos
					</div>

					<b>Dirección: Enrique Doldan Ibieta c/ San Blas

					<br>
					Teléfono: (0971) 868 761
					
					<br>
					cyberalex734@gmail.com</b>

				</div>

			</td>

			<!--<td style="border: 1px solid #666; background-color:white; width:150px; text-align:center; font-family: Times New Roman">
				<div style="font-size:12px; text-align:center; line-height:12px;">
					<br><br><b>RUC: 1234567-8<br>
					TIMBRADO N° 11122233</b>
					
					<div style="font-size:8px; text-align:center; line-height:15px;">
						FECHA INICIO VIGENCIA 01/Enero/2020<br>
						VALIDO HASTA 31/Diciembre/2020<br>

						<div style="font-size:12px; text-align:center; line-height:15px;">
							<b>FACTURA</b><br>
							<b>001-001-00000</b>
						</div>
					</div>

				</div>

			</td>-->

		</tr>

	</table>

	<br>
	<h1 style="text-align:center;">Reporte de ventas</h1>
	<br>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF


	<table style="font-size:10px; font-family: Times New Roman; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid white; background-color:white; width:540px">

				<b>FECHA y HORA:</b> $fechaActual

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid white; background-color:white; width:540px"><b>Usuario:</b> Administrador</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; font-family: Times New Roman; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid white; background-color:white; width:54px; text-align:center"><b>Código</b></td>
		<td style="border: 1px solid white; background-color:white; width:108px; text-align:center"><b>Cliente</b></td>
		<td style="border: 1px solid white; background-color:white; width:108px; text-align:center"><b>Vendedor</b></td>
		<td style="border: 1px solid white; background-color:white; width:81px; text-align:center"><b>Total</b></td>
		<td style="border: 1px solid white; background-color:white; width:81px; text-align:center"><b>Fecha</b></td>
		<td style="border: 1px solid white; background-color:white; width:108px; text-align:center"><b></b></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

$itemCliente = null;
$valorCliente = null;

$clientes = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

foreach ($ventas as $key => $item) {

$cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);
$total = number_format($item["total"],2);
$fecha = substr($item["fecha"],0,10);

/*
$ivaProducto = 0;

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorServicios::ctrMostrarServicios($itemProducto, $valorProducto);

$valorUnitario = number_format($respuestaProducto["costo"], 0);

$precioTotal = number_format($item["total"], 0);

$ivaProducto = number_format($item["precio"], 0);

*/

$bloque4 = <<<EOF

	<table style="font-size:10px; font-family: Times New Roman; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid white; color:#333; background-color:white; width:54px; text-align:center">
				$item[codigo]
			</td>

			<td style="border: 1px solid white; color:#333; background-color:white; width:108px; text-align:center">
				$cliente[nombre_razon_social]
			</td>

			<td style="border: 1px solid white; color:#333; background-color:white; width:108px; text-align:center"> 
				$vendedor[nombre]
			</td>

			<td style="border: 1px solid white; color:#333; background-color:white; width:81px; text-align:center">G. 
				$total
			</td>

			<td style="border: 1px solid white; color:#333; background-color:white; width:81px; text-align:center">
				$fecha
			</td>

		</tr>

	</table>
	<p style="text-align:center;">................................................................................................................................................</p>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque5 = <<<EOF

<br><br><br>
<p style="text-align: right;">________________________________________</p>
<p style="text-align: right;">Firma del Encargado</p>

<!--	<table style="font-size:10px; font-family: Times New Roman; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center; border-bottom:1px solid #666"></td>

		</tr>
		
		<tr>
		

			<td style="border: 1px solid #666;  background-color:white; width:450px; text-align:left">
				SUBTOTAL:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:left">
				G. 0000
			</td>

		</tr>

		<tr>

			<td style="border: 1px solid #666; background-color:white; width:450px; text-align:left">
				IMPUESTO:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:left">
				G. 0000
			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:450px; text-align:left">
				TOTAL:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:left">
				0000
			</td>

		</tr>


	</table>-->

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('reporte_ventas.pdf', 'D');

}

}

$reporte = new imprimirReporteClientes();
//$reporte -> codigo = $_GET["codigo"];
$reporte -> traerImpresionFactura();

?>