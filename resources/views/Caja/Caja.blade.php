@extends('Template.Body')

@section('title','Caja')

@section('style')
	<style>
		p.border-Title{
        	border-radius: 1px 1px 25px 1px;
        	color: white;
        	font-size: 12px; 
        	font-weight: bold;
        	margin: 3px;
        	padding: 5px;
        }

        p.border-Title-Inverse{
        	border-radius: 1px 1px 1px 25px;
        	color: white;
        	font-size: 12px; 
        	font-weight: bold;
        	margin: 3px;
        	padding: 5px;
        }

        p.Red{
        	background-color: #dc3545;
        }

        p.Black{
        	background-color: rgb(0,0,0);
        }
	</style>
@stop

@section('body')
	
	<!-- ul nav -->
	<ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
	  <!-- li Informacion -->
	  <?php if(Auth::user()->perfil=='CAJA' || Auth::user()->perfil=='ADMIN'){ ?>
	  <li class="nav-item dropdown">
	    <a class="nav-link active dropdown-toggle tooltips2" data-toggle="dropdown" href="#" data-placement="top" title="Informacion"><span class="icon icon-info"></span> <!-- Información --></a>
	    <div class="dropdown-menu">
	      <a class="dropdown-item" data-toggle="pill" href="#pills-info" role="tab" style="padding-bottom:35px;><span class="icon icon-eye"></span> Ver</a>
	      <!--<a class="dropdown-item" href="#" data-toggle="modal" data-target="#pedido"><span class="icon icon-plus"></span> Nuevo</a>-->
	    </div>
	  </li>
	  <?php } ?>
	  	  <!-- li pagos -->
	  <li class="nav-item dropdown">
	    <a class="nav-link dropdown-toggle tooltips2" data-toggle="dropdown" href="#" data-placement="top" title="Cobranza"><span class="icon icon-coin-dollar"></span> <!-- Información --></a>
	    <div class="dropdown-menu">
	      <a class="dropdown-item" data-toggle="pill" href="#pills-pagos" role="tab" style="padding-bottom:35px;"><span class="icon icon-eye"></span> Pagos</a>
	    </div>
	  </li>
	  <!-- li Pedido -->
	  <li class="nav-item dropdown">
	    <a class="nav-link dropdown-toggle tooltips2" data-toggle="dropdown" href="#" data-placement="top" title="Pedido"><span class="icon icon-cart"></span> <!-- Pedido --></a>
	    <div class="dropdown-menu">
	      <a class="dropdown-item" data-toggle="pill" href="#pills-pedido" role="tab"><span class="icon icon-eye"></span> Ver</a>
	      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#pedido"><span class="icon icon-plus"></span> Nuevo</a>
	      <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#devolucion_pedido"><span class="icon icon-cross"></span> Devolución</a> -->
	    </div>
	  </li>
	  <!-- li Compra -->
	  <li class="nav-item dropdown">
	    <a class="nav-link dropdown-toggle tooltips2" data-toggle="dropdown" href="#" data-placement="top" title="Compra"><span class="icon icon-price-tag"></span> <!-- Compra --></a>
	    <div class="dropdown-menu">
	      <a class="dropdown-item" data-toggle="pill" href="#pills-compra" role="tab"><span class="icon icon-eye"></span> Ver</a>
	      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#compra_material"><span class="icon icon-plus"></span> Nuevo</a>
	    </div>
	  </li>
	  <!-- li Movimiento Temporal -->
	  <li class="nav-item dropdown">
	    <a class="nav-link dropdown-toggle tooltips2" data-toggle="dropdown" href="#" data-placement="top" title="Movimiento Temporal"><span class="icon icon-upload"></span> <!-- Mov. Temporal --></a>
	    <div class="dropdown-menu">
	      <a class="dropdown-item" data-toggle="pill" href="#pills-movimiento" role="tab"><span class="icon icon-eye"></span> Ver</a>
	      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#movimiento"><span class="icon icon-plus"></span> Nuevo</a>
	    </div>
	  </li>
	  <!-- li Movimiento Prestamo -->
	  <li class="nav-item dropdown">
	    <a class="nav-link dropdown-toggle tooltips2" data-toggle="dropdown" href="#" data-placement="top" title="Prestamo"><span class="icon icon-coin-dollar"></span> <!-- Prestamo --></a>
	    <div class="dropdown-menu">
	      <a class="dropdown-item" data-toggle="pill" href="#pills-prestamo" role="tab"><span class="icon icon-eye"></span> Ver</a>
	      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#prestamo"><span class="icon icon-plus"></span> Nuevo</a>
	    </div>
	  </li>
	  <!-- li Movimiento Viajes -->
	  <li class="nav-item dropdown">
	    <a class="nav-link dropdown-toggle tooltips2" data-toggle="dropdown" href="#" data-placement="top" title="Viajes"><span class="icon icon-truck"></span> <!-- Viajes --></a>
	    <div class="dropdown-menu">
	      <a class="dropdown-item" data-toggle="pill" href="#pills-viajes" role="tab"><span class="icon icon-eye"></span> Ver</a>
	      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viajes"><span class="icon icon-plus"></span> Nuevo</a>
	    </div>
	  </li>
	  <!-- li Produccion -->
	  <li class="nav-item dropdown">
	    <a class="nav-link dropdown-toggle tooltips2" data-toggle="dropdown" href="#" data-placement="top" title="Produccion"><span class="icon icon-hammer"></span> <!-- Produccion --></a>
	    <div class="dropdown-menu">
	      <a class="dropdown-item" data-toggle="pill" href="#pills-produccion" role="tab"><span class="icon icon-eye"></span> Ver</a>
	      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#produccion_pedido"><span class="icon icon-forward"></span> Enviar</a>
	      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ajuste_inventario"><span class="icon icon-cog"></span> Ajuste Inventario</a>
	      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#AgregarProduccion"><span class="icon icon-plus"></span> Agregar Producción</a>
	      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ImprimirInventario"><span class="icon icon-file-pdf"></span> Imprimir Inventario</a>
	    </div>
	  </li>
	</ul> <!-- /ul nav -->

	<!-- Tab Content -->
	<div class="tab-content" id="pills-tabContent">
		<!-- Tab Informacion -->
		<div class="tab-pane fade show active" id="pills-info" role="tabpanel">
			<div class="card-header text-center text-white bg-danger"><b>INGRESOS Y EGRESOS</b></div>
		    <table class="table table-hover table-sm">
	            <thead>
	                <th></th>
	                <th>Ingresos</th>
	                <th>Egresos</th>
	                <th>Saldo</th>
	            </thead>
	            <tbody>
	                <!-- TOTAL DE INGRESOS -->
	                <tr>
	                    <th>Totales</th>
	                    <?php $total_pedido=\DB::table('pedidos')->SUM('pe_total_abonado'); ?>
	                    <?php $total_ab_prestamos=\DB::table('abono_prestamo')->SUM('ab_abono'); ?>
	                    <!-- SUMA EL TOTAL DE INGRESOS -->
	                    <?php $total_ingresos=$total_pedido+$total_ab_prestamos ?>
	                    <!-- PINTA EL TOTAL DE INGRESOS -->
	                	<td><?php echo '$'. number_format($total_ingresos,2) ?></td>  

	                <!-- TOTAL DE EGRESOS -->
	                    <?php $total_comp=\DB::table('compras')->SUM('cm_total_abonado'); ?>
	                    <?php $total_mov_temp=\DB::table('movimiento_temporal')->SUM('mt_gasto'); ?>
	                    <?php $total_viaje=\DB::table('viaje')->SUM('vi_viaticos'); ?>
	                    <?php $total_egreso=\DB::table('egresos')->SUM('eg_importe'); ?>
	                    <?php $total_prestamo=\DB::table('prestamo')->SUM('pres_cantidad'); ?>
	                    <!-- SUMA EL TOTAL DE EGRESOS -->
	                    <?php $total_egresos=$total_comp+$total_mov_temp+$total_viaje+$total_egreso+$total_prestamo ?>
	                    <!-- PINTA EL TOTAL DE EGRESOS -->
	                	<td><?php echo '$'. number_format($total_egresos,2) ?></td>
	                	<!-- PINTA EL SALDO -->
	                	<?php $total_saldo=$total_ingresos - $total_egresos ?>
	                	<td><?php echo '$'. number_format($total_saldo,2) ?></td>  		      
	                </tr>
		        </tbody>
		    </table>
			<br>
	  
	  		<div class="card">
	  			<div class="card-header text-center text-white bg-dark" data-toggle="collapse" href="#CollapseProductos" aria-expanded="true" aria-controls="CollapseProductos"><b><span class="icon icon-circle-down"></span> Productos en Existencia</b></div>
	  			<div id="CollapseProductos" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
        			<table class="table table-hover table-sm">
			            <thead>
			                <th>No. Producto</th>
			                <th>Nombre</th>
			                <th>Tipo</th>
			                <th>Cantidad</th>
			            </thead>
			            <tbody>
			                <?php if(count($productos) < 1) { ?>
			                    <tr>
			                        <td colspan="4">NO SE ENCONTRO NINGÚN REGISTRO</td>
			                    </tr>
			                <?php } ?>
			                <?php foreach ($productos as $pd) { ?>
			                    <tr class='<?php if($pd->pd_cantidad!=0){ echo "table-success"; } else { echo "table-danger"; } ?>'>
			                        <th><?php echo  str_pad($pd->id_producto, 2, "0", STR_PAD_LEFT) ?></th>
			                        <td><?php echo $pd->pd_nombre ?></td>
			                        <td><?php echo $pd->pd_tipo ?></td>
			                        <td><?php echo number_format($pd->pd_cantidad) ?></td>
			                    </tr>
			                <?php } ?>
			            </tbody>
		        	</table>
		        </div>
		    </div>
			<br>
			<div class="card">
	  			<div class="card-header text-center text-white bg-danger" data-toggle="collapse" href="#CollapseMateria" aria-expanded="true" aria-controls="CollapseMateria"><b><span class="icon icon-circle-down"></span> Materia Prima en Existencia</b></div>
	  			<div id="CollapseMateria" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
		        	<table class="table table-hover table-sm">
			            <thead>
			            	<th>No. Materia Prima</th>
			                <th>Nombre</th>
			                <th>Cantidad</th>
			            </thead>
			            <tbody>
			                <?php if(count($mat_primas) < 1) { ?>
			                    <tr>
			                        <td colspan="3">NO SE ENCONTRO NINGÚN REGISTRO</td>
			                    </tr>
			                <?php } ?>
			                <?php foreach ($mat_primas as $mp) { ?>
			                    <?php $cantidad_total=\DB::table('compra_mp')->where('mp_id',$mp->id_materia_prima)->SUM('det_cantidad'); ?>
			                    <tr class='<?php if($cantidad_total!=0){ echo "table-success"; } else { echo "table-danger"; } ?>'>
			                        <th><?php echo str_pad($mp->id_materia_prima, 2, "0", STR_PAD_LEFT) ?></th>
			                        <td><?php echo $mp->mp_nombre." ".$mp->mp_cantidad." ".$mp->mp_unidad ?></td> 
			                        <!-- TOTAL DE MATERIA PRIMA -->
			                        <td>{{$cantidad_total or "0"}}</td>                 
			                    </tr>
			                <?php } ?>
			            </tbody>
			        </table>
 				</div>
 			</div>
 		</div>
 		<!-- Tab Cobranza -->
	  	<div class="tab-pane fade" id="pills-pagos" role="tabpanel">
	  		<!-- PAGOS DEL CLIENTE -> PEDIDOS -->
		  	<div class="card">
		  		<div class="card-header text-center text-white bg-danger" data-toggle="collapse" href="#CollapseCliente" aria-expanded="true" aria-controls="CollapseCliente"><b><span class="icon icon-circle-down"></span> Cobranza a Cliente</b></div>
			  	<div id="CollapseCliente" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
				  	<form action="{{ route('post_pago_pedido') }}" method="POST">
				  		{{ csrf_field() }}
				  		<div class="row card-body">
					  		<div class="col-md-6">
					  			<label>Clientes</label>
							  	<select name="cliente" required class="form-control" id="SelectClientePendiente">
									<option value="">Seleccionar Cliente</option>
									<?php foreach($ClientesPendientes as $cl){ ?>
										<option value="<?php echo $cl->cliente->id_cliente?>"><?php echo $cl->cliente->cl_nombre ?></option>
									<?php } ?> 
								</select>
					  		</div>
					  		<div class="col-md-3">
					  			<label>Cuenta</label>
					  			<div class="input-group">
					  				<div class="input-group-addon"><span class="icon icon-credit-card"></span></div>
					  				<select name="cuenta" required class="form-control">
					  					<option value="">Seleccionar Cuenta</option>
					  					<option value="CAJA">CAJA</option>
					  					@foreach($cuentas as $cuenta)
					  						<option value="{{$cuenta->ct_nombre}}">{{$cuenta->ct_nombre}}</option>
					  					@endforeach
					  				</select>
					  			</div>
					  		</div>
					  		<div class="col-md-3">
					  			<label>Total a Cobrar</label>
					  			<div class="input-group">
					  				<input type="number" class="form-control" name="pago_total" step="0.01" min="0.01" value="0.00" id="pago" readonly>
					  				<div class="input-group-btn">
					  					<button type="submit" class="btn btn-dark" id="BtnPagoClientePedidos" disabled><span class="icon icon-coin-dollar"></span> Cobrar</button>
					  				</div>
					  			</div>
					  		</div>
						  	<div class="col-md-12" style="margin-top:15px;">
						        <table class="table table-hover table-sm text-center">
						            <thead>
						            	<th class="text-center"></th>
						                <th class="text-center">No. Nota</th>
						                <th class="text-center">Pedido</th>
						                <!-- <th class="text-center">Cliente</th> -->
						                <th class="text-center">Termino</th>
						                <th class="text-center">Debe</th>
						                <th class="text-center">Total Abonado</th>
						                <th class="text-center">Cantidad a Abonar</th>
						            </thead>
						            <tbody id="BodyPedidosCliente">
					                    <tr>
					                        <td colspan="6">NO SE ENCONTRO NINGÚN REGISTRO</td>
					                    </tr>
						            </tbody>
						        </table>
						  	</div>
			        	</div>
				  	</form>
		        </div>
		  	</div>
		  	<br><br>
		  	<!-- PAGOS AL PROVEEDOR -> COMPRAS -->
		  	<div class="card">
		  		<div class="card-header text-center text-white bg-dark" data-toggle="collapse" href="#CollapseProveedor" aria-expanded="true" aria-controls="CollapseProveedor"><b><span class="icon icon-circle-down"></span> Pago a Proveedor</b></div>
			  	<div id="CollapseProveedor" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
				  	<form action="{{ route('post_pago_compra') }}" method="POST">
				  		{{ csrf_field() }}
				  		<div class="row card-body">
					  		<div class="col-md-6">
					  			<label>Proveedores</label>
							  	<select name="proveedor" required class="form-control" id="SelectProveedorPendiente">
									<option value="">Seleccionar Proveedor</option>
									<?php foreach($ProveedoresPendientes as $pv){ ?>
										<option value="<?php echo $pv->proveedor->id_proveedor?>"><?php echo $pv->proveedor->pv_nombre ?></option>
									<?php } ?> 
								</select>
					  		</div>
					  		<div class="col-md-3">
					  			<label>Cuenta</label>
					  			<div class="input-group">
					  				<div class="input-group-addon"><span class="icon icon-credit-card"></span></div>
					  				<select name="cuenta" required class="form-control">
					  					<option value="">Seleccionar Cuenta</option>
					  					<option value="CAJA">CAJA</option>
					  					@foreach($cuentas as $cuenta)
					  						<option value="{{$cuenta->ct_nombre}}">{{$cuenta->ct_nombre}}</option>
					  					@endforeach
					  				</select>
					  			</div>
					  		</div>
					  		<div class="col-md-3">
					  			<label>Total a Pagar</label>
					  			<div class="input-group">
					  				<input type="number" class="form-control" name="pago_total" step="0.01" min="0.01" value="0.00" id="pago_proveedor" readonly>
					  				<div class="input-group-btn">
					  					<button type="submit" class="btn btn-danger" id="BtnPagoProveedorCompra" disabled><span class="icon icon-coin-dollar"></span> Pagar</button>
					  				</div>
					  			</div>
					  		</div>
						  	<div class="col-md-12" style="margin-top:15px;">
						        <table class="table table-hover table-sm text-center">
						            <thead>
						            	<th class="text-center"></th>
						                <th class="text-center">No. Nota</th>
						                <th class="text-center">Compra</th>
						                <th class="text-center">Termino</th>
						                <th class="text-center">Resto</th>
						                <th class="text-center">Total Abonado</th>
						                <th class="text-center">Cantidad a Abonar</th>
						            </thead>
						            <tbody id="BodyComprasProveedor">
					                    <tr>
					                        <td colspan="6">NO SE ENCONTRO NINGÚN REGISTRO</td>
					                    </tr>
						            </tbody>
						        </table>
						  	</div>
			        	</div>
				  	</form>
		        </div>
		  	</div>
		  	<br><br>
		  	<!-- PAGOS DEL EMPLEADO -> PRESTAMO -->
		  	<div class="card">
		  		<div class="card-header text-center text-white bg-danger" data-toggle="collapse" href="#CollapseEmpleado" aria-expanded="true" aria-controls="CollapseEmpleado"><b><span class="icon icon-circle-down"></span> Pago al Prestamo</b></div>
			  	<div id="CollapseEmpleado" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
				  	<form action="{{ route('post_pago_prestamo') }}" method="POST">
				  		{{ csrf_field() }}
				  		<div class="row card-body">
					  		<div class="col-md-6">
					  			<label>Deudores</label>
							  	<select name="deudor" required class="form-control" id="SelectEmpleadoPendiente">
									<option value="">Seleccionar Empleado</option>
									<?php foreach($EmpleadosPendientes as $emp){ ?>
										<option value="<?php echo $emp->empleado->id_empleado ?>"><?php echo $emp->empleado->em_nombre ?></option>
									<?php } ?> 
								</select>
					  		</div>
					  		<div class="col-md-3">
					  			<label>Cuenta</label>
					  			<div class="input-group">
					  				<div class="input-group-addon"><span class="icon icon-credit-card"></span></div>
					  				<select name="cuenta" required class="form-control">
					  					<option value="">Seleccionar</option>
					  					<option value="CAJA">CAJA</option>
					  					@foreach($cuentas as $cuenta)
					  						<option value="{{$cuenta->ct_nombre}}">{{$cuenta->ct_nombre}}</option>
					  					@endforeach
					  				</select>
					  			</div>
					  		</div> 
					  		<div class="col-md-3">
					  			<label>Total a Pagar</label>
					  			<div class="input-group">
					  				<input type="number" class="form-control" name="pago_total" step="0.01" min="0.1" value="0" id="pago_empleado" readonly>
					  				<div class="input-group-btn">
					  					<button type="submit" class="btn btn-danger" id="BtnPagoEmpleado" disabled><span class="icon icon-coin-dollar"></span> Cobrar</button>
					  				</div>
					  			</div>
					  		</div>
						  	<div class="col-md-12" style="margin-top:15px;">
						        <table class="table table-hover table-sm">
						            <thead>
						            	<th class="text-center"></th>
						                <th class="text-center">No. Prestamo</th>
						                <th>Prestado</th>
						                <th>Total Abonado</th>
						                <th>Resto</th>
						                <th>Fecha del Prestamo</th>
						                <th>Cantidad a Abonar</th>
						                <th class="text-center">Memo</th>
						            </thead>
						            <tbody id="BodyEmpleadoPrestamo">
					                    <tr>
					                        <td colspan="4" class="text-center">NO SE ENCONTRO NINGÚN REGISTRO</td>
					                    </tr>
						            </tbody>
						        </table>
						  	</div>
			        	</div>
				  	</form>
		        </div>
		  	</div>
 		</div>
	  	<!-- Tab Pedido -->
	  	<div class="tab-pane fade" id="pills-pedido" role="tabpanel">
	  	<div class="card">
	  			<div class="card-header text-center text-white bg-danger" data-toggle="collapse" href="#CollapsePedidos" aria-expanded="true" aria-controls="CollapsePedidos"><b><span class="icon icon-circle-down"></span> PEDIDOS</b></div>
	  			<div id="CollapsePedidos" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
		        <table class="table table-hover table-sm">
		            <thead>
		                <th>No. Nota</th>
		                <th>Pedido</th>
		                <th>Entrega</th>
		                <th>Cliente</th>
		                <th>Destino</th>
		            </thead>
		            <tbody>
		                <?php if(count($pedidos) < 1) { ?>
		                    <tr>
		                        <td colspan="5">NO SE ENCONTRO NINGÚN REGISTRO</td>
		                    </tr>
		                <?php } ?>
		                <?php foreach ($pedidos as $pe) { ?>
		                    <tr>
		                        <td><?php echo $pe->pe_nota ?></td>
		                        <td><?php echo $pe->pe_fecha_pedido ?></td>
		                        <td><?php echo $pe->pe_fecha_entrega ?></td>
		                        <td><?php echo $pe->cliente->cl_nombre ?></td>
		                        <td><?php echo $pe->pe_destino_pedido ?></td>
		                        <td>
		                            <button type="button" class="btn btn-dark btn-sm tooltips2" title="Información" data-toggle="modal" data-target="#info-<?php echo $pe->id_pedido ?>"><span class="icon icon-info"></span></button>
		                        	<?php if ($pe->pe_status != "PREPARADO PARA ENTREGAR"): ?>
		                        		<a target="_blank()" href="<?php echo route('pdf_pedido',['id'=>$pe->id_pedido,'preorden'=>1,'copia'=>1]) ?>" class="btn btn-danger btn-sm tooltips2" title="Nota"><span class="icon icon-file-pdf"></span></a>
		                        	<?php else : ?>
		                        		<a target="_blank()" href="<?php echo route('pdf_pedido',['id'=>$pe->id_pedido,'preorden'=>0,'copia'=>1]) ?>" class="btn btn-danger btn-sm tooltips2" title="Nota"><span class="icon icon-file-pdf"></span></a>
		                        	<?php endif ?>
		                            <a href="<?php echo route('get_view_update_pedido',$pe->id_pedido) ?>" class="btn btn-dark btn-sm tooltips2" title="Modificar"><span class="icon icon-pencil"></span></a>
		                        </td>
		                    </tr>
		                    <!-- INFORMACION DE PEDIDO -->
		                    <div class="modal fade" id="info-<?php echo $pe->id_pedido ?>" tabindex="-1" role="dialog" aria-labelledby="infos" aria-hidden="true">
		                        <div class="modal-dialog modal-lg" role="document">
		                            <div class="modal-content">
		                                <div class="modal-header">
		                                    <h5 class="modal-title" id="infos">Informacion del Pedido</h5>
		                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                        <span aria-hidden="true">&times;</span>
		                                    </button>
		                                </div>
		                                <div class="modal-body">
		                                	<div class="form-row">
		                                		<div class="col">
		                                			<p class="border-Title Red"><b>Estatus: </b><?php echo $pe->pe_status ?></p>
		                                		</div>
		                                		<div class="col">
		                                			<p class="border-Title-Inverse Black"><b>Ciudad: </b><?php echo $pe->pe_destino_ciudad ?></p>
		                                		</div>
		                                	</div>
		                                	<div class="form-row">
		                                		<div class="col">
		                                			<p class="border-Title Red"><b>Termino: </b><?php echo $pe->pe_termino ?></p>
		                                		</div>
		                                		<div class="col">
		                                			<p class="border-Title-Inverse Black"><b>Forma Pago: </b><?php echo $pe->pe_forma_pago ?></p>
		                                		</div>
		                                		<div class="col-md-12">
		                                			<p class="border-Title Black"><b>Memo: </b><br><?php echo $pe->pe_memo; ?></p>
		                                		</div>
		                                	</div>
		                                	<div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Pedido</b></div>
											<div class="form-row">
												<div class="col-md-2 text-center">
													<p><b>Cantidad</b></p>
												</div>
												<div class="col-md-6">
													<p><b>Producto</b></p>
												</div>
												<div class="col-md-2">
													<p><b>Precio</b></p>
												</div>
												<div class="col-md-2">
													<p><b>SubTotal</b></p>
												</div>
											</div>
		                            		<?php foreach($pe->productos as $pro) { ?>
												<div class="form-row">
													<div class="col-md-2 text-center">
														<p><?php echo $pro->pivot->det_prod_cantidad ?></p>
													</div>
													<div class="col-md-6">
														<p><?php echo $pro->pd_nombre ?></p>
													</div>
													<div class="col-md-2">
														<p>$<?php echo number_format($pro->pivot->det_prod_precio,2) ?></p>
													</div>
													<div class="col-md-2">
														<p>$<?php echo number_format($pro->pivot->det_prod_subtotal,2) ?></p>
													</div>
												</div>
											<?php } ?>
											<div class="row" style="border-top: 1px solid black;">
												<div class="col-md-2 text-center">
													<p class="border-Title Black"><b>Total</b></p>
												</div>
												<div class="col-md-2 text-center">
													<p><b>$<?php echo number_format($pe->pe_importe,2) ?></b></p>
												</div>
											</div>
										</div>
		                            </div>
		                        </div>
		                    </div>
		                <?php } ?>
		            </tbody>
		        </table>
		    </div>
	  	</div>
		<br>
		<!-- COBRANZA -->
		<div class="card">
	  			<div class="card-header text-center text-white bg-dark" data-toggle="collapse" href="#CollapseCobranza" aria-expanded="true" aria-controls="CollapseCobranza"><b><span class="icon icon-circle-down"></span> COBRANZA</b></div>
	  			<div id="CollapseCobranza" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
		        <table class="table table-hover table-sm">
		            <thead>
		                <th>No. Nota</th>
		                <th>Pedido</th>
		                <th>Entrega</th>
		                <th>Cliente</th>
		                <th>Destino</th>
		            </thead>
		            <tbody>
		                <?php if(count($cobranza) < 1) { ?>
		                    <tr>
		                        <td colspan="5">NO SE ENCONTRO NINGÚN REGISTRO</td>
		                    </tr>
		                <?php } ?>
		                <?php foreach ($cobranza as $co) { ?>
		                    <tr>
		                        <td><?php echo $co->pe_nota ?></td>
		                        <td><?php echo $co->pe_fecha_pedido ?></td>
		                        <td><?php echo $co->pe_fecha_entrega ?></td>
		                        <td><?php echo $co->cliente->cl_nombre ?></td>
		                        <td><?php echo $co->pe_destino_pedido ?></td>
		                        <td>
		                            <button type="button" class="btn btn-dark btn-sm tooltips2" title="Información" data-toggle="modal" data-target="#info-<?php echo $co->id_pedido ?>"><span class="icon icon-info"></span></button>
		                        	<?php if ($co->pe_status != "PREPARADO PARA ENTREGAR"): ?>
		                        		<a target="_blank()" href="<?php echo route('pdf_pedido',['id'=>$co->id_pedido,'preorden'=>1,'copia'=>1]) ?>" class="btn btn-danger btn-sm tooltips2" title="Nota"><span class="icon icon-file-pdf"></span></a>
		                        	<?php else : ?>
		                        		<a target="_blank()" href="<?php echo route('pdf_pedido',['id'=>$co->id_pedido,'preorden'=>0,'copia'=>1]) ?>" class="btn btn-danger btn-sm tooltips2" title="Nota"><span class="icon icon-file-pdf"></span></a>
		                        	<?php endif ?>
		                            <a href="<?php echo route('get_view_update_pedido',$co->id_pedido) ?>" class="btn btn-dark btn-sm tooltips2" title="Modificar"><span class="icon icon-pencil"></span></a>
		                        </td>
		                    </tr>
		                    <!-- INFORMACION DE PEDIDO -->
		                    <div class="modal fade" id="info-<?php echo $co->id_pedido ?>" tabindex="-1" role="dialog" aria-labelledby="infos" aria-hidden="true">
		                        <div class="modal-dialog modal-lg" role="document">
		                            <div class="modal-content">
		                                <div class="modal-header">
		                                    <h5 class="modal-title" id="infos">Informacion del Pedido</h5>
		                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                        <span aria-hidden="true">&times;</span>
		                                    </button>
		                                </div>
		                                <div class="modal-body">
		                                	<div class="form-row">
		                                		<div class="col">
		                                			<p class="border-Title Red"><b>Estatus: </b><?php echo $co->pe_status ?></p>
		                                		</div>
		                                		<div class="col">
		                                			<p class="border-Title-Inverse Black"><b>Ciudad: </b><?php echo $co->pe_destino_ciudad ?></p>
		                                		</div>
		                                	</div>
		                                	<div class="form-row">
		                                		<div class="col">
		                                			<p class="border-Title Red"><b>Termino: </b><?php echo $co->pe_termino ?></p>
		                                		</div>
		                                		<div class="col">
		                                			<p class="border-Title-Inverse Black"><b>Forma Pago: </b><?php echo $co->pe_forma_pago ?></p>
		                                		</div>
		                                		<div class="col-md-12">
		                                			<p class="border-Title Black"><b>Memo: </b><br><?php echo $co->pe_memo; ?></p>
		                                		</div>
		                                	</div>
		                                	<div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Pedido</b></div>
											<div class="form-row">
												<div class="col-md-2 text-center">
													<p><b>Cantidad</b></p>
												</div>
												<div class="col-md-6">
													<p><b>Producto</b></p>
												</div>
												<div class="col-md-2">
													<p><b>Precio</b></p>
												</div>
												<div class="col-md-2">
													<p><b>SubTotal</b></p>
												</div>
											</div>
		                            		<?php foreach($co->productos as $pro) { ?>
												<div class="form-row">
													<div class="col-md-2 text-center">
														<p><?php echo $pro->pivot->det_prod_cantidad ?></p>
													</div>
													<div class="col-md-6">
														<p><?php echo $pro->pd_nombre ?></p>
													</div>
													<div class="col-md-2">
														<p>$<?php echo number_format($pro->pivot->det_prod_precio,2) ?></p>
													</div>
													<div class="col-md-2">
														<p>$<?php echo number_format($pro->pivot->det_prod_subtotal,2) ?></p>
													</div>
												</div>
											<?php } ?>
											<div class="row" style="border-top: 1px solid black;">
												<div class="col-md-2 text-center">
													<p class="border-Title Black"><b>Total</b></p>
												</div>
												<div class="col-md-2 text-center">
													<p><b>$<?php echo number_format($co->pe_importe,2) ?></b></p>
												</div>
											</div>
										</div>
		                            </div>
		                        </div>
		                    </div>
		                <?php } ?>
		            </tbody>
		        </table>

		    </div>
	  	</div>
		</div>
	  	<!-- Tab Compra -->
	  	<div class="tab-pane fade" id="pills-compra" role="tabpanel">
			<div class="card text-black bg-light">
				<div class="card-header text-center text-white bg-danger"><b>COMPRAS PENDIENTES A BODEGA</b></div>
				<table class="table table-hover table-sm">
					<thead>
							<th>No. Nota</th>
							<th>Fecha</th>
							<th>Total</th>
							<th>Proveedor</th>
							<th>Termino</th>
							<th>Tipo Compra</th>
					</thead>
					<tbody>
						<?php if (count($compras) < 1): ?>
							<tr>
								<td colspan="6">NO SE ENCONTRO NINGÚN REGISTRO</td>
							</tr>
						<?php endif ?>
						<?php foreach($compras as $compra){ ?>
					 		<tr>
				 				<th class="text-left"><?php echo $compra->cm_nota ?></th>
				 				<td><?php echo $compra->created_at ?></td>
				 				<td>$<?php echo number_format($compra->cm_total,2) ?></td>
				 				<td><?php echo $compra->proveedor->pv_nombre ?></td>
				 				<td><?php echo $compra->cm_termino ?></td>
				 				<td><?php echo $compra->cm_tipo ?></td>
				 				<td>
				 					<button type="button" class="btn btn-dark btn-sm tooltips2" title="Bodega" data-toggle="modal" data-target="#bodega-<?php echo $compra->id_compra ?>"><span class="icon icon-checkmark"></span></button>
				 					<button type="button" class="btn btn-sm btn-danger tooltips2" title="Detalle" data-toggle="modal" data-target="#ModalInfoCompra-<?php echo $compra->id_compra?>"><span class="icon icon-eye"></span></button>
				 				</td>
					 		</tr>
					 		<!-- MODAL DATOS DE ENTRADA A BODEGA -->
							<div class="modal fade" id="bodega-<?php echo $compra->id_compra ?>" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="movimientos">Datos de Entrada a Bodega</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="<?php echo route('put_CompraBodega',$compra->id_compra) ?>" method="POST">
												<input type="hidden" name="_method" value="PUT">
						                        <input type="hidden" name="_token" value="<?php echo csrf_token()?>">
												<div class="form-row">
													<div class="form-group col">
														<div class="input-group">
															<span class="input-group-addon"><span class="icon icon-user"></span></span>
															<select name="empleado" required class="form-control">
																<option value="">Recibe</option>
																<?php foreach($empleados as $emp){ ?>
																	<option value="<?php echo $emp->id_empleado?>"><?php echo $emp->em_nombre ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group col">
														<div class="input-group">
															<span class="input-group-addon"><span class="icon icon-pen"></span></span>
															<input type="number" class="form-control" placeholder="NUMERO DE ENTRADA" name="num_entrada" required>
														</div>
													</div>
												</div>
												<div class="form-row AddConcepto" style="margin-top:25px;"></div>
												<div class="modal-footer">
													<button type="reset"  class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
													<button type="submit" class="btn btn-dark"><span class="icon icon-floppy-disk"></span> Guardar</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>

							<!-- Modal INFO DE COMPRA -->
							<div class="modal fade" id="ModalInfoCompra-<?php echo $compra->id_compra?>" tabindex="-1" role="dialog" aria-labelledby="info" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="info"><b>Información de la Compra</b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-row">
												<div class="col">
													<p><b>Estatus: </b><br><b style="color:<?php if($compra->cm_status != 'PAGADO') {echo 'red';} else {echo 'green';}?>"><?php echo $compra->cm_status ?></b></p>
												</div>
												<div class="col">
													<p><b>Proveedor: </b><br><?php echo $compra->proveedor->pv_nombre ?></p>
												</div>
												<div class="col">
													<p><b>Fecha Compra: </b><br><?php echo $compra->created_at ?></p>
												</div>
											</div>
											<div class="form-row">
												<div class="col">
													<p><b>Bodega: </b><b style="color:<?php if(!$compra->cm_bodega) {echo 'red';} else {echo 'green';}?>"><br><?php if(!$compra->cm_bodega) {echo 'NO';} else {echo 'SI';} ?></b></p>
												</div>
												<div class="col">
													<p><b>Termino Pago: </b><br><?php echo $compra->cm_termino ?></p>
												</div>
												<div class="col">
													<p><b>No. Nota: </b><br><?php echo $compra->cm_nota ?></p>
												</div>
											</div>
											<div class="form-row">
												<div class="col">
													<p><b>Tipo Compra:</b><br><?php echo $compra->cm_tipo?></p>
												</div>
												<div class="col">
													<p><b>Total Pagar:</b><br>$<?php echo number_format($compra->cm_total,2) ?></p>
												</div>
												<div class="col">
													<p><b>Total Abonado:</b><br>$<?php echo number_format($compra->cm_total_abonado,2) ?></p>
												</div>
											</div>
											<div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Compras</b></div>
							

												<div class="form-row">
													<div class="col-md-2 text-center">
														<p><b>Cantidad</b></p>
													</div>
													<div class="col-md-6">
														<p><b>Compra</b></p>
													</div>
													<div class="col-md-2">
														<p><b>Precio</b></p>
													</div>
													<div class="col-md-2">
														<p><b>SubTotal</b></p>
													</div>
												</div>
											
												<?php foreach($compra->materiasprimas as $material) { ?>
													<div class="form-row">
														<div class="col-md-2 text-center">
															<p><?php echo $material->pivot->det_cantidad ?></p>
														</div>
														<div class="col-md-6">
															<p><?php echo $material->mp_nombre ?></p>
														</div>
														<div class="col-md-2">
															<p>$<?php echo number_format($material->pivot->det_precio,2) ?></p>
														</div>
														<div class="col-md-2">
															<p>$<?php echo number_format($material->pivot->det_subtotal,2) ?></p>
														</div>
													</div>
												<?php } ?>
												<?php foreach($compra->gastos as $gasto) { ?>
													<div class="form-row">
														<div class="col-md-2 text-center">
															<p><?php echo $gasto->gf_cantidad ?></p>
														</div>
														<div class="col-md-6">
															<p><?php echo $gasto->gf_concepto ?></p>
														</div>
														<div class="col-md-2">
															<p>$<?php echo number_format($gasto->gf_importe,2) ?></p>
														</div>
														<div class="col-md-2">
															<p>$<?php echo number_format($gasto->gf_subtotal,2) ?></p>
														</div>
													</div>
												<?php } ?>
											<br>
											<br>
											<div class="row" style="border-top: 1px solid black;">
												<div class="col-md-2 text-center">
													<p class="border-Title Black"><b>Total</b></p>
												</div>
												<div class="col-md-2 text-center">
													<p><b>$<?php echo number_format($compra->cm_total,2) ?></b></p>
												</div>
											</div>
												
											
										</div>
		                                <div class="modal-footer">
		                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
		                                </div>
	                        		</div>
	                    		</div>
	                		</div>
	                	<?php } ?>
	            	</tbody>
	        	</table>
	    	</div>
    	</div>
    	<!-- Tab Prestamo -->
	  	<div class="tab-pane fade" id="pills-prestamo" role="tabpanel">
			<div class="card text-black bg-light">
				<div class="card-header text-center text-white bg-danger"><b>PRESTAMOS PENDIENTES</b></div>
				<!-- <div class="card-body"> -->
				<table class="table table-hover table-sm">
					<thead>
						<th>#</th>
						<th>Fecha</th>
						<th>Deudor</th>
						<th>Cantidad</th>
						<th>Descripción</th>
	                    <th>Tipo</th>
						<th></th>
					</thead>
					<tbody>
						<?php if(count($PPendientes) < 1){ ?>
							<tr><td colspan="7">NO HAY NINGÚN REGISTRO</td></tr>
						<?php } ?>
						<?php foreach($PPendientes as $pre){ ?>
							<tr>
								<th><?php echo str_pad($pre->id_prestamo , 2, "0", STR_PAD_LEFT) ?></th>
								<td><?php echo $pre->created_at ?></td>
								<td><?php echo $pre->empleado->em_nombre ?></td>
								<td>$<?php echo number_format($pre->pres_cantidad,2) ?></td>
								<td><?php echo $pre->pres_descripcion ?></td>
	                            <td><?php echo $pre->pres_tipo ?></td>
								<td>
									<button type="button" class="btn btn-dark btn-sm tooltips2" title="Aprobación" data-toggle="modal" data-target="#prestamo_pendiente-<?php echo $pre->id_prestamo ?>"><span class="icon icon-spinner9"></span></button>
									<?php if($pre->movimiento_temporal_id > 0){ ?>
										<Button type="button" class="btn btn-danger btn-sm tooltips2" title="Movimiento Temporal" data-toggle="modal" data-target="#prestamo_movimiento-<?php echo $pre->id_prestamo ?>"><span class="icon icon-upload"></span></Button>
										<!-- Modal INFO DEL PRESTAMO DE MOVIMIENTO -->
										<div class="modal fade" id="prestamo_movimiento-<?php echo $pre->id_prestamo ?>" tabindex="-1" role="dialog" aria-labelledby="pres_mov" aria-hidden="true">
											<div class="modal-dialog modal-lg" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="pres_mov">PRESTAMO DEL MOVIMIENTO TEMPORAL</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body text-left">
														<div class="form-row">
															<div class="col-md-6">
																<p><b>No. Movimiento Temporal: </b><?php echo str_pad($pre->movimiento->id_movimiento_temporal , 2, "0", STR_PAD_LEFT) ?></p>
															</div>
															<div class="col-md-6">
																<p><b>Estatus: </b><?php echo $pre->movimiento->mt_status ?></p>
															</div>
														</div>
														<div class="form-row">
															<div class="col-md-6">
																<p><b>Efectivo Entregado: $</b><?php echo number_format($pre->movimiento->mt_entregado,2) ?></p>
															</div>
															<div class="col-md-6">
																<p><b>Total Gasto: $</b><?php echo number_format($pre->movimiento->mt_gasto,2) ?></p>
															</div>
														</div>
														<div class="form-row">
															<div class="col-md-6">
																<p><b>Resto: </b><?php echo number_format(($pre->movimiento->mt_entregado - $pre->movimiento->mt_gasto),2) ?></p>
															</div>
														</div>
														<p><b>Concepto(s) Utilizado:</b></p>
														<?php $conceptos = \DB::table('detalle_movimientos')->select('ct_concepto','id_concepto')->where('movimiento_temporal_id',$pre->movimiento_temporal_id)->get(); ?>
														<?php foreach($pre->movimiento->compras as $con){ ?>
															<li>Compra No° <?php echo str_pad($con->cm_nota, 2, "0", STR_PAD_LEFT) ?></li>
														<?php } ?>
														<?php foreach($conceptos as $con){ ?>
															<li><?php echo $con->ct_concepto ?></li>
														<?php } ?>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
													</div>
												</div>
											</div>
										</div>
									<?php } else if ($pre->viaje_id > 0) { ?>
										<Button type="button" class="btn btn-danger btn-sm tooltips2" title="Viaje" data-toggle="modal" data-target="#prestamo_viaje"><span class="icon icon-truck"></span></Button>
										<!-- FALTA HACER EL MODAL DE INFO DEL VIAJE -->
									<?php } ?>
								</td>
								<!-- Modal PARA APROBAR O DESAPROBAR EL PRESTAMO -->
								<div class="modal fade" id="prestamo_pendiente-<?php echo $pre->id_prestamo ?>" tabindex="-1" role="dialog" aria-labelledby="pres_pend" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="pres_pend">APROBACION DEL PRESTAMO</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body text-left">
												<form action="<?php echo route('put_PPendiente') ?>" method="POST">
													{{csrf_field()}}
													<input type="hidden" name="_method" value="PUT">
													<input type="hidden" name="prestamo" value="<?php echo $pre->id_prestamo ?>">
													<div class="form-row">
														<div class="form-group col">
															<select class="form-control" name="estatus" required>
																<option value="">Seleccionar</option>
																<option value="APROBADO">SI APRUEBO EL PRESTAMO</option>
																<option value="NO APROBADO">NO APRUEBO EL PRESTAMO</option>
															</select>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
														<button type="submit" class="btn btn-dark" onClick="confirm('Si continua no se hara modificaciones mas adelante, Desea Continuar?')"><span class="icon icon-floppy-disk"></span> Guardar</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			<!-- </div> -->
			</div>
	  	</div>
	  	<!-- Tab Movimiento Temporal -->
	  	<div class="tab-pane fade" id="pills-movimiento" role="tabpanel">
			<div class="card text-black bg-light">
			<div class="card-header text-center text-white bg-danger"><b>MOVIMIENTOS TEMPORALES</b></div>
			<!-- <div class="card-body"> -->
				<table class="table table-hover table-sm">
					<thead>
						<th class="text-center">#</th>
						<th>Fecha</th>
						<th>Empleado</th>
						<th>Efectivo Entregado</th>
						<th>Concepto(s)</th>
						<th>Estatus</th>
						<th>Opciones</th>
					</thead>
					<tbody>
						<?php if(count($mtPendientes) < 1){ ?>
							<tr><td colspan="6" class="text-center">NO HAY NINGÚN REGISTRO</td></tr>
						<?php } ?>
						<?php foreach($mtPendientes as $mt){ ?>
							<tr>
								<th class="text-center"><?php echo str_pad($mt->id_movimiento_temporal, 2, "0", STR_PAD_LEFT) ?></th>
								<td><?php echo $mt->created_at ?></td>
								<td><?php echo $mt->empleado ?></td>
								<td>$<?php echo number_format($mt->mt_entregado,2)?></td>
								<td class="text-left">
									<?php $conceptos = \DB::table('detalle_movimientos')->select('ct_concepto','id_concepto')->where('movimiento_temporal_id',$mt->id_movimiento_temporal)->where('compra_id','0')->get(); ?>
									<?php foreach($mt->compras as $con){ ?>
										<li>Compra No° <?php echo str_pad($con->cm_nota, 2, "0", STR_PAD_LEFT) ?></li>
									<?php } ?>
									<?php foreach($conceptos as $con){ ?>
										<li><?php echo $con->ct_concepto ?></li>
									<?php } ?>
								</td>
								<th>
									<?php echo $mt->mt_status ?>
								</th>
								<td>
									<button type="button" class="btn btn-dark btn-sm btn-addConcepto tooltips2" title="Agregar" data-toggle="modal" data-target="#new_concepto-<?php echo $mt->id_movimiento_temporal ?>">
										<span class="icon icon-plus"></span>
									</button>

									<button type="button" class="btn btn-danger btn-sm tooltips2" title="Finalizar" data-toggle="modal" data-target="#mov_pendiente-<?php echo $mt->id_movimiento_temporal ?>"><span class="icon icon-checkmark"></span></button>

									<a class="btn btn-dark btn-sm tooltips2" title="Ticket" target="_blank()" href="<?php echo route('ticket_movimiento',['id'=>$mt->id_movimiento_temporal,'copia'=>1]) ?>"><span class="icon icon-ticket"></span></a>
								
								</td>
							</tr>
							<!-- Modal MOVIEMIENTOS PENDIENTES-->
							<div class="modal fade" id="mov_pendiente-<?php echo $mt->id_movimiento_temporal ?>" tabindex="-1" role="dialog" aria-labelledby="mov_pendientes" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="mov_pendientes">Movimiento Pendiente</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="<?php echo route('put_MTPendiente') ?>" method="POST">
												<input type="hidden" name="_method" value="PUT">
												<input type="hidden" name="movimiento" value="<?php echo $mt->id_movimiento_temporal ?>">
												{{csrf_field()}}
												<div class="form-row">
													<div class="form-group col">
														<label>Entregado</label>
														<div class="input-group">
															<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
															<input type="text" class="form-control" value="$<?php echo number_format($mt->mt_entregado,2)?>" readonly>
														</div>
													</div>
													<div class="form-group col">
														<label>Total Gasto</label>
														<div class="input-group">
															<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
															<input type="hidden" class="h_total_gasto" name="total_gasto" value="0.00">
															<input type="text" class="form-control total_gasto" value="0.00" readonly>
														</div>
													</div>
												</div>
												<div class="form-row">
													<div class="col">
														<p><b>Concepto/Compra</b></p>
													</div>
													<div class="col">
														<p><b>Gasto Real</b></p>
													</div>
													<div class="col">
														<p><b>No. Nota</b></p>
													</div>
												</div>												
												<?php foreach($mt->compras as $con){ ?>
													<div class="form-row">
														<div class="form-group col">
															<div class="input-group">
																<span class="input-group-addon"><span class="icon icon-price-tag"></span></span>
																<input type="text" class="form-control" value="Compra No° <?php echo str_pad($con->cm_nota, 2, "0", STR_PAD_LEFT)?>" readonly>
															</div>
														</div>
														<div class="form-group col">
															<div class="input-group">
																<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
																<input type="text" class="form-control gasto" name="gasto_compra[]" value="0.00" required>
															</div>
														</div>
														<div class="form-group col">
															<div class="input-group">
																<span class="input-group-addon"><span class="icon icon-profile"></span></span>
																<input type="text" class="form-control" name="nota_compra[]" value="No Tiene" placeholder="NO. NOTA">
															</div>
														</div>
													</div>
												<?php } ?>
												<?php foreach($conceptos as $con){ ?>
													<input type="hidden" name="id_concepto[]" value="<?php echo $con->id_concepto ?>">
													<div class="form-row">
														<div class="form-group col">
															<div class="input-group">
																<span class="input-group-addon"><span class="icon icon-price-tag"></span></span>
																<input type="text" class="form-control" value="<?php echo $con->ct_concepto?>" readonly>
															</div>
														</div>
														<div class="form-group col">
															<div class="input-group">
																<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
																<input type="text" class="form-control gasto" name="gasto_concepto[]" value="0.00" required>
															</div>
														</div>
														<div class="form-group col">
															<div class="input-group">
																<span class="input-group-addon"><span class="icon icon-profile"></span></span>
																<input type="text" class="form-control" name="nota_concepto[]" value="No Tiene" placeholder="NO. NOTA">
															</div>
														</div>
													</div>
												<?php } ?>
												<div class="form-group col">
													<label class="form-check-label text-uppercase">
														<input class="form-check-input" type="checkbox" required>
														Me fue entregado el/los comprobante y cambio del gasto especificado
													</label>
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
							</div>

							<!-- Modal AGREGAR CONCEPTO DE UN MOVIMIENTO TEMPORAL EXISTENTE -->
							<div class="modal fade" id="new_concepto-<?php echo $mt->id_movimiento_temporal ?>" tabindex="-1" role="dialog" aria-labelledby="new_conceptos" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="new_conceptos">Agregar Conceptos</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="<?php echo route('post_AddOtroConcepto') ?>" method="POST" onsubmit="return ValidacionAddMovimientos(<?php echo $mt->id_movimiento_temporal ?>)">
												{{csrf_field()}}
												<input type="hidden" name="movimiento" value="<?php echo $mt->id_movimiento_temporal ?>">
												<div class="form-row">
													<div class="form-group col-md-12" style="width:100%;">
														<label>Compras</label>
														<select name="compras[]" class="form-control addcompras-<?php echo $mt->id_movimiento_temporal ?> multicompra" multiple>
															@foreach($mov_compras as $compra)
																<option value="{{$compra->id_compra}}">Compra No° {{str_pad($compra->cm_nota, 2, "0", STR_PAD_LEFT)}}</option>
															@endforeach
														</select>
													</div>
													<div class="form-group col">
														<label>Concepto</label>
														<div class="input-group">
															<span class="input-group-addon"><span class="icon icon-price-tag"></span></span>
															<select name="concepto" id="" class="form-control addconcept-<?php echo $mt->id_movimiento_temporal ?>" required>
																<option value="">Seleccionar Concepto</option>
																	@foreach($cat_gastos as $gast)
																<option value="{{$gast->ga_concepto}}">		{{$gast->ga_concepto}}</option>
																	@endforeach
															</select>
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
							</div>

						<?php } ?>
					</tbody>
				</table>
			<!-- </div> -->
			</div>
	  	</div>
	  	<!-- Tab Viajes -->
	  	<div class="tab-pane fade" id="pills-viajes" role="tabpanel">
			<div class="card text-black bg-light">
			<div class="card-header text-center text-white bg-danger"><b>VIAJES</b></div>
			<!-- <div class="card-body"> -->
				<table class="table table-hover table-sm text-center">
					<thead>
						<th>No. Viaje</th>
						<th class="text-center">Repartidor</th>
						<th class="text-center">Vehículo</th>
						<th class="text-center">Destino</th>
						<th class="text-center">Fecha</th>
						<th class="text-center">Opciones</th>
					</thead>
					<tbody>
						<?php if (count($viajes) < 1): ?>
							<tr>
								<td colspan="6">NO SE ENCONTRO NINGÚN REGISTRO</td>
							</tr>
						<?php endif ?>
						@foreach($viajes as $viaje)
							<tr>
								<th><?php echo str_pad($viaje->id_viaje , 2, "0", STR_PAD_LEFT) ?></th>
								<td><?php echo $viaje->empleado->em_nombre ?></td>
								<td><?php echo $viaje->vehiculo->vh_nombre ?></td>
								<td><?php echo $viaje->vi_destino ?></td>
								<td><?php echo $viaje->created_at ?></td>
								<td>
									<a class="btn btn-dark btn-sm tooltips2"  title="Finalizar" target="_blank()" href="<?php echo route('get_viaje',$viaje->id_viaje) ?>"><span class="icon icon-checkmark"></span></a>
								</td>
								<td>
									<a class="btn btn-danger btn-sm tooltips2" title="Detalle" target="_blank()" href="<?php echo route('get_viaje_caja',$viaje->id_viaje) ?>"><span class="icon icon-eye"></span></a>
								</td>
								<td>
									<a class="btn btn-dark btn-sm tooltips2" title="Nota" target="_blank()" href="<?php echo route('ticket_viaje',['id'=>$viaje->id_viaje,'copia'=>1]) ?>"><span class="icon icon-ticket"></span></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			<!-- </div> -->
			</div>
	  	</div>
	  	<!-- Tab Produccion -->
	  	<div class="tab-pane fade" id="pills-produccion" role="tabpanel">
			<div class="card text-black bg-light">
			<div class="card text-black bg-light">
				<div class="card-header text-center text-white bg-danger"><b>PEDIDOS EN PRODUCCION</b></div>
				<table class="table table-hover table-sm">
					<thead>
						<th>Fecha</th>
						<th class="text-center">Productos</th>
						<th class="text-center">Materiales</th>
						<th>Memo</th>
					</thead>
					<tbody>
						@if(count($PedidosProduccion) < 1)
							<tr>
								<td colspan="4" class="text-center">NO SE ENCONTRO NINGÚN REGISTRO</td>
							</tr>
						@endif
						@foreach($PedidosProduccion as $pr)
							<tr>
								<td><?php echo $pr->created_at ?></td>
								<th>
									<ul>
										<?php 
											$PrProductos = explode('|', $pr->pr_productos);
											foreach ($PrProductos as $pd) {
												echo "<li>".$pd."</li>";
											}
										?>
									</ul>
								</th>
								<th>
									<ul>
										<?php 
											$PrMateriales = explode('|', $pr->pr_materiales);
											foreach ($PrMateriales as $mat) {
												echo "<li>".$mat."</li>";
											}
										?>
									</ul>
								</th>
								<td><?php echo $pr->pr_memo ?></td>
								<td>
									<button type="button" class="btn btn-dark btn-sm tooltips2" title="Finalizar" data-target="#FinalizarProduccion-{{$pr->id_produccion}}" data-toggle="modal"><span class="icon icon-checkmark"></span></button>
									<a class="btn btn-danger btn-sm tooltips2" title="Cancelar" href="{{route('cancelacion_produccion',$pr->id_produccion)}}" onClick="return confirm('Seguro que desea cancelar?')"><span class="icon icon-cancel-circle"></span></a>
									<a href="{{route('pdf_produccion',$pr->id_produccion)}}" class="btn btn-dark btn-sm tooltips2" title="Nota" target="_blank"><span class="icon icon-file-pdf"></span></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
	  	</div>
	  	</div>
	</div> <!-- /Tab Content -->

	<!-- Modal VIAJES-->
	<div class="modal fade" id="viajes" tabindex="-1" role="dialog" aria-labelledby="viaticos" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="viaticos">Viaje</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{route('post_viaje')}}" method="POST">
						{{csrf_field()}}
						<div class="form-row">
							<div class="form-group col">
								<label>Repartidor</label>
								<select name="repartidor" id="" class="form-control" required>
									<option value="">Seleccionar</option>
									@foreach($empleados as $emp)
										<option value="{{$emp->id_empleado}}">{{$emp->em_nombre}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col">
								<label>Fecha</label>
								<div class="input-group date fecha_viaje" id="picker-container">
									<span class="input-group-addon"><span class="icon icon-calendar"></span></span>
									<input type="text" class="form-control" name="fecha" value="<?php echo date('Y-m-d') ?>" required>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<label>Destino</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-road"></span></span>
									<select name="destino" class="form-control" required>
										<option value="">Seleccionar</option>
										@foreach($ciudades as $ciudad)
											<option value="<?php echo $ciudad->pe_destino_ciudad ?>"><?php echo $ciudad->pe_destino_ciudad ?></option>
										@endforeach
									</select>
									<!-- <input type="text" class="form-control" name="destino" placeholder="DESTINO">-->
								</div>
							</div>
							<div class="form-group col">
								<label>Transporte</label>
								<select name="transporte" class="form-control select-vehiculo" required>
									<option value="">Seleccionar</option>
									@foreach($vehiculos as $veh)
										<option value="{{$veh->placas}}">{{$veh->vh_nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<label>Viáticos</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="number" class="form-control" name="viaticos" value="0.00">
								</div>
							</div>
							<div class="form-group col">
								<label>Kilometraje Inicial</label>
								<div class="input-group">
									<span class="input-group-addon">KM</span>
									<input type="number" class="form-control kilometraje" value="0" name="inicial">
								</div>
							</div>
						</div>
						<div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Pedidos</b></div>
						<div class="form-row">
							<table class="table table-hover table-sm">
								<thead>
									<th></th>
									<th>Nota</th>
									<th>Cliente</th>
									<!-- <th>Fecha</th> -->
									<th>Destino</th>
								</thead>
								<tbody>
									@if(count($preparados) < 1)
										<tr>
											<td colspan="4" class="text-center">NO SE ENCONTRO NINGÚN REGISTRO</td>
										</tr>
									@endif
									@foreach($preparados as $index=>$pedido)
										<tr>
											<td><input type="checkbox" class="PedidoCheck" name="pedidos[]" value="<?php echo $pedido->id_pedido ?>"></td>
											<th><?php echo $pedido->pe_nota?></th>
											<td><?php echo $pedido->cliente->cl_nombre?></td>
											<!-- <td><?php echo $pedido->pe_fecha_pedido ?></td> -->
											<td><?php echo $pedido->pe_destino_pedido ." - ". $pedido->pe_destino_ciudad?></td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Cobranza</b></div>
						<div class="form-row">
							<table class="table table-hover table-sm">
								<thead>
									<th></th>
									<th>Nota</th>
									<th>Cliente</th>
									<th>Fecha</th>
									<th>Importe</th>
									<th>Resto</th>
								</thead>
								<tbody>
									@if(count($cobranza) < 1)
										<tr>
											<td colspan="6" class="text-center">NO SE ENCONTRO NINGÚN REGISTRO</td>
										</tr>
									@endif
									@foreach($cobranza as $index=>$pedido)
										<tr>
											<td><input type="checkbox" name="cobrar[]" value="<?php echo $pedido->id_pedido ?>"></td>
											<th><?php echo $pedido->pe_nota ?></th>
											<td><?php echo $pedido->cliente->cl_nombre ?></td>
											<td><?php echo $pedido->pe_fecha_pedido ?></td>
											<td><?php echo "$".number_format($pedido->pe_importe,2) ?></td>
											<td><?php echo "$".number_format($pedido->pe_importe - $pedido->pe_total_abonado,2) ?></td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<button type="reset"  class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
							<button type="submit" class="btn btn-dark BtnPedidoNuevo"><span class="icon icon-floppy-disk"></span> Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal AJUSTE DE INVENTARIO -->
	<div class="modal fade" id="ajuste_inventario" tabindex="-1" role="dialog" aria-labelledby="produccion" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="produccion">Ajuste de Inventario</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{route('ajuste_inventario')}}" method="POST">
						{{csrf_field()}}
						<div>
					        <div class="form-row" style="margin-bottom:15px;">
					            <div class="text-center col">
					                <button type="button" class="btn btn-dark BtnAjusteProducto"><span class="icon icon-plus" ></span> Producto</button>
					                <button type="button" class="btn btn-danger BtnAjusteMaterial"><span class="icon icon-plus" ></span> Material</button>
					            </div>
					        </div>
							<div class="AddAjuste"></div>
							<div class="form-row">
								<label>Memo:</label>
								<div class="input-group">
									<div class="input-group-addon"><span class="icon icon-pen"></span></div>
									<textarea name="memo" rows="3" class="form-control" required>NO HAY NINGÚN COMENTARIO</textarea>
								</div>
							</div>
							<div class="modal-footer">
								<button type="reset"  class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
								<button type="submit" class="btn btn-dark BtnAjusteInventario" disabled><span class="icon icon-floppy-disk"></span> Guardar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal PRODUCCION PEDIDOS-->
	<div class="modal fade" id="produccion_pedido" tabindex="-1" role="dialog" aria-labelledby="produccion" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="produccion">Pedidos para Producción</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{route('post_pedido_produccion')}}" method="POST">
						{{csrf_field()}}
						<div class="card" style="margin-left:7px;margin-bottom:20px;">
							<table class="table table-hover" style="width:100%;">
								<thead class="bg-danger text-white">
									<th><!-- <input type="checkbox" id="check_all"> --></th>
									<th>Cliente</th>
									<th class="text-center">Productos</th>
									<th class="text-center">Material</th>
								</thead>
								<tbody>
									@if(count($pendientes) < 1)
										<tr>
											<td class="text-center" colspan="4">NO SE ENCONTRO NINGÚN REGISTRO</td>
										</tr>
									@endif
									<?php foreach ($pendientes as $pedido): ?>
										<?php 
											$material_array = []; 
											$producto_array = []; 
										?>
										<tr>
											<td><input type="checkbox" name="pedidos[]" class="CheckPedido" value="<?php echo $pedido->id_pedido ?>" required></td>
											<td><?php echo $pedido->cliente->cl_nombre ?></td>
											<td class="li-productos">
												<ul>
													<?php foreach ($pedido->productos as $producto){ ?>
														<li>
															{{$producto->pivot->det_prod_cantidad}} <b>{{$producto->pd_nombre}}</b>
															<input type="hidden" value="{{$producto->pivot->det_prod_cantidad}}" class="CantProducto">
															<input type="hidden" value="{{$producto->pd_nombre}}" class="NomProducto">
														</li>
														<?php foreach ($producto->materiasprimas as $material){
															$existe = array_key_exists($material->id_materia_prima, $material_array);
															if ($existe) {
																$suma_cantidades = $material_array[$material->id_materia_prima]['cantidad'] + ($material->pivot->det_cantidad * $producto->pivot->det_prod_cantidad);
																$material_array[$material->id_materia_prima]['cantidad'] = $suma_cantidades;
															} else {
																$material_array[$material->id_materia_prima] = ['nombre' => $material->mp_nombre, 'cantidad' => ($material->pivot->det_cantidad * $producto->pivot->det_prod_cantidad), 'unidad' => $material->mp_unidad];
															}
														}
														foreach ($producto->productos as $pd){
															$existe = array_key_exists($pd->id_producto, $producto_array);
															if ($existe) {
																$suma_cantidades = $producto_array[$pd->id_producto]['cantidad'] + ($pd->pivot->det_pd_cantidad * $producto->pivot->det_prod_cantidad);
																$producto_array[$pd->id_producto]['cantidad'] = $suma_cantidades;
															} else {
																$producto_array[$pd->id_producto] = ['nombre' => $pd->pd_nombre, 'cantidad' => ($pd->pivot->det_pd_cantidad * $producto->pivot->det_prod_cantidad)];
															}
														}
														/*foreach ($producto->productos as $pd){
															foreach ($pd->materiasprimas as $mp){
																$existe = array_key_exists($mp->id_materia_prima, $material_array);
																if ($existe) {
																	$suma_cantidades = $material_array[$mp->id_materia_prima]['cantidad'] + $mp->pivot->det_cantidad;
																	$material_array[$mp->id_materia_prima]['cantidad'] = $suma_cantidades;
																} else {
																	$material_array[$mp->id_materia_prima] = ['nombre' => $mp->mp_nombre, 'cantidad' => $mp->pivot->det_cantidad, 'unidad' => $mp->mp_unidad];
																}
															} 
														}*/
													} ?>
												</ul>
											</td>
											<td class="li-requisitos">
												<ul class="ul-material">
													<?php foreach ($material_array as $value => $material): ?>
														<li>
															{{$material['cantidad'] . " " . $material['unidad']}} <b>{{$material['nombre']}}</b>
															
															<input type="hidden" class="CantidadMaterial" value="{{$material['cantidad']}}">
															<input type="hidden" class="NombreMaterial" value="{{$material['nombre']}}">
															<input type="hidden" class="UnidadMaterial" value="{{$material['unidad']}}">
														</li>
													<?php endforeach ?>
												</ul>
												<ul class="ul-producto" style="margin-top:-15px;">
													<?php foreach ($producto_array as $value => $product): ?>
														<li>
															{{$product['cantidad']}} <b>{{$product['nombre']}}</b>
															
															<input type="hidden" class="CantidadProducto" value="{{$product['cantidad']}}">
															<input type="hidden" class="NombreProducto" value="{{$product['nombre']}}">
														</li>
													<?php endforeach ?>
												</ul>
											</td>
										</tr>
									<?php endforeach ?>
									<tr>
										<td colspan="2" class="text-danger">
											<b>Total:</b>
										</td>
										<td>
											<ul class="AppendListProductos"></ul>
										</td>
										<td>
											<ul class="AppendListMateriales"></ul>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="form-group col-md-12">
							<div class="input-group">
								<span class="input-group-addon"><span class="icon icon-pen"></span></span>
								<textarea name="memo" rows="3" class="form-control" placeholder="MEMO" required>NO HAY NINGÚN COMENTARIO</textarea>
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
	</div>

	<!-- Modal PEDIDOS-->
	<div class="modal fade" id="pedido" tabindex="-1" role="dialog" aria-labelledby="pedidos" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="pedidos">Nuevo Pedido</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo route('post_pedido') ?>" method="POST">
						{{csrf_field()}}
						<div class="form-row">
							<div class="form-group col">
								<label>Fecha Pedido</label>
								<div class="input-group date fecha_pedido" id="picker-container">
									<span class="input-group-addon"><span class="icon icon-calendar"></span></span>
									<input type="text" class="form-control" name="fecha_pedido" value="<?php echo date('Y-m-d') ?>" required>
								</div>
							</div>
							<div class="form-group col">
								<label>Fecha Entrega</label>
								<div class="input-group date fecha_entrega" id="picker-container2">
									<span class="input-group-addon"><span class="icon icon-calendar"></span></span>
									<input type="text" class="form-control" name="fecha_programada" value="<?php echo date('Y-m-d') ?>" required>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<!--<label>No. Nota</label>-->
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-profile"></span></span>
									<input type="number" class="form-control" name="nota" value="{{$ultima_nota}}" placeholder="No. NOTA" required>
								</div>
							</div>
							<div class="form-group col">
								<!--<label>Cliente</label>-->
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-user"></span></span>
									<select name="cliente" id="cl" class="form-control" required>
										<option value="" hidden>Seleccionar Cliente</option>
										<option value="add">Nuevo Cliente</option>
										<?php foreach($clientes as $cl){ ?>
											<option value="<?php echo $cl->id_cliente?>"><?php echo $cl->cl_nombre ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-credit-card"></span></span>
									<select name="forma_pago" class="form-control select-pago" required>
										<option value="">Forma Pago</option>
										<option value="EFECTIVO">EFECTIVO</option>
                                        <option value="CHEQUE">CHEQUE</option>
                                        <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                        <option value="DEPOSITO">DEPOSITO</option>
									</select>
								</div>
							</div>
							<div class="fomr-group col input-cheque" style="display:none;">
								<div class="input-group">
									<span class="input-group-addon">NO. CHEQUE</span>
									<input type="number" class="form-control" value="0" placeholder="No. Cheque" name="no_cheque">
								</div>
							</div>
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-clock"></span></span>
									<select name="termino" class="form-control select-termino" required>
										<option value="">Termino</option>
										<option value="CONTADO">CONTADO</option>
                                        <option value="1 DIA">1 DIA</option>
                                        <option value="1 SEMANA">1 SEMANA</option>
                                        <option value="1 MES">1 MES</option>
                                        <option value="1 BIMESTRE">1 BIMESTRE</option>
                                        <option value="1 TRIMESTRE">1 TRIMESTRE</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<!--<label>Destino</label>-->
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-road"></span></span>
									<select name="destino" id="dest" class="form-control" required>
										<option value="">Seleccionar Destino</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<!--<label>Destino</label>-->
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-eye"></span></span>
									<textarea name="notas" class="form-control input-notas" placeholder="NOTAS"></textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<!--<label>Destino</label>-->
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-eye"></span></span>
									<textarea name="memo" class="form-control" placeholder="MEMO"></textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
						   <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="number" class="form-control input-subtotal" name="importe"  placeholder="IMPORTE" readonly required>
								</div>
							</div>
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-hammer"></span></span>
									<select class="form-control" name="status" required>
                                        <option value="PENDIENTE PARA PRODUCCION">PENDIENTE PARA PRODUCCION</option>
                                        <!-- <option value="EN PRODUCCION">EN PRODUCCION</option> -->
                                        <option value="PREPARADO PARA ENTREGAR">PREPARADO PARA ENTREGAR</option>
                                        <!-- <option value="EN CAMINO">EN CAMINO</option> -->
                                        <option value="ENTREGADO">ENTREGADO</option>
                                    </select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<!--<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-credit-card"></span></span>
									<select class="form-control select-status-pago" name="pago_status" required>
										<option value="">Pago</option>
	                                    <option value="PENDIENTE">PENDIENTE</option>
	                                    <option value="ABONADO">ABONADO</option>
	                                    <option value="PAGADO">PAGADO</option>
	                                </select>
								</div>
							</div>-->
							<div class="form-group col input-status-abono" style="display:none;">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="text" class="form-control" name="abono_pedido" value="0">
								</div>
							</div>
						</div>
						<div class="AddProducto"></div>
						<div class="form-row" style="margin-bottom:15px;">
							<div class="text-center col">
								<button type="button" class="btn btn-danger btn-AddProducto"><span class="icon icon-plus"></span>Agregar</button>
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
	</div>

	<!-- Modal MOVIMIENTOS TEMPORALES -->
	<div class="modal fade" id="movimiento" tabindex="-1" role="dialog" aria-labelledby="movimientos" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="movimientos">Nuevo Movimiento Temporal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo route('post_movimiento') ?>" method="POST" onsubmit="return ValidacionMovimientos()">
						{{csrf_field()}}
						<div class="form-row">
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-user"></span></span>
									<input type="text" class="form-control" name="empleado" placeholder="PERSONA QUE REALIZA EL MOVIMIENTO" required>
								</div>
							</div>
						<div class="form-group col">
								<!--<label>Fecha Pedido</label>-->
								<div class="input-group date fecha_movimiento" id="picker-container">
									<span class="input-group-addon"><span class="icon icon-calendar"></span></span>
									<input type="text" class="form-control" name="fecha_movimiento" value="<?php echo date('Y-m-d') ?>" required>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<label>Efectivo A Entregar</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="text" class="form-control" name="entregado" placeholder="EFECTIVO ENTREGADO" required>
								</div>
							</div>
							<div class="form-group col">
								<label>Total Compras</label>
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="text" class="form-control totalCompras" value="0" readonly>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12" style="width:100%;">
								<label>Compras</label>
								<select name="compras[]" class="form-control multicompra" multiple>
									@foreach($mov_compras as $compra)
										<option value="{{$compra->id_compra}}">Compra No° {{str_pad($compra->cm_nota, 2, "0", STR_PAD_LEFT)}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-12 text-center">
								<Button type="button" class="btn btn-concepto btn-danger"> <span class="icon icon-plus"></span> <b>Concepto</b></Button>
							</div>
						</div>
						<div class="form-row AddConcepto" style="margin-top:25px;"></div>
						<div class="modal-footer">
							<button type="reset"  class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
							<button type="submit" class="btn btn-dark"><span class="icon icon-floppy-disk"></span> Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal PRESTAMOS -->
	<div class="modal fade" id="prestamo" tabindex="-1" role="dialog" aria-labelledby="prestamos" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="prestamos">Nuevo Prestamo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					@foreach($empleados as $emp)
					<form action="<?php echo route('post_prestamo', $emp->id_empleado) ?>" method="POST">
						{{csrf_field()}}
						@endforeach
						<div class="form-row">
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-user"></span></span>
										<select name="empleado" id="emp" class="form-control select-emp" required>
											<option value="" hidden>Seleccionar Empleado</option>
											<option value="add">Otros</option>
											@foreach($empleados as $emp)
											<option value="{{$emp->id_empleado}}">{{$emp->em_nombre}}</option>
											@endforeach
										</select>
								</div>
							</div>
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-calendar"></span></span>
									<input type="text" class="form-control" value="<?php echo date('d-m-Y') ?>" required readonly>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="number" class="form-control" name="prestamo" placeholder="EFECTIVO A PRESTAR" required>
								</div>
							</div>
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-user"></span></span>
									<input type="text" value="PERSONAL" class="form-control" name="tipo" readonly>
									<!--<select name="tipo" required class="form-control">
										<option value="">Seleccionar Tipo</option>
										<option value="GASTO">GASTO</option>
										<option value="PERSONAL">PERSONAL</option>
									</select>-->
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-eye"></span></span>
									<textarea class="form-control" row="5" name="descripcion" placeholder="MEMO" required></textarea>
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
	</div>

	<!-- Modal PRESTAMO -> AGREGAR NUEVA PERSONA <OPTION> -->
	<div class="modal fade" id="NewPersona" tabindex="-1" role="dialog" aria-labelledby="personas" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="personas">Nueva Persona</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" id="form-Per">
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
						<div class="form-row">
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-user"></span></span>
									<input type="text" class="form-control form-clearPer" name="nombre" placeholder="NOMBRE" required>
								</div>
							</div>
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-user"></span></span>
									<input type="text" class="form-control form-clearPer" name="telefono" placeholder="TELEFONO" required>
								</div>
							</div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset"  class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button> 
                            <button type="button" class="btn btn-danger btn-closePR" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
                            <button type="button" class="btn btn-dark btn-SubmitPer"><span class="icon icon-floppy-disk"></span> Guardar</button>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal PEDIDO -> AGREGAR NUEVO CLIENTE <OPTION> -->
	<div class="modal fade" id="NewCliente" tabindex="-1" role="dialog" aria-labelledby="clientes" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="clientes">Nuevo Cliente</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="form-Cli">
						{{ csrf_field() }}
                        <div class="form-row">                            
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-user"></span></span>
                                    <input type="text" class="form-control form-clearCli" name="nombre" placeholder="NOMBRE" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                    <input type="text" class="form-control form-clearCli" name="rfc"  placeholder="RFC" required>
                                </div>
                            </div>
                            
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-mail4"></span></span>
                                    <input type="email" class="form-control form-clearCli" name="correo"  placeholder="CORREO" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-phone"></span></span>
                                    <input type="text" class="form-control form-clearCli" name="telefono"  placeholder="TELEFONO" required>
                                </div>
                            </div>

                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-bubble"></span></span>
                                    <input type="text" class="form-control form-clearCli" name="nombre_contacto"  placeholder="NOMBRE DEL CONTACTO" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-user-tie"></span></span>
                                    <input type="text" class="form-control form-clearCli" name="nombre_dueno"  placeholder="NOMBRE DEL DUEÑO" required>
                                </div>
                            </div>

                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-credit-card"></span></span>
                                    <select class="form-control form-clearCli" name="forma_pago" required>
                                        <option value="">FORMA DE PAGO</option>
                                        <option value="EFECTIVO">EFECTIVO</option>
                                        <option value="CHEQUE">CHEQUE</option>
                                        <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                        <option value="DEPOSITO">DEPOSITO</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-accessibility"></span></span>
                                    <select class="form-control form-clearCli" name="tipo" required>
                                        <option value="">TIPO CLIENTE</option>
                                        <option value="NORMAL">NORMAL</option>
                                        <option value="RIGUROSO">RIGUROSO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-clock"></span></span>
                                    <select class="form-control form-clearCli" name="termino" required>
                                        <option value="">TERMINO CREDITO</option>
                                        <option value="CONTADO">CONTADO</option>
                                        <option value="1 DIA">1 DIA</option>
                                        <option value="1 SEMANA">1 SEMANA</option>
                                        <option value="1 MES">1 MES</option>
                                        <option value="1 BIMESTRE">1 BIMESTRE</option>
                                        <option value="1 TRIMESTRE">1 TRIMESTRE</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-location"></span></span>
                                    <input class="form-control form-clearCli" name="calle[]" type="text" placeholder="CALLE" required>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-location"></span></span>
                                    <input class="form-control form-clearCli" name="colonia[]" type="text" placeholder="COLONIA" required>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-office"></span></span>
                                    <input class="form-control form-clearCli" name="ciudad[]" type="text" placeholder="CIUDAD" required>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-location"></span></span>
                                    <input class="form-control form-clearCli" name="codigo_postal[]" type="text" placeholder="C.P" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-binoculars"></span></span>
                                    <textarea class="form-control form-clearCli" row="8" name="observaciones" placeholder="OBSERVACIONES">NO HAY OBSERVACIONES</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-row text-center">
                            <div class="form-group col">
                                <label>
                                    <input type="checkbox"  name="check_hacienda" value="1">
                                    Alta de Hacienda
                                </label>  
                            </div>
                        
                            <div class="form-group col">
                                <label>
                                    <input type="checkbox"  name="check_domicilio" value="1">
                                    Comprobante de Domicilio
                                </label>  
                            </div>
                    
                            <div class="form-group col">
                                <label>
                                    <input type="checkbox" name="check_ine" value="1">
                                    INE
                                </label>  
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="reset"  class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button> 
                            <button type="button" class="btn btn-danger btn-closeCli" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
                            <button type="button" class="btn btn-dark btn-SubmitCli"><span class="icon icon-floppy-disk"></span> Guardar</button>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal COMPRA MATERIA PRIMA o GASTOS -->
	<div class="modal fade" id="compra_material" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="materiales" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="materiales">Compra</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo route('post_compra') ?>" method="POST">
						{{csrf_field()}}
						<div class="form-row">
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-user-tie"></span></span>
									<select name="proveedor" required class="form-control select-prov">
										<option value="">Seleccionar Proveedor</option>
										<option value="add">NUEVO PROVEEDOR</option>
										<?php foreach($proveedores as $pro){ ?>
											<option value="<?php echo $pro->id_proveedor?>"><?php echo $pro->pv_nombre ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group col-md-12">
                                <label>
                                    <input type="checkbox"  name="check_proveedor" value="1">
                                        Entrega Proveedor
                                </label>  
                            </div>
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-clock"></span></span>
									<select name="termino" required class="form-control">
										<option value="">Seleccionar Termino</option>
										<option value="CONTADO">CONTADO</option>
										<option value="1 DIA">1 DIA</option>
										<option value="1 SEMANA">1 SEMANA</option>
										<option value="1 MES">1 MES</option>
										<option value="1 BIMESTRE">1 BIMESTRE</option>
										<option value="1 TRIMESTRE">1 TRIMESTRE</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="hidden" class="h_input-costo" value="0.00" name="importe">
									<input type="text" class="form-control input-costo" value="0.00" readonly>
								</div>
							</div>
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-calendar"></span></span>
									<input type="text" class="form-control" value="<?php echo date('d/m/Y')?>" readonly>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-profile"></span></span>
									<input type="text" class="form-control" name="no_nota" placeholder="NO. NOTA" required>
								</div>
							</div>
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-price-tags"></span></span>
									<select name="tipo_compra" required class="form-control TypeCompra">
										<option value="">Seleccionar Tipo de Compra</option>
										<option value="MATERIA PRIMA">MATERIA PRIMA</option>
										<option value="PRODUCTO NO ENSAMBLADO">PRODUCTO NO ENSAMBLADO</option>
										<option value="GASTOS">GASTOS</option>
									</select>
								</div>
							</div>
						</div>
						<div id="ComprasMP"></div>
						<div class="col-md-12 text-center DivBtnMp" style="margin-bottom:15px;display:none;">
							<button type="button" class="btn-AddMP btn btn-dark"><span class="icon icon-plus"></span> Agregar</button>
						</div>
						<div id="ComprasPD"></div>
						<div class="col-md-12 text-center DivBtnPd" style="margin-bottom:15px;display:none;">
							<button type="button" class="btn-AddPD btn btn-dark"><span class="icon icon-plus"></span> Agregar</button>
						</div>
						<div id="ComprasArt"></div>
						<div class="col-md-12 text-center DivBtnArt" style="margin-bottom:15px;display:none;">
							<button type="button" class="btn-AddArt btn btn-dark"><span class="icon icon-plus"></span> Agregar</button>
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
	</div>

	<!-- Modal COMPRA -> AGREGAR NUEVA MATERIA PRIMA <OPTION> -->
	<div class="modal fade" id="NewMateriaPrima" tabindex="-1" role="dialog" aria-labelledby="NewMateriaPrimas" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="NewMateriaPrimas">NUEVA MATERIA PRIMA</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" id="form-MP">
						{{ csrf_field() }}
						<div class="form-row">
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-droplet"></span></span>
									<input type="text" class="form-control" name="nombre" placeholder="NOMBRE" required>
								</div>
							</div>
                            
							<!--<div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-stack"></span></span>
                                    <input type="number" class="form-control" name="cantidad" min="0.1" step="0.01" placeholder="CANTIDAD" required>
                                </div>
                            </div>-->
                            
                            <input type="hidden" name="cantidad" value="1">

                            <div class="form-row">
                                    <div class="form-group col">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                            <select class="form-control select-tipo" required name="unidad">
                                                <option value="KILOS">KILOS</option>
                                                <option value="LITROS">LITROS</option>
                                                <option value="PIEZAS">PIEZAS</option>
                                                <option value="MILILITROS">MILILITROS</option>
                                                <option value="METROS">METROS</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            <div class="form-group col-md-3">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="number" class="form-control" name="precio" min="0.1" step="0.01" placeholder="PRECIO" required>
								</div>
							</div>
                        </div>
                        <div class="form-row">
                            
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-binoculars"></span></span>
                                    <textarea class="form-control" name="observacion" placeholder="OBSERVACIONES" row="5">ninguna observación</textarea>
								</div>
							</div>
                        
                        </div>
						<div class="modal-footer">
							<button type="reset"  class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button>
							<button type="button" class="btn btn-danger btn-closeMP"><span class="icon icon-cross"></span> Cerrar</button>
							<button type="button" class="btn btn-dark btn-SubmitMP"><span class="icon icon-floppy-disk"></span> Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal COMPRA -> AGREGAR NUEVO PRODUCTO <OPTION> -->
	<div class="modal fade" id="NewProducto" tabindex="-1" role="dialog" aria-labelledby="productos" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="productos">Nuevo Producto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo route('post_producto')?>" method="POST">
                        {{csrf_field()}}
						<div class="form-row">
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-briefcase"></span></span>
									<input type="text" class="form-control" name="nombre" placeholder="NOMBRE" required>
								</div>
							</div>
                            
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-hammer"></span></span>
									<select class="form-control" name="tipo" id="type" required>
                                        <option value="NO ENSAMBLADO">NO ENSAMBLADO</option>
                                        <option value="ENSAMBLADO">ENSAMBLADO</option>
                                    </select>
								</div>
							</div>
                            <!-- <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-stack"></span></span>
                                    <input type="text" class="form-control" name="cantidad_producto" value="1" placeholder="CANTIDAD" readonly>
                                </div>
                            </div> -->
                            <input type="hidden" name="cantidad_unidad" value="1">
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="number" class="form-control input-costo" name="costo"  placeholder="COSTO" required>
								</div>
							</div>
                            
                             <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="number" class="form-control" name="precio_venta"  placeholder="PRECIO DE VENTA" required>
								</div>
							</div>
                        
                        </div>

                        <div class="AddEnsamblado"></div>

                        <div class="col-md-12 AppendBtn text-center" style="margin-bottom:15px;"></div>

                        <div class="modal-footer">
                            <button type="reset"  class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button> 
                            <button type="button" class="btn btn-danger btn-closePD" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
                            <button type="submit" class="btn btn-dark"><span class="icon icon-floppy-disk"></span> Guardar</button>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal COMPRA -> AGREGAR NUEVO GASTO <OPTION> -->
	<!-- <div class="modal fade" id="NewGasto" tabindex="-1" role="dialog" aria-labelledby="NewGastos" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="NewGastos">NUEVO GASTO</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" id="form-Gast">
						{{ csrf_field() }}
						<div class="form-row">
	                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-pencil"></span></span>
									<input type="text" class="form-control form-clearGast" name="nombre" placeholder="NOMBRE GASTO" required>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="reset"  class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button>
							<button type="button" class="btn btn-danger btn-closeGast"><span class="icon icon-cross"></span> Cerrar</button>
							<button type="button" class="btn btn-dark btn-SubmitGast"><span class="icon icon-floppy-disk"></span> Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> -->

	<!-- Modal COMPRA -> INSERTAR NUEVO PROVEEDOR <OPTION> -->
	<div class="modal fade" id="proveedor" tabindex="-1" role="dialog" aria-labelledby="proveedores" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="proveedores">NUEVO PROVEEDOR</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" id="form-Prov">
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
						<div class="form-row">
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-user"></span></span>
									<input type="text" class="form-control form-clearProv" name="nombre" placeholder="NOMBRE">
								</div>
							</div>
                            
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-mail4"></span></span>
									<input type="email" class="form-control form-clearProv" name="correo" required placeholder="CORREO">
								</div>
							</div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-location"></span></span>
									<input type="text" class="form-control form-clearProv" name="domicilio"  placeholder="DOMICILIO">
								</div>
							</div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-location"></span></span>
									<input type="text" class="form-control" name="ciudad"  placeholder="CIUDAD" required>
								</div>
							</div>
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-profile"></span></span>
									<input type="text" class="form-control" name="rfc"  placeholder="RFC" required>
								</div>
							</div>
                        </div> 

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-user-tie"></span></span>
                                    <input class="form-control form-clearProv" name="contacto[]" type="text" placeholder="NOMBRE DEL CONTACTO">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-phone"></span></span>
                                    <input class="form-control form-clearProv" name="telefono[]" type="text" placeholder="TELEFONO">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset"  class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button> 
                            <button type="button" class="btn btn-danger btn-closeProv"><span class="icon icon-cross"></span> Cerrar</button>
                            <button type="button" class="btn btn-dark btn-SubmitProv"><span class="icon icon-floppy-disk"></span> Guardar</button>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal PEDIDO -> INSERTAR NUEVO DOMICILIO <OPTION> -->
	<div class="modal fade" id="Domicilio" tabindex="-1" role="dialog" aria-labelledby="domicilios" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="domicilios">NUEVO DOMICILIO</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" id="form-Dom">
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                        <input type="hidden" name="id" value="" id="cli_id">
						<div class="form-row">
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-location"></span></span>
									<input type="text" class="form-control form-clearDom" name="calle" placeholder="CALLE">
								</div>
							</div>
                            
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-location"></span></span>
									<input type="email" class="form-control form-clearDom" name="colonia"  placeholder="COLONIA">
								</div>
							</div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-office"></span></span>
									<input type="text" class="form-control form-clearDom" name="ciudad"  placeholder="CIUDAD" required>
								</div>
							</div>
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-location"></span></span>
									<input type="text" class="form-control form-clearDom" name="codigo_postal"  placeholder="C.P.">
								</div>
							</div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset"  class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button> 
                            <button type="button" class="btn btn-danger btn-closeDom"><span class="icon icon-cross"></span> Cerrar</button>
                            <button type="button" class="btn btn-dark btn-SubmitDom"><span class="icon icon-floppy-disk"></span> Guardar</button>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>

	@foreach($PedidosProduccion as $pr)
		<!-- Modal Finalizar Produccion-->
		<div class="modal fade" id="FinalizarProduccion-{{$pr->id_produccion}}" tabindex="-1" role="dialog" aria-labelledby="viaticos" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="viaticos">Finalizar Producción</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{route('finalizar_produccion',$pr->id_produccion)}}" method="POST">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="_method" value="PUT">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Encargado</label>
									<div class="input-group">
										<div class="input-group-addon"><span class="icon icon-user-tie"></span></div>
										<input type="text" name="encargado" class="form-control" placeholder="Encargado" required>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label>Ayudante</label>
									<div class="input-group">
										<div class="input-group-addon"><span class="icon icon-user"></span></div>
										<input type="text" name="ayudante" class="form-control" placeholder="Ayudante">
									</div>
								</div>
								<div class="form-group col-md-6">
									<label>Turno</label>
									<div class="input-group">
										<div class="input-group-addon"><span class="icon icon-clock"></span></div>
										<select name="turno" class="form-control" required>
											<option value="">Seleccionar</option>
											<option value="MATUTINO">MATUTINO</option>
											<option value="VESPERTINO">VESPERTINO</option>
										</select>
									</div>
								</div>
							<div class="form-group col-md-6">
								<div class="form-group col">
									<label>Fecha</label>
									<div class="input-group">
										<div class="input-group-addon"><span class="icon icon-clock"></span></div>
										<input type="text" name="fecha" class="form-control" value="<?php echo date('d-m-Y') ?>">
									</div>
									</div>
							</div>
							</div>
							<div class="form-row">
								<div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Exceso de Producto</b></div>
								<div class="col-md-12">
									<p><b>Si se excede de productos solicitados, favor de especificar los productos excedidos para afectar inventario, caso al contrario omitir este proceso.</b></p>
							</div>
							</div>
							<div class="form-row" style="margin-bottom:25px;">
								<div class="text-center col-md-12">
									<button type="button" class="btn btn-dark BtnAddProductoExceso"><span class="icon icon-plus"></span> Producto</button>
								</div>
							</div>
							<div class="AppendProductoExceso"></div>
							<div class="modal-footer">
								<button type="reset"  class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
								<button type="submit" class="btn btn-dark"><span class="icon icon-floppy-disk"></span> Guardar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endforeach

	
		<!-- Modal Agregar Produccion-->
	<div class="modal fade" id="AgregarProduccion" tabindex="-1" role="dialog" aria-labelledby="viaticos" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="viaticos">Agregar Producción</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?php echo route('agregar_produccion') ?>" method="POST">
						{{csrf_field()}}
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Encargado</label>
									<div class="input-group">
										<div class="input-group-addon"><span class="icon icon-user-tie"></span></div>
										<input type="text" name="encargado" class="form-control" placeholder="Encargado" required>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label>Ayudante</label>
									<div class="input-group">
										<div class="input-group-addon"><span class="icon icon-user"></span></div>
										<input type="text" name="ayudante" class="form-control" placeholder="Ayudante">
									</div>
								</div>
								<div class="form-group col-md-6">
									<label>Turno</label>
									<div class="input-group">
										<div class="input-group-addon"><span class="icon icon-clock"></span></div>
										<select name="turno" class="form-control" required>
											<option value="">Seleccionar</option>
											<option value="MATUTINO">MATUTINO</option>
											<option value="VESPERTINO">VESPERTINO</option>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label>Memo</label>
									<div class="input-group">
										<div class="input-group-addon"><span class="icon icon-user"></span></div>
										<input type="text" name="memo" class="form-control" placeholder="OBSERVACIONES">
									</div>
								</div>
								<div class="form-group col-md-6">
								<!--<div class="form-group col">
									<label>Fecha</label>
									<div class="input-group">
										<div class="input-group-addon"><span class="icon icon-clock"></span></div>
										<input type="text" name="fecha" class="form-control" value="<?php //echo date('d-m-Y') ?>">
									</div>
								</div>-->
							</div>
							</div>
							<div class="form-row">
								<div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Agregar Producto(s)</b></div>
								<div class="col-md-12">
									<p><b>Agregar la Producción que se hizo durante el día.</b></p>
								</div>
							</div>
							<div class="form-row" style="margin-bottom:25px;">
								<div class="text-center col-md-12">
									<button type="button" class="btn btn-dark BtnAddProductoExceso"><span class="icon icon-plus"></span> Producto</button>
								</div>
							</div>
							<div class="AppendProductoExceso"></div>
							<div class="modal-footer">
								<button type="reset"  class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
								<button type="submit" class="btn btn-dark"><span class="icon icon-floppy-disk"></span> Guardar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
	</div>

	<!-- Modal Imprimir Inventario-->
		<div class="modal fade" id="ImprimirInventario" tabindex="-1" role="dialog" aria-labelledby="viaticos" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="viaticos">Imprimir Inventario</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<h2 class="text-center">MODULO EN PROCESO...</h2>
					</div>
				</div>
			</div>
		</div>

	<!-- Modal MENSAJE ERROR -->
	<div class="modal fade" id="MensajeError" tabindex="-1" role="dialog" aria-labelledby="MensajeErrors" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="MensajeErrors">Error!</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="mensaje-error-ajax"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal IMAGEN CARGANDO -->
	<div class="modal fade" id="ImgCargando" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="Cargando" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-body text-center">
					<img src="{{asset('img/cargando.gif')}}" >
				</div>
			</div>
		</div>
	</div>

	
@stop

@section('js')
	<script src="<?php echo asset('js/caja.js') ?>"></script>
	<script src="<?php echo asset('js/pedido.js') ?>"></script>
	<script src="<?php echo asset('js/viaje.js') ?>"></script>
	<script src="<?php echo asset('js/produccion.js') ?>"></script>
	<script src="<?php echo asset('js/movimiento_temporal.js') ?>"></script>
	<script src="<?php echo asset('js/cobranza.js') ?>"></script>
	<script src="<?php echo asset('js/ajuste_inventario.js') ?>"></script>
	
	<script>
		// PAGAR COMPRA
		function ValidarCantidadPagar(num){
			var total   = $('.TotalPagarCompra-'+num).val();
			var abonado = $('.TotalAbonadoCompra-'+num).val();
			var pago    = $('.PagoCompra-'+num).val();

			var oper = parseFloat(pago) + parseFloat(abonado);
			var dif  = parseFloat(total) - parseFloat(abonado);
			if (oper > total) {
				$('.PagoCompra-'+num).val(dif);
			}
		}

		function ValidacionMovimientos(){
			var compras   = $('.multicompra').val();
			var conceptos = $('.conceptos').val();
			if(typeof(conceptos) === 'undefined' && compras.length === 0){
				alert("Debe Seleccionar al menos una Compra o un Concepto");
				return false;
			}else{

			return true;
			}
		}

		function ValidacionAddMovimientos(id){
			var compras   = $('.addcompras-'+id).val();
			var conceptos = $('.addconcept-'+id).val();
			if(conceptos === 'undefined' && compras.length === 0){
				alert("Debe Seleccionar al Menos Una Compra o Agregar un Concepto");
				return false;
			}
			return true;
		}
			
		/* Modal normal */
      	$('.fecha_pedido').datepicker({
		    format: 'yyyy-mm-dd',
		    autoclose:true,
		    language:'es',
		    container: "#picker-container",
		    title:"Fecha Pedido"
		});

		$('.fecha_viaje').datepicker({
		    format: 'yyyy-mm-dd',
		    autoclose:true,
		    language:'es',
		    container: "#picker-container",
		    title:"Fecha Viaje"
		});

		$('.fecha_movimiento').datepicker({
		    format: 'yyyy-mm-dd',
		    autoclose:true,
		    language:'es',
		    container: "#picker-container",
		    title:"Fecha Movimiento"
		});

		$('.fecha_entrega').datepicker({
		    format: 'yyyy-mm-dd',
		    autoclose:true,
		    language:'es',
		    startDate: $('input[name="fecha_pedido"]').val(),
		    container: "#picker-container2",
		    title:"Fecha Programada"
		});

		$('.fecha_pedido').datepicker().on('changeDate',function(e){
			$('.fecha_entrega').datepicker('setStartDate',$('input[name="fecha_pedido"]').val());
		});

		/* Modal Updated */
		$('.fecha_pedido2').datepicker({
		    format: 'yyyy-mm-dd',
		    autoclose:true,
		    language:'es',
		    title:"Fecha Pedido"
		});

		$('.fecha_entrega2').datepicker({
		    format: 'yyyy-mm-dd',
		    autoclose:true,
		    language:'es',
		    startDate: $('input[name="fecha_pedido2"]').val(),
		    title:"Fecha Programada"
		});

		$('.fecha_pedido2').datepicker().on('changeDate',function(e){
			$('.fecha_entrega2').datepicker('setStartDate',$('input[name="fecha_pedido2"]').val());
		});
	</script>
@stop


    
