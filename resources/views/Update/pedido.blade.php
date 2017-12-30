@extends('Template.Body')

@section('title','Modificar Pedido')

@section('body')
    <div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Modicar Pedido No. <?php echo $pedido->pe_nota?></b></div>
    
    <form action="<?php echo route('put_datos_pedido',$pedido->id_pedido)?>" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
        <div class="form-row">
            <div class="form-group col">
                <label>Fecha Pedido</label>
                <div class="input-group date fecha_pedido2">
                    <span class="input-group-addon"><span class="icon icon-calendar"></span></span>
                    <input type="text" class="form-control" name="fecha_pedido2" value="<?php echo date("Y-m-d", strtotime($pedido->pe_fecha_pedido)) ?>" readonly required>
                </div>
            </div>
            <div class="form-group col">
                <label>Fecha Entrega</label>
                <div class="input-group date fecha_entrega2">
                    <span class="input-group-addon"><span class="icon icon-calendar"></span></span>
                    <input type="text" class="form-control" name="fecha_programada2" value="<?php echo date("Y-m-d", strtotime($pedido->pe_fecha_entrega)) ?>" readonly required>
                </div>
            </div>
            <div class="form-group col">
                <label>No. Nota</label>
                <div class="input-group">
                    <span class="input-group-addon"><span class="icon icon-profile"></span></span>
                    <input type="text" class="form-control" name="nota" value="{{$pedido->pe_nota}}" placeholder="No. NOTA" required>
                </div>
            </div>
        </div>
        <div class="form-row">
            <!-- <div class="form-group col">
                <div class="input-group">
                    <span class="input-group-addon"><span class="icon icon-credit-card"></span></span>
                    <select class="form-control select-status-pago2" id="<?php echo $pedido->id_pedido ?>"name="pago_status" required>
                        <option value="{{$pedido->pe_pago_status}}" hidden selected>{{$pedido->pe_pago_status}}</option>
                        <option value="PENDIENTE">PENDIENTE</option>
                        <option value="ABONADO">ABONADO</option>
                        <option value="PAGADO">PAGADO</option>
                    </select>
                </div>
            </div>
            <div class="form-group col input-status-abono-<?php echo $pedido->id_pedido ?>" style="display:<?php if($pedido->pe_pago_status == 'ABONADO') echo 'block'; else echo 'none';?>">
                <div class="input-group">
                    <span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
                    <input type="text" class="form-control" name="abono_pedido" value="0">
                </div>
            </div> -->
        </div>
        <div class="form-row">
            <div class="form-group col">
                <label>Forma Pago</label>
                <div class="input-group">
                    <span class="input-group-addon"><span class="icon icon-credit-card"></span></span>
                    <select name="forma_pago" class="form-control select-pago" disabled>
                        <option value="{{$pedido->pe_forma_pago}}"selected hidden>{{$pedido->pe_forma_pago}}</option>
                        <option value="">Forma Pago</option>
                        <option value="EFECTIVO">EFECTIVO</option>
                        <option value="CHEQUE">CHEQUE</option>
                        <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                        <option value="DEPOSITO">DEPOSITO</option>
                    </select>
                </div>
            </div>
            <!-- <div class="fomr-group col input-cheque" style="display:<?php if($pedido->pe_forma_pago == 'CHEQUE') echo 'block'; else echo 'none';?>">
                <div class="input-group">
                    <span class="input-group-addon">NO. CHEQUE</span>
                    <input type="text" class="form-control" value="{{$pedido->no_cheque}}" placeholder="No. Cheque" name="no_cheque">
                </div>
            </div> -->
            <div class="form-group col">
                <label>Termino Pago</label>
                <div class="input-group">
                    <span class="input-group-addon"><span class="icon icon-clock"></span></span>
                    <select name="termino" class="form-control select-termino" required>
                        <option value="{{$pedido->pe_termino}}"selected hidden>{{$pedido->pe_termino}}</option>
                        <option value="">Termino</option>
                        <option value="CONTADO">CONTADO</option>
                        <option value="1 DIA">1 DIA</option>
                        <option value="1 SEMANA">1 SEMANA</option>
                        <option value="1 MES">1 MES</option>
                        <option value="1 BIMESTRE">1 BIMESTRE</option>
                        <option value="1 TRIMESTRE">1 TRIMESTRE</option>
                    </select>
                </div>
            </div>
            <div class="form-group col">
                <label>Estatus Pedido</label>
                <div class="input-group">
                    <span class="input-group-addon"><span class="icon icon-hammer"></span></span>
                    <select class="form-control" name="status" required>
                        <option value="{{$pedido->pe_status}}" hidden selected>{{$pedido->pe_status}}</option>
                        <option value="PENDIENTE PARA PRODUCCION">PENDIENTE PARA PRODUCCION</option>
                        <!-- <option value="EN PRODUCCION">EN PRODUCCION</option> -->
                        <option value="PREPARADO PARA ENTREGAR">PREPARADO PARA ENTREGAR</option>
                        <!-- <option value="EN CAMINO">EN CAMINO</option> -->
                        <option value="ENTREGADO">ENTREGADO</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <label>Destino</label>
                <div class="input-group">
                    <span class="input-group-addon"><span class="icon icon-road"></span></span>
                    <select name="destino" class="form-control" required>
                        <option value="0" hidden>{{$pedido->pe_destino_pedido . " - " . $pedido->pe_destino_ciudad}}</option>
                        <option value="">Seleccionar Destino</option>
                        @foreach($pedido->cliente->domicilios as $dom)
                            <option value="{{$dom->dom_calle . ', ' . $dom->dom_colonia . '>' . $dom->dom_ciudad}}">{{$dom->dom_calle . ", " . $dom->dom_colonia . " - " . $dom->dom_ciudad}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col">
                <label>Importe</label>
                <div class="input-group">
                    <span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>
                    <input type="text" class="form-control input-subtotal-<?php echo $pedido->id_pedido?>" name="importe" value="{{$pedido->pe_importe}}" placeholder="IMPORTE" readonly required>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <label>Memo</label>
                <div class="input-group">
                    <span class="input-group-addon"><span class="icon icon-eye"></span></span>
                    <textarea name="memo" class="form-control" placeholder="MEMO">{{$pedido->pe_memo}}</textarea>
                </div>
            </div>
        </div>
        <div class="col text-center bg-danger text-white" style="font-size:20px;"><b>Pedido</b></div>
        <div class="AddProducto-<?php echo $pedido->id_pedido ?>">
            @foreach($pedido->productos as $index=>$detalle)
                <div class="form-row">
                    <input type="hidden" value="{{$pedido->id_pedido}}" id="id">
                    <div class="form-group col-md-1 DivCantidad">
                        <label>Cant.</label>
                        <input type="text" name="cantidad2[]" class="form-control" value="{{$detalle->pivot->det_prod_cantidad}}" placeholder="NECESITA" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Producto</label>
                        <select name="producto2[]" class="form-control select-producto2" required>
                            <option value="{{$detalle->id_producto}}">{{$detalle->pd_nombre}}</option>
                            @foreach($productos as $pro)
                                <option value="{{$pro->id_producto}}">{{$pro->pd_nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" class="cantidad_producto" value="0">
                    <div class="form-group col-md-2 DivPrecio">
                        <label>Precio</label>
                        <input type="text" name="precio2[]" class="form-control precio-<?php echo $pedido->id_pedido?>" value="{{$detalle->pivot->det_prod_precio}}" placeholder="$" required>
                    </div>
                    <div class="form-group col-md-2 DivSub">
                        <label>Sub. Total</label>
                        <input type="text" class="form-control subtotal-<?php echo $pedido->id_pedido?>" name="subtotal2[]" value="{{$detalle->pivot->det_prod_subtotal}}" readonly>
                    </div>
                    @if($index != 0)
                        <div class="form-group col-md-1">   
                            <button type="button" class="btn btn-danger btn-delete3" style="margin-top:32px;"><span class="icon icon-bin2"></span></button>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="form-row" style="margin-bottom:15px;">
            <div class="text-center col">
                <button type="button" class="btn btn-dark btn-AddProducto2" value="<?php echo $pedido->id_pedido?>"><span class="icon icon-plus" ></span>Agregar</button>
            </div>
        </div>
        <hr>
        <div class="form-row">
            <div class="text-left col-md-4">
                <button type="reset" class="btn btn-dark"><span class="icon icon-fire"></span> Limpiar</button>
            </div>
            <div class="text-center col-md-4">
                <a href="<?php echo URL::previous() ?>" class="btn btn-danger" data-dismiss="modal"><span class="icon icon-undo2"></span> Cancelar</a>
            </div>
            <div class="text-right col-md-4">
                <button type="submit" class="btn btn-dark"><span class="icon icon-pencil"></span> Modificar</button>
            </div>
        </div>
        <br><br>
    </form>
@stop

@section('js')
    <script src="<?php echo asset('js/pedido.js') ?>"></script>
    <script>
        /* Modal Updated */
        $('.fecha_pedido2').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true,
            language:'es',
            title:"Fecha Pedido"
        });

        $('.fecha_entrega2').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true,
            language:'es',
            startDate: $('input[name="fecha_pedido2"]').val(),
            title:"Fecha Programada"
        });

        $('.fecha_pedido2').datepicker().on('changeDate',function(e){
            $('.fecha_entrega2').datepicker('setStartDate',$('input[name="fecha_pedido2"]').val());
        });
    </script>
@stop

