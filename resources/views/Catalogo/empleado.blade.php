@extends('Template.Body')

@section('title','Captura Empleado')

@section('style')
    <style>
        label{
            font-weight:bold;
        }
    </style>
@stop

@section('body')

    <a href="Caja" class="btn btn-danger">
		<span class="icon icon-exit"></span> Salir
	</a>

    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#empleado">
		<span class="icon icon-user-plus"></span> Nuevo
	</button>
    <br>
    <br>
    <div class="card text-black bg-light">
		<div class="card-header text-center text-white bg-danger"><b>EMPLEADOS</b></div>
        <table class="table table-hover table-responsive table-sm">
            <thead>
                <th>Clave</th>
                <th>Nombre</th>
                <th>CURP</th>
                <th>Fecha Inicio</th>
                <th>Tipo</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <?php if(count($empleados) < 1) { ?>
                    <tr>
                        <td colspan="6">NO SE ENCONTRO NINGUN REGISTRO</td>
                    </tr>
                <?php } ?>
                <?php foreach ($empleados as $emp) { ?>
                    <tr class='<?php if($emp->em_status){ echo "table-success"; } else { echo "table-danger"; } ?>'>
                        <th><?php echo str_pad($emp->id_empleado, 2, "0", STR_PAD_LEFT) ?></th>
                        <td><?php echo $emp->em_nombre ?></td>
                        <td>{{ $emp->em_curp or 'Sin registro'}}</td>
                        <td><?php echo $emp->em_fecha_inicio ?></td>
                        <td><?php echo $emp->em_tipo ?></td>
                        <td>
                            <!-- BOTON DE MODIFICAR CLIENTE -->
                            <button type="button" class="btn btn-danger btn-sm tooltips2" data-placement="top" title="Modificar" data-toggle="modal" data-target="#mod-<?php echo $emp->id_empleado ?>"><span class="icon icon-pencil"></span></button>

                            <button type="button" class="btn btn-dark btn-sm tooltips2" data-placement="top" title="Información" data-toggle="modal" data-target="#info-<?php echo $emp->id_empleado ?>"><span class="icon icon-info"></span></button>

                            @if($emp->em_status)
                                <a href="{{route('put_empleado', $emp->id_empleado)}}" class="btn btn-danger btn-sm tooltips2" data-placement="top" title="Suspender"><span class="icon icon-arrow-down"></span></a>
                            @else 
                                <a href="{{route('put_empleado', $emp->id_empleado)}}" class="btn btn-danger btn-sm tooltips2" data-placement="top" title="Activar"><span class="icon icon-arrow-up"></span></a>
                            @endif

                            @if($emp->em_tipo != "BASE")
                                <button class="btn btn-dark btn-sm tooltips2" data-placement="top" title="Renovar" type="button" data-toggle="modal" data-target="#renovacion-<?php echo $emp->id_empleado ?>"><span class="icon icon-spinner10"></span></button>
                            @endif
                        </td>
                    </tr>
                    <!-- INFORMACION EMPLEADO -->
                    <div class="modal fade" id="info-<?php echo $emp->id_empleado ?>" tabindex="-1" role="dialog" aria-labelledby="infos" aria-hidden="true">
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
                                        <div class="col-md-6">
                                            <label>Nombre: </label>
                                            <p><?php echo $emp->em_nombre ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Tipo de Contrato: </label>
                                            <p><?php echo $emp->em_tipo ?></p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label>Fecha Inicial Laboral: </label>
                                            <p>{{$emp->em_fecha_inicio}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Fecha Final Laboral: </label>
                                            <?php 
                                                $fecha_final = \DB::table('contratos')->select('cont_fecha_fin')->where('empleado_id','=',$emp->id_empleado)->orderBy('id_contrato','DESC')->first();
                                            ?>
                                            <p>{{$fecha_final->cont_fecha_fin or 'Sin registro' }}</p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label>No. Licencia: </label>
                                            <p>{{$emp->em_num_licencia or 'Sin registro' }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Vigencia Licencia: </label>
                                            <p>{{$emp->em_vigencia_licencia or 'Sin registro' }}</p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label>No. Seguro Social: </label>
                                            <p>{{$emp->em_num_seg_social or 'Sin registro' }}</p>
                                        </div>
                                    </div>
                                    <div class="col text-center bg-dark text-white" style="font-size:20px;"><b>Datos Usuario</b></div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label>Usuario: </label>
                                            <p><?php echo $emp->usuario->usuario ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Perfil: </label>
                                            <p><?php echo $emp->usuario->perfil ?></p>
                                        </div>
                                    </div>
                                    <div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Documentos Entregados</b></div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <p><span class="icon icon-<?php if($emp->documentos->acta_nacimiento) {echo 'checkmark';} else {echo 'cross';}?>"></span> Acta de Nacimiento</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><span class="icon icon-<?php if($emp->documentos->comprobante_domicilio) {echo 'checkmark';} else {echo 'cross';}?>"></span> Comprobante de Domicilio</p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <p><span class="icon icon-<?php if($emp->documentos->seguro_social) {echo 'checkmark';} else {echo 'cross';}?>"></span> Seguro Social</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><span class="icon icon-<?php if($emp->documentos->curp) {echo 'checkmark';} else {echo 'cross';}?>"></span> CURP</p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <p><span class="icon icon-<?php if($emp->documentos->ine) {echo 'checkmark';} else {echo 'cross';}?>"></span> Credencial de Lector</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><span class="icon icon-<?php if($emp->documentos->licencia_conducir) {echo 'checkmark';} else {echo 'cross';}?>"></span> Licencia de Conducir</p>
                                        </div>
                                    </div>
                                    @if(count($emp->contratos) > 0)
                                        <div class="col text-center bg-dark text-white" style="font-size:20px;"><b>Historial Contratos</b></div>
                                        <ul>
                                            @foreach($emp->contratos as $contrato)
                                                <li>
                                                    <b>Fecha Inicial: </b>{{$contrato->cont_fecha_inicio}} - <b>Fecha Final: </b>{{$contrato->cont_fecha_fin}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODIFICAR EMPLEADO -->
                    <div class="modal fade" id="mod-<?php echo $emp->id_empleado ?>" tabindex="-1" role="dialog" aria-labelledby="pedidos" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="repartidor">Modificar Empleado</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo route('put_datos_empleado',$emp->id_empleado)?>" method="POST">
                                        <div id="FormUpdated">
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token()?>">
                                            <div class="form-row">
                                                <div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Documentos Pendientes</b></div>
                                            </div>
                                            <div class="form-row">
                                                @if(!$emp->documentos->acta_nacimiento)
                                                    <div class="form-group col-md-6">
                                                        <label>
                                                            <input type="checkbox" name="check_nacimiento" value="1">
                                                            Acta de Nacimiento
                                                        </label>  
                                                    </div>
                                                @else
                                                    <input type="hidden" name="check_nacimiento" value="1">
                                                @endif
                                                
                                                @if(!$emp->documentos->comprobante_domicilio)
                                                    <div class="form-group col-md-6">
                                                        <label>
                                                            <input type="checkbox" name="check_domicilio" value="1">
                                                            Comprobante de Domicilio
                                                        </label>  
                                                    </div>
                                                @else
                                                    <input type="hidden" name="check_domicilio" value="1">
                                                @endif
                                                
                                                @if(!$emp->documentos->seguro_social)
                                                    <div class="form-group col-md-6">
                                                        <label>
                                                            <input type="checkbox" name="check_seguro" class="CheckSeguroUpdated" value="1">
                                                            Seguro Social
                                                        </label>  
                                                    </div>
                                                @else
                                                    <input type="hidden" name="check_seguro" value="1">
                                                @endif

                                                @if(!$emp->documentos->curp)
                                                    <div class="form-group col-md-6">
                                                        <label>
                                                            <input type="checkbox" class="CheckCurpUpdated" name="check_curp" value="1">
                                                            CURP
                                                        </label>  
                                                    </div>
                                                @else
                                                    <input type="hidden" name="check_curp" value="1">
                                                @endif
                                            
                                                @if(!$emp->documentos->ine)
                                                    <div class="form-group col-md-6">
                                                        <label>
                                                            <input type="checkbox" name="check_ine" value="1">
                                                            INE
                                                        </label>  
                                                    </div>
                                                @else
                                                    <input type="hidden" name="check_ine" value="1">
                                                @endif
                                                
                                                @if(!$emp->documentos->licencia_conducir)
                                                    <div class="form-group col-md-12">
                                                        <label>
                                                            <input type="checkbox" name="check_licencia" value="1" class="CheckLicenciaUpdated">
                                                            Licencia de Conducir
                                                        </label>  
                                                    </div>
                                                @else
                                                    <input type="hidden" name="check_licencia" value="1">
                                                @endif

                                                @if($emp->documentos->licencia_conducir && $emp->documentos->ine && $emp->documentos->curp && $emp->documentos->seguro_social && $emp->documentos->comprobante_domicilio && $emp->documentos->acta_nacimiento)
                                                    <label>Ningún Documento Pendiente</label>
                                                @endif
                                                
                                            </div> <!-- form-row-->
                                            <div class="form-row">
                                                <div class="col text-center bg-dark text-white" style="font-size:20px;"><b>Datos Generales</b></div>
                                            </div>
                                            <br>
                                            <div class="form-row HijoCurp">
                                                <div class="form-group col">
                                                    <label>Tipo Contrato</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                                        <select class="form-control SelectTipo" required name="tipo">
                                                             <option value="<?php echo $emp->em_tipo?>" hidden selected><?php echo $emp->em_tipo?></option>
                                                            <option value="BASE">BASE</option>
                                                            <option value="CONTRATO">CONTRATO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                @if(!$emp->documentos->curp)
                                                    <div class="form-group col Hijo">
                                                        <label>CURP</label>
                                                        <div class="input-group ">
                                                            <span class="input-group-addon"><span class="icon icon-user"></span></span>
                                                            <input type="text" class="form-control readonly CurpUpdated" name="curp" placeholder="CURP" pattern=".{18,18}" maxlength="18" title="Debe Contener 18 Caracteres">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-row HijoTipo">
                                                <div class="form-group col">
                                                    <label>Fecha Inicial</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="icon icon-calendar"></span></span>
                                                        <input type="text" class="form-control Numeros date-format" name="fecha_inicio" value="<?php echo $emp->em_fecha_inicio ?>" placeholder="FECHA INICIO" maxlength="10" required>
                                                    </div>
                                                </div>
                                                @if(count($emp->contratos) < 1)
                                                    <div class="form-group col Hijo">
                                                        <label>Fecha Final</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="icon icon-calendar"></span></span>
                                                            <input type="text" class="<?php echo ($emp->em_tipo != 'CONTRATO') ? 'readonly' : '' ?> form-control Numeros date-format tipo" name="fecha_final" value="<?php echo $emp->em_fecha_final ?>" placeholder="FECHA FINAL" maxlength="10">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                                    
                                            <div class="form-row HijoLicencia">
                                                <div class="form-group col HijoNoLicencia">
                                                    <label>No. Licencia</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                                        <input type="number" class="<?php echo (!$emp->documentos->licencia_conducir) ? 'readonly' : '' ?> form-control licencia" name="num_licencia" placeholder="Numero de Licencia" value="<?php echo $emp->em_num_licencia ?>" >
                                                    </div>
                                                </div>

                                                <div class="form-group col HijoVigenciaLicencia">
                                                    <label>Vigencia Licencia</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                                        <input type="text" class="<?php echo (!$emp->documentos->licencia_conducir) ? 'readonly' : '' ?> form-control licencia Numeros date-format" name="vigencia_licencia" placeholder="Vigencia de Licencia" value="<?php echo $emp->em_vigencia_licencia ?>" maxlength="10">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row HijoSeguro">
                                                <div class="form-group col">
                                                    <label>No. Seguro Social</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="icon icon-plus"></span></span>
                                                        <input type="number" class="<?php echo (!$emp->documentos->seguro_social) ? 'readonly' : '' ?> form-control num_seg" name="seg_social" placeholder="Numero de Seguro Social" value="<?php echo $emp->em_num_seg_social ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Datos Usuario</b></div>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label>Usuario</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="icon icon-user"></span></span>
                                                        <input type="text" class="form-control" name="usuario" placeholder="USUARIO" value="<?php echo $emp->usuario->usuario ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col">
                                                    <label>Perfil</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="icon icon-user"></span></span>
                                                        <select class="form-control select-perfil" required name="perfil">
                                                            <option value="<?php echo $emp->usuario->perfil?>" hidden selected><?php echo $emp->usuario->perfil?></option>
                                                            <option value="CAJA">CAJA</option>
                                                            <option value="ADMIN">ADMIN</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label>Contraseña</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="icon icon-key"></span></span>
                                                        <input type="password" class="form-control" name="password" placeholder="CONTRASEÑA">
                                                    </div>
                                                </div>
                                                <div class="form-group col">
                                                    <label>Confirmar Contraseña</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="icon icon-key"></span></span>
                                                        <input type="password" class="form-control" name="password_confirmation" placeholder="CONFIRMAR CONTRASEÑA">
                                                    </div>
                                                </div>
                                            </div>
                                            <p><b>Si desea actualizar la contraseña deberá escribir los campos correspondientes con la nueva contraseña, sino desea actualizarla solo omita los campos.</b></p>
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

                    <!-- RENOAVACION CONTRATO -->
                    @if($emp->em_tipo != "BASE")
                        <div class="modal fade" id="renovacion-<?php echo $emp->id_empleado ?>" tabindex="-1" role="dialog" aria-labelledby="pedidos" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="repartidor">Renovación Contrato</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?php echo route('contrato_empleado',$emp->id_empleado)?>" method="POST">
                                            {{csrf_field()}}
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label>Fecha Inicial</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="icon icon-calendar"></span></span>
                                                        <input type="text" class="form-control Numeros date-format" name="fecha_inicio" placeholder="FECHA INICIO" maxlength="10" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col">
                                                    <label>Fecha Final</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="icon icon-calendar"></span></span>
                                                        <input type="text" class="form-control Numeros date-format" name="fecha_final" placeholder="FECHA FINAL" maxlength="10">
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
                    @endif
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- INSERTAR NUEVO EMPLEADO -->
	<div class="modal fade" id="empleado" tabindex="-1" role="dialog" aria-labelledby="pedidos" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="repartidor">Nuevo Empleado</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo route('post_empleado')?>" method="POST">
                        {{csrf_field()}}
						<div class="form-row">
                            <div class="col-md-6"><!-- izquierda-->
                                <div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Documentos</b></div>
								<br>
                                <div class="form-group col-md-12">
                                    <label>
                                        <input type="checkbox"  name="check_nacimiento" value="1">
                                        Acta de Nacimiento
                                    </label>  
                                </div>
                            
								<div class="form-group col-md-12">
                                    <label>
                                        <input type="checkbox"  name="check_domicilio" value="1">
                                        Comprobante de Domicilio
                                    </label>  
                                </div>
                        
                        
								<div class="form-group col-md-12">
                                    <label>
                                        <input type="checkbox"  name="check_seguro" class="check-num_seg" value="1">
                                        Seguro Social
                                    </label>  
                                </div>
                            
								<div class="form-group col-md-12">
                                    <label>
                                        <input type="checkbox" class="check-curp" name="check_curp" value="1">
                                        CURP
                                    </label>  
                                </div>

								<div class="form-group col-md-12">
                                    <label>
                                        <input type="checkbox" name="check_ine" value="1">
                                        INE
                                    </label>  
                                </div>
                            
								<div class="form-group col-md-12">
                                    <label>
                                        <input type="checkbox" name="check_licencia" value="1" class="check-licencia">
                                        Licencia de Conducir
                                    </label>  
                                </div>

                                <div class="col text-center bg-dark text-white" style="font-size:20px;"><b>Licencia Conducir</b></div>
                                <br>
                                        
                                <div class="form-row">
                                    <div class="form-group col">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                            <input type="number" class="form-control readonly no_licencia" name="num_licencia" placeholder="Numero" value="<?php echo old('num_licencia') ?>">
                                        </div>
                                    </div>

                                    <div class="form-group col">
                                        <div class="input-group" id="picker-container3">
                                            <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                            <input type="text" class="form-control readonly vigencia" name="vigencia_licencia" placeholder="Vigencia" value="<?php echo old('vigencia_licencia') ?>">
                                        </div>
                                    </div>
                                </div>
						    </div><!-- izquierda-->

                            <div class="col-md-6"><!-- Derecha-->
                                <div class="col text-center bg-dark text-white" style="font-size:20px;"><b>Datos Generales</b></div><br>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="icon icon-user"></span></span>
                                            <input type="text" class="form-control" name="nombre"  placeholder="Nombre Completo" value="<?php echo old('nombre') ?>" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group col">
                                        <div class="input-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="icon icon-phone"></span></span>
                                                <input type="text" class="form-control" name="telefono"  placeholder="Telefono" value="<?php echo old('telefono') ?>" required>
                                            </div>
                                        </div>
                                    </div>	
                                </div>
                                        
                                <div class="form-row">
                                    <div class="form-group col">
                                        <div class="input-group ">
                                            <span class="input-group-addon"><span class="icon icon-user"></span></span>
                                            <input type="text" class="form-control readonly curp" name="curp" placeholder="CURP" value="<?php echo old('curp') ?>" pattern=".{18,18}" maxlength="18" title="Debe Contener 18 Caracteres">
                                        </div>
                                    </div>
                                </div>
                                        
                                <div class="form-row">
                                    <div class="form-group col">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="icon icon-plus"></span></span>
                                            <input type="number" class="form-control readonly num_seg" name="seg_social" placeholder="Numero de Seguro Social" value="<?php echo old('seg_social') ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Contrato</b></div>
                                <br>     

                                <div class="form-row">
                                    <div class="form-group col">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                            <select class="form-control select-tipo" required name="tipo">
                                                <option value="" hidden selected>TIPO CONTRATO</option>
                                                <option value="BASE">BASE</option>
                                                <option value="CONTRATO">CONTRATO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <div class="input-group" id="picker-container">
                                            <span class="input-group-addon"><span class="icon icon-calendar"></span></span>
                                            <input type="text" class="form-control readonly fecha_inicial" name="fecha_inicio" placeholder="Inicial" value="<?php echo old('fecha_inicio') ?>" required>
                                        </div>
                                    </div>
                                
                                    <div class="form-group col" id="picker-container2">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="icon icon-calendar"></span></span>
                                            <input type="text" class="form-control readonly fecha_final tipo" name="fecha_final" placeholder="Final" value="<?php echo old('fecha_final') ?>">
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- derecha-->
                        </div> <!-- form-row-->

                        <div class="form-row">
                            <div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Datos Usuario</b></div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-user"></span></span>
                                    <input type="text" class="form-control" name="usuario" placeholder="USUARIO" value="<?php echo old('usuario') ?>" required>
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-user"></span></span>
                                    <select class="form-control select-perfil" required name="perfil">
                                        <option value="">PERFIL</option>
                                        <option value="CAJA">CAJA</option>
                                        <option value="ADMIN">ADMIN</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-key"></span></span>
                                    <input type="password" class="form-control" name="password" placeholder="CONTRASEÑA" id="password" required>
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-key"></span></span>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="CONFIRMAR CONTRASEÑA" id="confirm_password" required>
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

@section('js')
    <script>
        $(document).ready(function(){

            // INSERTAR
            $('.check-curp').click(function(){
                if ($(this).prop('checked')) {
                    $('.curp').removeClass('readonly').prop('required',true);
                } else {
                    $('.curp').addClass('readonly').val('').prop('required',false);
                }
            });
            
            $('.check-num_seg').click(function(){
                if ($(this).prop('checked')) {
                    $('.num_seg').removeClass('readonly').prop('required',true);
                } else {
                    $('.num_seg').addClass('readonly').val('').prop('required',false);
                }
            });

            $('.check-licencia').click(function(){
                if ($(this).prop('checked')) {
                    $('.no_licencia').removeClass('readonly').val('').prop('required',true);
                    $('.vigencia').prop('required',true);
                    CampoFechaFinal(true, 'vigencia', "picker-container3");
                } else {
                    $('.no_licencia').addClass('readonly').val('').prop('required',false);
                    $('.vigencia').val('').prop('required',false);
                    CampoFechaFinal(false, 'vigencia', "picker-container3");
                }
            });

            $('.select-tipo').click(function(){
                var tipo = $(this).val();
                if (tipo != "BASE") {
                    $('.tipo').prop('required',true);
                    CampoFechaFinal(true, 'fecha_final', "picker-container2");
                } else {
                    $('.tipo').val('').prop('required',false);
                    CampoFechaFinal(false, 'fecha_final', "picker-container2");
                }
            });

            $('button[type="reset"]').click(function(){
                $('.tipo, .curp, .num_seg, .licencia').prop('readonly', true).prop('required',false);
            });

            //MODIFICAR
            $('.CheckCurpUpdated').click(function(){
                if ($(this).prop('checked')) {
                    $(this).parent('label').parent('.form-group').parent('.form-row').parent('#FormUpdated').find('.HijoCurp').find('.Hijo').find('.input-group').find('input').removeClass('readonly').prop('required',true);
                } else {
                    $(this).parent('label').parent('.form-group').parent('.form-row').parent('#FormUpdated').find('.HijoCurp').find('.Hijo').find('.input-group').find('input').addClass('readonly').val('').prop('required',false);
                }
            });

            $('.CheckLicenciaUpdated').click(function(){
                if ($(this).prop('checked')) {
                    $(this).parent('label').parent('.form-group').parent('.form-row').parent('#FormUpdated').find('.HijoLicencia').find('.HijoNoLicencia').find('.input-group').find('input').removeClass('readonly');
                    $(this).parent('label').parent('.form-group').parent('.form-row').parent('#FormUpdated').find('.HijoLicencia').find('.HijoVigenciaLicencia').find('.input-group').find('input').removeClass('readonly');
                } else {
                    $(this).parent('label').parent('.form-group').parent('.form-row').parent('#FormUpdated').find('.HijoLicencia').find('.HijoNoLicencia').find('.input-group').find('input').addClass('readonly').val('');
                    $(this).parent('label').parent('.form-group').parent('.form-row').parent('#FormUpdated').find('.HijoLicencia').find('.HijoVigenciaLicencia').find('.input-group').find('input').addClass('readonly').val('');
                }
            });

            $('.CheckSeguroUpdated').click(function(){
                if ($(this).prop('checked')) {
                    $(this).parent('label').parent('.form-group').parent('.form-row').parent('#FormUpdated').find('.HijoSeguro').find('.input-group').find('input').removeClass('readonly');
                } else {
                    $(this).parent('label').parent('.form-group').parent('.form-row').parent('#FormUpdated').find('.HijoSeguro').find('.input-group').find('input').addClass('readonly').val('');
                }
            });

            $('.SelectTipo').change(function(){
                var valor = $(this).val();
                if (valor != "BASE") {
                    $(this).parent('.input-group').parent('.form-group').parent('.form-row').parent('#FormUpdated').find('.HijoTipo').find('.Hijo').find('.input-group').find('input').removeClass('readonly').prop('required',true);
                } else {
                    $(this).parent('.input-group').parent('.form-group').parent('.form-row').parent('#FormUpdated').find('.HijoTipo').find('.Hijo').find('.input-group').find('input').addClass('readonly').val('').prop('required',false);
                }
            });

            /* Modal Insertar */
            $('.fecha_inicial').datepicker({
                format: 'yyyy-mm-dd',
                autoclose:true,
                language:'es',
                container: "#picker-container"
            });

            function CampoFechaFinal(flag,date,container){
                if (flag) {
                    $('.'+date).datepicker({
                        format: 'yyyy-mm-dd',
                        autoclose:true,
                        language:'es',
                        container: "#"+container
                    });
                    return true;
                }

                $('.'+date).datepicker('destroy');

                return false;
            }

            $('.date-format').keydown(function(e){
                var fecha = $(this).val();
                if ((fecha.length === 4 || fecha.length === 7) && e.keyCode != 8) {
                    fecha += "-";
                }
                $(this).val(fecha);
            });

            $('#confirm_password, #password').keyup(function(){
                ValidarPassword();
            });

            function ValidarPassword(){
                var pass = document.getElementById('password');
                var pass2 = document.getElementById('confirm_password');

                if (pass.value != pass2.value) {
                    pass2.setCustomValidity("Las contraseñas no coinciden");
                } else {
                    pass2.setCustomValidity('');
                }
            }

        });//documents
    </script>
@stop