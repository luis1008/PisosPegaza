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

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#empleado">
		<span class="icon icon-user-plus"></span> Nuevo
	</button>
    <br>
    <br>
    <div class="card text-black bg-light">
		<div class="card-header text-center text-white bg-danger"><b>EMPLEADOS</b></div>
        <table class="table table-hover table-sm">
            <thead>
                <th>Clave</th>
                <th>Nombre</th>
                <th>CURP</th>
                <th>Fecha Inicio</th>
                <th>Tipo</th>
                <th>Opciones</th>
                <th></th>
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
                        <td><?php echo $emp->em_curp ?></td>
                        <td><?php echo $emp->em_fecha_inicio ?></td>
                        <td><?php echo $emp->em_tipo ?></td>
                        <td>

                                 <!-- BOTON DE MODIFICAR CLIENTE -->
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mod-<?php echo $emp->id_empleado ?>"><span class="icon icon-spinner10"></span></button>

                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#info-<?php echo $emp->id_empleado ?>"><span class="icon icon-eye"></span></button>

                            <form action="<?php echo route('put_empleado') ?>" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                                <input type="hidden" name="empleado" value="<?php echo $emp->id_empleado ?>">
                                <?php if($emp->em_status){ ?>
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" class="btn btn-danger btn-sm"><span class="icon icon-arrow-down"></span>
                                <?php } else { ?>
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-success btn-sm"><span class="icon icon-arrow-up"></span>
                                <?php } ?>
                            </form>
                        </td>
                    </tr>
                    <!-- INFORMACION EMPLEADO -->
                    <div class="modal fade" id="info-<?php echo $emp->id_empleado ?>" tabindex="-1" role="dialog" aria-labelledby="infos" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="infos">Informacion de <?php echo $emp->em_nombre ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><b>Tipo: </b><?php echo $emp->em_tipo ?></p>
                                    <p><b>Fecha Inicio Laboral: </b><?php echo $emp->em_fecha_inicio ?></p>
                                    <p><b>Fecha Final Laboral: </b><?php if($emp->em_tipo == "CONTRATO") {echo $emp->em_fecha_final;} else {echo "NO SE HA REGISTRADO";} ?></p>
                                    <p><b>No. Seguro Social: </b><?php if($emp->em_num_licencia != "0"){echo $emp->em_num_seg_social;}else{echo "NO SE HA REGISTRADO";} ?></p>
                                    <p><b>No. Licencia: </b><?php if($emp->em_num_licencia != ""){echo $emp->em_num_licencia;}else{echo "NO SE HA REGISTRADO";} ?></p>
                                    <p><b>Vigencia Licencia: </b><?php if($emp->em_vigencia_licencia != ""){echo $emp->em_vigencia_licencia;}else{echo "NO SE HA REGISTRADO";} ?></p>
                                    <p><b>Documentos entregados: </b></p>
                                    <p><span class="icon icon-<?php if($emp->documentos->acta_nacimiento) {echo 'checkmark';} else {echo 'cross';}?>"></span> Acta de Nacimiento</p>
                                    <p><span class="icon icon-<?php if($emp->documentos->comprobante_domicilio) {echo 'checkmark';} else {echo 'cross';}?>"></span> Comprobante de Domicilio</p>
                                    <p><span class="icon icon-<?php if($emp->documentos->seguro_social) {echo 'checkmark';} else {echo 'cross';}?>"></span>Seguro Social</p>
                                    <p><span class="icon icon-<?php if($emp->documentos->curp) {echo 'checkmark';} else {echo 'cross';}?>"></span> CURP</p>
                                    <p><span class="icon icon-<?php if($emp->documentos->ine) {echo 'checkmark';} else {echo 'cross';}?>"></span> Credencial de Lector</p>
                                    <p><span class="icon icon-<?php if($emp->documentos->licencia_conducir) {echo 'checkmark';} else {echo 'cross';}?>"></span> Licencia de Conducir</p>
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
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token()?>">
                                        <div class="form-row">
                                            <div class="col-md-6"><!-- izquierda-->                                            
                                                <div class="form-group col-md-12">
                                                    <label>
                                                        <input type="checkbox"  name="check_domicilio" value="1">
                                                        Comprobante de Domicilio
                                                    </label>  
                                                </div>
                                            
                                                <div class="form-group col-md-12">
                                                    <label>
                                                        <input type="checkbox" name="check_licencia" value="1" class="check-licencia">
                                                        Licencia de Conducir
                                                    </label>  
                                                </div>
                                            </div><!-- izquierda-->

                                            <div class="col-md-6"><!-- Derecha--> 

                                                <div class="form-row">
                                                    <div class="form-group col">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                                            <input type="text" class="form-control" name="fecha_inicio" value="<?php echo $emp->em_fecha_inicio ?>" placeholder="FECHA INICIO" required>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="form-group col">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                                            <input type="text" class="form-control tipo" name="fecha_final" value="<?php echo $emp->em_fecha_final ?>" placeholder="FECHA FINAL" required>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                        
                                                <div class="form-row">
                                                    <div class="form-group col">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                                            <input type="text" class="form-control licencia" name="num_licencia" placeholder="Numero de Licencia" value="<?php echo $emp->em_num_licencia ?>" >
                                                        </div>
                                                    </div>

                                                    <div class="form-group col">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                                            <input type="text" class="form-control licencia" name="vigencia_licencia" placeholder="Vigencia de Licencia" value="<?php echo $emp->em_vigencia_licencia ?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                                        
                                                <div class="form-row">
                                                    <div class="form-group col">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                                            <select class="form-control select-tipo" required name="tipo">
                                                                <option value="">TIPO</option>
                                                                <option value="BASE">BASE</option>
                                                                <option value="CONTRATO">CONTRATO</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- derecha-->
                                        </div> <!-- form-row-->
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
						    </div><!-- izquierda-->

                            <div class="col-md-6"><!-- Derecha-->
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
                                        <div class="input-group ">
                                            <span class="input-group-addon"><span class="icon icon-phone"></span></span>
                                            <input type="text" class="form-control curp" name="curp" placeholder="CURP" value="<?php echo old('curp') ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                        
                                <div class="form-row">
                                    <div class="form-group col">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                            <input type="text" class="form-control num_seg" name="seg_social" placeholder="Numero de Seguro Social" value="<?php echo old('seg_social') ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                            <input type="text" class="form-control" name="fecha_inicio" placeholder="Fecha de Inicio" value="<?php echo old('fecha_inicio') ?>" required>
                                        </div>
                                    </div>
                                
                                    <div class="form-group col">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                            <input type="text" class="form-control tipo" name="fecha_final" placeholder="Fecha Final" value="<?php echo old('fecha_final') ?>" readonly>
                                        </div>
                                    </div>
                                    
                                </div>
                                        
                                <div class="form-row">
                                    <div class="form-group col">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                            <input type="text" class="form-control licencia" name="num_licencia" placeholder="Numero de Licencia" value="<?php echo old('num_licencia') ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group col">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                            <input type="text" class="form-control licencia" name="vigencia_licencia" placeholder="Vigencia de Licencia" value="<?php echo old('vigencia_licencia') ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                        
                                <div class="form-row">
                                    <div class="form-group col">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                                            <select class="form-control select-tipo" required name="tipo">
                                                <option value="">TIPO</option>
                                                <option value="BASE">BASE</option>
                                                <option value="CONTRATO">CONTRATO</option>
                                            </select>
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
                                            <span class="input-group-addon"><span class="icon icon-user"></span></span>
                                            <input type="text" class="form-control" name="usuario" placeholder="USUARIO" value="<?php echo old('usuario') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="icon icon-key"></span></span>
                                            <input type="password" class="form-control" name="password" placeholder="CONTRASEÑA">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="icon icon-key"></span></span>
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="CONFIRMAR CONTRASEÑA">
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- derecha-->
                        </div> <!-- form-row-->
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

            $('.check-curp').click(function(){
                if ($(this).prop('checked')) {
                    $('.curp').prop('readonly', false).prop('required',true);
                } else {
                    $('.curp').prop('readonly', true).val('').prop('required',false);
                }
            });
            
            $('.check-num_seg').click(function(){
                if ($(this).prop('checked')) {
                    $('.num_seg').prop('readonly', false).prop('required',true);
                } else {
                    $('.num_seg').prop('readonly', true).val('').prop('required',false);
                }
            });

            $('.check-licencia').click(function(){
                if ($(this).prop('checked')) {
                    $('.licencia').prop('readonly', false).prop('required',true);
                } else {
                    $('.licencia').prop('readonly', true).val('').prop('required',false);
                }
            });

            $('.select-tipo').click(function(){
                var tipo = $(this).val();
                if (tipo != "BASE") {
                    $('.tipo').prop('readonly', false).prop('required',true);
                } else {
                    $('.tipo').prop('readonly', true).val('').prop('required',false);
                }
            });

            $('button[type="reset"]').click(function(){
                $('.tipo, .curp, .num_seg, .licencia').prop('readonly', true).prop('required',false);
            });

        });//documents
    </script>
@stop