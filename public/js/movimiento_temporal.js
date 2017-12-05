$(document).ready(function(){
	$(".multicompra").chosen({
	    //max_selected_options: 5,
		placeholder_text_multiple: "Seleccionar Compras",
		width: "100%"
	});

	$('.multicompra').change(function(){
		var compras = $(this).val();
		var total   = 0;
		for (var i = 0 ; i < compras.length; i++) {
			$.ajax({
				url:"/GetImporteCompra",
				async: false,
				dataType: "json",
				type: "GET",
				data:{
					id:compras[i]
				},
				success:function(importe){
					total += parseFloat(importe);
				}
			});
			// $.get('/GetImporteCompra',{id:compras[i]}).done(function(importe){
			// 	alert(importe)
			// });
		}
		$('.totalCompras').val(format_money(total));
	});

	function format_money(money){
		var v_money = money;
		var f_money = v_money.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g,"$1,");

		return f_money;
	}
});