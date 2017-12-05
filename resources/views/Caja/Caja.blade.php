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
	  <li class="nav-item dropdown">
	    <a class="nav-link active dropdown-toggle tooltips2" data-toggle="dropdown" href="#" data-placement="top" title="Informacion"><span class="icon icon-info"></span> <!-- Información --></a>
	    <div class="dropdown-menu">
	      <a class="dropdown-item" data-toggle="pill" href="#pills-info" role="tab"><span class="icon icon-eye"></span> Ver</a>
	      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#pedido"><span class="icon icon-plus"></span> Nuevo</a>
	    </div>
	  </li>
	  	  <!-- li pagos -->
	  <li class="nav-item dropdown">
	    <a class="nav-link dropdown-toggle tooltips2" data-toggle="dropdown" href="#" data-placement="top" title="Cobranza"><span class="icon icon-coin-dollar"></span> <!-- Información --></a>
	    <div class="dropdown-menu">
	      <a class="dropdown-item" data-toggle="pill" href="#pills-pagos" role="tab"><span class="icon icon-eye"></span> Ver</a>
	      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#"><span class="icon icon-plus"></span> Nuevo</a>
	    </div>
	  </li>
	  <!-- li Pedido -->
	  <li class="nav-item dropdown">
	    <a class="nav-link dropdown-toggle tooltips2" data-toggle="dropdown" href="#" data-placement="top" title="Pedido"><span class="icon icon-cart"></span> <!-- Pedido --></a>
	    <div class="dropdown-menu">
	      <a class="dropdown-item" data-toggle="pill" href="#pills-pedido" role="tab"><span class="icon icon-eye"></span> Ver</a>
	      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#pedido"><span class="icon icon-plus"></span> Nuevo</a>
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
	      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#produccion"><span class="icon icon-plus"></span> Nuevo Pedido</a>
	    </div>
	  </li>
	</ul> <!-- /ul nav -->

	<!-- Tab Content -->
	<div class="tab-content" id="pills-tabContent">

	

 					  	<!-- Tab Informacion -->
	  	<div class="tab-pane fade show active" id="pills-info" role="tabpanel">
	  		<div class="card-header text-center text-white bg-danger"><b>PRODUCTOS EN EXISTENCIA</b></div>
        	<table class="table table-hover table-sm">
            <thead>
                <th>No. Producto</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th></th>
            </thead>
            <tbody>
                <?php if(count($productos) < 1) { ?>
                    <tr>
                        <td colspan="6">NO SE ENCONTRO NINGUN REGISTRO</td>
                    </tr>
                <?php } ?>
                <?php foreach ($productos as $pd) { ?>
                    <tr class='<?php if($pd->pd_status){ echo "table-success"; } else { echo "table-danger"; } ?>'>
                        <th><?php echo  str_pad($pd->id_producto, 2, "0", STR_PAD_LEFT) ?></th>
                        <td><?php echo $pd->pd_nombre ?></td>
                        <td><?php echo $pd->pd_tipo ?></td>
                        <td><?php echo number_format($pd->pd_cantidad) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        	</table>

        	<br>

        	<div class="card-header text-center text-white bg-danger"><b>MATERIA PRIMA EN EXISTENCIA</b></div>
        	<table class="table table-hover table-sm">
            <thead>
            	<th>No. Materia Prima</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th></th>
            </thead>
            <tbody>
                <?php if(count($mat_primas) < 1) { ?>
                    <tr>
                        <td colspan="5">NO SE ENCONTRO NINGUN REGISTRO</td>
                    </tr>
                <?php } ?>
                <?php foreach ($mat_primas as $mp) { ?>
                    <tr class='<?php if($mp->mp_status){ echo "table-success"; } else { echo "table-danger"; } ?>'>
                        <th><?php echo str_pad($mp->id_materia_prima, 2, "0", STR_PAD_LEFT) ?></th>
                        <td><?php echo $mp->mp_nombre ?></td> 
                        <!-- TOTAL DE MATERIA PRIMA -->
                        	<?php $cantidad_total=\DB::table('compra_mp')->where('mp_id',$mp->id_materia_prima)->SUM('det_cantidad'); ?>
                        	<td><?php echo $cantidad_total ?></td>                 
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
        <br>
        <div class="card-header text-center text-white bg-danger"><b>INGRESOS Y EGRESOS</b></div>
		    <table class="table table-hover table-sm">
		            <thead>
		                <th></th>
		                <th>Ingresos</th>
		                <th>Egresos</th>
		            </thead>
		            <tbody>
		                <?php if(count($pedidos) < 1) { ?>
		                    <tr>
		                        <td colspan="5">NO SE ENCONTRO NINGUN PEDIDO</td>
		                    </tr>
		                <?php } ?>
		                <!-- TOTAL DE INGRESOS -->
		                    <tr>
		                        <th>Total</th>
		                        <?php $total=\DB::table('pedidos')->SUM('pe_total_abonado'); ?>
                        	<td><?php echo number_format($total,2) ?></td>  

                        	<!-- TOTAL DE EGRESOS -->
		                        <?php $total=\DB::table('compras')->SUM('cm_total'); ?>
                        	<td><?php echo number_format($total,2) ?></td>  		      
		                    </tr>
		                 
		    </table>
						
<br>
<br>
 		</div>

 				  	<!-- Tab Cobranza -->
	  	<div class="tab-pane fade" id="pills-pagos" role="tabpanel">
	  	<div class="card-header text-center text-white bg-danger" align="center"><b>COBRANZAS</b></div>
	  	<br>
	  	<select name="cliente" required class="form-control">

				<option value="">Clientes</option>
					<?php foreach($clientes as $cl){ ?>
				<option value="<?php echo $cl->id_cliente?>"><?php echo $cl->cl_nombre ?></option>
												<?php } ?>
		</select>
			<br>
			<br>
			<div class="card-header text-center text-white bg-info"><b>PEDIDOS QUE ADEUDA</b></div>
		        <table class="table table-hover table-sm">
		            <thead>
		                <th>No. Nota</th>
		                <th>Pedido</th>
		                <th>Cliente</th>
		                <th>Debe</th>
		                <th>Total Abonado</th>
		            </thead>
		            <tbody>
		                <?php if(count($pedidos_adeuda) < 1) { ?>
		                    <tr>
		                        <td colspan="5">NO SE ENCONTRO NINGUN PEDIDO</td>
		                    </tr>
		                <?php } ?>
		                <?php foreach ($pedidos_adeuda as $pe) { ?>
		                    <tr>
		                        <td><?php echo $pe->pe_nota ?></td>
		                        <td><?php echo $pe->pe_fecha_pedido ?></td>
		                        <td><?php echo $pe->cliente->cl_nombre ?></td>
		                        <td><?php echo $pe->pe_importe ?></td>
		                        <td><?php echo $pe->pe_total_abonado ?></td>		               
		                        <td>
		                            <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#abonar-<?php echo $pe->id_pedido ?>">Abonar</button>
		                        </td>
		                    </tr>
				        	<!-- MODAL PARA ABONAR -->
							<div class="modal fade" id="abonar-<?php echo $pe->id_pedido ?>" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="movimientos">Abonar a Pedido: <?php echo $pe->id_pedido ?></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="<?php echo route('put_abona_pedido',$pe->id_pedido) ?>" method="POST">
												<input type="hidden" name="_method" value="PUT">
						                        <input type="hidden" name="_token" value="<?php echo csrf_token()?>">
												<div class="form-row">
													<div class="form-group col">
														<div class="input-group">
															<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
															<input type="text" class="form-control" placeholder="CANTIDAD QUE ABONA" name="abona" required>
														</div>
													</div>

													<div class="form-group col">
														<div class="input-group">
															<span class="input-group-addon"><span class="icon icon-user"></span></span>
															<select name="forma_pago" required class="form-control">
																	<option value="">FORMA DE PAGO</option>
																	<option value="EFECTIVO">EFECTIVO</option>
																	<option value="CHEQUE">CHEQUE</option>
																	<option value="DEPOSITO">DEPOSITO</option>
																	<option value="TRANSFERENCIA">TRANSFERENCIA</option>
																
															</select>
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
		                <?php } ?>
		            </tbody>
		        </table>

		        <br>
			<br>

 		</div>

	  	<!-- Tab Pedido -->
	  	<div class="tab-pane fade" id="pills-pedido" role="tabpanel">
			<div class="card text-black bg-light">
				<div class="card-header text-center text-white bg-danger"><b>PEDIDOS</b></div>
		        <table class="table table-hover table-sm">
		            <thead>
		                <th>No. Nota</th>
		                <th>Pedido</th>
		                <th>Entrega</th>
		                <th>Cliente</th>
		                <th>Destino</th>
		                <th>Opciones</th>
		            </thead>
		            <tbody>
		                <?php if(count($pedidos) < 1) { ?>
		                    <tr>
		                        <td colspan="5">NO SE ENCONTRO NINGUN PEDIDO</td>
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
		                            <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#info-<?php echo $pe->id_pedido ?>"><span class="icon icon-info"></span></button>
		                        </td>
		                        <td>
		                        	<?php if ($pe->pe_status != "PREPARADO PARA ENTREGAR"): ?>
		                        		<a href="<?php echo route('pdf_pedido',['id'=>$pe->id_pedido,'preorden'=>1,'copia'=>1]) ?>" class="btn btn-danger btn-sm"><span class="icon icon-file-pdf"></span></a>
		                        	<?php else : ?>
		                        		<a href="<?php echo route('pdf_pedido',['id'=>$pe->id_pedido,'preorden'=>0,'copia'=>1]) ?>" class="btn btn-danger btn-sm"><span class="icon icon-file-pdf"></span></a>
		                        	<?php endif ?>
		                        </td>
		                        <td>
		                            <a href="<?php echo route('get_view_update_pedido',$pe->id_pedido) ?>" class="btn btn-dark btn-sm">Editar</a>
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
	  	<!-- Tab Compra -->
	  	<div class="tab-pane fade" id="pills-compra" role="tabpanel">
			<div class="card text-black bg-light">
				<div class="card-header text-center text-white bg-danger"><b>Compras</b></div>
				<table class="table table-hover table-sm text-center">
					<thead>
							<th>No. Nota</th>
							<th class="text-center">Fecha</th>
							<th class="text-center">Total</th>
							<th class="text-center">Proveedor</th>
							<th class="text-center">Termino</th>
							<th class="text-center">Tipo Compra</th>
							<th class="text-center">Estatus</th>
							<th class="text-center">Bodega</th>
							<th class="text-center">Ver</th>
							<th></th>
					</thead>
					<tbody>
						<?php if (count($compras) < 1): ?>
							<tr>
								<td colspan="9" class="table-dark">NO SE ENCONTRO NINGUN REGISTRO</td>
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
				 					<span class="badge badge-dark" >
				 						<?php echo $compra->cm_status ?>
				 					</span>
				 				</td>
				 				<td>
				 					<?php if(!$compra->cm_bodega){ ?>
				 						 <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#bodega-<?php echo $compra->id_compra ?>"><span class="icon icon-checkmark"></span></button>

				 					<?php } else{ ?>
				 						<span class="badge badge-dark">SI</span>
				 					<?php } ?>
				 				</td>
				 				<td>
				 					<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ModalInfoCompra-<?php echo $compra->id_compra?>"><span class="icon icon-eye"></span></button>
				 				</td>
					 		</tr>
					 		<!-- MODAL DATOS DE ENTRADA A BODEGA -->
							<div class="modal fade" id="bodega-<?php echo $compra->id_compra ?>" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="movimientos">Datos de Entrada en Bodega</h5>
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
																<option value="">Empleado Que Recibe</option>
																<?php foreach($empleados as $emp){ ?>
																	<option value="<?php echo $emp->id_empleado?>"><?php echo $emp->em_nombre ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group col">
														<div class="input-group">
															<span class="input-group-addon"><span class="icon icon-calendar"></span></span>
															<input type="text" class="form-control" placeholder="NUMERO DE ENTRADA" name="num_entrada" required>
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
			<div class="card-header text-center text-white bg-danger"><b>PRESTAMOS</b></div>
			<!-- <div class="card-body"> -->
				<table class="table table-hover table-sm text-center">
					<thead>
						<th>#</th>
						<th class="text-center">Fecha</th>
						<th class="text-center">Empleado</th>
						<th class="text-center">Cantidad</th>
						<th class="text-center">Descripcion</th>
	                    <th class="text-center">Tipo</th>
						<th class="text-center">Estatus</th>
					</thead>
					<tbody>
						<?php if(count($PPendientes) < 1){ ?>
							<tr><td colspan="7" class="table-dark">NO HAY PRESTAMOS PENDIENTES</td></tr>
						<?php } ?>
						<?php foreach($PPendientes as $pre){ ?>
							<tr>
								<th><?php echo str_pad($pre->id_prestamo , 2, "0", STR_PAD_LEFT) ?></th>
								<td><?php echo $pre->created_at ?></td>
								<td><?php echo $pre->empleado->em_nombre ?></td>
								<td><?php echo number_format($pre->pres_cantidad,2) ?></td>
								<td><?php echo $pre->pres_descripcion ?></td>
	                            <td><?php echo $pre->pres_tipo ?></td>
								<td><span class="badge badge-pill badge-success" data-toggle="modal" data-target="#prestamo_pendiente-<?php echo $pre->id_prestamo ?>">Pendiente</span></td>
								<td>
									<?php if($pre->movimiento_temporal_id > 0){ ?>
										<Button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#prestamo_movimiento-<?php echo $pre->id_prestamo ?>"><span class="icon icon-eye"></span></Button>
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
															<li>Compra No° <?php echo str_pad($con->id_compra, 2, "0", STR_PAD_LEFT) ?></li>
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
										<Button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#prestamo_viaje"><span class="icon icon-eye"></span></Button>
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
																<option value="LISTO">SI APRUEBO EL PRESTAMO</option>
																<option value="NO APROBADO"> NO APRUEBO EL PRESTAMO</option>
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
							<tr class="table-dark"><td colspan="4">NO HAY MOVIMIENTOS TEMPORALES PENDIENTES</td></tr>
						<?php } ?>
						<?php foreach($mtPendientes as $mt){ ?>
							<tr>
								<th class="text-center"><?php echo str_pad($mt->id_movimiento_temporal, 2, "0", STR_PAD_LEFT) ?></th>
								<td><?php echo $mt->created_at ?></td>
								<td><?php echo $mt->empleado->em_nombre ?></td>
								<td>$<?php echo number_format($mt->mt_entregado,2)?></td>
								<td class="text-left">
									<?php $conceptos = \DB::table('detalle_movimientos')->select('ct_concepto','id_concepto')->where('movimiento_temporal_id',$mt->id_movimiento_temporal)->where('compra_id','0')->get(); ?>
									<?php foreach($mt->compras as $con){ ?>
										<li>Compra No° <?php echo str_pad($con->id_compra, 2, "0", STR_PAD_LEFT) ?></li>
									<?php } ?>
									<?php foreach($conceptos as $con){ ?>
										<li><?php echo $con->ct_concepto ?></li>
									<?php } ?>
								</td>
								<th>
									<?php echo $mt->mt_status ?>
								</th>
								<td>
									<button type="button" class="btn btn-dark btn-sm btn-addConcepto" data-toggle="modal" data-target="#new_concepto-<?php echo $mt->id_movimiento_temporal ?>">
										<span class="icon icon-plus"></span>
									</button>
									<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#mov_pendiente-<?php echo $mt->id_movimiento_temporal ?>">
										<!-- <span class="icon icon-checkmark"></span> -->
										<b>Finalizar</b>
									</button>

									<a class="btn btn-dark btn-sm" target="_blank()" href="<?php echo route('ticket_movimiento',['id'=>$mt->id_movimiento_temporal,'copia'=>1]) ?>"><span class="icon icon-ticket"></span></a>
								
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
																<input type="text" class="form-control" value="Compra No° <?php echo str_pad($con->id_compra, 2, "0", STR_PAD_LEFT)?>" readonly>
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
											<form action="<?php echo route('post_AddOtroConcepto') ?>" method="POST" onsubmit="return ValidacionAddMovimientos()">
												{{csrf_field()}}
												<input type="hidden" name="movimiento" value="<?php echo $mt->id_movimiento_temporal ?>">
												<div class="form-row">
													<div class="form-group col-md-12" style="width:100%;">
														<label>Compras</label>
														<select name="compras[]" class="form-control addcompras multicompra" multiple>
															@foreach($mov_compras as $compra)
																<option value="{{$compra->id_compra}}">Compra No° {{str_pad($compra->id_compra, 2, "0", STR_PAD_LEFT)}}</option>
															@endforeach
														</select>
													</div>
													<div class="form-group col">
														<label>Concepto</label>
														<div class="input-group">
															<span class="input-group-addon"><span class="icon icon-price-tag"></span></span>
															<input class="form-control addconcept" name="concepto" type="text" placeholder="CONCEPTO">
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
								<td colspan="5" class="table-dark">NO SE ENCONTRO NINGUN REGISTRO</td>
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
									<a class="btn btn-danger btn-sm" href="<?php echo route('get_viaje',$viaje->id_viaje) ?>"><span class="icon icon-eye"></span></a>
								</td>
								<td>
									<a class="btn btn-dark btn-sm" target="_blank()" href="<?php echo route('ticket_viaje',['id'=>$viaje->id_viaje,'copia'=>1]) ?>"><span class="icon icon-ticket"></span></a>
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
				<div class="card-header text-center text-white bg-danger"><b>PEDIDOS PEGAZA PENDIENTES</b></div>
				<table class="table table-hover table-sm text-center">
					<thead>
						<th>No. Nota</th>
						<th class="text-center">Memo</th>
						<th class="text-center">Fecha</th>
					</thead>
					<tbody>
						@if(count($pedidos_pegaza) < 1)
							<tr>
								<td colspan="3" class="table-dark">NO SE ENCONTRO NINGUN PEDIDO PENDIENTE</td>
							</tr>
						@endif
						@foreach($pedidos_pegaza as $pedido)
							<tr>
								<th><?php echo $pedido->pp_nota ?></th>
								<td><?php echo $pedido->pp_memo ?></td>
								<td><?php echo $pedido->created_at ?></td>
								<td width="50">
									<a class="btn btn-danger btn-sm" href="#"><span class="icon icon-eye"></span></a>
								</td>
								<td width="50">
									<a class="btn btn-dark btn-sm" href="#"><span class="icon icon-pencil"></span></a>
								</td>
								<td width="50">
									<a class="btn btn-danger btn-sm" href="#"><span class="icon icon-cross"></span></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<br>
			<div class="card text-black bg-light">
				<div class="card-header text-center text-white bg-dark"><b>PEDIDOS A PRODUCCION</b></div>
				<table class="table table-hover table-sm text-center">
					<thead>
						<th>No. Nota</th>
						<th class="text-center">Memo</th>
						<th class="text-center">Fecha</th>
					</thead>
					<tbody>
						@if(count($pedidos_pegaza) < 1)
							<tr>
								<td colspan="3">NO SE ENCONTRO NINGUN PEDIDO PENDIENTE</td>
							</tr>
						@endif
						@foreach($pedidos_pegaza as $pedido)
							<tr>
								<th><?php echo $pedido->pp_nota ?></th>
								<td><?php echo $pedido->pp_memo ?></td>
								<td><?php echo $pedido->created_at ?></td>
								<td width="50">
									<a class="btn btn-danger btn-sm" href="#"><span class="icon icon-eye"></span></a>
								</td>
								<td width="50">
									<a class="btn btn-dark btn-sm" href="#"><span class="icon icon-pencil"></span></a>
								</td>
								<td width="50">
									<a class="btn btn-danger btn-sm" href="#"><span class="icon icon-cross"></span></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
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
								<select name="repartidor" id="" class="form-control">
									<option value="">Seleccionar</option>
									@foreach($empleados as $emp)
										<option value="{{$emp->id_empleado}}">{{$emp->em_nombre}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col">
								<label>Fecha</label>
								<input type="text" class="form-control" value="<?php echo date('d-m-Y') ?>" readonly>
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
									@foreach($preparados as $index=>$pedido)
										<tr>
											<td><input type="checkbox" name="pedidos[]" value="<?php echo $pedido->id_pedido ?>" <?php if($index == 0) echo 'checked'; ?>></td>
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
									@foreach($cobranza as $index=>$pedido)
										<tr>
											<td><input type="checkbox" name="cobrar[]" value="<?php echo $pedido->id_pedido ?>" <?php if($index == 0) echo 'checked'; ?>></td>
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
							<button type="submit" class="btn btn-dark"><span class="icon icon-floppy-disk"></span> Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal PEDIDOS PRODUCCION-->
	<div class="modal fade" id="produccion" tabindex="-1" role="dialog" aria-labelledby="produccion" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="produccion">Pedido Sin Cliente</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{route('post_pedido_produccion')}}" method="POST">
						{{csrf_field()}}
						<div class="form-row">
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-profile"></span></span>
									<input type="text" class="form-control" name="nota" placeholder="NO. NOTA" required>
								</div>
							</div>
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-calendar"></span></span>
									<input type="text" class="form-control" value="<?php echo date('d-m-Y') ?>" readonly>
								</div>
							</div>
							<div class="form-group col-md-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-pencil"></span></span>
									<textarea name="memo" rows="3" class="form-control" placeholder="MEMO" required></textarea>
								</div>
							</div>
						</div>
						<div class="AddProductoProduccion"></div>
				        <div class="form-row" style="margin-bottom:15px;">
				            <div class="text-center col">
				                <button type="button" class="btn btn-dark btn-AddProductoProduccion"><span class="icon icon-plus" ></span>Agregar</button>
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
									<input type="text" class="form-control" name="fecha_pedido" value="<?php echo date('Y-m-d') ?>" readonly required>
								</div>
							</div>
							<div class="form-group col">
								<label>Fecha Entrega</label>
								<div class="input-group date fecha_entrega" id="picker-container2">
									<span class="input-group-addon"><span class="icon icon-calendar"></span></span>
									<input type="text" class="form-control" name="fecha_programada" value="<?php echo date('Y-m-d') ?>" readonly required>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<!--<label>No. Nota</label>-->
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-profile"></span></span>
									<input type="text" class="form-control" name="nota" value="{{$ultima_nota}}" placeholder="No. NOTA" required>
								</div>
							</div>
							<div class="form-group col">
								<!--<label>Cliente</label>-->
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-user"></span></span>
									<select name="cliente" id="cl" class="form-control" required>
										<option value="">Seleccionar Cliente</option>
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
									<input type="text" class="form-control" value="0" placeholder="No. Cheque" name="no_cheque">
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
									<textarea name="memo" class="form-control" placeholder="MEMO"></textarea>
								</div>
							</div>
						</div>
						<div class="form-row">
						   <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="text" class="form-control input-subtotal" name="importe"  placeholder="IMPORTE" readonly required>
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
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-credit-card"></span></span>
									<select class="form-control select-status-pago" name="pago_status" required>
										<option value="">Pago</option>
	                                    <option value="PENDIENTE">PENDIENTE</option>
	                                    <option value="ABONADO">ABONADO</option>
	                                    <option value="PAGADO">PAGADO</option>
	                                </select>
								</div>
							</div>
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
								<button type="button" class="btn btn-primary btn-AddProducto"><span class="icon icon-plus"></span>Agregar</button>
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
									<select name="empleado" required class="form-control">
										<option value="">Seleccionar Empleado</option>
										<?php foreach($empleados as $emp){ ?>
											<option value="<?php echo $emp->id_empleado?>"><?php echo $emp->em_nombre ?></option>
										<?php } ?>
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
										<option value="{{$compra->id_compra}}">Compra No° {{str_pad($compra->id_compra, 2, "0", STR_PAD_LEFT)}}</option>
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
					<form action="<?php echo route('post_prestamo') ?>" method="POST">
						{{csrf_field()}}
						<div class="form-row">
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-user"></span></span>
									<select name="empleado" required class="form-control">
										<option value="">Seleccionar Empleado</option>
										<?php foreach($empleados as $emp){ ?>
											<option value="<?php echo $emp->id_empleado?>"><?php echo $emp->em_nombre ?></option>
										<?php } ?>
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
									<input type="text" class="form-control" name="prestamo" placeholder="EFECTIVO A PRESTAR" required>
								</div>
							</div>
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-user"></span></span>
									<select name="tipo" required class="form-control">
										<option value="">Seleccionar Tipo</option>
										<option value="GASTO">GASTO</option>
										<option value="PERSONAL">PERSONAL</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-eye"></span></span>
									<textarea class="form-control" row="5" name="descripcion" placeholder="MEMO"></textarea>
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
                                    <textarea class="form-control form-clearCli" row="8" name="observaciones" placeholder="OBSERVACIONES"></textarea>
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
                            <button type="reset"  class="btn btn-primary"><span class="icon icon-fire"></span> Limpiar</button> 
                            <button type="button" class="btn btn-danger btn-closeCli" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
                            <button type="button" class="btn btn-success btn-SubmitCli"><span class="icon icon-floppy-disk"></span> Guardar</button>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal COMPRA MATERIA PRIMA o GASTOS -->
	<div class="modal fade" id="compra_material" tabindex="-1" role="dialog" aria-labelledby="materiales" aria-hidden="true">
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
										<option value="GASTOS">GASTOS</option>
									</select>
								</div>
							</div>
						</div>
						<div id="ComprasMP"></div>
						<div class="col-md-12 text-center DivBtnMp" style="margin-bottom:15px;display:none;">
							<button type="button" class="btn-AddMP btn btn-primary"><span class="icon icon-plus"></span> Agregar</button>
						</div>
						<div id="ComprasArt"></div>
						<div class="col-md-12 text-center DivBtnArt" style="margin-bottom:15px;display:none;">
							<button type="button" class="btn-AddArt btn btn-primary"><span class="icon icon-plus"></span> Agregar</button>
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
									<input type="text" class="form-control form-clearMP" name="nombre" placeholder="NOMBRE" required>
								</div>
							</div>
                            
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-stack"></span></span>
									<input type="text" class="form-control form-clearMP" name="cantidad"  placeholder="CANTIDAD (UNIDAD)" required>
								</div>
							</div>

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

                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="number" min="1" class="form-control form-clearMP" name="precio" placeholder="PRECIO" required>
								</div>
							</div>
                        </div>
                        <div class="form-row">
                            
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-binoculars"></span></span>
                                    <textarea class="form-control form-clearMP" name="observacion" placeholder="MEMO" row="5"></textarea>
								</div>
							</div>
                        
                        </div>
						<div class="modal-footer">
							<button type="reset"  class="btn btn-primary"><span class="icon icon-fire"></span> Limpiar</button>
							<button type="button" class="btn btn-danger btn-closeMP"><span class="icon icon-cross"></span> Cerrar</button>
							<button type="button" class="btn btn-success btn-SubmitMP"><span class="icon icon-floppy-disk"></span> Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal COMPRA -> AGREGAR NUEVO GASTO <OPTION> -->
	<div class="modal fade" id="NewGasto" tabindex="-1" role="dialog" aria-labelledby="NewGastos" aria-hidden="true">
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
							<button type="reset"  class="btn btn-primary"><span class="icon icon-fire"></span> Limpiar</button>
							<button type="button" class="btn btn-danger btn-closeGast"><span class="icon icon-cross"></span> Cerrar</button>
							<button type="button" class="btn btn-success btn-SubmitGast"><span class="icon icon-floppy-disk"></span> Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

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
									<input type="email" class="form-control form-clearProv" name="correo"  placeholder="CORREO">
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
                            <button type="reset"  class="btn btn-primary"><span class="icon icon-fire"></span> Limpiar</button> 
                            <button type="button" class="btn btn-danger btn-closeProv"><span class="icon icon-cross"></span> Cerrar</button>
                            <button type="button" class="btn btn-success btn-SubmitProv"><span class="icon icon-floppy-disk"></span> Guardar</button>
                        </div>
					</form>
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
@stop

@section('js')
	<script src="<?php echo asset('js/caja.js') ?>"></script>
	<script src="<?php echo asset('js/pedido.js') ?>"></script>
	<script src="<?php echo asset('js/viaje.js') ?>"></script>
	<script src="<?php echo asset('js/produccion.js') ?>"></script>
	<script src="<?php echo asset('js/movimiento_temporal.js') ?>"></script>
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
				alert("Debe Seleccionar Compra(s) o Agregar Concepto(s)");
				return false;
			}
			return true;
		}

		function ValidacionAddMovimientos(){
			var compras   = $('.addcompras').val();
			var conceptos = $('.addconcept').val();
			if(conceptos === '' && compras.length === 0){
				alert("Debe Seleccionar Compra(s) o Agregar Concepto(s)");
				return false;
			}
			return true;
		}

		// tooltips2
		$('.tooltips2').tooltip();
			
		/* Modal normal */
      	$('.fecha_pedido').datepicker({
		    format: 'yyyy-mm-dd',
		    autoclose:true,
		    language:'es',
		    container: "#picker-container",
		    title:"Fecha Pedido"
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


    
