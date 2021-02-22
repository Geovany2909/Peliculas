
function devolucion() {
    console.log("");
    $.ajax({
        type: 'GET',
        url: '/fechaDev',
        data: $(this).serialize(),
        success: function (data) {
        }
    });
}

$(document).ready(function () {
    setInterval(function () { devolucion(); }, 5000);
});
