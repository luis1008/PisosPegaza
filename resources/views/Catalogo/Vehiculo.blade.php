@extends('Template.Body')

@section('title','Captura Vehiculo')

@section('body')

    <a href="Caja" class="btn btn-danger">
		<span class="icon icon-exit"></span> Salir
	</a>

    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#vehiculo">
		<span class="icon icon-truck"></span> Nuevo
	</button>
    <br>
    <br>
    <div class="card text-black bg-light">
		<div class="card-header text-center text-white bg-danger"><b>VEHICULO</b></div>
        <table class="table table-hover table-sm text-center">
            <thead>
                <th class="text-center">Placas</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Caracteristicas</th>
                <th class="text-center">Opciones</th>
            </thead>
            <tbody>
                <?php if(count($vehiculos) < 1) { ?>
                    <tr>
                        <td colspan="4" class="text-center">NO SE ENCONTRO NINGÚN REGISTRO</td>
                    </tr>
                <?php } ?>
                <?php foreach ($vehiculos as $vh) { ?>
                    <tr class='<?php if($vh->vh_status){ echo "table-success"; } else { echo "table-danger"; } ?>'>
                        <td><?php echo $vh->placas ?></td>
                        <td><?php echo $vh->vh_nombre ?></td>
                        <td><?php echo $vh->vh_caracteristicas ?></td>
                        <td>
                            <a href="{{route('view_fallas',$vh->placas)}}" class="btn btn-dark btn-sm tooltips2" title="Historial de Fallas"><span class="icon icon-eye"></span></a>

                            <button type="button" class="btn btn-danger btn-sm tooltips2" title="Modificar" data-toggle="modal" data-target="#mod-<?php echo $vh->placas ?>"><span class="icon icon-pencil"></span></button>

                            <button type="button" class="btn btn-dark btn-sm tooltips2" title="Agregar Falla" data-toggle="modal" data-target="#falla-<?php echo $vh->placas ?>"><span class="icon icon-wrench"></span></button>
                            
                            <?php if($vh->vh_status){ ?>
                                <a href="<?php echo route('put_vehiculo', $vh->placas) ?>" class="btn btn-danger btn-sm tooltips2" title="Suspender"><span class="icon icon-arrow-down"></span></a>
                            <?php } else { ?>
                                <a href="<?php echo route('put_vehiculo', $vh->placas) ?>" class="btn btn-danger btn-sm tooltips2" title="Activar"><span class="icon icon-arrow-up"></span></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <!-- MODIFICAR VEHICULO -->
                    <div class="modal fade" id="mod-<?php echo $vh->placas ?>" tabindex="-1" role="dialog" aria-labelledby="clientes" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mod">Modificar Vehiculo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo route('put_datos_vehiculo',$vh->placas)?>" method="POST">
                                        <input type="hidden" value="PUT" name="_method"> 
                                        <input type="hidden" name="_token" value="<?php echo csrf_token()?>">
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-truck"></span></span>
                                                    <input type="text" class="form-control" name="placas" value="{{$vh->placas}}" placeholder="PLACAS" disabled>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-truck"></span></span>
                                                    <input type="text" class="form-control" name="nombre" value="{{$vh->vh_nombre}}" placeholder="NOMBRE" required>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-md-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-eye"></span></span>
                                                    <input type="text" class="form-control" name="caracteristicas" value="{{$vh->vh_caracteristicas}}" placeholder="CARACTERISTICAS">
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
                    <!-- AGREGAR FALLAS -->
                    <div class="modal fade" id="falla-<?php echo $vh->placas ?>" tabindex="-1" role="dialog" aria-labelledby="clientes" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mod">Agregar Falla del Vehículo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo route('add_fallas_vehiculo',$vh->placas)?>" method="POST">
                                        {{csrf_field()}}
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-location"></span></span>
                                                    <input type="text" class="form-control" name="lugar" placeholder="LUGAR REPARACION">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
                                                    <input type="number" class="form-control" name="costo" placeholder="COSTO REPARACION" required>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-md-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-wrench"></span></span>
                                                    <textarea name="descripcion" rows="5" class="form-control" placeholder="DESCRIPCION DE LA FALLA"></textarea>
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

    <!-- INSERTAR NUEVO VEHICULO -->
	<div class="modal fade" id="vehiculo" tabindex="-1" role="dialog" aria-labelledby="clientes" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="vehiculo">Nuevo Vehiculo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo route('post_vehiculo')?>" method="POST">
                        {{csrf_field()}}
						<div class="form-row">
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-truck"></span></span>
									<input type="text" class="form-control" name="placas" placeholder="PLACAS" required>
								</div>
							</div>
                            
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-truck"></span></span>
									<input type="text" class="form-control" name="nombre"  placeholder="NOMBRE" required>
								</div>
							</div>
                            
                            <div class="form-group col-md-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-eye"></span></span>
									<input type="text" class="form-control" name="caracteristicas"  placeholder="CARACTERISTICAS">
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
