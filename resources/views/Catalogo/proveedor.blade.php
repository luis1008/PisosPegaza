@extends('Template.Body')

@section('title','Captura Proveedor')

@section('body')

    <a href="Caja" class="btn btn-danger">
		<span class="icon icon-exit"></span> Salir
	</a>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#proveedor">
		<span class="icon icon-user-plus"></span> Nuevo
	</button>
    <br>
    <br>
    <div class="card text-black bg-light">
		<div class="card-header text-center text-white bg-danger"><b>PROVEEDORES</b></div>
        <table class="table table-hover table-sm">
            <thead>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Domicilio</th>
                <th>Correo</th>
                <th>Opciones</th>
                <th></th>
            </thead>
            <tbody>
                <?php if(count($proveedores) < 1) { ?>
                    <tr>
                        <td colspan="6">NO SE ENCONTRO NINGUN REGISTRO</td>
                    </tr>
                <?php } ?>
                <?php foreach ($proveedores as $prov) { ?>
                    <tr class='<?php if($prov->pv_status){ echo "table-success"; } else { echo "table-danger"; } ?>'>
                        <th><?php echo str_pad($prov->id_proveedor, 2, "0", STR_PAD_LEFT) ?></th>
                        <td><?php echo $prov->pv_nombre ?></td>
                        <td><?php echo $prov->pv_domicilio ?></td>
                        <td><?php echo $prov->pv_correo ?></td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mod-<?php echo $prov->id_proveedor ?>"><span class="icon icon-spinner10"></span></button>

                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#info-<?php echo $prov->id_proveedor ?>"><span class="icon icon-eye"></span></button>

                            <form action="<?php echo route('put_proveedor') ?>" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                                <input type="hidden" name="proveedor" value="<?php echo $prov->id_proveedor ?>">
                                <?php if($prov->pv_status){ ?>
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" class="btn btn-danger btn-sm"><span class="icon icon-arrow-down"></span>
                                <?php } else { ?>
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-success btn-sm"><span class="icon icon-arrow-up"></span>
                                <?php } ?>
                            </form>
                        </td>
                    </tr>
                    <!-- INFORMACION PROVEEDOR -->
                    <div class="modal fade" id="info-<?php echo $prov->id_proveedor ?>" tabindex="-1" role="dialog" aria-labelledby="infos" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="infos">Informacion de <?php echo $prov->pv_nombre ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><b>Contacto(s): </b></p>
                                    <?php foreach($prov->contactos as $cont) { ?>
                                        <p><?php echo "<b>Contacto: </b>" . $cont->cn_nombre . " <br><b>Telefono: </b>" . $cont->cn_telefono . "<hr>"?></p>
                                     <?php } ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODIFICAR PROVEEDOR -->
                    <div class="modal fade" id="mod-<?php echo $prov->id_proveedor ?>" tabindex="-1" role="dialog" aria-labelledby="proveedores" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="proveedores">Modificar Proveedor</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo route('put_datos_proveedor',$prov->id_proveedor)?>" method="POST">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token()?>">

                                        <div class="form-row">                            
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-mail4"></span></span>
                                                    <input type="email" class="form-control" name="correo"  placeholder="CORREO" value="<?php echo $prov->pv_correo ?>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-location"></span></span>
                                                    <input type="text" class="form-control" name="domicilio"  placeholder="DOMICILIO" value="<?php echo $prov->pv_domicilio ?>"  required>
                                                </div>
                                            </div>
                                        </div>  
                                        
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-location"></span></span>
                                                    <input type="text" class="form-control" name="ciudad"  placeholder="CIUDAD" value="<?php echo $prov->pv_ciudad ?>"  required>
                                                </div>
                                            </div>
                                        </div>    

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-user-tie"></span></span>
                                                    <input class="form-control" name="contacto[]" type="text" placeholder="NOMBRE DEL CONTACTO" value="<?php echo $cont->cn_nombre ?>"  required>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-phone"></span></span>
                                                    <input class="form-control" name="telefono[]" type="text" placeholder="TELEFONO" value="<?php echo $cont->cn_telefono ?>"  required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row col-md-12 AddContacto"></div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12 text-center">
                                                <button type="button" class="btn btn-primary btn-sm btn-contacto"><span class="icon icon-plus"></span><b>Contacto</b></button>
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

    <!-- INSERTAR NUEVO PROVEEDOR -->
	<div class="modal fade" id="proveedor" tabindex="-1" role="dialog" aria-labelledby="proveedores" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="proveedores">Nuevo Proveedor</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo route('post_proveedor')?>" method="POST">
                        {{csrf_field()}}
						<div class="form-row">
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-user"></span></span>
									<input type="text" class="form-control" name="nombre" placeholder="NOMBRE" required>
								</div>
							</div>
                            
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-mail4"></span></span>
									<input type="email" class="form-control" name="correo"  placeholder="CORREO" required>
								</div>
							</div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-location"></span></span>
									<input type="text" class="form-control" name="domicilio"  placeholder="DOMICILIO" required>
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
                                    <input class="form-control" name="contacto[]" type="text" placeholder="NOMBRE DEL CONTACTO" required>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-phone"></span></span>
                                    <input class="form-control" name="telefono[]" type="text" placeholder="TELEFONO" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row col-md-12 AddContacto"></div>

                        <div class="form-row">
                            <div class="form-group col-md-12 text-center">
                                <button type="button" class="btn btn-primary btn-sm btn-contacto"><span class="icon icon-plus"></span><b>Contacto</b></button>
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
    <script>
        $(document).ready(function(){
            $('.btn-contacto').click(function(){
                var formulario = "";
                formulario +=   '<div class="form-row">'+
                                    '<div class="form-group col-md-1">'+
                                        '<button type="button" class="btn btn-danger btn-delete"><span class="icon icon-bin2"></span></button>'+
                                    '</div>'+
                                    '<div class="form-group col">'+
                                        '<div class="input-group">'+
                                            '<span class="input-group-addon"><span class="icon icon-user-tie"></span></span>'+
                                            '<input class="form-control" name="contacto[]" type="text" placeholder="NOMBRE DEL CONTACTO" required>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group col">'+
                                        '<div class="input-group">'+
                                            '<span class="input-group-addon"><span class="icon icon-phone"></span></span>'+
                                            '<input class="form-control" name="telefono[]" type="text" placeholder="TELEFONO" required>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                $('.AddContacto').append(formulario);
            });

            $(document).on('click','.btn-delete', function(){
                $(this).parent('div.form-group').parent('div.form-row').remove();
            });
        });
    </script>
@stop