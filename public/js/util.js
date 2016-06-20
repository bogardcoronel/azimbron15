/**
 * Created by Bogard on 16/06/2016.
 */
$(function() {
    // var selector = document.getElementById("cantidad");
    //
    // var im = new Inputmask("999.99");
    // im.mask(selector);
    $( "#fecha_limite_pago").datepicker({
            minDate: 0,
            maxDate: "+6M +10D",
            dateFormat: 'dd/mm/yy',
            beforeShow: function (input, inst) {
            var rect = input.getBoundingClientRect();
            setTimeout(function () {
                inst.dpDiv.css({ top: rect.top + 40, left: rect.left + 0 });
            }, 0);
        }
        });

    $( "#fechaDePago").datepicker({
        minDate: -40,
        maxDate: "+6M +10D",
        dateFormat: 'dd/mm/yy',
        beforeShow: function (input, inst) {
            var rect = input.getBoundingClientRect();
            setTimeout(function () {
                inst.dpDiv.css({ top: rect.top + 40, left: rect.left + 0 });
            }, 0);
        }
    });

    $("#pagosPendientes").chosen({
        max_selected_options: 15,
        no_results_text: "No se encontraron resultados",
        placeholder_text_single: "Selecione una opción",
        placeholder_text_multiple: "Selecione las opciones..."});

    $("#pagosPendientes").on('change', function (event,params) {
        var cantidad;
        var total = $("#cantidad").val();
        if(params.selected) {
            cantidad = totalConcepto(params.selected);
            total= sumar(cantidad,total);
        }else{
            cantidad = totalConcepto(params.deselected);
            total= restar(total,cantidad);
        }

        $("#cantidad").val(total);
    });

    function totalConcepto(idPago) {
        var cantidad=0;
        $.ajax({
            url: "/pagos/cantidad",
            dataType: 'json',
            data: {idPago: idPago},
            type: 'GET',
            cache: false,
            async: false,
            success: function (data) {
                cantidad =data.cantidad;
            },
            error: function (xhr, ajaxOptions, thrownError) {
               return null;
            }
        });
        return cantidad;
    }
    
    function sumar(val1,val2) {
        return  Math.floor(val1) +  Math.floor(val2);
    }

    function restar(val1,val2) {
        if(val1<val2){
            return 0;
        }
        return  Math.floor(val1) -  Math.floor(val2);
    }
});