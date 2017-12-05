@extends('Template.Body')

@section('title','Captura Cliente')

@section('body')

    <a href="Caja" class="btn btn-danger">
		<span class="icon icon-exit"></span> Salir
	</a>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cliente">
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
                <th></th>
            </thead>
            <tbody>
                <?php if(count($clientes) < 1) { ?>
                    <tr>
                        <td colspan="6">NO SE ENCONTRO NINGUN REGISTRO</td>
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
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mod-<?php echo $cl->id_cliente ?>"><span class="icon icon-spinner10"></span></button>

                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#info-<?php echo $cl->id_cliente ?>"><span class="icon icon-eye"></span></button>

                            <form action="<?php echo route('put_cliente') ?>" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                                <input type="hidden" name="cliente" value="<?php echo $cl->id_cliente ?>">
                                <?php if($cl->cl_status){ ?>
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" class="btn btn-danger btn-sm"><span class="icon icon-arrow-down"></span>
                                <?php } else { ?>
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-success btn-sm"><span class="icon icon-arrow-up"></span>
                                <?php } ?>
                            </form>
                        </td>
                    </tr>
                    <!-- INFORMACION CLIENTE -->
                    <div class="modal fade" id="info-<?php echo $cl->id_cliente ?>" tabindex="-1" role="dialog" aria-labelledby="infos" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="infos">Informacion de <?php echo $cl->cl_nombre ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><b>Dueño: </b><?php echo $cl->cl_nombre_dueno ?></p>
                                    <p><b>Contacto: </b><?php echo $cl->cl_nombre_contacto ?></p>
                                    <p><b>RFC: </b><?php echo $cl->cl_rfc ?></p>
                                    <p><b>Termino Credito: </b><?php echo $cl->cl_termino_credito ?></p>
                                    <p><b>Domicilio(s): </b></p>
                                    <?php foreach($cl->domicilios as $dom) { ?>

                                        <p><?php echo $dom->dom_calle . ", " . $dom->dom_colonia . " - " . $dom->dom_codigo_postal ?></p>
                                        <?php } ?>

                                        <p><?php echo "<b>CALLE:</b> " . $dom->dom_calle . ", <b>COLONIA:</b> " . $dom->dom_colonia . ", <b>CIUDAD:</b> " . $dom->dom_ciudad . " - <b>CODIGO POSTAL:</b> " . $dom->dom_codigo_postal ?></p>

                                    <p><b>Observaciones: </b><?php echo $cl->cl_observacion ?></p>
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
                                                    <select class="form-control" name="tipo" required>
                                                        <option value="">TIPO CLIENTE</option>
                                                        <option value="NORMAL">NORMAL</option>
                                                        <option value="RIGUROSO">RIGUROSO</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-clock"></span></span>
                                                    <select class="form-control" name="termino" required>
                                                        <option value="">TERMINO CREDITO</option>
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
                                                <div class="form-group col-md-4">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="icon icon-location"></span></span>
                                                        <input class="form-control" value="<?php echo $dom->dom_calle ?>" name="calle[]" type="text" required>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="icon icon-location"></span></span>
                                                        <input class="form-control" value="<?php echo $dom->dom_colonia ?>" name="colonia[]" required>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="icon icon-office"></span></span>
                                                        <input class="form-control" value="<?php echo $dom->dom_ciudad ?>" name="ciudad[]" type="text" required>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="icon icon-location"></span></span>
                                                        <input class="form-control" value="<?php echo $dom->dom_codigo_postal ?>" name="codigo_postal[]" type="text"  required>
                                                    </div>
                                                </div>
                                            </div>

                                             <div class="form-row AddDomicilio"></div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12 text-center">
                                                    <button type="button" class="btn btn-primary btn-sm btn-domicilio"><span class="icon icon-plus"></span><b>Domicilio</b></button>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="icon icon-binoculars"></span></span>
                                                        <textarea class="form-control" row="8" name="observaciones" placeholder="OBSERVACIONES"></textarea>
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

    <!-- INSERTAR NUEVO CLIENTE -->
	<div class="modal fade" id="cliente" tabindex="-1" role="dialog" aria-labelledby="clientes" aria-hidden="true">
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
                                    <input type="text" class="form-control" name="nombre" placeholder="NOMBRE" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                    <input type="text" class="form-control" name="rfc"  placeholder="RFC" required>
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
                                    <span class="input-group-addon"><span class="icon icon-phone"></span></span>
                                    <input type="text" class="form-control" name="telefono"  placeholder="TELEFONO" required>
                                </div>
                            </div>

                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-bubble"></span></span>
                                    <input type="text" class="form-control" name="nombre_contacto"  placeholder="NOMBRE DEL CONTACTO" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-user-tie"></span></span>
                                    <input type="text" class="form-control" name="nombre_dueno"  placeholder="NOMBRE DEL DUEÑO" required>
                                </div>
                            </div>

                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-credit-card"></span></span>
                                    <select class="form-control" name="forma_pago" required>
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
                                    <select class="form-control" name="tipo" required>
                                        <option value="">TIPO CLIENTE</option>
                                        <option value="NORMAL">NORMAL</option>
                                        <option value="RIGUROSO">RIGUROSO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-clock"></span></span>
                                    <select class="form-control" name="termino" required>
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
                                    <input class="form-control" name="calle[]" type="text" placeholder="CALLE" required>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-location"></span></span>
                                    <input class="form-control" name="colonia[]" type="text" placeholder="COLONIA" required>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-office"></span></span>
                                    <input class="form-control" name="ciudad[]" type="text" placeholder="CIUDAD" required>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-location"></span></span>
                                    <input class="form-control" name="codigo_postal[]" type="text" placeholder="C.P" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row AddDomicilio"></div>

                        <div class="form-row">
                            <div class="form-group col-md-12 text-center">
                                <button type="button" class="btn btn-primary btn-sm btn-domicilio"><span class="icon icon-plus"></span><b>Domicilio</b></button>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-binoculars"></span></span>
                                    <textarea class="form-control" row="8" name="observaciones" placeholder="OBSERVACIONES"></textarea>
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
        });
    </script>
@stop