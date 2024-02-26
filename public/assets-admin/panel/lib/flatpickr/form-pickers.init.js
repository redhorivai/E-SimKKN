! function(h) {
    "use strict";
    var i = function() {};
    i.prototype.init = function() {
        h("#basic-datepicker").flatpickr(), h("#datetime-datepicker").flatpickr({
            enableTime: !0,
            dateFormat: "Y-m-d H:i"
        }), h(".tglSurat").flatpickr({
            altInput: !0,
            altFormat: "j F Y",
            dateFormat: "Y-m-d"
        }), h(".tglTerima").flatpickr({
            altInput: !0,
            altFormat: "j F Y",
            dateFormat: "Y-m-d"
        }), h(".tglTempo").flatpickr({
            altInput: !0,
            altFormat: "j F Y",
            dateFormat: "Y-m-d"
        }), h("#check-minutes").click(function(i) {
            i.stopPropagation(), e("#single-input").clockpicker("show").clockpicker("toggleView", "minutes")
        })
    }, h.FormPickers = new i, h.FormPickers.Constructor = i
}(window.jQuery),
function(h) {
    "use strict";
    h.FormPickers.init()
}(window.jQuery);