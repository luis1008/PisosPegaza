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
			<td><b>Viaje:</b></td><td style="color:red;"><?php echo $viajes->vi_status ?></td>
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
					<?php if ($pedido->pe_status==="PREPARADO PARA ENTREGAR"): ?>
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
				<th>Ingreso</th>
				<th>Proveniente</th>
			</thead>
			<tbody>
				{{-- FOREACH --}}
				<tr>
					<th>060</th>
					<td>ROGELIO VAZQUEZ</td>
					<td>$1000.00</td>
					<td>ENTREGO</td>
				</tr>
				<tr>
					<th>075</th>
					<td>MONICA MARTINEZ</td>
					<td>$500.00</td>
					<td>ENTREGO</td>
				</tr>
				<tr>
					<th>055</th>
					<td>JOSE VALENCIA</td>
					<td>$800.00</td>
					<td>COBRANZA</td>
				</tr>
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
				<th>Gasto</th>
				<th>Salida</th>
			</thead>
			<tbody>
				{{-- FOREACH --}}
				<tr>
					<td class="text-center"><span class="badge badge-success">SI</span></td>
					<td>Diesel</td>
					<td>$250.00</td>
				</tr>
				<tr>
					<td class="text-center"><span class="badge badge-success">SI</span></td>
					<td>Comida</td>
					<td>$100.00</td>
				</tr>
				<tr>
					<td class="text-center"><span class="badge badge-danger">NO</span></td>
					<td>Refacción</td>
					<td>$200.00</td>
				</tr>
			</tbody>
		</table>
	</div>
	<br>
	<div class="form-row">
		<div class="form-group col-md-3">
			<label>Kilometraje Final</label>
			<div class="input-group">
				<span class="input-group-addon">KM</span>
				<input type="text" class="form-control" name="final" value="">
			</div>
		</div>
	
		
	</div>
	<!-- Modal EGRESOS -->
	<div class="modal fade" id="egreso" tabindex="-1" role="dialog" aria-labelledby="egresos" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="egresos">Nuevo Gasto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="">
						<div class="form-row">
							<div class="form-group col">
								<label>Se Entrego Nota</label>
								<select name="nota" id="" class="form-control">
									<option value="SI">SI</option>
									<option value="NO">NO</option>
								</select>
							</div>
							<div class="form-group col">
								<label>Cantidad</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="number" class="form-control" name="cantidad" value="0.00">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<label>Concepto Gasto</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-price-tag"></span></span>
									<input type="text" class="form-control" name="concepto" placeholder="GASTO">
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span></button>
					<button type="button" class="btn btn-success"><span class="icon icon-floppy-disk"></span></button>
				</div>
			</div>
		</div>
	</div>
@stop