/* top-page JS */
$(document).ready(function () {
    $('#nav-toggle').on('click', function () {
        $('body').toggleClass('open');
        $(this).toggleClass('open');
        $('footer').toggleClass('hide');
    });
});


