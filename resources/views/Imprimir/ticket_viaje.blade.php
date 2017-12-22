@extends('Template.Body')

@section('title','Imprimir Ticket Viaje')

@section('body')
    <div class="card text-black bg-light" style="width:30%;margin:15% 0 0 35%;">
        <div class="card-header text-center text-white bg-danger"><b>IMPRIMIR TICKET VIAJE</b></div>
        <table class="table table-hover table-sm">
            <thead>
                <th class="text-center">Viaje a <?php echo $datos['destino'] . " - " . $datos['fecha'] ?></th>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">
                        <a href="<?php echo route('caja') ?>" class="btn btn-danger">
                            <span class="icon icon-undo2"></span> Salir
                        </a>
                        <a href="<?php echo route('ticket_viaje',['id'=>$datos['id']]) ?>" target="_blank()" class="btn btn-success">
                            <span class="icon icon-file-pdf"></span> Ticket Viaje
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@stop