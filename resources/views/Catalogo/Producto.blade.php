@extends('Template.Body')

@section('title','Captura Producto')

@section('body')

    <a href="Caja" class="btn btn-danger">
		<span class="icon icon-exit"></span> Salir
	</a>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#producto">
		<span class="icon icon-briefcase"></span> Nuevo
	</button>
    <br>
    <br>
    <div class="card text-black bg-light">
		<div class="card-header text-center text-white bg-danger"><b>PRODUCTO</b></div>
        <table class="table table-hover table-sm">
            <thead>
                <th>No. Producto</th>
                <th>Nombre</th>
                <th>Costo</th>
                <th>Precio Venta</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Opciones</th>
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
                        <td>$<?php echo number_format($pd->pd_costo,2) ?></td>
                        <td>$<?php echo number_format($pd->pd_precio_venta,2) ?></td>
                        <td><?php echo $pd->pd_tipo ?></td>
                        <td><?php echo number_format($pd->pd_cantidad) ?></td>
                        <td>
                            <form action="<?php echo route('put_producto') ?>" method="POST" style="display:inline-block;margin-right:5px;">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                                <input type="hidden" name="producto" value="<?php echo $pd->id_producto ?>">
                                <?php if($pd->pd_status){ ?>
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" class="btn btn-danger btn-sm"><span class="icon icon-arrow-down"></span>
                                <?php } else { ?>
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-success btn-sm"><span class="icon icon-arrow-up"></span>
                                <?php } ?>
                            </form>
                            <?php if($pd->pd_tipo === "ENSAMBLADO") { ?>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#info-<?php echo $pd->id_producto ?>"><span class="icon icon-eye"></span></button>
                            <?php } ?>
                        </td>
                    </tr>
                    <!-- INFORMACION PRODUCTO -->
                    <div class="modal fade" id="info-<?php echo $pd->id_producto ?>" tabindex="-1" role="dialog" aria-labelledby="infos" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="infos">Informacion de <?php echo $pd->pd_nombre ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><b>Costo: </b><?php echo $pd->pd_costo ?></p>
                                    <p><b>Precio de Venta: </b><?php echo $pd->pd_precio_venta ?></p>
                                    <p><b>Materia Prima: </b></p>
                                    <?php foreach ($pd->materiasprimas as $material) {?>
                                        <li><?php echo $material->mp_nombre.":"." ".$material->pivot->det_cantidad." ".$material->mp_unidad; ?></li>
                                    <?php } ?>
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

    <!-- INSERTAR NUEVO PRODUCTO -->
	<div class="modal fade" id="producto" tabindex="-1" role="dialog" aria-labelledby="productos" aria-hidden="true">
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
                             <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-stack"></span></span>
                                    <input type="text" class="form-control" name="cantidad_producto" value="1" placeholder="CANTIDAD" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="text" class="form-control input-costo" name="costo"  placeholder="COSTO" required>
								</div>
							</div>
                            
                             <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="text" class="form-control" name="precio_venta"  placeholder="PRECIO DE VENTA" required>
								</div>
							</div>
                        
                        </div>

                        <div class="AddEnsamblado"></div>
                        <div class="col-md-12 AppendBtn text-center" style="margin-bottom:15px;"></div>

                        <div class="modal-footer">
                            <button type="reset"  class="btn btn-primary"><span class="icon icon-fire"></span> Limpiar</button> 
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
                            <button type="submit" class="btn btn-success"><span class="icon icon-floppy-disk"></span> Guardar</button>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop

@section('js')
    <script src="<?php echo asset('js/producto.js') ?>"></script>
@stop