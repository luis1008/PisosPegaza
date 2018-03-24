$(document).ready(function(){

		//	REPORTE DE VIAJE
	$('.btn-egreso').click(function(){
		var formulario = "";
		formulario +=   '<div class="form-row">'+
							'<div class="form-group col-md-3">'+
								'<div class="input-group">'+
									'<span class="input-group-addon"><span class="icon icon-file-text2"></span></span>'+
									'<input class="form-control egresos" name="nota[]" type="text" placeholder="No. NOTA" required>'+
								'</div>'+
							'</div>'+
							'<div class="form-group col-md-4">'+
								'<div class="input-group">'+
								'<span class="input-group-addon"><span class="icon icon-price-tag"></span></span>'+
									'<input class="form-control egresos" name="concepto[]" type="text" placeholder="CONCEPTO" required>'+
								'</div>'+
							'</div>'+
							'<div class="form-group col-md-4">'+
								'<div class="input-group">'+
								'<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>'+
									'<input class="form-control egresos" name="importe[]" type="number" placeholder="IMPORTE" required>'+
								'</div>'+
							'</div>'+
							'<div class="form-group col-md-1">'+	
								'<button type="button" class="btn btn-danger btn-delete"><span class="icon icon-bin2"></span></button>'+		
							'</div>'+
						'</div>';
		$('.AddEgreso').append(formulario);
	});

	$(document).on('click','.btn-delete', function(){
		$(this).parent('div.form-group').parent('div.form-row').remove();
	});


	$('.select-vehiculo').change(function(){
		var placa = $(this).val();
		if(placa != ""){
			$.get('/GetKilometrajeFinal',{placa:placa}).done(function(kilometraje){
				$('.kilometraje').val(kilometraje);
			});
		}
	});
});