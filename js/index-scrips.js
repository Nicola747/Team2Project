function parallax_height() {
    var scroll_top = $(this).scrollTop();
    var home_section_top = $(".home-section").offset().top;
    var header_height = $(".home-header-section").outerHeight();
    $(".home-section").css({ "margin-top": header_height });
    $(".home-header").css({ height: header_height - scroll_top });
}
parallax_height();
$(window).scroll(function() {
    parallax_height();
});
$(window).resize(function() {
    parallax_height();
});