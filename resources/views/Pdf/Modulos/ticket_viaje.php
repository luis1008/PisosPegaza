<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ticket Viaje</title>
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
		<p class="text-center" style="font-size:40px;"><b><?php echo $viaje->created_at ?></b></p>
		<p class="text-center"><b><?php echo $nota ?></b></p>
		<p>el repartidor <?php echo $viaje->empleado->em_nombre ?> se le entrego $ <?php echo number_format($viaje->vi_viaticos,2) ?> de viáticos, por la cual hará la entrega de las siguientes notas con destino a <?php echo $viaje->vi_destino ?>: </p>
		<p class="text-center"><b>entrega</b></p>
		<?php foreach ($viaje->pedidos as $entrega): ?>
			<?php if ($entrega->pivot->det_tipo != "COBRANZA"): ?>
				<li><b>Nota N° <?php echo $entrega->pe_nota ?></b></li>
			<?php endif ?>
		<?php endforeach ?>
		<p class="text-center"><b>cobranza</b></p>
		<?php foreach ($viaje->pedidos as $entrega): ?>
			<?php if ($entrega->pivot->det_tipo != "ENTREGA"): ?>
				<li><b>Nota N° <?php echo $entrega->pe_nota ?></b></li>
			<?php endif ?>
		<?php endforeach ?>
		<br><br><br><br>
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
			<p class="text-center" style="font-size:40px;"><b><?php echo $viaje->created_at ?></b></p>
			<p class="text-center"><b>COPIA</b></p>
			<p>Al repartidor <?php echo $viaje->empleado->em_nombre ?> se le entrego $ <?php echo number_format($viaje->vi_viaticos,2) ?> de viáticos, por la cual hará la entrega de las siguientes notas con destino a <?php echo $viaje->vi_destino ?>: </p>
			<p class="text-center"><b>entrega</b></p>
			<?php foreach ($viaje->pedidos as $entrega): ?>
				<?php if ($entrega->pivot->det_tipo != "COBRANZA"): ?>
					<li><b>Nota N° <?php echo $entrega->pe_nota ?></b></li>
				<?php endif ?>
			<?php endforeach ?>
			<p class="text-center"><b>cobranza</b></p>
			<?php foreach ($viaje->pedidos as $entrega): ?>
				<?php if ($entrega->pivot->det_tipo != "ENTREGA"): ?>
					<li><b>Nota N° <?php echo $entrega->pe_nota ?></b></li>
				<?php endif ?>
			<?php endforeach ?>
			<p style="border-top:5px solid black;" class="text-center">
				FIRMA
			</p>
			<p align="center" style="font-size: 30px">www.pegaza.com.mx</p>
			<p align="center" style="font-size: 30px">***************************************************************************************************</p>
	</div>
		</div>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
	<?php endif ?>
</body>
</html>