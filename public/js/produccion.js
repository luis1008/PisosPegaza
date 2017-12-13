$(document).ready(function(){ 
	GetAjaxProductoProduccion(0);
    //MUESTRA LOS PRODUCTOS DENTRO DEL SELECT 
    function GetAjaxProductoProduccion(btn){
        $.ajax({
            url:'/GetProducto',
            dataType:'json',
            type:'GET',
            async: false,
            success:function(data){
                if(data != ""){
                    var form = '';
                    form += '<div class="form-row">'+
                                '<div class="form-group col-md-2">'+
                                    '<label>Cantidad</label>'+
                                    '<input type="text" name="cantidad3[]" class="form-control" value="1" placeholder="NECESITA" required>'+
                                '</div>'+
                                '<div class="form-group col-md-9">'+
                                    '<label>Producto</label>'+
                                    '<select name="producto3[]" class="form-control" required>'+
                                        '<option value="" selected>Seleccionar</option>';
                    
                    $.each(data,function(index, producto){
                        form += '<option value="'+producto.id_producto+'">'+producto.pd_nombre+ '</option>';
                    });
                    
                    form +=         '</select>'+
                                '</div>';
                    if(btn){
                        form += '<div class="form-group col-md-1">'+   
                                    '<button type="button" class="btn btn-danger btn-deleteProduccion" style="margin-top:32px;"><span class="icon icon-bin2"></span></button>'+
                                '</div>';
                    }

                    form += '</div>';

                    $('.AddProductoProduccion').append(form);
                }
            }
        });
    }    

    $(document).on('click','.btn-deleteProduccion', function(){
        $(this).parent('div.form-group').parent('div.form-row').remove();
        CalcularCostoProduccion();
    });

    $(document).on('click','.btn-AddProductoProduccion',function(){
        GetAjaxProductoProduccion(1);
    });

    $('#check_all').change(function(){
        var check = $(this).prop('checked');
        $('.CheckPedido').each(function(){
            $(this).prop('checked',check);
            $(this).prop('required',!check);
        });
    });

    $('.CheckPedido').change(function(){
        var checkeado = 0;
        var check;
        $('.CheckPedido').each(function(){
            if (this.checked) {
                checkeado++;
            }
        });
        if (checkeado != 0) {
            check = false;
        }else{
            check = true;
        }

        $('.CheckPedido').each(function(){
            $(this).prop('required',check);
        });
    });
});