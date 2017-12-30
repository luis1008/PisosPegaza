<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nota Pedido</title>
	<style>
		body{
			width: 100%;
			/* margin-left: 10%; */
            /* border: 1px solid black; */
		}

		table{
            width:100%;
            border-collapse:collapse;
        }
        div.logo{
        	width: 19%;
        	height: 5%;
        	/* border: 1px solid black;
        	background-color: gray;*/
        	display: inline-block; 
        }
        div.info{
			width: 45%;
        	height: 10%;
        	display: inline-block;
        	/* border: 1px solid black; */
        	margin-top: 5px;
        	text-align: center;
        	font-size: 10px;
        }

        div.info > p{
        	margin: 1px;
        }

        div.nota{
			width: 28%;
        	height: 10%;
        	display: inline-block;
        	/* border: 1px solid black; */
        	text-align: center;
        }

        img.letra{
			width: 170px;
			height: 50px;
        }

        p.border-Title{
        	border-radius: 1px 1px 25px 1px;
        	color: white;
        	/* border: 1px solid black; */
        	font-size: 8px;
        	font-weight: bold;
        	margin: 0px;
        	padding: 5px;
        }

        p.Red{
        	background-color: rgb(255,0,0);
        }

        p.Black{
        	background-color: rgb(0,0,0);
        }
		.ContenidoCenter{
			text-align: center;
			/* text-decoration: underline; */
			border-bottom: 1px solid black;
		}

		td.border{
			border: 1px solid black;
		}

		.text-center{
			text-align: center;
		}

		div.PagareTitle{
			width: 10%;
			background-color: black;
			color: white;
			font-weight: bold;
			display: inline-block;
			padding: 5px;
			border: 2px solid black;
			font-size: 10px;
			text-align: center;
		}

		div.PagarNumero{
			width: 15%;
			display: inline-block;
			padding: 5px;
			border: 2px solid black;
			font-size: 10px;
			margin-left: -8px;
			background-color: white;
		}
	</style>
