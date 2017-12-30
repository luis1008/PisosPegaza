$(document).ready(function(){
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
                                    '<input type="number" name="CantidadExcesos[]" class="form-control" value="1" min="1" placeholder="NECESITA" required>'+
                                '</div>'+
                                '<div class="form-group col-md-9">'+
                                    '<label>Producto</label>'+
                                    '<select name="ProductosExcesos[]" class="form-control" required>'+
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

                    $('.AppendProductoExceso').append(form);
                }
            }
        });
    }    

    $(document).on('click','.btn-deleteProduccion', function(){
        $(this).parent('div.form-group').parent('div.form-row').remove();
    });

    $(document).on('click','.BtnAddProductoExceso',function(){
        GetAjaxProductoProduccion(1);
    });

    /*$('#check_all').change(function(){
        var check = $(this).prop('checked');
        $('.CheckPedido').each(function(){
            $(this).prop('checked',check);
            $(this).prop('required',!check);
        });
    });*/

    $('.CheckPedido').change(function(){
        var checkeado = 0;
        var check;
        var array_productos  = [];
        var array_materiales = [];
        var array_requisitos = [];
        $('.CheckPedido').each(function(){
            if (this.checked) {
                checkeado++;
                $(this).parent('td').parent('tr').find('td.li-productos').find('ul').find('li').each(function(){
                    var cantidad     = $(this).find('.CantProducto').val();
                    var nombre       = $(this).find('.NomProducto').val();
                    var tam          = array_productos.length;
                    var modificacion = 0;

                    for (var i = 0; i < tam; i++) {
                        if(array_productos[i].nombre == nombre){
                            modificacion++;
                            array_productos[i].cantidad = parseFloat(array_productos[i].cantidad) + parseFloat(cantidad);
                        }
                    }

                    if (array_productos.length === 0 || modificacion === 0) {
                        array_productos.push({'cantidad':cantidad,'nombre':nombre});
                    }
                });
                $(this).parent('td').parent('tr').find('td.li-requisitos').find('ul.ul-material').find('li').each(function(){
                    var cantidad = $(this).find('.CantidadMaterial').val();
                    var nombre   = $(this).find('.NombreMaterial').val();
                    var unidad   = $(this).find('.UnidadMaterial').val();

                    var tam      = array_materiales.length;

                    var modificacion = 0;

                    for (var i = 0; i < tam; i++) {
                        if(array_materiales[i].nombre == nombre){
                            modificacion++;
                            array_materiales[i].cantidad = parseFloat(array_materiales[i].cantidad) + parseFloat(cantidad);
                        }
                    }

                    if (array_materiales.length === 0 || modificacion === 0) {
                        array_materiales.push({'cantidad':cantidad,'nombre':nombre,'unidad':unidad});
                    }
                });
                $(this).parent('td').parent('tr').find('td.li-requisitos').find('ul.ul-producto').find('li').each(function(){
                    var cantidad = $(this).find('.CantidadProducto').val();
                    var nombre   = $(this).find('.NombreProducto').val();

                    var tam      = array_requisitos.length;

                    var modificacion = 0;

                    for (var i = 0; i < tam; i++) {
                        if(array_requisitos[i].nombre == nombre){
                            modificacion++;
                            array_requisitos[i].cantidad = parseFloat(array_requisitos[i].cantidad) + parseFloat(cantidad);
                        }
                    }

                    if (array_requisitos.length === 0 || modificacion === 0) {
                        array_requisitos.push({'cantidad':cantidad,'nombre':nombre});
                    }
                });
            }
        });

        AppendTotalProductos(array_productos,'AppendListProductos');
        AppendTotalProductos(array_requisitos,'AppendListMateriales');
        AppendTotalMateriales(array_materiales);

        if (checkeado != 0) {
            check = false;
        }else{
            check = true;
        }

        $('.CheckPedido').each(function(){
            $(this).prop('required',check);
        });
    });

    function AppendTotalProductos(array,campo){
        var total = '';
        $.each(array, function(index,producto){
            total += '<li><b><span class="text-danger">' + producto.cantidad + '</span> ' + producto.nombre + '</b></li>';
                if (campo != 'AppendListMateriales') {
                    total += '<input type="hidden" name="productos[]" value="' + producto.cantidad + ' ' + producto.nombre + '">';
                } else {
                    total += '<input type="hidden" name="requisitos[]" value="' + producto.cantidad + ' ' + producto.nombre + '">';
                }
        });
        $('.'+campo).empty().append(total);
    }

    function AppendTotalMateriales(array){
        var total = '';
        $.each(array, function(index,producto){
            total += '<li><b><span class="text-danger">' + producto.cantidad + '</span> ' + producto.unidad + ' ' + producto.nombre + '</b></li>'+
                     '<input type="hidden" name="materiales[]" value="' + producto.cantidad + ' ' + producto.unidad +  ' ' + producto.nombre + '">';
        });
        $('.AppendListMateriales').append(total);
    }
});