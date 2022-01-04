//sidebar toggle
$(document).ready(function () {
    $("#sidebar-toggle").click(function () {
        $(".sidebar").toggleClass("active");
    });
    $(".menu-toggle").click(function () {
        $("body").toggleClass("widescreen");
    });
    /*//slim
    $('.nicescroll').slimScroll({
        height: '100%',
        railOpacity: 0.9
    });*/
//metis menu
    $("#menu").metisMenu();
    
    $(".content-page,.side-menu").equalize({});

    //tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();
    });

    // $("form").parsley();

    $("#sparkline8").sparkline([5, 6, 7, 2, 0, 4, 2, 4, 5, 7, 2, 4, 12, 14, 4, 2, 14, 12, 7], {
        type: 'bar',
        barWidth: 4,
        height: '60px',
        barColor: '#efc100',
        negBarColor: '#c6c6c6'});

});
