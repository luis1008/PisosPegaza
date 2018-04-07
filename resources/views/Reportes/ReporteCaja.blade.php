@extends('Template.Body')

@section('title','Reporte de Caja')

@section('body')
    <form action="{{route('get_caja')}}" method="GET">
        <div class="form-row">
            <div class="col-md-1" style="margin-top:30px;">
                <a class="btn btn-danger" href="{{route('caja')}}"><span class="icon icon-exit"></span> Salir</a>
            </div>

            <div class="form-group col" id="container-picker">
                <label>Fecha Inicial</label>
                <div class="input-group">
                    <div class="input-group-addon"><span class="icon icon-calendar"></span></div>
                    <input type="text" class="form-control readonly form-control-sm" value="{{date('Y-m-d')}}" name="inicial">
                </div>
            </div>

            <div class="form-group col" id="container-picker2">
                <label>Fecha Final</label>
                <div class="input-group">
                    <div class="input-group-addon"><span class="icon icon-calendar"></span></div>
                    <input type="text" class="form-control readonly form-control-sm" name="final">
                </div>
            </div>

            <div class="col-md-1" style="margin-top:30px;">
                <button class="btn btn-dark" type="submit"><span class="icon icon-search"></span> Buscar</button>
            </div>
        </div>
    </form>
    <br>
    <div class="card">
        <!--INFRESOS-->
        <div class="card-header text-center text-white bg-danger" data-toggle="collapse" href="#CollapseIngresos" aria-expanded="true" aria-controls="CollapseIngresos"><b><span class="icon icon-circle-down"></span> INGRESOS</b></div>
                <div id="CollapseIngresos" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
        <table class="table table-hover table-sm">
            <thead>
                <th width="10" class="text-center">Fecha</th>
                <th width="10" class="text-center">Concepto Ingreso</th>
                <th width="100">Importe de Nota</th>
                <th width="100">Ingreso</th>
                <th width="100">Saldo</th>
            </thead>
            <tbody>
                <?php if(count($cajas) < 1) { ?>
                    <tr>
                        <td colspan="5" class="text-center">NO SE ENCONTRO NINGÚN REGISTRO</td>
                    </tr>
                <?php } ?>
                <?php foreach ($cajas as $caja) { ?>
                    <tr>
                        <th class="text-center">{{$caja->pe_fecha_pedido}}</th>
                         <td>{{'Nota'." ".$caja->pe_nota.":"." ".$caja->cliente->cl_nombre}}</td>
                        <td>{{'$'.number_format($caja->pe_importe,2)}}</td>
                        <td>{{'$'.number_format($caja->pe_total_abonado,2)}}</td>
                        <?php $total=$caja->pe_importe - $caja->pe_total_abonado ?>
                        <td><?php echo '$'. number_format($total,2) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
    </div>
    <br>
    <br>
    <br>
<div class="card">
    <!--EGRESOS-->
    <div class="card-header text-center text-white bg-dark" data-toggle="collapse" href="#CollapseEgresos" aria-expanded="true" aria-controls="CollapseEgresos"><b><span class="icon icon-circle-down"></span> EGRESOS</b></div>
        <div id="CollapseEgresos" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
        <table class="table table-hover table-sm">
            <thead>
                <th width="10" class="text-center">Fecha</th>
                <th width="10" class="text-center">Concepto Ingreso</th>
                <th width="100">Ingreso</th>
                <th width="100">Saldo</th>
            </thead>
            <tbody>
                <?php if(count($cajas) < 1) { ?>
                    <tr>
                        <td colspan="5" class="text-center">NO SE ENCONTRO NINGÚN REGISTRO</td>
                    </tr>
                <?php } ?>
                <?php foreach ($cajas as $caja) { ?>
                    <tr>
                        <th class="text-center">{{$caja->pe_fecha_pedido}}</th>
                        <td>{{$caja->pe_nota}}</td>
                        <td>{{'$'.number_format($caja->pe_total_abonado,2)}}</td>
                        <?php $total=$caja->pe_importe - $caja->pe_total_abonado ?>
                        <td><?php echo '$'. number_format($total,2) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
</div>
@stop

@section('js')
    <script>
        $(document).ready(function(){
            $('input[name="inicial"]').datepicker({
                format: 'yyyy-mm-dd',
                autoclose:true,
                language:'es',
                endDate: $('input[name="inicial"]').val(),
                clearBtn: true,
                title:"Fecha Inicial"
            });

            $('input[name="final"]').datepicker({
                format: 'yyyy-mm-dd',
                autoclose:true,
                language:'es',
                startDate: $('input[name="inicial"]').val(),
                endDate: $('input[name="inicial"]').val(),
                clearBtn: true,
                title:"Fecha Final"
            });

            $('input[name="inicial"]').datepicker().on('changeDate',function(e){
                $('input[name="final"]').datepicker('setStartDate',$('input[name="inicial"]').val());
            });
        });
    </script>
@stop