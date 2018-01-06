$(document).ready(function(){

		//	REPORTE DE VIAJE
	$('.btn-egreso').click(function(){
		var formulario = "";
		formulario +=   '<div class="form-group col-md-6">'+
							'<div class="input-group">'+
								'<span class="input-group-addon"><span class="icon icon-price-tag"></span></span>'+
								'<input class="form-control egresos" name="nota[]" type="text" placeholder="NOTA" required>'+
								'<div class="input-group-btn">'+
								'<span class="input-group-addon"><span class="icon icon-coin-dollar"></span></span>'+
								'<input class="form-control egresos" name="importe[]" type="text" placeholder="IMPORTE" required>'+
								'<div class="input-group-btn">'+
								'<span class="input-group-addon"><span class="icon icon-price-tag"></span></span>'+
								'<input class="form-control egresos" name="concepto[]" type="text" placeholder="CONCEPTO" required>'+
								'<div class="input-group-btn">'+
									'<button type="button" class="btn btn-danger btn-delete"><span class="icon icon-bin2"></span></button>'+
								'</div>'+
							'</div>'+
						'</div>';
		$('.AddEgreso').append(formulario);
	});

	$(document).on('click','.btn-delete', function(){
		$(this).parent('div.input-group-btn').parent('div.input-group').parent('div.form-group').remove();
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