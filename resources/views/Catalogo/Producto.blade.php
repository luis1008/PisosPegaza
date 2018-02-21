@extends('Template.Body')

@section('title','Captura Producto')

@section('body')

    <a href="Caja" class="btn btn-danger">
		<span class="icon icon-exit"></span> Salir
	</a>

    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#producto">
		<span class="icon icon-briefcase"></span> Nuevo
	</button>
    <br>
    <br>
    <div class="card text-black bg-light">
		<div class="card-header text-center text-white bg-danger"><b>PRODUCTOS</b></div>
        <table class="table table-hover table-sm">
            <thead>
                <th class="text-center">No. Producto</th>
                <th>Nombre</th>
                <th>Costo</th>
                <th>Precio Venta</th>
                <th>Tipo</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <?php if(count($productos) < 1) { ?>
                    <tr>
                        <td colspan="6">NO SE ENCONTRO NINGÚN REGISTRO</td>
                    </tr>
                <?php } ?>
                <?php foreach ($productos as $pd) { ?>
                    <tr class='<?php if($pd->pd_status){ echo "table-success"; } else { echo "table-danger"; } ?>'>
                        <th class="text-center"><?php echo  str_pad($pd->id_producto, 2, "0", STR_PAD_LEFT) ?></th>
                        <td><?php echo $pd->pd_nombre ?></td>
                        <td>$<?php echo number_format($pd->pd_costo,2) ?></td>
                        <td>$<?php echo number_format($pd->pd_precio_venta,2) ?></td>
                        <td><?php echo $pd->pd_tipo ?></td>
                        <td>
                            <button type="button" class="btn btn-dark btn-sm tooltips2" title="Modificar" data-toggle="modal" data-target="#mo-<?php echo $pd->id_producto ?>"><span class="icon icon-pencil"></span></button>

                            <?php if($pd->pd_status){ ?>
                                <a href="{{route('put_producto',$pd->id_producto)}}" class="btn btn-danger btn-sm tooltips2" title="Suspender"><span class="icon icon-arrow-down"></span></a>
                            <?php } else { ?>
                                <a href="{{route('put_producto',$pd->id_producto)}}" class="btn btn-danger btn-sm tooltips2" title="Activar"><span class="icon icon-arrow-up"></span></a>
                            <?php } ?>

                            <?php if($pd->pd_tipo === "ENSAMBLADO") { ?>
                                <button type="button" class="btn btn-dark btn-sm tooltips2" title="Requisitos" data-toggle="modal" data-target="#info-<?php echo $pd->id_producto ?>"><span class="icon icon-droplet"></span></button>
                            <?php } ?>
                        </td>
                    </tr>
                    <!-- MODIFICAR PRODUCTO -->
                    <div class="modal fade" id="mo-<?php echo $pd->id_producto ?>" tabindex="-1" role="dialog" aria-labelledby="infos" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="infos">Modificar Producto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo route('put_datos_producto',$pd->id_producto)?>" method="POST">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-briefcase"></span></span>
                                                    <input type="text" class="form-control" name="nombre" value="{{$pd->pd_nombre}}" placeholder="NOMBRE" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
                                                    <input type="number" class="form-control input-costo" name="costo"  placeholder="COSTO" value="{{$pd->pd_costo}}" required>
                                                </div>
                                            </div>
                                            
                                             <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
                                                    <input type="number" class="form-control" name="precio_venta" value="{{$pd->pd_precio_venta}}" placeholder="PRECIO DE VENTA" required>
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

                    <!-- MODIFICAR REQUISITOS DEL PRODUCTO -->
                    <div class="modal fade" id="requisitos-<?php echo $pd->id_producto ?>" tabindex="-1" role="dialog" aria-labelledby="infos" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="infos">Modificar Requisitos del Producto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo route('put_datos_producto',$pd->id_producto)?>" method="POST">
                                        {{csrf_field()}}

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
    
    @foreach($productos as $pd)
        <!-- INFORMACION/MODIFICACION REQUISITO PARA EL PRODUCTO -->
        <div class="modal fade" id="info-<?php echo $pd->id_producto ?>" tabindex="-1" role="dialog" aria-labelledby="infos" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infos">Información/Modificación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Requisitos Actual</b></div>
                        </div>
                        <div class="form-row">
                            <ul>
                                <?php foreach ($pd->materiasprimas as $material) {?>
                                    <li><?php echo "<b>" . $material->mp_nombre.":</b>"." ".$material->pivot->det_cantidad." ".$material->mp_unidad; ?></li>
                                <?php } ?>
                                <?php foreach ($pd->productos as $producto) {?>
                                    <li><?php echo "<b>" . $producto->pd_nombre.":</b>"." ".$producto->pivot->det_pd_cantidad ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="form-row">
                            <div class="col text-center bg-dark text-white" style="font-size:20px;"><b>Nuevo Requisitos</b></div>
                        </div>
                        <p><b>Si desea cambiar los requisitos para este producto completar la parte inferior, agregando el materia o producto necesario (Es importante que al modificar los requisitos actuales, no habrá forma de recuperarlo).</b></p>
                        <form action="{{ route('put_requisitos',$pd->id_producto)}}" method="POST" onSubmit="return confirm('Seguro que desea modificar?')">
                            {{csrf_field()}}
                            <div>
                                <div class="form-row text-center">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-dark BtnUpdatedMaterial"><span class="icon icon-plus"></span> Material</button>
                                        <!--<button type="button" class="btn btn-danger BtnUpdatedProducto" style="margin-left:5px;"><span class="icon icon-plus"></span> Producto</button>-->
                                    </div>
                                </div>
                                <br>
                                <div class="AddRequisitos"></div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-cross"></span> Cerrar</button>
                                    <button type="submit" class="btn btn-dark" disabled><span class="icon icon-upload"></span> Modificar Requisitos</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- INSERTAR NUEVO PRODUCTO -->
	<div class="modal fade" id="producto" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="productos" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="productos">Nuevo Producto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo route('post_producto')?>" method="POST">
                        {{csrf_field()}}
						<div class="form-row">
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-briefcase"></span></span>
									<input type="text" class="form-control" name="nombre" placeholder="NOMBRE" required>
								</div>
							</div>
                            
							<div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-hammer"></span></span>
									<select class="form-control" name="tipo" id="type" required>
                                        <option value="NO ENSAMBLADO">NO ENSAMBLADO</option>
                                        <option value="ENSAMBLADO">ENSAMBLADO</option>
                                    </select>
								</div>
							</div>
                            <!-- <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-stack"></span></span>
                                    <input type="text" class="form-control" name="cantidad_producto" value="1" placeholder="CANTIDAD" readonly>
                                </div>
                            </div> -->
                            <input type="hidden" name="cantidad_unidad" value="1">
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="number" class="form-control input-costo" name="costo"  placeholder="COSTO" required>
								</div>
							</div>
                            
                             <div class="form-group col">
								<div class="input-group">
									<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
									<input type="number" class="form-control" name="precio_venta"  placeholder="PRECIO DE VENTA" required>
								</div>
							</div>
                        
                        </div>

                        <div class="AddEnsamblado"></div>

                        <div class="col-md-12 AppendBtn text-center" style="margin-bottom:15px;"></div>

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
    <script src="<?php echo asset('js/producto.js') ?>"></script>
@stop