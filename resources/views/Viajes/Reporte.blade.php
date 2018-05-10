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
			<td><b>Viaje:</b></td><td><?php echo $viajes->id_viaje ?></td>
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
	<form action="<?php echo route('post_finalizar_viaje', $viajes->id_viaje)?>" method="POST" onSubmit="return confirm('¿Seguro que desea Finalizar el Viaje? Una vez Finalizado, no se permiten modificaciones.')">
        {{csrf_field()}}
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
				<th>Forma de Pago</th>
				<th>Abonar/Pagar</th>
			</thead>
			<tbody>
				<?php foreach ($viajes->pedidos as $pedido): ?>
					<?php if ($pedido->pe_status==="EN CAMINO A ENTREGAR"): ?>
						<tr>
							<td><?php echo $pedido->pe_nota ?></td>
							<td><?php echo $pedido->pe_fecha_pedido ?></td>
							<td><?php echo $pedido->cliente->cl_nombre ?></td>
							<td><?php echo $pedido->pe_importe ?></td>
							<td><?php echo $pedido->pe_destino_pedido ?></td>
							<td><?php echo $pedido->pivot->det_status ?></td>
							<td>
								<select name="forma_pago[]">
									<option value="">Seleccionar</option>
									<option value="CAJA">CAJA</option>
									<option value="TRANSFERENCIA">TRANSFERENCIA</option>
									<option value="CHEQUE">CHEQUE</option>

								</select>
							</td>
							<td>
								<input type="hidden" name="id_pedido[]" value="<?php echo $pedido->id_pedido ?> ">
								<input type="text" class="form-control" name="abono[]" placeholder="$">
							</td>

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
				<th>Estatus</th>
				<th>Forma de Pago</th>
				<th>Abonar/Pagar</th>
			</thead>
			<tbody>
				<?php foreach ($viajes->pedidos as $pedido): ?>
					<?php if ($pedido->pe_status==="EN CAMINO A COBRAR"): ?>
						<tr>
							<td><?php echo $pedido->pe_nota ?></td>
							<td><?php echo $pedido->cliente->cl_nombre ?></td>
							<td><?php echo $pedido->pe_importe ?></td>
							<td><?php echo $pedido->pe_total_abonado ?></td>
							<td><?php echo $pedido->pe_importe - $pedido->pe_total_abonado ?></td>
							<td><?php echo $pedido->pivot->det_status ?></td>
							<td>
								<select name="forma_pago[]">
									<option value="">Seleccionar</option>
									<option value="CAJA">CAJA</option>
									<option value="TRANSFERENCIA">TRANSFERENCIA</option>
									<option value="CHEQUE">CHEQUE</option>

								</select>
							</td>
							<td>
								<input type="hidden" name="id_pedido[]" value="<?php echo $pedido->id_pedido ?> ">
								<input type="text" class="form-control" name="abono[]" placeholder="$">
							</td>
						</tr>	
					<?php endif ?>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<br>
	<br>
	<div class="card">
		<div class="card-header bg-danger text-center text-white"><b>Egresos</b></div>
			<div class="AddEgreso" style="padding: 25px 0 0 25px"></div>	
	</div> 
	<br>
	<div class="col-md-12 text-center">
		<Button type="button" class="btn btn-egreso btn-dark"> <span class="icon icon-plus"></span> <b>Egreso</b></Button>
	</div>
	
	<div class="form-row">
		<div class="form-group col-md-3">
			<label>Kilometraje Final</label>
			<div class="input-group">
				<span class="input-group-addon">KM</span>
				<input type="text" class="form-control" name="final">
			</div>
		</div>
		<div class="form-group col-md-12">
			<label>Observaciones</label>
			<textarea name="descripcion" id="" cols="30" rows="10" class="form-control"></textarea>
		</div>
		<div class="form-group col-md-12 text-center">
			<button class="btn btn-danger">Finalizar Viaje</button>
		</div>
	</div>
	</form>
	<!-- Modal EGRESOS -->
	<!--
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
					<form action="{{route('post_gastos',$viajes->id_viaje)}}" method="POST">
						{{csrf_field()}}
						<div class="form-row">
								<div class="form-group col">
								<label>No. Nota</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="text" class="form-control" name="nota" placeholder="No. Nota">
								</div>
							</div>
							<div class="form-group col">
								<label>Importe</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="number" class="form-control" name="importe" value="0.00">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<label>Concepto Gasto</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-price-tag"></span></span>
									<input type="text" class="form-control" name="concepto" placeholder="Concepto">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="reset"  class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
							<button type="submit" class="btn btn-dark"><span class="icon icon-floppy-disk"></span> Guardar</button>
						</div>
					</form>
				</div>
			
			</div>
		</div>
	</div>  -->
@stop

@section('js')
	<script src="<?php echo asset('js/viaje.js') ?>"></script>
@stop
	