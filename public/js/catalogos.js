$(document).ready(function(){

    $('.check-curp').click(function(){
    	if ($(this).prop('checked')) {
    		$('.curp').prop('readonly', false);
    	} else {
    		$('.curp').prop('readonly', true).val('');
    	}
    });
    
    
    $('.check-num_seg').click(function(){
    	if ($(this).prop('checked')) {
    		$('.num_seg').prop('readonly', false);
    	} else {
    		$('.num_seg').prop('readonly', true).val('');
    	}
    });
});//documents