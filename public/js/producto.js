$(document).ready(function(){
    
    $('#type').change(function(){
        var tipo = $(this).val();
        if(tipo == "ENSAMBLADO"){
            $('.input-costo').prop('readonly',true);
            //GetAjaxMateriaPrima(0);
            $('.AppendBtn').append('<button type="button" class="btn btn-dark btn-AddMaterial"><span class="icon icon-plus"></span> Material</button>');
            /*$('.AppendBtn').append('<button type="button" class="btn btn-danger btn-AddProducto" style="margin-left:5px;"><span class="icon icon-plus"></span> Producto</button>');*/
        } else {
            $('.AddEnsamblado,.AppendBtn').empty();
            $('.input-costo').val('').prop('readonly',false);
        }
    });

    $(document).on('click','.btn-AddMaterial',function(){
        var campos = GetAjaxMateriaPrima(1);
        $('.AddEnsamblado').append(campos);
    });

    /*$(document).on('click','.btn-AddProducto',function(){
        var campos = GetAjaxProducto(1);
        $('.AddEnsamblado').append(campos);
    });*/

    $(document).on('click','.BtnUpdatedMaterial',function(){
        var campos = GetAjaxMateriaPrima(1);
        $(this).parent('div').parent('div').parent('div').find('div.AddRequisitos').append(campos);
        $(this).parent('div').parent('div').parent('div').find('div.modal-footer').find('button[type="submit"]').prop('disabled',false);

    });

    /*$(document).on('click','.BtnUpdatedProducto',function(){
        var campos = GetAjaxProducto(1);
        $(this).parent('div').parent('div').parent('div').find('div.AddRequisitos').append(campos);
        $(this).parent('div').parent('div').parent('div').find('div.modal-footer').find('button[type="submit"]').prop('disabled',false);

    });*/

    $(document).on('click','.btn-delete', function(){
        var cont = 0;
        // Ver cuantos campos hay en updated de cada modal
        $(this).parent('div.form-group').parent('div.form-row').parent('div.AddRequisitos').find('div.form-row').each(function(){
            cont++;
        });
        
        // si cont es uno o menor de 2 -> se eliminara el ultimo campo y bloqueamos el boton por que no existiran campos que enviar
        if (cont < 2) {
            $(this).parent('div.form-group').parent('div.form-row').parent('div.AddRequisitos').parent('div').find('div.modal-footer').find('button[type="submit"]').prop('disabled',true);
        }
        // borrar campo 
        $(this).parent('div.form-group').parent('div.form-row').remove();
        CalcularCosto();
    });

    $('button[type="reset"]').click(function(){
        $('.AddEnsamblado,.AppendBtn').empty(); 
        $('.input-costo').prop('readonly',false);     
    });

    $(document).on('change','.select-material',function(){
        var id    = $(this).val();
        var valor = 0;
        var cantidad = 0;
        $.ajax({
            url:'/GetPrecioMateriaPrimaSelected',
            dataType:'json',
            type:'GET',
            async: false,
            data: {id:id},
            success:function(data){
                if(data != ""){
                    valor = data.mp_precio;
                    cantidad = data.mp_cantidad;
                }
            }
        });
        $(this).parent('div.form-group').parent('div.form-row').find('div.DivPrecio').find('input').val(valor);
        $(this).parent('div.form-group').parent('div.form-row').find('input.cantidad_materiaprima').val(cantidad);
        CalcularSubTotal();
        CalcularCosto();
    });

    /*$(document).on('change','.select-producto',function(){
        var id    = $(this).val();
        var valor = 0;
        var cantidad = 0;
        $.ajax({
            url:'/GetPrecioProductoSelected',
            dataType:'json',
            type:'GET',
            async: false,
            data: {id:id},
            success:function(data){
                if(data != ""){
                    valor = data.pd_precio_venta;
                    cantidad = data.pd_cantidad;
                }
            }
        });
        $(this).parent('div.form-group').parent('div.form-row').find('div.DivPrecio').find('input').val(valor);
        $(this).parent('div.form-group').parent('div.form-row').find('input.cantidad_materiaprima').val(cantidad);
        CalcularSubTotal();
        CalcularCosto();
    });*/

    $(document).on('keyup','input[name="precio[]"],input[name="precio_producto[]"]', function(){
        CalcularSubTotal();
        CalcularCosto();
    });

    $(document).on('keyup','input[name="cantidad[]"],input[name="cantidad_producto[]"]', function(){
        CalcularSubTotal();
        CalcularCosto();
    });

    /*$(document).on('keyup','input[name="unidad[]"]', function(){
        CalcularSubTotal();
        CalcularCosto();
    });*/

    function CalcularCosto(){
        var subtotal = 0;
        $.each($('input.subtotal'),function(){
            subtotal += parseFloat($(this).val());
        });
        subtotal = Math.round(subtotal * 100 / 100);
        $('.input-costo').val(subtotal);
    }

    function CalcularSubTotal(){
        var cantidad = 0;
        var precio   = 0;
        var oper     = 0;
        $.each($('input[name="precio[]"]'),function(){
            precio   = $(this).val();
            unidades = $(this).parent('div.form-group').parent('div.form-row').find('input.cantidad_materiaprima').val();
            cantidad = $(this).parent('div.form-group').parent('div.form-row').find('div.DivCantidad').find('input[name="cantidad[]"]').val();
            oper = (parseFloat(cantidad) * parseFloat(precio)) / parseFloat(unidades);
            $(this).parent('div.form-group').parent('div.form-row').find('div.DivSub').find('input.subtotal').val(oper);
        });

        $.each($('input[name="precio_producto[]"]'),function(){
            precio   = $(this).val();
            unidades = $(this).parent('div.form-group').parent('div.form-row').find('input.cantidad_materiaprima').val();
            cantidad = $(this).parent('div.form-group').parent('div.form-row').find('div.DivCantidad').find('input[name="cantidad_producto[]"]').val();
            oper = (parseFloat(cantidad) * parseFloat(precio)) / parseFloat(unidades);
            $(this).parent('div.form-group').parent('div.form-row').find('div.DivSub').find('input.subtotal').val(oper);
        });
    }

    function GetAjaxMateriaPrima(btn){
        var form = '';
        $.ajax({
            url:'/GetMateriaPrima',
            dataType:'json',
            type:'GET',
            async: false,
            success:function(data){
                if(data != ""){
                    form += '<div class="form-row">'+
                                '<div class="form-group col-md-1 DivCantidad">'+
                                    '<label>Cant.</label>'+
                                    '<input step="0.0001" type="number" name="cantidad[]" class="form-control" value="1.0000" placeholder="NECESITA" required>'+
                                '</div>'+
                                '<div class="form-group col-md-6">'+
                                    '<label>Material</label>'+
                                    '<select name="material[]" class="form-control select-material" required>'+
                                        '<option value="" selected>Seleccionar</option>';
                    
                    $.each(data,function(index, material){
                        form += '<option value="'+material.id_materia_prima+'">'+material.mp_nombre+' '+material.mp_cantidad+' '+material.mp_unidad+  '</option>';
                    });
                    
                    form +=         '</select>'+
                                '</div>'+
                                '<input type="hidden" class="cantidad_materiaprima" value="0">'+
                                '<div class="form-group col-md-2 DivPrecio">'+
                                    '<label>Precio</label>'+
                                    '<input type="number" name="precio[]" class="form-control" value="0.0000" step="0.0001" placeholder="$" required>'+
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

                    //$('.AddEnsamblado').append(form);
                }
            }
        });
        return form;
    }

    function GetAjaxProducto(btn){
        var form = '';
        $.ajax({
            url:'/GetProducto',
            dataType:'json',
            type:'GET',
            async: false,
            success:function(data){
                if(data != ""){
                    form += '<div class="form-row">'+
                                '<div class="form-group col-md-1 DivCantidad">'+
                                    '<label>Cant.</label>'+
                                    '<input step="0.01" type="number" name="cantidad_producto[]" class="form-control" value="1" placeholder="NECESITA" required>'+
                                '</div>'+
                                '<div class="form-group col-md-6">'+
                                    '<label>Producto</label>'+
                                    '<select name="productos[]" class="form-control select-producto" required>'+
                                        '<option value="" selected>Seleccionar</option>';
                    
                    $.each(data,function(index, producto){
                        form += '<option value="'+producto.id_producto+'">'+producto.pd_nombre+'</option>';
                    });
                    
                    form +=         '</select>'+
                                '</div>'+
                                '<input type="hidden" class="cantidad_materiaprima" value="0.0000" step="0.0001">'+
                                '<div class="form-group col-md-2 DivPrecio">'+
                                    '<label>Precio</label>'+
                                    '<input type="number" name="precio_producto[]" class="form-control" value="0" placeholder="$" required>'+
                                '</div>'+
                                '<div class="form-group col-md-2 DivSub">'+
                                    '<label>Sub. Total</label>'+
                                    '<input type="text" class="form-control subtotal" name="subtotal_producto[]" value="0" readonly>'+
                                '</div>';
                    if(btn){
                        form += '<div class="form-group col-md-1">'+   
                                    '<button type="button" class="btn btn-danger btn-delete" style="margin-top:32px;"><span class="icon icon-bin2"></span></button>'+
                                '</div>';
                    }

                    form += '</div>';

                    //$('.AddEnsamblado').append(form);
                }
            }
        });

        return form;
    }

    function FormatMoney(money){
        var v_money = money.toFixed(4).replace(/(\d)(?=(\d\d\d)+(?!\d))/g,"$1,");
        return v_money;
    }
});