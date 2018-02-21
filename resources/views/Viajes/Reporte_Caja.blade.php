@extends('Template.Body')

@section('title','Reporte Viaje')

@section('style')
	<style>
		label{
			font-weight: bold;
		}
	</style>
@stop 

@section('body')

	<?php if (count($viajes) < 1): ?>
		<tr>
			<td colspan="9" class="table-dark">NO SE ENCONTRO NINGUN REGISTRO</td>
		</tr>
	<?php endif ?>
		 		
	<table class="table">
		<tr style="border-style:hidden;">
			<td colspan="2"></td>
			<td><b>Viaje:</b></td><td style="color:red;"><?php echo $viajes->id_viaje ?></td>
		</tr>
		<tr style="border-style:hidden;">
		
			<td><b>Repartidor:</b></td><td><?php echo $viajes->empleado->em_nombre ?></td>
		
			<td><b>Destino:</b></td><td><?php echo $viajes->vi_destino ?></td>
			<td><b>Fecha:</b></td><td><?php echo $viajes->created_at ?></td>
		</tr>
		<tr style="border-style:hidden;">
		
			<td><b>Vehiculo:</b></td><td><?php echo $viajes->vehiculo->vh_nombre ?></td>
		
			<td><b>Viáticos:</b></td><td><?php echo $viajes->vi_viaticos ?></td>
			<td><b>Kilometraje Inicial:</b></td><td><?php echo $viajes->vi_kilometraje_inicial ?></td>
		</tr>
	</table>
	<div class="card">
		<div class="card-header bg-danger text-center text-white"><b>Entrego</b></div>
		<table class="table table-sm">
			<thead>
				<th>Nota</th>
				<th>Fecha</th>
				<th>Cliente</th>
				<th>Importe</th>
				<th>Destino</th>
				<th>Estatus</th>
			</thead>
			<tbody>
				<?php foreach ($viajes->pedidos as $pedido): ?>
					<?php if ($pedido->pe_status==="ENTREGADO"): ?>
						<tr>
							<td><?php echo $pedido->pe_nota ?></td>
							<td><?php echo $pedido->pe_fecha_pedido ?></td>
							<td><?php echo $pedido->cliente->cl_nombre ?></td>
							<td><?php echo $pedido->pe_importe ?></td>
							<td><?php echo $pedido->pe_destino_pedido ?></td>
							<td><?php echo $pedido->pivot->det_status ?></td>
						</tr>	
					<?php endif ?>
				<?php endforeach ?>
				
			</tbody>
		</table>
	</div>
	<br>
	<div class="card">
		<div class="card-header bg-dark text-center text-white"><b>Cobranza</b></div>
		<table class="table table-sm">
			<thead>
				<th>Nota</th>
				<th>Cliente</th>
				<th>Importe</th>
				<th>Abonado</th>
				<th>Resto</th>
				<th>Forma de Pago</th>
				<th>Estatus</th>
			</thead>
			<tbody>
				<?php foreach ($viajes->pedidos as $pedido): ?>
					<?php if ($pedido->pe_pago_status==="PENDIENTE"): ?>
						<tr>
							<td><?php echo $pedido->pe_nota ?></td>
							<td><?php echo $pedido->cliente->cl_nombre ?></td>
							<td><?php echo $pedido->pe_importe ?></td>
							<td><?php echo $pedido->pe_total_abonado ?></td>
							<td><?php echo $pedido->pe_importe - $pedido->pe_total_abonado ?></td>
							<td><?php echo $pedido->pe_forma_pago ?></td>
							<td><?php echo $pedido->pivot->det_status ?></td>
						</tr>	
					<?php endif ?>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<br>
	<div class="card">
		<div class="card-header bg-danger text-center text-white"><b>Ingresos</b></div>
		<table class="table table-sm">
			<thead>
				<th>Nota</th>
				<th>Cliente</th>
				<th>Importe</th>
				<th>Abonado</th>
				<th>Resto</th>
				<th>Forma de Pago</th>
				<th>Estatus</th>
			</thead>
			<tbody>
				<?php foreach ($viajes->pedidos as $pedido): ?>
					<?php if ($pedido->pe_pago_status==="ABONADO"): ?>
						<tr>
							<td><?php echo $pedido->pe_nota ?></td>
							<td><?php echo $pedido->cliente->cl_nombre ?></td>
							<td><?php echo $pedido->pe_importe ?></td>
							<td><?php echo $pedido->pe_total_abonado ?></td>
							<td><?php echo $pedido->pe_importe - $pedido->pe_total_abonado ?></td>
							<td><?php echo $pedido->pe_forma_pago ?></td>
							<td><?php echo $pedido->pivot->det_status ?></td>
						</tr>	
					<?php endif ?>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<br>
	<br>
	<div class="card">
		<div class="card-header bg-dark text-center text-white"><b>Egresos</b></div>
		<table class="table table-sm">
			<thead>
				<th class="text-center">Nota</th>
				<th>Concepto</th>
				<th>Importe</th>
			</thead>
			<tbody>
				{{-- FOREACH --}}
				<tr>
					<td class="text-center"><span class="badge badge-success"></span></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td class="text-center"><span class="badge badge-success"></span></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td class="text-center"><span class="badge badge-danger"></span></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
@stop