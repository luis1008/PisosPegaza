@extends('Template.Body')

@section('title','Fallas del Vehiculo')

@section('body')
    <form action="{{route('view_fallas',$vehiculo->placas)}}" method="GET">
        <div class="form-row">
            <div class="col-md-1" style="margin-top:30px;">
                <a class="btn btn-danger" href="{{route('vehiculo')}}"><span class="icon icon-exit"></span> Salir</a>
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
        <div class="card-header text-center text-white bg-danger"><b>FALLAS</b></div>
        <table class="table table-hover table-sm">
            <thead>
                <th width="10" class="text-center"># Falla</th>
                <th width="50" class="text-center">Fecha</th>
                <th width="100">Lugar Reparación</th>
                <th width="100">Costo Reparación</th>
                <th width="100" class="text-center">Descripción Falla</th>
            </thead>
            <tbody>
                <?php if(count($fallas) < 1) { ?>
                    <tr>
                        <td colspan="5" class="text-center">NO SE ENCONTRO NINGÚN REGISTRO</td>
                    </tr>
                <?php } ?>
                <?php foreach ($fallas as $falla) { ?>
                    <tr>
                        <th class="text-center">{{$falla->id_falla}}</th>
                        <td>{{$falla->created_at}}</td>
                        <td>{{$falla->fa_lugar}}</td>
                        <td>${{number_format($falla->fa_costo,2)}}</td>
                        <td>{{$falla->fa_descripcion}}</td>
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