$(document).ready(function(){
	$('.select-vehiculo').change(function(){
		var placa = $(this).val();
		if(placa != ""){
			$.get('/GetKilometrajeFinal',{placa:placa}).done(function(kilometraje){
				$('.kilometraje').val(kilometraje);
			});
		}
	});
});