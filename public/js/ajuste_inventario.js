$(document).ready(function(){

	$('.BtnAjusteProducto').click(function(){
		var form = GetAjaxProducto(1);
		$('.AddAjuste').append(form);
		$('.BtnAjusteInventario').prop('disabled',false);
	});

	$('.BtnAjusteMaterial').click(function(){
		var form = GetAjaxMateriaPrima(1);
		$('.AddAjuste').append(form);
		$('.BtnAjusteInventario').prop('disabled',false);
	});

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
                                '<div class="form-group col-md-2">'+
                                    '<label>Cant.</label>'+
                                    '<input step="0.01" type="number" name="CantMaterial[]" class="form-control" value="1" placeholder="NECESITA" required>'+
                                '</div>'+
                                '<div class="form-group col-md-7">'+
                                    '<label>Material</label>'+
                                    '<select name="AjusteMaterial[]" class="form-control select-material" required>'+
                                        '<option value="" selected>Seleccionar</option>';
                    
                    $.each(data,function(index, material){
                        form += '<option value="'+material.id_materia_prima+'">'+material.mp_nombre+' '+material.mp_cantidad+' '+material.mp_unidad+  '</option>';
                    });
                    
                    form +=         '</select>'+
                                '</div>'+
                                '<div class="form-group col-md-2">'+
                                    '<label>Operación</label>'+
                                    '<select name="OperacionMaterial[]" class="form-control" required>'+
                                    	'<option value="">Seleccionar</option>'+
                                    	'<option value="SUMA">AGREGAR</option>'+
                                    	'<option value="RESTA">REMOVER</option>'+
                                    '</select>'+
                                '</div>';
                    if(btn){
                        form += '<div class="form-group col-md-1">'+   
                                    '<button type="button" class="btn btn-danger BtnDeleteAjuste" style="margin-top:32px;"><span class="icon icon-bin2"></span></button>'+
                                '</div>';
                    }

                    form += '</div>';
                }
            }
        });
        return form;
    }

    function GetAjaxProducto(btn){
        var form = '';
        $.ajax({
            url:'/GetProductoInventario',
            dataType:'json',
            type:'GET',
            async: false,
            success:function(data){
                if(data != ""){
                    form += '<div class="form-row">'+
                                '<div class="form-group col-md-2">'+
                                    '<label>Cant.</label>'+
                                    '<input step="0.01" type="number" name="CantProducto[]" class="form-control" value="1" placeholder="NECESITA" required>'+
                                '</div>'+
                                '<div class="form-group col-md-7">'+
                                    '<label>Producto</label>'+
                                    '<select name="AjusteProducto[]" class="form-control select-producto" required>'+
                                        '<option value="" selected>Seleccionar</option>';
                    
                    $.each(data,function(index, producto){
                        form += '<option value="'+producto.id_producto+'">'+producto.pd_nombre+'</option>';
                    });
                    
                    form +=         '</select>'+
                                '</div>'+
                                '<div class="form-group col-md-2">'+
                                    '<label>Operación</label>'+
                                    '<select name="OperacionProducto[]" class="form-control" required>'+
                                    	'<option value="">Seleccionar</option>'+
                                    	'<option value="SUMA">AGREGAR</option>'+
                                    	'<option value="RESTA">REMOVER</option>'+
                                    '</select>'+
                                '</div>';
                    if(btn){
                        form += '<div class="form-group col-md-1">'+   
                                    '<button type="button" class="btn btn-danger BtnDeleteAjuste" style="margin-top:32px;"><span class="icon icon-bin2"></span></button>'+
                                '</div>';
                    }

                    form += '</div>';

                    //$('.AddEnsamblado').append(form);
                }
            }
        });

        return form;
    }

    $(document).on('click','.BtnDeleteAjuste', function(){
        var cont = 0;
        // Ver cuantos campos hay en updated de cada modal
        $(this).parent('div.form-group').parent('div.form-row').parent('div.AddAjuste').find('div.form-row').each(function(){
            cont++;
        });
        
        // si cont es uno o menor de 2 -> se eliminara el ultimo campo y bloqueamos el boton por que no existiran campos que enviar
        if (cont < 2) {
            $(this).parent('div.form-group').parent('div.form-row').parent('div.AddAjuste').parent('div').find('div.modal-footer').find('button.BtnAjusteInventario').prop('disabled',true);
        }

        $(this).parent('div.form-group').parent('div.form-row').remove();
    });
});