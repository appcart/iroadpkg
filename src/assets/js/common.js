header = $('.header-menu').innerHeight();
footer = $('.site-footer').innerHeight();
window_height = $(window).innerHeight();
// console.log(window_height);
// console.log(header);
// console.log(footer);       

$('.clearfix').css('min-height', window_height - header - footer + 'px');