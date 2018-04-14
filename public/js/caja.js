$(document).ready(function(){

	//	MOVIMIENTOS TEMPORALES
		$('.btn-concepto').click(function(){
		var formulario = "";
		formulario +=   '<div class="form-group col-md-6">'+
							'<div class="input-group">'+
								'<span class="input-group-addon"><span class="icon icon-price-tag"></span></span>'+
								'<input class="form-control conceptos" name="concepto[]" type="text" placeholder="CONCEPTO" required>'+
								'<div class="input-group-btn">'+
									'<button type="button" class="btn btn-danger btn-delete"><span class="icon icon-bin2"></span></button>'+
								'</div>'+
							'</div>'+
						'</div>';
		$('.AddConcepto').append(formulario);
	});

	$(document).on('click','.btn-delete', function(){
		$(this).parent('div.input-group-btn').parent('div.input-group').parent('div.form-group').remove();
	});


	//	MOVIMIENTOS TEMPORALES PENDIENTES
	$('.gasto').keyup(function(){
		var gasto = 0;
		$.each($('.gasto'),function(index,dato){
			var v_gasto = $(this).val();
			gasto += parseFloat(v_gasto);
		});
		$('.total_gasto').val(format_money(gasto));
		$('.h_total_gasto').val(gasto);
	});

	// COMPRAS -> TIPO DE COMPRAS
	$('.TypeCompra').change(function(){
		var tipo = $(this).val();
		$('.input-costo').val('0');
		if (tipo === "MATERIA PRIMA") {
			$('#ComprasMP, #ComprasArt, #ComprasPD').empty();
			$('.DivBtnArt').hide();
			$('.DivBtnMp').show();
			GetAjaxMateriaPrima(0);

		} else if(tipo === "PRODUCTO NO ENSAMBLADO"){
			$('#ComprasMP, #ComprasArt, #ComprasPD').empty();
			$('.DivBtnMp').hide();
			$('.DivBtnPd').show();
			GetAjaxProducto(0);
		}
		else if(tipo === "GASTOS"){
			$('#ComprasMP, #ComprasArt, #ComprasPD').empty();
			$('.DivBtnPd').hide();
			$('.DivBtnArt').show();
			GetAjaxCuentas(0);
		} else {
			$('.DivBtnArt, .DivBtnMp, DivBtnPd').hide();
			$('#ComprasMP, #ComprasArt, #ComprasPD').empty();			
		}
	});

	// SCRIPT DE AGREGAR, ELIMINAR, SELECCIONAR Y ENTRE OTRAS FUNCIONES QUE APLICA LA MATERIA PRIMA EN COMPRAS
	$('.btn-AddMP').click(function(){
		GetAjaxMateriaPrima(1);
	});
	
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
                                    '<input type="number" name="cantidad[]" class="form-control" value="1" min="1" placeholder="NECESITA" required>'+
                                '</div>'+
                                '<div class="form-group col-md-6">'+
                                    '<label>Material</label>'+
                                    '<select name="material[]" class="form-control select-material" required>'+
                                        '<option value="" selected>Seleccionar</option>'+
                                        '<option value="add">NUEVA MATERIA PRIMA</option>';
                    
                    $.each(data,function(index, material){
                        form += '<option value="'+material.id_materia_prima+'">'+material.mp_nombre+' '+material.mp_cantidad+' '+material.mp_unidad+'</option>';
                    });
                    
                    form +=         '</select>'+
                                '</div>'+
                                '<div class="form-group col-md-2 DivPrecio">'+
                                    '<label>Precio</label>'+
                                    '<input type="number" name="precio[]" class="form-control" value="0.0000" step="0.0001" min="1" placeholder="$" required>'+
                                '</div>'+
                                '<div class="form-group col-md-2 DivSub">'+
                                    '<label>Sub. Total</label>'+
                                    '<input type="text" class="form-control subtotal" name="subtotal[]" value="0.0000" step="0.0001" readonly>'+
                                '</div>';
                    if(btn){
                        form += '<div class="form-group col-md-1">'+   
                                    '<button type="button" class="btn btn-danger btn-delete2" style="margin-top:32px;"><span class="icon icon-bin2"></span></button>'+
                                '</div>';
                    }

                    form += '</div>';

                    $('#ComprasMP').append(form);
                }
            }
        });
	}

	// SCRIPT DE AGREGAR, ELIMINAR, SELECCIONAR Y ENTRE OTRAS FUNCIONES QUE APLICA LA MATERIA PRIMA EN COMPRAS
	$('.btn-AddPD').click(function(){
		GetAjaxProducto(1);
	});

	function GetAjaxProducto(btn){
        $.ajax({
            url:'/GetProductoNoEnsamblado',
            dataType:'json',
            type:'GET',
            async: false,
            success:function(data){
                if(data != ""){
                    var form = '';
                    form += '<div class="form-row">'+
                                '<div class="form-group col-md-1 DivCantidad">'+
                                    '<label>Cant.</label>'+
                                    '<input type="number" name="cantidad[]" class="form-control" value="1" min="1" placeholder="NECESITA" required>'+
                                '</div>'+
                                '<div class="form-group col-md-6">'+
                                    '<label>Producto</label>'+
                                    '<select name="material[]" class="form-control select-producto" required>'+
                                        '<option value="" selected>Seleccionar</option>'+
                                        '<option value="add">NUEVO PRODUCTO</option>';
                    
                    $.each(data,function(index, producto){
                        form += '<option value="'+producto.id_producto+'">'+producto.pd_nombre+' '+producto.pd_cantidad+' '+"PIEZAS"+'</option>';
                    });
                    
                    form +=         '</select>'+
                                '</div>'+
                                '<div class="form-group col-md-2 DivPrecio">'+
                                    '<label>Precio</label>'+
                                    '<input type="number" name="precio[]" class="form-control" value="0.0000" step="0.0001" min="1" placeholder="$" required>'+
                                '</div>'+
                                '<div class="form-group col-md-2 DivSub">'+
                                    '<label>Sub. Total</label>'+
                                    '<input type="text" class="form-control subtotal" name="subtotal[]" value="0.0000" step="0.0001" readonly>'+
                                '</div>';
                    if(btn){
                        form += '<div class="form-group col-md-1">'+   
                                    '<button type="button" class="btn btn-danger btn-delete2" style="margin-top:32px;"><span class="icon icon-bin2"></span></button>'+
                                '</div>';
                    }

                    form += '</div>';

                    $('#ComprasPD').append(form);
                }
            }
        });
	}
	// ELMINA TANTO MATERIA PRIMA/GASTO
	$(document).on('click','.btn-delete2', function(){
		$(this).parent('div.form-group').parent('div.form-row').remove();
		CalcularSubTotal();
        CalcularCosto();
	});
	
	$(document).on('change','.select-material',function(){
        var id    = $(this).val();
		var valor = 0;
		var tipo  = "material";
		if (id === "add") {
			$('#NewMateriaPrima').modal('show');
			$('#compra_material').modal('hide');
			$(this).val("");
		} else {
			$.ajax({
				url:'/GetPrecioUltimaCompra',
				dataType:'json',
				type:'GET',
				async: false,
				data: {id:id,tipo:tipo},
				success:function(data){
					if(data != ""){
						valor = data;
					}
				}
			});
			$(this).parent('div.form-group').parent('div.form-row').find('div.DivPrecio').find('input').val(valor);
			CalcularSubTotal();
			CalcularCosto();
		}
	});

