@extends('Template.Body')

@section('title','Captura Materia Prima')

@section('body')

    <a href="Caja" class="btn btn-danger">
		<span class="icon icon-exit"></span> Salir
	</a>

    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#materia_prima">
		<span class="icon icon-droplet"></span> Nuevo
	</button>
    <br>
    <br>
    <div class="card text-black bg-light">
		<div class="card-header text-center text-white bg-danger"><b>MATERIA PRIMA</b></div>
        <table class="table table-hover table-sm">
            <thead>
                <th width="50" class="text-center">Clave</th>
                <th width="100">Nombre</th>
                <th width="100">Contenido</th>
                <th width="50">Unidad</th>
                <th width="50">Precio</th>
                <th width="100">Observación</th>
                <th width="50">Opciones</th>
            </thead>
            <tbody>
                <?php if(count($mat_primas) < 1) { ?>
                    <tr>
                        <td colspan="5">NO SE ENCONTRO NINGÚN REGISTRO</td>
                    </tr>
                <?php } ?>
                <?php foreach ($mat_primas as $mp) { ?>
                    <tr class='<?php if($mp->mp_status){ echo "table-success"; } else { echo "table-danger"; } ?>'>
                        <th class="text-center"><?php echo str_pad($mp->id_materia_prima, 2, "0", STR_PAD_LEFT) ?></th>
                        <td><?php echo $mp->mp_nombre?></td>
                        <td><?php echo $mp->mp_cantidad ?></td>
                        <td><?php echo $mp->mp_unidad ?></td>
                        <td>$<?php echo number_format($mp->mp_precio,2) ?></td>
                        <td><?php echo $mp->mp_observacion ?></td>
                        <td>
                            <button type="button" class="btn btn-dark btn-sm tooltips2" title="Modificar" data-toggle="modal" data-target="#mo-{{$mp->id_materia_prima}}"><span class="icon icon-pencil"></span></button>

                            <?php if($mp->mp_status){ ?>
                                <a href="{{route('put_mat_prima',$mp->id_materia_prima)}}" class="btn btn-danger btn-sm tooltips2" title="Suspender"><span class="icon icon-arrow-down"></span></a>
                            <?php } else { ?>
                                <a href="{{route('put_mat_prima',$mp->id_materia_prima)}}" class="btn btn-danger btn-sm tooltips2" title="Activar"><span class="icon icon-arrow-up"></span></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <!-- MODIFICAR MATERIA PRIMA -->
                    <div class="modal fade" id="mo-{{$mp->id_materia_prima}}" tabindex="-1" role="dialog" aria-labelledby="vehiculos" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="clientes">Modificar Materia Prima</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo route('put_datos_mat_prima',$mp->id_materia_prima)?>" method="POST">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-droplet"></span></span>
                                                    <input type="text" class="form-control" name="nombre" value="{{$mp->mp_nombre}}" placeholder="NOMBRE" required>
                                                </div>
                                            </div>
                                            
                                            <!--<div class="form-group col-md-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-stack"></span></span>
                                                    <input type="number" class="form-control" step="0.01" min="0.1" name="cantidad" value="{{$mp->mp_cantidad}}" placeholder="CANTIDAD" required>
                                                </div>
                                            </div>-->

                                            <div class="form-row">
                                                    <div class="form-group col">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                                            <select class="form-control select-tipo" required name="unidad">
                                                                <option value="{{$mp->mp_unidad}}" hidden selected>{{$mp->mp_unidad}}</option>
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
                                                    <input type="number" class="form-control" step="0.01" min="0.1" name="precio" value="{{$mp->mp_precio}}" placeholder="PRECIO" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-binoculars"></span></span>
                                                    <textarea class="form-control" name="observacion" placeholder="OBSERVACIONES" row="5" required>{{$mp->mp_observacion}}</textarea>
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
                                    <input type="number" class="form-control" name="cantidad" min="0.1" step="0.001" placeholder="CONTENIDO" required>
                                </div>
                            </div>
                            
                            <!--<input type="hidden" name="cantidad" value="1">-->

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
                                    <textarea class="form-control" name="observacion" placeholder="OBSERVACIONES" row="5">NINGUNA OBSERVACIÓN.</textarea>
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
@stop