/* top-page JS */
global.$ = global.jQuery = require('jquery');
$(document).ready(function () {

    $('#nav-toggle').on('click', function () {
        $('body').toggleClass('open');
        $(this).hide();
    });
});


