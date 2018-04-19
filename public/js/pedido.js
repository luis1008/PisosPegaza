$(document).ready(function(){
    //ABRE EL BOTON PARA AGREGAR MAS PRODUCTOS
    GetAjaxProducto(0);
    $(document).on('click','.btn-AddProducto',function(){
        GetAjaxProducto(1);
    });

    $(document).on('click','.btn-delete', function(){
        $(this).parent('div.form-group').parent('div.form-row').remove();
        CalcularCosto();
    });

    $('button[type="reset"]').click(function(){
        $('.AddProducto,.AppendBtn').empty(); 
        GetAjaxProducto(0);
        $('.input-importe').prop('readonly',false); 
    });

    $('.select-status-pago').change(function(){
        var valor = $(this).val();
        if(valor === "ABONADO"){
            $('.input-status-abono').show();
        } else {
            $('.input-status-abono').hide();
            $('.input-status-abono').find('div.input-group').find('input').val("0");
        }
    });

    $('.select-status-pago2').change(function(){
        var id    = $(this).attr('id');
        var valor = $(this).val();
        if(valor === "ABONADO"){
            $('.input-status-abono-'+id).show();
        } else {
            $('.input-status-abono-'+id).hide();
            $('.input-status-abono-'+id).find('div.input-group').find('input').val("0");
        }
    });

    $('.select-pago').change(function(){
        var valor = $(this).val();
        if(valor === "CHEQUE"){
            $('.input-cheque').show();
        } else {
            $('.input-cheque').hide();
            $('.input-cheque').find('div.input-group').find('input').val("0");
        }
    });

    $('#cl').change(function(){
        var id = $(this).val();
        if(id == "add"){
            $('#pedido').modal('hide');
            $('#NewCliente').modal('show');
            $(this).val("");
        } else {
            $('#cli_id').val(id);
            $.get('/GetDomicilioCliente',{id:id}).done(function(data){
                //console.log(data);
                $('#dest').empty().append('<option value="">Seleccionar Destino</option><option value="add">Nuevo Domicilio</option>')
                $.each(data,function(index,domicilio){
                    $('#dest').append('<option value="'+domicilio.dom_calle+', '+domicilio.dom_colonia+'>'+domicilio.dom_ciudad+'">'+domicilio.dom_calle+' '+domicilio.dom_colonia+' '+domicilio.dom_ciudad+'</option>')
                });
            });
            $.get('/GetClienteSelected',{id:id}).done(function(data){
                $('.select-termino').val(data.cl_termino_credito);
                $('.select-pago').val(data.cl_forma_pago);
                if(data.cl_termino_credito == "CHEQUE"){
                    $('.input-cheque').show();
                } else {
                    $('.input-cheque').hide().val("0");
                }
            });

            $.get('/GetClienteSelected',{id:id}).done(function(data){
                $('.input-notas').val(data.cl_observacion);
            });
        }
    });

    $('.btn-closeCli').click(function(){
        $('#NewCliente').modal('hide');
        $('.form-clearCli').val("");
        $('#pedido').modal('show');
    });

    $('.btn-SubmitCli').click(function(){
        $.post('/Cliente',$('#form-Cli').serialize()).done(function(data){
            if (data === "exito") {
                $('#NewCliente').modal('hide');
            //  $('#ComprasMP, #ComprasArt').empty();
                $('.form-clearCli').val("");
                GetAjaxCliente();
                $('#pedido').modal('show');
                $('input[type="checkbox"]').prop('checked',false);
            }
        }).fail(function(error){
            $('.mensaje-error-ajax').empty();
            $.each(error.responseJSON,function(index, mensaje){
                $('.mensaje-error-ajax').append("<p style='color:red;font-weight:bold;'>"+mensaje[0]+"</p>");
            });
            $('#MensajeError').modal('show');
        });
    });

    function GetAjaxCliente(){
        $('#cl').empty();
        $.get("/GetCliente").done(function(data){
            var options = '';
            options += '<option value="">Seleccionar Cliente</option><option value="add">Nuevo Cliente</option>';
            $.each(data,function(index,cliente){
                options += '<option value="'+cliente.id_cliente+'">'+cliente.cl_nombre+'</option>';
            });
            $('#cl').append(options);
        });
    }

    $(document).on('change','.select-producto',function(){
        var id   = $(this).val();
        var valor = 0;
        $.ajax({
            url:'/GetPrecioUltimaVenta',
            dataType:'json',
            type:'GET',
            async: false,
            data: {id:id},
            success:function(data){
                if(data != ""){
                    valor = data;
                }
            }
        });
        $(this).parent('div.form-group').parent('div.form-row').find('div.DivPrecio').find('input').val(valor);
        CalcularSubTotal();
        CalcularCosto();
    });

    $(document).on('keyup','input[name="precio[]"]', function(){
        CalcularSubTotal();
        CalcularCosto();
    });

    $(document).on('keyup','input[name="cantidad[]"]', function(){
        CalcularSubTotal();
        CalcularCosto();
    });

    //CALCULA EL COSTO DEL PRODUCTO
    function CalcularCosto(){
        var subtotal = 0;
        $.each($('input.subtotal'),function(){
            subtotal += parseFloat($(this).val());
        });
        $('.input-subtotal').val(subtotal);
    }

    function CalcularSubTotal(){
        var cantidad = 0;
        var precio   = 0;
        var oper     = 0;
        $.each($('input[name="precio[]"]'),function(){
            precio   = $(this).val();
            cantidad = $(this).parent('div.form-group').parent('div.form-row').find('div.DivCantidad').find('input[name="cantidad[]"]').val();
            oper = parseFloat(cantidad) * parseFloat(precio);
            $(this).parent('div.form-group').parent('div.form-row').find('div.DivSub').find('input.subtotal').val(oper);
        });
    }
    
    //MUESTRA LOS PRODUCTOS DENTRO DEL SELECT
    function GetAjaxProducto(btn){
        $.ajax({
            url:'/GetProducto',
            dataType:'json',
            type:'GET',
            async: false,
            success:function(data){
                if(data != ""){
                    var form = '';
                    form += '<div class="form-row">'+
                                '<div class="form-group col-md-1 DivCantidad">'+
                                    '<label>Cant.</label>'+
                                    '<input type="text" name="cantidad[]" class="form-control" value="1" placeholder="NECESITA" required>'+
                                '</div>'+
                                '<div class="form-group col-md-6">'+
                                    '<label>Producto</label>'+
                                    '<select name="producto[]" class="form-control select-producto" required>'+
                                        '<option value="" selected>Seleccionar</option>';
                    
                    $.each(data,function(index, producto){
                        form += '<option value="'+producto.id_producto+'">'+producto.pd_nombre+ '</option>';
                    });
                    
                    form +=         '</select>'+
                                '</div>'+
                                '<input type="hidden" class="cantidad_producto" value="0">'+
                                '<div class="form-group col-md-2 DivPrecio">'+
                                    '<label>Precio</label>'+
                                    '<input type="text" name="precio[]" class="form-control" value="0.0000" step="0.0001" placeholder="$" required>'+
                                '</div>'+
                                '<div class="form-group col-md-2 DivSub">'+
                                    '<label>Sub. Total</label>'+
                                    '<input type="text" class="form-control subtotal" name="subtotal[]" value="0.0000" step="0.0001" readonly>'+
                                '</div>';
                    if(btn){
                        form += '<div class="form-group col-md-1">'+   
                                    '<button type="button" class="btn btn-danger btn-delete" style="margin-top:32px;"><span class="icon icon-bin2"></span></button>'+
                                '</div>';
                    }

                    form += '</div>';

                    $('.AddProducto').append(form);
                }
            }
        });
    }    

    //CALCULA EL COSTO DEL PRODUCTO UPDATE
    function CalcularCostoUpdate(id){
        var subtotal = 0;
        $.each($('input.subtotal-'+id),function(){
            subtotal += parseFloat($(this).val());
        });
        $('.input-subtotal-'+id).val(subtotal);
    }

    function CalcularSubTotalUpdate(id){
        var cantidad = 0;
        var precio   = 0;
        var oper     = 0;
        $.each($('input.precio-'+id),function(){
            precio   = $(this).val();
            cantidad = $(this).parent('div.form-group').parent('div.form-row').find('div.DivCantidad').find('input[name="cantidad2[]"]').val();
            oper = parseFloat(cantidad) * parseFloat(precio);
            $(this).parent('div.form-group').parent('div.form-row').find('div.DivSub').find('input.subtotal-'+id).val(oper);
        });
    }

    //MUESTRA LOS PRODUCTOS DENTRO DEL SELECT UPDATE
    function GetAjaxProductoUpdate(btn,id){
        $.ajax({
            url:'/GetProducto',
            dataType:'json',
            type:'GET',
            async: false,
            success:function(data){
                if(data != ""){
                    var form = '';
                    form += '<div class="form-row">'+
                                '<input type="hidden" value="'+id+'" id="id">'+
                                '<div class="form-group col-md-1 DivCantidad">'+
                                    '<label>Cant.</label>'+
                                    '<input type="text" name="cantidad2[]" class="form-control" value="1" placeholder="NECESITA" required>'+
                                '</div>'+
                                '<div class="form-group col-md-6">'+
                                    '<label>Producto</label>'+
                                    '<select name="producto2[]" class="form-control select-producto2" required>'+
                                        '<option value="" selected>Seleccionar</option>';
                    
                    $.each(data,function(index, producto){
                        form += '<option value="'+producto.id_producto+'">'+producto.pd_nombre+ '</option>';
                    });
                    
                    form +=         '</select>'+
                                '</div>'+
                                '<input type="hidden" class="cantidad_producto" value="0">'+
                                '<div class="form-group col-md-2 DivPrecio">'+
                                    '<label>Precio</label>'+
                                    '<input type="text" name="precio2[]" class="form-control precio-'+id+'" value="0.0000" step="0.0001" placeholder="$" required>'+
                                '</div>'+
                                '<div class="form-group col-md-2 DivSub">'+
                                    '<label>Sub. Total</label>'+
                                    '<input type="text" class="form-control subtotal-'+id+'" name="subtotal2[]" value="0.0000" step="0.0001" readonly>'+
                                '</div>';
                    if(btn){
                        form += '<div class="form-group col-md-1">'+   
                                    '<button type="button" class="btn btn-danger btn-delete3" style="margin-top:32px;"><span class="icon icon-bin2"></span></button>'+
                                '</div>';
                    }

                    form += '</div>';

                    $('.AddProducto-'+id).append(form);
                }
            }
        });
    }    

    $(document).on('keyup','input[name="precio2[]"]', function(){
        var id = $(this).parent('div.form-group').parent('div.form-row').find('input#id').val();
        CalcularSubTotalUpdate(id);
        CalcularCostoUpdate(id);
    });

    $(document).on('keyup','input[name="cantidad2[]"]', function(){
        var id = $(this).parent('div.form-group').parent('div.form-row').find('input#id').val();
        CalcularSubTotalUpdate(id);
        CalcularCostoUpdate(id);
    });

    $(document).on('click','.btn-delete3', function(){
        var id = $(this).parent('div.form-group').parent('div.form-row').find('input#id').val();
        $(this).parent('div.form-group').parent('div.form-row').remove();
        CalcularCostoUpdate(id);
    });

    $(document).on('change','.select-producto2',function(){
        var pedido = $(this).parent('div.form-group').parent('div.form-row').find('input#id').val();
        var id     = $(this).val();
        var valor = 0;
        $.ajax({
            url:'/GetPrecioUltimaVenta',
            dataType:'json',
            type:'GET',
            async: false,
            data: {id:id},
            success:function(data){
                if(data != ""){
                    valor = data;
                }
            }
        });
        $(this).parent('div.form-group').parent('div.form-row').find('div.DivPrecio').find('input').val(valor);
        CalcularSubTotalUpdate(pedido);
        CalcularCostoUpdate(pedido);
    });


    $(document).on('click','.btn-AddProducto2',function(){
        var id = $(this).val();
        GetAjaxProductoUpdate(1,id);
    });

    //FUNCION DE AGREGAR DOMICILIO A CLIENTE DESDE EL PEDIDO
    $(document).on('change','#dest',function(){
        var id = $(this).val();
        if (id === "add") {
            $('#Domicilio').modal('show');
            $('#pedido').modal('hide');
            $(this).val("");
        } 
    });

    $('.btn-SubmitDom').click(function(){
        $.post('/SetDomicilios',$('#form-Dom').serialize()).done(function(data){
            if (data === "exito") {
                $('#Domicilio').modal('hide');
                $('.form-clearDom').val("");
                GetAjaxDomicilios();
                $('#pedido').modal('show');
            }
        }).fail(function(error){
            $('.mensaje-error-ajax').empty();
            $.each(error.responseJSON,function(index, mensaje){
                $('.mensaje-error-ajax').append("<p style='color:red;font-weight:bold;'>"+mensaje[0]+"</p>");
            });
            $('#MensajeError').modal('show');
        });
    });

    $('.btn-closeDom').click(function(){
        $('#Domicilio').modal('hide');
        $('.form-clearDom').val("");
        $('#pedido').modal('show');
    });

    function GetAjaxDomicilios(){
        var id = $('#cl').val();
        $.get('/GetDomicilioCliente',{id:id}).done(function(data){
            //console.log(data);
            $('#dest').empty().append('<option value="">Seleccionar Destino</option><option value="add">Nuevo Domicilio</option>')
            $.each(data,function(index,domicilio){
                $('#dest').append('<option value="'+domicilio.dom_calle+', '+domicilio.dom_colonia+'>'+domicilio.dom_ciudad+'">'+domicilio.dom_calle+' '+domicilio.dom_colonia+' '+domicilio.dom_ciudad+'</option>')
            });
        });
    }

    $('input[name="cobrar[]"]').change(function(){
        var cont = 0;
        $('input[name="cobrar[]"]').each(function(){
            if (this.checked) {
                cont++;
            }
        });
        $('.PedidoCheck').each(function(){
            if (this.checked) {
                cont++;
            }
        });
        if (cont > 0) {
            $('.BtnPedidoNuevo').prop('disabled',false);
        } else {
            $('.BtnPedidoNuevo').prop('disabled',true);
        }
    });
});