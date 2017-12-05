@extends('Template.Body')

@section('title','Captura Materia Prima')

@section('body')

    <a href="Caja" class="btn btn-danger">
		<span class="icon icon-exit"></span> Salir
	</a>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#materia_prima">
		<span class="icon icon-droplet"></span> Nuevo
	</button>
    <br>
    <br>
    <div class="card text-black bg-light">
		<div class="card-header text-center text-white bg-danger"><b>MATERIA PRIMA</b></div>
        <table class="table table-hover table-sm">
            <thead>
                <th>Nombre</th>
                <!-- <th>Cantidad</th> -->
                <th>Precio</th>
                <th>Observacion</th>
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
                        <td><?php echo $mp->mp_nombre ?></td>
                        <!-- <td><?php echo $mp->mp_cantidad ?></td> -->
                        <td>$<?php echo number_format($mp->mp_precio,2) ?></td>
                        <td><?php echo $mp->mp_observacion ?></td>
                        <td>
                            <form action="<?php echo route('put_mat_prima') ?>" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                                <input type="hidden" name="mat_prima" value="<?php echo $mp->id_materia_prima ?>">
                                <?php if($mp->mp_status){ ?>
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" class="btn btn-danger btn-sm"><span class="icon icon-arrow-down"></span>
                                <?php } else { ?>
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-success btn-sm"><span class="icon icon-arrow-up"></span>
                                <?php } ?>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- INSERTAR NUEVA MATERIA PRIMA -->
	<div class="modal fade" id="materia_prima" tabindex="-1" role="dialog" aria-labelledby="vehiculos" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="clientes">Nueva Materia Prima</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo route('post_mat_prima')?>" method="POST">
                        {{csrf_field()}}
						<div class="form-row">
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-droplet"></span></span>
									<input type="text" class="form-control" name="nombre" placeholder="NOMBRE" required>
								</div>
							</div>
                            
							<div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-stack"></span></span>
                                    <input type="text" class="form-control" name="cantidad"  placeholder="CANTIDAD" required>
                                </div>
                            </div>


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
									<input type="money" class="form-control" name="precio"  placeholder="PRECIO" required>
								</div>
							</div>
                        </div>
                        <div class="form-row">
                            
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-binoculars"></span></span>
                                    <textarea class="form-control" name="observacion" placeholder="OBSERVACIONES" row="5" required></textarea>
								</div>
							</div>
                        
                        </div>

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

@stop