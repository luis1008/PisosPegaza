@extends('Template.Body')

@section('title','Captura Cliente')

@section('body')

    <a href="Caja" class="btn btn-danger">
		<span class="icon icon-exit"></span> Salir
	</a>

    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#cliente">
		<span class="icon icon-user-plus"></span> Nuevo
	</button>
    <br>
    <br>
    <div class="card text-black bg-light">
		<div class="card-header text-center text-white bg-danger"><b>CLIENTES</b></div>
        <table class="table table-hover table-sm">
            <thead>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Forma Pago</th>
                <th>Tipo Cliente</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <?php if(count($clientes) < 1) { ?>
                    <tr>
                        <td colspan="6">NO SE ENCONTRO NINGÚN REGISTRO</td>
                    </tr>
                <?php } ?>
                <?php foreach ($clientes as $cl) { ?>
                    <tr class='<?php if($cl->cl_status){ echo "table-success"; } else { echo "table-danger"; } ?>'>
                        <td><?php echo $cl->cl_nombre ?></td>
                        <td><?php echo $cl->cl_correo ?></td>
                        <td><?php echo $cl->cl_telefono ?></td>
                        <td><?php echo $cl->cl_forma_pago ?></td>
                        <td><?php echo $cl->cl_tipo_cliente ?></td>
                        <td>
                            <!-- BOTON DE MODIFICAR CLIENTE -->
                            <button type="button" class="btn btn-dark btn-sm tooltips2" title="Agregar/Eliminar Domicilios" data-toggle="modal" data-target="#location-<?php echo $cl->id_cliente ?>"><span class="icon icon-location"></span></button>

                            <button type="button" class="btn btn-danger btn-sm tooltips2" title="Modificar" data-toggle="modal" data-target="#mod-<?php echo $cl->id_cliente ?>"><span class="icon icon-pencil"></span></button>

                            <button type="button" class="btn btn-dark btn-sm tooltips2" title="Información" data-toggle="modal" data-target="#info-<?php echo $cl->id_cliente ?>"><span class="icon icon-info"></span></button>
                            
                            <?php if($cl->cl_status){ ?>
                                <a href="<?php echo route('put_cliente', $cl->id_cliente) ?>" class="btn btn-danger btn-sm tooltips2" title="Suspender"><span class="icon icon-arrow-down"></span></a>
                            <?php } else { ?>
                                <a href="<?php echo route('put_cliente', $cl->id_cliente) ?>" class="btn btn-danger btn-sm tooltips2" title="Activar"><span class="icon icon-arrow-up"></span></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <!-- INFORMACION CLIENTE -->
                    <div class="modal fade" id="info-<?php echo $cl->id_cliente ?>" tabindex="-1" role="dialog" aria-labelledby="infos" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="infos">Información</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Datos Generales</b></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <label>Dueño:</label>
                                            <p><?php echo $cl->cl_nombre_dueno ?></p>
                                        </div>
                                        <div class="col">
                                            <label>RFC:</label>
                                            <p><?php echo $cl->cl_rfc ?></p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <label>Contacto:</label>
                                            <p><?php echo $cl->cl_nombre_contacto ?></p>
                                        </div>
                                        <div class="col">
                                            <label>Termino Credito:</label>
                                            <p><?php echo $cl->cl_termino_credito ?></p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <label>Observaciones:</label>
                                            <p><?php echo $cl->cl_observacion ?></p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col text-center bg-dark text-white" style="font-size:20px;"><b>Domicilio(s)</b></div>
                                    </div>
                                    @foreach($cl->domicilios as $dom)
                                        @if($dom->dom_status)
                                            <li><?php echo $dom->dom_calle . ", " . $dom->dom_colonia . " - " . $dom->dom_codigo_postal . " - " . $dom->dom_ciudad ?></li>
                                        @endif
                                    @endforeach

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODIFICAR CLIENTE -->
                    <div class="modal fade" id="mod-<?php echo $cl->id_cliente ?>" tabindex="-1" role="dialog" aria-labelledby="clientes" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="clientes">Modificar Cliente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo route('put_datos_cliente',$cl->id_cliente)?>" method="POST">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token()?>">

                                        <div class="form-row">                      
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-mail4"></span></span>
                                                    <input type="email" value="<?php echo $cl->cl_correo ?>" class="form-control" name="correo" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-phone"></span></span>
                                                    <input type="text" value="<?php echo $cl->cl_telefono ?>" class="form-control" name="telefono" required>
                                                </div>
                                            </div>

                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-bubble"></span></span>
                                                    <input type="text" value="<?php echo $cl->cl_nombre_contacto ?>" class="form-control" name="nombre_contacto" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-credit-card"></span></span>
                                                    <select class="form-control" name="forma_pago" required>
                                                        <option value="{{$cl->cl_forma_pago}}" hidden selected>{{$cl->cl_forma_pago}}</option>
                                                        <!-- <option value="">FORMA DE PAGO</option> -->
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
                                                    <select class="form-control" name="tipo" required>
                                                        <option value="{{$cl->cl_tipo_cliente}}" hidden selected>{{$cl->cl_tipo_cliente}}</option>
                                                        <!-- <option value="">TIPO CLIENTE</option> -->
                                                        <option value="NORMAL">NORMAL</option>
                                                        <option value="RIGUROSO">RIGUROSO</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-clock"></span></span>
                                                    <select class="form-control" name="termino" required>
                                                        <option value="{{$cl->cl_termino_credito}}" hidden selected>{{$cl->cl_termino_credito}}</option>
                                                        <!-- <option value="">TERMINO CREDITO</option> -->
                                                        <option value="NINGUNO">NINGUNO</option>
                                                        <option value="1 SEMANA">1 SEMANA</option>
                                                        <option value="15 DIAS">15 DIAS</option>
                                                        <option value="1 MES">1 MES</option>
                                                        <option value="2 MESES">2 MESES</option>
                                                        <option value="6 MESES">6 MESES</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-binoculars"></span></span>
                                                    <textarea class="form-control" row="8" name="observaciones" placeholder="OBSERVACIONES"></textarea>
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

                    <!-- AGREGAR/ELIMINAR DOMICILIOS -->
                    <div class="modal fade" id="location-<?php echo $cl->id_cliente ?>" tabindex="-1" role="dialog" aria-labelledby="clientes" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="clientes">Domicilios</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Eliminación Domicilios</b></div>
                                    </div>
                                    <p><b>Si solo desea eliminar un domicilio, presione el botón "<span class="icon icon-bin"></span>" correspondiente (Es importante que al eliminar el Domicilio no habrá forma de recuperarlo).</b></p>
                                    @foreach($cl->domicilios as $domicilio)
                                        @if($domicilio->dom_status)
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <div class="input-group">
                                                        <input type="text" value="{{$domicilio->dom_calle . ', ' . $domicilio->dom_colonia . ', ' . $domicilio->dom_ciudad . ' - ' . $domicilio->dom_codigo_postal}}" class="form-control form-control-sm" disabled>
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-sm btn-danger BtnEliminarDomicilio" value="{{$domicilio->id_domicilio}}"><span class="icon icon-bin"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="form-row">
                                        <div class="col text-center bg-dark text-white" style="font-size:20px;"><b>Nuevo Domicilio</b></div>
                                    </div>
                                    <br>
                                    <form action="<?php echo route('add_domicilio_cliente',$cl->id_cliente)?>" method="POST">
                                        {{csrf_field()}}
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-location"></span></span>
                                                    <input class="form-control" name="calle" type="text" placeholder="CALLE" required>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-location"></span></span>
                                                    <input class="form-control" name="colonia" type="text" placeholder="COLONIA" required>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-office"></span></span>
                                                    <input class="form-control" name="ciudad" type="text" placeholder="CIUDAD" required>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-location"></span></span>
                                                    <input class="form-control Numeros" name="codigo_postal" type="text" placeholder="C.P" maxlength="5" required>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="reset"  class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button> 
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
                                            <button type="submit" class="btn btn-dark"><span class="icon icon-floppy-disk"></span> Guardar Nuevo Domicilio</button>
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

    <!-- INSERTAR NUEVO CLIENTE -->
	<div class="modal fade" id="cliente" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="clientes" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="clientes">Nuevo Cliente</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo route('post_cliente')?>" method="POST">
                        {{csrf_field()}}

                        <div class="form-row">                            
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-user"></span></span>
                                    <input type="text" class="form-control" name="nombre" placeholder="NOMBRE">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                    <input type="text" class="form-control" name="rfc"  placeholder="RFC">
                                </div>
                            </div>
                            
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-mail4"></span></span>
                                    <input type="email" class="form-control" name="correo"  placeholder="CORREO">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-phone"></span></span>
                                    <input type="text" class="form-control Numeros" name="telefono" maxlength="13" placeholder="TELEFONO">
                                </div>
                            </div>

                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-bubble"></span></span>
                                    <input type="text" class="form-control" name="nombre_contacto"  placeholder="NOMBRE DEL CONTACTO">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-user-tie"></span></span>
                                    <input type="text" class="form-control" name="nombre_dueno" placeholder="NOMBRE DEL DUEÑO">
                                </div>
                            </div>

                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-credit-card"></span></span>
                                    <select class="form-control" name="forma_pago">
                                        <option value="">FORMA DE PAGO</option>
                                        <option value="EFECTIVO">EFECTIVO</option>
                                        <option value="CHEQUE">CHEQUE</option>
                                        <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                        <option value="DEPOSITO">DEPOSITO</option>
                                        <option value="NO ESPECIFICA">NO ESPECIFICA</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-accessibility"></span></span>
                                    <select class="form-control" name="tipo">
                                        <option value="">TIPO CLIENTE</option>
                                        <option value="NORMAL">NORMAL</option>
                                        <option value="RIGUROSO">RIGUROSO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-clock"></span></span>
                                    <select class="form-control" name="termino">
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
                                    <input class="form-control" name="calle[]" type="text" placeholder="CALLE">
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-location"></span></span>
                                    <input class="form-control" name="colonia[]" type="text" placeholder="COLONIA">
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-office"></span></span>
                                    <input class="form-control" name="ciudad[]" type="text" placeholder="CIUDAD">
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-location"></span></span>
                                    <input class="form-control Numeros" name="codigo_postal[]" type="text" placeholder="C.P" maxlength="5">
                                </div>
                            </div>

                        </div>

                        <div class="form-row AddDomicilio"></div>

                        <div class="form-row">
                            <div class="form-group col-md-12 text-center">
                                <button type="button" class="btn btn-dark btn-sm btn-domicilio"><span class="icon icon-plus"></span> <b>Domicilio</b></button>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-binoculars"></span></span>
                                    <textarea class="form-control" row="8" name="observaciones" placeholder="OBSERVACIONES">NO HAY OBSERVACIONES</textarea>
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

            $('.btn-domicilio').click(function(){
                var formulario = "";
                formulario +=   '<div class="form-row">'+
                                    '<div class="form-group col-md-3">'+
                                    '<div class="input-group">'+
                                        '<span class="input-group-addon"><span class="icon icon-location"></span></span>'+
                                        '<input class="form-control" name="calle[]" type="text" placeholder="CALLE" required>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="form-group col-md-3">'+
                                        '<div class="input-group">'+
                                            '<span class="input-group-addon"><span class="icon icon-location"></span></span>'+
                                            '<input class="form-control" name="colonia[]" type="text" placeholder="COLONIA" required>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group col-md-3">'+
                                        '<div class="input-group">'+
                                            '<span class="input-group-addon"><span class="icon icon-office"></span></span>'+
                                            '<input class="form-control" name="ciudad[]" type="text" placeholder="CIUDAD" required>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group col-md-2">'+
                                        '<div class="input-group">'+
                                            '<span class="input-group-addon"><span class="icon icon-location"></span></span>'+
                                            '<input class="form-control" name="codigo_postal[]" type="text" placeholder="C.P." required>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="form-group col-md-1">'+
                                        '<button type="button" class="btn btn-danger btn-delete"><span class="icon icon-bin2"></span></button>'+
                                    '</div>'+
                                '</div>';
                $('.AddDomicilio').append(formulario);
            });

            $(document).on('click','.btn-delete', function(){
                $(this).parent('div.form-group').parent('div.form-row').remove();
            });

            $('.BtnEliminarDomicilio').click(function(){
                var confirmacion = confirm('Esta Realmente Seguro?'), valor = $(this).val();
                if (!confirmacion) {return false}
                $.get('/SetEliminacionDomicilioCliente',{id:valor}).done(function(response){
                    if (response === "OK") {
                        alert("Se elimino correctamente")
                    }
                });
                $(this).parent('div').parent('div').parent('div').parent('div').fadeOut();
            });
        });
    </script>
@stop