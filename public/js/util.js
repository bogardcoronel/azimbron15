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
});