@extends('Template.Body')

@section('title','Imprimir Nota Pedido')

@section('body')
    <div class="card text-black bg-light" style="width:30%;margin:15% 0 0 35%;">
        <div class="card-header text-center text-white bg-danger"><b>IMPRIMIR NOTA PEDIDO</b></div>
        <table class="table table-hover table-sm">
            <thead>
                <th class="text-center">N° <?php echo $datos['no_nota'] ?></th>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">
                        <a href="<?php echo route('caja') ?>" class="btn btn-danger">
                            <span class="icon icon-undo2"></span> Salir
                        </a>
                        <a href="<?php echo route('pdf_pedido',['id'=>$datos['id'],'preorden'=>$datos['orden']]) ?>" target="_blank()" class="btn btn-success" target="_blank">
                            <span class="icon icon-file-pdf"></span> Nota Pedido
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@stop