</head>
<body>
	<div class="text-center">
		<p><b><?php echo $nota ?></b></p>
	</div>
	<div class="logo">
		<img src="img/LogoSinLetra.jpg">
	</div>
	<div class="info">
		<img src="img/letra_logo.png?>" class="letra">
		<p>Orquidea #58 Fracc. la Primavera c.p 49600, Zapotiltic, Jal.</p>
		<p><b>Tels:</b> 01(341) 414-44-44, 414-44-45</p>
		<p><b>Email:</b> pinturaspegaza@hotmail.com</p>
	</div>
	<div class="nota">
		<p class="border-Title Red"><?php echo $leyenda; ?> DEL PEDIDO</p>
		<p style="margin:2px;font-size:10px;"><b>N° <?php echo $pedido->pe_nota ?> </b></p>
		<p class="border-Title Black">FECHA DE PEDIDO</p>
		<p style="margin:2px;font-size:10px;"><b><?php echo $pedido->pe_fecha_pedido ?> </b></p>
		<p class="border-Title Black">FECHA DE ENTREGA</p>
		<p style="margin:2px;font-size:10px;"><b><?php echo $pedido->pe_fecha_entrega ?> </b></p>
	</div>
	<br><br>
	<table>
		<tbody>
			<tr>
				<td width="50"><p class="border-Title Black">NOMBRE:</p></td>
				<td colspan="3" class="ContenidoCenter"><?php echo $pedido->cliente->cl_nombre ?></td>
			</tr>
			<tr>
				<td><p class="border-Title Red">DOMICILIO:</p></td>
				<td colspan="3" class="ContenidoCenter"><?php echo $pedido->pe_destino_pedido ?></td>
			</tr>
			<tr>
				<td><p class="border-Title Black">CIUDAD:</p></td>
				<td class="ContenidoCenter"><?php echo $pedido->pe_destino_ciudad ?></td>
				<td style="border-bottom:1px solid black;" width="50"><p class="border-Title Red">TEL:</p></td>
				<td class="ContenidoCenter"><?php echo $pedido->cliente->cl_telefono ?></td>
			</tr>
		</tbody>
	</table>
	<table style="border: 1px solid black;margin-top:15px;">
		<tbody>
			<tr>
				<td width="50" class="border"><p class="border-Title Black">CANT.</p></td>
				<td width="250" class="border"><p class="border-Title Red">PRODUCTO</p></td>
				<td class="border"><p class="border-Title Black">PRECIO</p></td>
				<td class="border"><p class="border-Title Red">IMPORTE</p></td>
			</tr>
			<?php foreach($pedido->productos as $producto) { ?>
				<tr>
					<td class="border text-center"><b><?php echo $producto->pivot->det_prod_cantidad; ?></b></td>
					<td class="border"><b><?php echo $producto->pd_nombre; ?></b></td>
					<td class="border text-center"><b>$<?php echo number_format($producto->pivot->det_prod_precio,2); ?></b></td>
					<td class="border text-center"><b>$<?php echo number_format($producto->pivot->det_prod_subtotal,2); ?></b></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<table style="margin-top:15px;">
		<tbody>
			<tr>
				<td width="300" colspan="2"><p class="border-Title Red" style="text-transform:uppercase;">SUB-TOTAL CON LETRA - <?php echo $letra ?></p></td>
				<td style="border-width: 1px 0 1px 1px;border-style:solid;"><p class="border-Title Red">SUB-TOTAL $</p></td>
				<td class="text-center" style="border-width: 1px 1px 1px 0;border-style:solid;"><b>$<?php echo number_format($pedido->pe_importe,2) ?></b></td>
			</tr>
			<tr>
				<td colspan="2"><p class="border-Title Black">OBSERVACIONES</p></td>
				<td style="border-width: 1px 0 1px 1px;border-style:solid;"><p class="border-Title Black">I.V.A.</p></td>
				<td class="text-center" style="border-width: 1px 1px 1px 0;border-style:solid;"></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:9px;"><?php echo $pedido->pe_memo ?></td>
				<td style="border-width: 1px 0 1px 1px;border-style:solid;"><p class="border-Title Red">Total $</p></td>
				<td class="text-center" style="border-width: 1px 1px 1px 0;border-style:solid;"></td>
			</tr>
		</tbody>
	</table>
	<br>
	<p class="border-Title Black">CONDICIONES DE PAGO: <?php echo $pedido->pe_forma_pago ?></p>
	<br>
	<div style="position:absolute;">
		<div class="PagareTitle">
			PAGARE
		</div>
		<div class="PagarNumero">
			NO. 
		</div>
	</div>
	<div style="border:2px solid black;margin-top:15px;padding:5px;font-size:10px;text-align:justify;">
		<div>
			<p style="display:inline-block;">EN ZAPOTILTIC, JALISCO A: <?php echo $pedido->pe_fecha_entrega ?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				BUENO POR: <?php echo number_format($pedido->pe_importe,2) ?>
			</p>
			
		</div>
		<p>
			Debo y pagare a la orden de <?php echo $pedido->cliente->cl_nombre ?> en Zapotiltic, Jal. el <?php echo $pedido->pe_fecha_entrega ?> la cantidad de <?php echo number_format($pedido->pe_importe,2) ?> <p>SUB-TOTAL CON LETRA - <?php echo $letra ?></p> valor recibido a mi entera satisfacción. Este pagare forma parte de una serie de (un numero) al (otro número) y todos están sujetos a la condición de que al no pagarse cualquiera de ellos a su vencimiento serán exigibles todos los que sigan en número y desde la fecha de vencimiento de este documento hasta el día de su liquidación. Causara intereses moratorios y con la aceptación de que la mora causara un interés del (%) pagadero en esta ciudad puntualmente con el principal. Se aplicara en lo conducente los numerales 1,2,3,4,5,23,24,26,33,109,110,111,13,114,150,152,170,171,173,174 y demás relativos y aplicables de la ley general de títulos y operaciones de crédito así como los comprendidos del 1391 al 1414 del código del comercio en vigor.
		</p>
		<p><b>DATOS DEL DEUDOR:</b></p>
		<p><b>NOMBRE: </b><span><?php echo $pedido->cliente->cl_nombre_dueno ?></span></p>
		<p><b>DIRECCION: </b><span><?php echo $pedido->pe_destino_pedido . ", " . $pedido->pe_destino_ciudad ?></span></p>
		<p style="display:inline-block;width:75%;"><b>TEL. </b><span><?php echo $pedido->cliente->cl_telefono ?></span></p>
		<p style="display:inline-block;text-decoration:overline;">
			<b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				FIRMA
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</b>
		</p>
	</div>
</body>

</html>