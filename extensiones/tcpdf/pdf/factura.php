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

class imprimirFactura{

public $codigo;


public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],0);
$impuesto = number_format($respuestaVenta["impuesto"],0);
$total = number_format($respuestaVenta["total"],0);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

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



//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
		
		<tr>

			<td style="border: 1px solid #666; background-color:white; width:390px; font-family=Times New Roman">
				
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

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:center; font-family: Times New Roman">
				<div style="font-size:12px; text-align:center; line-height:12px;">
					<br><br><b>RUC: 1234567-8<br>
					TIMBRADO N° 11122233</b>
					
					<div style="font-size:8px; text-align:center; line-height:15px;">
						FECHA INICIO VIGENCIA 01/Enero/2020<br>
						VALIDO HASTA 31/Diciembre/2020<br>

						<div style="font-size:12px; text-align:center; line-height:15px;">
							<b>FACTURA</b><br>
							<b>001-001-$valorVenta</b>
						</div>
					</div>

				</div>

			</td>

		</tr>

	</table>
	<br>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF


	<table style="font-size:10px; font-family: Times New Roman; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:300px">

				<b>FECHA:</b> $fecha

			</td>

			<td style="border: 1px solid #666; background-color:white; width:240px;">
			
				$condicionVenta

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:540px"><b>NOMBRE O RAZÓN SOCIAL:</b> $respuestaCliente[nombre_razon_social]</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:540px"><b>DIRECCIÓN:</b> $respuestaCliente[direccion]</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:540px"><b>RUC/CI:</b> $respuestaCliente[documento]</td>

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
		
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><b>Cantidad</b></td>
		<td style="border: 1px solid #666; background-color:white; width:200px; text-align:center"><b>Descripción</b></td>
		
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><b>Precio Unit.</b></td>
		<td style="border: 1px solid #666; background-color:white; width:60px; text-align:center"><b>Exentas</b></td>
		<td style="border: 1px solid #666; background-color:white; width:40px; text-align:center"><b>5%</b></td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><b>10%</b></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($productos as $key => $item) {

$ivaProducto = 0;

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorServicios::ctrMostrarServicios($itemProducto, $valorProducto);

$valorUnitario = number_format($respuestaProducto["costo"], 0);

$precioTotal = number_format($item["total"], 0);

$ivaProducto = number_format($item["precio"], 0);

$bloque4 = <<<EOF

	<table style="font-size:10px; font-family: Times New Roman; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				1
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:200px; text-align:center">
				$item[descripcion]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">G. 
				$valorUnitario
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:60px; text-align:center"> 
				
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:40px; text-align:center">
				
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">G. 
				$precioTotal
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:10px; font-family: Times New Roman; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center; border-bottom:1px solid #666"></td>

		</tr>
		
		<tr>
		

			<td style="border: 1px solid #666;  background-color:white; width:450px; text-align:left">
				SUBTOTAL:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:left">
				G. $neto
			</td>

		</tr>

		<tr>

			<td style="border: 1px solid #666; background-color:white; width:450px; text-align:left">
				IMPUESTO:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:left">
				G. $impuesto
			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:450px; text-align:left">
				TOTAL:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:left">
				G. $total
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('factura.pdf', 'D');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>