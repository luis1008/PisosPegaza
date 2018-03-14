@extends('Template.Body')

@section('title','Gastos')

@section('body')

    <a href="Caja" class="btn btn-danger">
        <span class="icon icon-exit"></span> Salir
    </a>

    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#gastos">
        <span class="icon icon-coin-dollar"></span> Nuevo
    </button>
    <br>
    <br>
    <div class="card text-black bg-light">
        <div class="card-header text-center text-white bg-danger"><b>GASTOS</b></div>
        <table class="table table-hover table-sm">
            <thead>
                <th width="50" class="text-center">Clave</th>
                <th width="100">Concepto</th>
                <th width="50">Opciones</th>
            </thead>
            <tbody>
                <?php if(count($gastos) < 1) { ?>
                    <tr>
                        <td colspan="3" class="text-center">NO SE ENCONTRO NINGÚN REGISTRO</td>
                    </tr>
                <?php } ?>
                <?php foreach ($gastos as $gasto) { ?>
                    <tr class='<?php if($gasto->ga_status){ echo "table-success"; } else { echo "table-danger"; } ?>'>
                        <th class="text-center"><?php echo str_pad($gasto->id_gastos, 2, "0", STR_PAD_LEFT) ?></th>
                        <td><?php echo $gasto->ga_concepto ?></td>
                        <td>
                            <button type="button" class="btn btn-dark btn-sm tooltips2" title="Modificar" data-toggle="modal" data-target="#mo-{{$gasto->id_gastos}}"><span class="icon icon-pencil"></span></button>

                            <?php if($gasto->ga_status){ ?>
                                <a href="{{route('put_gasto',$gasto->id_gastos)}}" class="btn btn-danger btn-sm tooltips2" title="Suspender"><span class="icon icon-arrow-down"></span></a>
                            <?php } else { ?>
                                <a href="{{route('put_gasto',$gasto->id_gastos)}}" class="btn btn-danger btn-sm tooltips2" title="Activar"><span class="icon icon-arrow-up"></span></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <!-- MODIFICAR GASTO -->
                    <div class="modal fade" id="mo-{{$gasto->id_gastos}}" tabindex="-1" role="dialog" aria-labelledby="vehiculos" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="clientes">Modificar Gastos</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo route('put_datos_gasto',$gasto->id_gastos)?>" method="POST">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
                                                    <input type="text" class="form-control" name="concepto" value="{{$gasto->ga_concepto}}" placeholder="CONCEPTO" required>
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

    <!-- INSERTAR NUEVO GASTO -->
    <div class="modal fade" id="gastos" tabindex="-1" role="dialog" aria-labelledby="vehiculos" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clientes">Nuevo Gasto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo route('post_gasto')?>" method="POST">
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
                                    <input type="text" class="form-control" name="concepto" placeholder="CONCEPTO" required>
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