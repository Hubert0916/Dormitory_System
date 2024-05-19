$('#toggle').click(function() {
    $(this).toggleClass('toggle-active');
    $('#overlay').toggleClass('nav-active');
});
$('#overlay a').click(function() {
    $('#toggle').removeClass('toggle-active');
    $('#overlay').removeClass('nav-active');
});