@extends('Template.Body')

@section('title','Reporte de Compras')

@section('body')
    <form action="{{route('get_compras')}}" method="GET">
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

    <div class="card text-black bg-light">
        <div class="card-header text-center text-white bg-danger"><b>EGRESOS</b></div>
        <table class="table table-hover table-sm">
            <thead>
                <th width="10" class="text-center"># Compra</th>
                <th width="10" class="text-center">Proveedor</th>
                <th width="50" class="text-center">Importe</th>
                <th width="100">Abonado</th>
                <th width="100">Fecha Compra</th>
            </thead>
            <tbody>
                <?php if(count($compras) < 1) { ?>
                    <tr>
                        <td colspan="5" class="text-center">NO SE ENCONTRO NINGÚN REGISTRO</td>
                    </tr>
                <?php } ?>
                <?php foreach ($compras as $compra) { ?>
                    <tr>
                        <th class="text-center">{{$compra->cm_nota}}</th>
                         <td>{{$compra->proveedor->pv_nombre}}</td>
                        <td>{{'$'.number_format($compra->cm_total,2)}}</td>
                        <td>{{'$'.number_format($compra->cm_total_abonado,2)}}</td>
                        <td>{{$compra->created_at}}</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
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