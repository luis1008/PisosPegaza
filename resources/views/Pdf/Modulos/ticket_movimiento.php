<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ticket Movimiento Temporal</title>
	<style>
		body{
			width: 100%;
			margin-left: 0%;
            /* border: 1px solid black; */
            font-size: 55px;
            text-transform: uppercase;
		}

		.text-center{
			text-align: center;
		}

		.text-justify{
			text-align: justify;
		}
	</style>
</head>
<body>
	<div>
		<p align="center" style="font-size: 40px">Fecha</p>
		<p class="text-center" style="font-size:40px;"><b><?php echo $movimiento->created_at ?></b></p>
		<p class="text-center"><b><?php echo $nota ?></b></p>
		<p>A la persona: <?php echo $movimiento->empleado ?> se le entregó la cantidad de: $ <?php echo number_format($movimiento->mt_entregado,2) ?> para ir a comprar a los diferentes lugares lo siguiente:</p>
		<p class="text-center"><b>Concepto</b></p>

		<?php $conceptos = \DB::table('detalle_movimientos')->select('ct_concepto','id_concepto')->where('movimiento_temporal_id',$movimiento->id_movimiento_temporal)->where('compra_id','0')->get(); ?>

		<?php foreach ($movimiento->compras as $compra){ ?>
			<li>Compra No° <?php echo str_pad($compra->cm_nota, 2, "0", STR_PAD_LEFT) ?></li>
		<?php } ?>
		<?php foreach($conceptos as $con){ ?>
										<li><?php echo $con->ct_concepto ?></li>
									<?php } ?>
	
		<p style="border-top:5px solid black;" class="text-center">
			FIRMA
		</p>
		<p align="center" style="font-size: 30px">www.pegaza.com.mx</p>
			<br>
		<p align="center" style="font-size: 20px">***************************************************************************************************</p>
	</div>
			   	 
	<?php if ($nota == "ORIGINAL"): ?>
		<div> 
		<p align="center" style="font-size: 40px">Fecha</p>  				 
			<p class="text-center" style="font-size:40px;"><b><?php echo $movimiento->created_at ?></b></p>
		<p class="text-center"><b>COPIA</b></p>
		<p>A la perona: <?php echo $movimiento->empleado ?> se le entrego la cantidad de: $ <?php echo number_format($movimiento->mt_entregado,2) ?> para ir a comprar a los diferentes lugares lo siguiente:</p>
		<p class="text-center"><b>Concepto</b></p>

		<?php $conceptos = \DB::table('detalle_movimientos')->select('ct_concepto','id_concepto')->where('movimiento_temporal_id',$movimiento->id_movimiento_temporal)->where('compra_id','0')->get(); ?>

		<?php foreach ($movimiento->compras as $compra){ ?>
			<li>Compra No° <?php echo str_pad($compra->cm_nota, 2, "0", STR_PAD_LEFT) ?></li>
		<?php } ?>
		<?php foreach($conceptos as $con){ ?>
										<li><?php echo $con->ct_concepto ?></li>
									<?php } ?>
		<br><br><br><br>
		<p style="border-top:5px solid black;" class="text-center">
			FIRMA
		</p>
		<p align="center" style="font-size: 30px">www.pegaza.com.mx</p>
		<p align="center" style="font-size: 30px">***************************************************************************************************</p>
		</div>
	<?php endif ?>
</body>
</html>