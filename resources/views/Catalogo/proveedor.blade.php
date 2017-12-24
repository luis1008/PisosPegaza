@extends('Template.Body')

@section('title','Captura Proveedor')

@section('body')

    <a href="Caja" class="btn btn-danger">
		<span class="icon icon-exit"></span> Salir
	</a>

    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#proveedor">
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
            </thead>
            <tbody>
                <?php if(count($proveedores) < 1) { ?>
                    <tr>
                        <td colspan="5">NO SE ENCONTRO NINGÚN REGISTRO</td>
                    </tr>
                <?php } ?>
                <?php foreach ($proveedores as $prov) { ?>
                    <tr class='<?php if($prov->pv_status){ echo "table-success"; } else { echo "table-danger"; } ?>'>
                        <th><?php echo str_pad($prov->id_proveedor, 2, "0", STR_PAD_LEFT) ?></th>
                        <td><?php echo $prov->pv_nombre ?></td>
                        <td><?php echo $prov->pv_domicilio ?></td>
                        <td><?php echo $prov->pv_correo ?></td>
                        <td>
                            <button type="button" class="btn btn-dark btn-sm tooltips2" title="Agregar/Eliminar Contactos" data-toggle="modal" data-target="#contacto-<?php echo $prov->id_proveedor ?>"><span class="icon icon-phone"></span></button>

                            <button type="button" class="btn btn-danger btn-sm tooltips2" title="Modificar" data-toggle="modal" data-target="#mod-<?php echo $prov->id_proveedor ?>"><span class="icon icon-pencil"></span></button>

                            <button type="button" class="btn btn-dark btn-sm tooltips2" title="Información" data-toggle="modal" data-target="#info-<?php echo $prov->id_proveedor ?>"><span class="icon icon-info"></span></button>
                            
                            <?php if($prov->pv_status){ ?>
                                <a href="<?php echo route('put_proveedor',$prov->id_proveedor) ?>" class="btn btn-danger btn-sm tooltips2" title="Suspender"><span class="icon icon-arrow-down"></span></a>
                            <?php } else { ?>
                                <a href="<?php echo route('put_proveedor',$prov->id_proveedor) ?>" class="btn btn-danger btn-sm tooltips2" title="Activar"><span class="icon icon-arrow-up"></span></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <!-- INFORMACION PROVEEDOR -->
                    <div class="modal fade" id="info-<?php echo $prov->id_proveedor ?>" tabindex="-1" role="dialog" aria-labelledby="infos" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="infos">Información</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Datos Generales</b></div>
                                    <div class="form-row">
                                        <div class="col">
                                            <label>RFC:</label>
                                            <p>{{$prov->pv_rfc}}</p>
                                        </div>
                                        <div class="col">
                                            <label>Ciudad:</label>
                                            <p>{{$prov->pv_ciudad}}</p>
                                        </div>
                                    </div>
                                    <div class="col text-center bg-dark text-white" style="font-size:20px;"><b>Contactos</b></div>
                                    <?php foreach($prov->contactos as $cont) { ?>
                                        @if($cont->cn_status)
                                            <p><?php echo "<b>Contacto: </b>" . $cont->cn_nombre . " <br><b>Telefono: </b>" . $cont->cn_telefono ?></p>
                                        @endif
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

                    <!-- AGREGAR/ELIMINAR CONTACTOS -->
                    <div class="modal fade" id="contacto-<?php echo $prov->id_proveedor ?>" tabindex="-1" role="dialog" aria-labelledby="clientes" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="clientes">Contactos</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Eliminación Contactos</b></div>
                                    </div>
                                    <p><b>Si solo desea eliminar un contacto, presione el botón "<span class="icon icon-bin"></span>" correspondiente (Es importante que al eliminar el Contacto no habrá forma de recuperarlo).</b></p>
                                    @foreach($prov->contactos as $contacto)
                                        @if($contacto->cn_status)
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <div class="input-group">
                                                        <input type="text" value="{{'Nombre: ' . $contacto->cn_nombre . ' - Tel: ' . $contacto->cn_telefono }}" class="form-control form-control-sm" disabled>
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-sm btn-danger BtnEliminarContacto" value="{{$contacto->id_contacto}}"><span class="icon icon-bin"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="form-row">
                                        <div class="col text-center bg-dark text-white" style="font-size:20px;"><b>Nuevo Contacto</b></div>
                                    </div>
                                    <br>
                                    <form action="<?php echo route('add_contacto_proveedor',$prov->id_proveedor)?>" method="POST">
                                        {{csrf_field()}}
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-user-tie"></span></span>
                                                    <input class="form-control" name="contacto" type="text" placeholder="NOMBRE CONTACTO" required>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-phone"></span></span>
                                                    <input class="form-control Numeros" maxlength="13" name="telefono" type="text" placeholder="TELEFONO" required>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="reset"  class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button> 
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
                                            <button type="submit" class="btn btn-dark"><span class="icon icon-floppy-disk"></span> Guardar Nuevo Contacto</button>
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

                        <div class="AddContacto"></div>

                        <div class="form-row">
                            <div class="form-group col-md-12 text-center">
                                <button type="button" class="btn btn-dark btn-sm btn-contacto"><span class="icon icon-plus"></span><b>Contacto</b></button>
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

@section('js')
    <script>
        $(document).ready(function(){
            $('.btn-contacto').click(function(){
                var formulario = "";
                formulario +=   '<div class="form-row">'+
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
                                    '<div class="form-group col-md-1">'+
                                        '<button type="button" class="btn btn-danger btn-delete"><span class="icon icon-bin2"></span></button>'+
                                    '</div>'+
                                '</div>';
                $('.AddContacto').append(formulario);
            });

            $(document).on('click','.btn-delete', function(){
                $(this).parent('div.form-group').parent('div.form-row').remove();
            });

            $('.BtnEliminarContacto').click(function(){
                var confirmacion = confirm('Esta Realmente Seguro?'), valor = $(this).val();
                if (!confirmacion) {return false}
                $.get('/SetEliminacionContactoProveedor',{id:valor}).done(function(response){
                    if (response === "OK") {
                        alert("Se elimino correctamente")
                    }
                });
                $(this).parent('div').parent('div').parent('div').parent('div').fadeOut();
            });
        });
    </script>
@stop