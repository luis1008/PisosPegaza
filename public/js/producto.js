$(document).ready(function(){
    
    $('#type').change(function(){
        var tipo = $(this).val();
        if(tipo == "ENSAMBLADO"){
            $('.input-costo').prop('readonly',true);
            GetAjaxMateriaPrima(0);
            $('.AppendBtn').append('<button type="button" class="btn btn-primary btn-AddMaterial"><span class="icon icon-plus"></span> Material</button>');
        } else {
            $('.AddEnsamblado,.AppendBtn').empty();
        }
    });

    $(document).on('click','.btn-AddMaterial',function(){
        GetAjaxMateriaPrima(1);
    });

    $(document).on('click','.btn-delete', function(){
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

    $(document).on('keyup','input[name="precio[]"]', function(){
        CalcularSubTotal();
        CalcularCosto();
    });

    $(document).on('keyup','input[name="cantidad[]"]', function(){
        CalcularSubTotal();
        CalcularCosto();
    });

      $(document).on('keyup','input[name="unidad[]"]', function(){
        CalcularSubTotal();
        CalcularCosto();
    });

    function CalcularCosto(){
        var subtotal = 0;
        $.each($('input.subtotal'),function(){
            subtotal += parseFloat($(this).val());
        });
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
    }

    function GetAjaxMateriaPrima(btn){
        $.ajax({
            url:'/GetMateriaPrima',
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
                                    '<input type="text" name="precio[]" class="form-control" value="0" placeholder="$" required>'+
                                '</div>'+
                                '<div class="form-group col-md-2 DivSub">'+
                                    '<label>Sub. Total</label>'+
                                    '<input type="text" class="form-control subtotal" name="subtotal[]" value="0" readonly>'+
                                '</div>';
                    if(btn){
                        form += '<div class="form-group col-md-1">'+   
                                    '<button type="button" class="btn btn-danger btn-delete" style="margin-top:32px;"><span class="icon icon-bin2"></span></button>'+
                                '</div>';
                    }

                    form += '</div>';

                    $('.AddEnsamblado').append(form);
                }
            }
        });
    }
});