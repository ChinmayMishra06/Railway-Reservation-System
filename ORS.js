jQuery(document).ready(function() {
    var width = jQuery(window).width();
    if(767<width)
    {
        jQuery('.centering').css({
        'position' : 'absolute',
        'left' : '50%',
        'top' : '50%',
        'margin-left' : function() {return -$(this).outerWidth()/2},
        'margin-top' : function() {return -$(this).outerHeight()/2}
    });}

});

function print_page()
{
	var print_button = document.getElementById('print');
	print_button .style.visibility = 'hidden';
	window.print();
	print_button .style.visibility = 'visible';
}