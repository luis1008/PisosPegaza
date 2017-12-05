@extends('Template.Body')

@section('title','Captura Vehiculo')

@section('body')

    <a href="Caja" class="btn btn-danger">
		<span class="icon icon-exit"></span> Salir
	</a>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#vehiculo">
		<span class="icon icon-user-plus"></span> Nuevo
	</button>
    <br>
    <br>
    <div class="card text-black bg-light">
		<div class="card-header text-center text-white bg-danger"><b>VEHICULO</b></div>
        <table class="table table-hover table-sm">
            <thead>
                <th>Placas</th>
                <th>Nombre</th>
                <th>Caracteristicas</th>
                <th>Falla</th>
                <th>Opciones</th>
                <th></th>
            </thead>
            <tbody>
                <?php if(count($vehiculos) < 1) { ?>
                    <tr>
                        <td colspan="6">NO SE ENCONTRO NINGUN REGISTRO</td>
                    </tr>
                <?php } ?>
                <?php foreach ($vehiculos as $vh) { ?>
                    <tr class='<?php if($vh->vh_status){ echo "table-success"; } else { echo "table-danger"; } ?>'>
                        <td><?php echo $vh->placas ?></td>
                        <td><?php echo $vh->vh_nombre ?></td>
                        <td><?php echo $vh->vh_caracteristicas ?></td>
                        <td><?php echo $vh->vh_falla ?></td>
                        <td>
                             <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mod-<?php echo $vh->placas ?>"><span class="icon icon-spinner10"></span></button>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#info-<?php echo $vh->placas ?>"><span class="icon icon-eye"></span></button>
                            <form action="<?php echo route('put_vehiculo') ?>" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                                <input type="hidden" name="vehiculo" value="<?php echo $vh->placas ?>">
                                <?php if($vh->vh_status){ ?>
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" class="btn btn-danger btn-sm"><span class="icon icon-arrow-down"></span>
                                <?php } else { ?>
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-success btn-sm"><span class="icon icon-arrow-up"></span>
                                <?php } ?>
                            </form>
                        </td>
                    </tr>
                    <!-- INFORMACION VEHICULO -->
                    <div class="modal fade" id="info-<?php echo $vh->placas ?>" tabindex="-1" role="dialog" aria-labelledby="infos" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="infos">Informacion de <?php echo $vh->vh_nombre ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><b>Nombre: </b><?php echo $vh->vh_nombre ?></p>
                                    <p><b>Caracteristicas: </b><?php echo $vh->vh_caracteristicas ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <form action="<?php echo route('post_datos_vehiculo')?>" method="POST">
                                        {{csrf_field()}}
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-wrench"></span></span>
                                                    <input type="text" class="form-control" name="placas" value="<?php echo $vh->placas ?>" required readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-wrench"></span></span>
                                                    <input type="text" class="form-control" name="descripcion"  placeholder="FALLA" required>
                                                </div>
                                            </div>

                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-location2"></span></span>
                                                    <input type="text" class="form-control" name="lugar"  placeholder="LUGAR" required>
                                                </div>
                                            </div>

                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
                                                    <input type="text" class="form-control" name="costo"  placeholder="COSTO" required>
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
									<span class="input-group-addon"><span class="icon icon-newspaper"></span></span>
									<input type="text" class="form-control" name="placas" placeholder="PLACAS" required>
								</div>
							</div>
                            
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-truck"></span></span>
									<input type="text" class="form-control" name="nombre"  placeholder="NOMBRE" required>
								</div>
							</div>
                            
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-hammer"></span></span>
									<input type="text" class="form-control" name="caracteristicas"  placeholder="CARACTERISTICAS" required>
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