//AGREGAR NUEVO PRODUCTO
		$(document).on('change','.select-producto',function(){
        var id    = $(this).val();
		var valor = 0;
		var tipo  = "producto";
		if (id === "add") {
			$('#NewProducto').modal('show');
			$('#compra_material').modal('hide');
			$(this).val("");
		} else {
			$.ajax({
				url:'/GetPrecioUltimaCompra',
				dataType:'json',
				type:'GET',
				async: false,
				data: {id:id,tipo:tipo},
				success:function(data){
					if(data != ""){
						valor = data;
					}
				}
			});
			$(this).parent('div.form-group').parent('div.form-row').find('div.DivPrecio').find('input').val(valor);
			CalcularSubTotal();
			CalcularCosto();
		}
	});
	
	$('.btn-SubmitMP').click(function(){
		$.post('/MateriaPrima',$('#form-MP').serialize()).done(function(data){
			if (data === "exito") {
				$('#NewMateriaPrima').modal('hide');
				$('#ComprasMP, #ComprasArt, #ComprasPD').empty();
				$('.TypeCompra, .form-clearMP').val("");
				$('#compra_material').modal('show');
			}
		}).fail(function(error){
			$('.mensaje-error-ajax').empty();
			$.each(error.responseJSON,function(index, mensaje){
				$('.mensaje-error-ajax').append("<p style='color:red;font-weight:bold;'>"+mensaje[0]+"</p>");
			});
			$('#MensajeError').modal('show');
		});
	});

	$('button[type="reset"]').click(function(){
		$('.DivBtnArt, .DivBtnMp').hide();
		$('#ComprasMP, #ComprasArt, #ComprasPD').empty();
		$('.multicompra').val('').trigger('chosen:updated');
	});

	$('.btn-closeMP').click(function(){
		$('#NewMateriaPrima').modal('hide');
		$('.form-clearMP').val("");
		$('#compra_material').modal('show');
	});

	$('.btn-closePD').click(function(){
		$('#NewProducto').modal('hide');
		$('.form-clearMP').val("");
		$('#compra_material').modal('show');
	});

	// SCRIPT DE AGREGAR, ELIMINAR, SELECCIONAR Y ENTRE OTRAS FUNCIONES QUE APLICA LOS ARTICULOS EN COMPRAS
	$('.btn-AddArt').click(function(){
		GetAjaxCuentas(1);
	});

	$(document).on('change','.select-gasto',function(){
        var id    = $(this).val();
        var valor = 0;
        var tipo  = "gasto";
		if (id === "add") {
			$('#NewGasto').modal('show');
			$('#compra_material').modal('hide');
			$(this).val("");
		} else {
			$.ajax({
				url:'/GetPrecioUltimaCompra',
				dataType:'json',
				type:'GET',
				async: false,
				data: {id:id,tipo:tipo},
				success:function(data){
					if(data != ""){
						valor = data;
					}
				}
			});
			$(this).parent('div.form-group').parent('div.form-row').find('div.DivPrecio').find('input').val(valor);
			CalcularSubTotal();
			CalcularCosto();
		}
	});

	$('.btn-SubmitGast').click(function(){
		$.post('/SetCuentas',$('#form-Gast').serialize()).done(function(data){
			if (data === "exito") {
				$('#NewGasto').modal('hide');
				$('#ComprasMP, #ComprasArt, #ComprasPD').empty();
				$('.TypeCompra, .form-clearGast').val("");
				$('#compra_material').modal('show');
			}
		}).fail(function(error){
			$('.mensaje-error-ajax').empty();
			$.each(error.responseJSON,function(index, mensaje){
				$('.mensaje-error-ajax').append("<p style='color:red;font-weight:bold;'>"+mensaje[0]+"</p>");
			});
			$('#MensajeError').modal('show');
		});
	});

	$('.btn-closeGast').click(function(){
		$('#NewGasto').modal('hide');
		$('.form-clearGast').val("");
		$('#compra_material').modal('show');
	});

	function GetAjaxCuentas(btn){
		//$.get('/GetCuentas').done(function(data){
			var form = '';
			form += '<div class="form-row">'+
						'<div class="form-group col-md-1 DivCantidad">'+
							'<label>Cant.</label>'+
							'<input type="number" name="cantidad[]" class="form-control" value="1" min="1" placeholder="NECESITA" required>'+
						'</div>'+
						'<div class="form-group col-md-6">'+
							'<label>Concepto</label>'+
							'<input type="text" class="form-control" name="material[]" placeholder="CONCEPTO" required>';

			/*$.each(data,function(index, gasto){
				form += '<option value="'+gasto.id_cuentas+'">'+gasto.ct_nombre+'</option>';
			});*/

			form +=         //'</select>'+
						'</div>'+
						'<div class="form-group col-md-2 DivPrecio">'+
							'<label>Importe</label>'+
							'<input type="number" name="precio[]" class="form-control" value="0.0000" step="0.0001" min="1" placeholder="$" required>'+
						'</div>'+
						'<div class="form-group col-md-2 DivSub">'+
							'<label>Sub. Total</label>'+
							'<input type="text" class="form-control subtotal" name="subtotal[]" value="0.0000" step="0.0001" readonly>'+
						'</div>';
			if(btn){
				form += '<div class="form-group col-md-1">'+   
							'<button type="button" class="btn btn-danger btn-delete2" style="margin-top:32px;"><span class="icon icon-bin2"></span></button>'+
						'</div>';
			}

			form += '</div>';
			$('#ComprasArt').append(form);
		//});
	}

	// SCRIPT PARA AGREGAR NUEVA PERSONA EN PRESTAMOS
	$('.select-emp').change(function(){
		var valor = $(this).val();
		if (valor === "add") {
			$('#prestamo').modal('hide');
			$('#NewPersona').modal('show');
			$(this).val("");
		}
	});

		$('.btn-closePR').click(function(){
		$('#NewPersona').modal('hide');
		$('.form-clearPer').val("");
		$('#prestamo').modal('show');
	});


		$('.btn-SubmitPer').click(function(){
		$.post('/SetEmpleado',$('#form-Per').serialize()).done(function(data){
			if (data === "exito") {
				$('#NewPersona').modal('hide');
				//volver a pintar los option del proveedor
				GetAjaxEmpleado();
				$('.form-clearPer').val("");
				$('#prestamo').modal('show');
			}
		}).fail(function(error){
			$('.mensaje-error-ajax').empty();
			$.each(error.responseJSON,function(index, mensaje){
				$('.mensaje-error-ajax').append("<p style='color:red;font-weight:bold;'>"+mensaje[0]+"</p>");
			});
			$('#MensajeError').modal('show');
		});
	});


	// SCRIPT PARA AGREGAR NUEVO PROVEEDOR EN COMPRAS
	$('.select-prov').change(function(){
		var valor = $(this).val();
		if (valor === "add") {
			$('#compra_material').modal('hide');
			$('#proveedor').modal('show');
			$(this).val("");
		}
	});

	$('.btn-closeProv').click(function(){
		$('#proveedor').modal('hide');
		$('.form-clearProv').val("");
		$('#compra_material').modal('show');
	});

	$('.btn-SubmitProv').click(function(){
		$.post('/Proveedor',$('#form-Prov').serialize()).done(function(data){
			if (data === "exito") {
				$('#proveedor').modal('hide');
				//volver a pintar los option del proveedor
				GetAjaxProveedor();
				$('.form-clearProv').val("");
				$('#compra_material').modal('show');
			}
		}).fail(function(error){
			$('.mensaje-error-ajax').empty();
			$.each(error.responseJSON,function(index, mensaje){
				$('.mensaje-error-ajax').append("<p style='color:red;font-weight:bold;'>"+mensaje[0]+"</p>");
			});
			$('#MensajeError').modal('show');
		});
	});

	function GetAjaxProveedor(){
		$('.select-prov').empty();
		$.get("/GetProveedor").done(function(data){
			var options = '';
			options += '<option value="">SELECCIONAR PROVEEDOR</option><option value="add">NUEVO PROVEEDOR</option>';
			$.each(data,function(index,proveedor){
				options += '<option value="'+proveedor.id_proveedor+'">'+proveedor.pv_nombre+'</option>';
			});
			$('.select-prov').append(options);
		});
	}

	function GetAjaxEmpleado(){
		$('.select-emp').empty();
		$.get("/GetEmpleado").done(function(data){
			var options = '';
			options += '<option value="">SELECCIONAR EMPLEADO</option><option value="add">OTROS</option>';
			$.each(data,function(index,empleado){
				options += '<option value="'+empleado.id_empleado+'">'+empleado.em_nombre+'</option>';
			});
			$('.select-emp').append(options);
		});
	}
	// FUNCIONES QUE CALCULAN DE LOS PRECIOS Y SUBTOTALES
	$(document).on('change','input[name="precio[]"]', function(){
        CalcularSubTotal();
        CalcularCosto();
    });

    $(document).on('change','input[name="cantidad[]"]', function(){
        CalcularSubTotal();
        CalcularCosto();
    });

	function CalcularCosto(){
        var subtotal = 0;
        $.each($('input.subtotal'),function(){
            subtotal += parseFloat($(this).val());
        });
        $('.input-costo').val(format_money(subtotal));
        $('.h_input-costo').val(subtotal);
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
	
	function format_money(money){
		var v_money = money;
		var f_money = v_money.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g,"$1,");

		return f_money;
	}


});