@extends('Template.Body')

@section('title','Imprimir Ticket Movimiento')

@section('body')
    <div class="card text-black bg-light" style="width:30%;margin:15% 0 0 35%;">
        <div class="card-header text-center text-white bg-danger"><b>IMPRIMIR TICKET DE MOVIMIENTO</b></div>
        <table class="table table-hover table-sm">
            <thead>
                <th class="text-center">Movimiento No. <?php echo $datos['id'] . " Del dia: " ."  ". $datos['fecha'] ?></th>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">
                        <a href="<?php echo route('caja') ?>" class="btn btn-danger">
                            <span class="icon icon-undo2"></span> Salir
                        </a>
                        <a href="<?php echo route('ticket_movimiento',['id'=>$datos['id']]) ?>" class="btn btn-success">
                            <span class="icon icon-file-pdf"></span> Ticket Movimiento
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@stop