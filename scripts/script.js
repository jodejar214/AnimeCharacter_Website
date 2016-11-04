//looked at code from:
//http://inspirationalpixels.com/tutorials/creating-an-accordion-with-html-css-jquery

$(document).ready(function() {

    function close_accordion_section() {
        $('.accordion .section-title').removeClass('active');
        $('.accordion .section-content').slideUp(300).removeClass('open');
    }
 
    $('.section-title').click(function(e) {
        // Grab current anchor value
        var link = $(this).attr('href');
 
        if($(e.target).is('.active')) {
            close_accordion_section();
        }else {
            close_accordion_section();
 
            // Add active class to section title
            $(this).addClass('active');
            // Open up the hidden content panel
            $('.accordion ' + link).slideDown(300).addClass('open'); 
        }
 
        e.preventDefault();
    });

    $('.accordion .section-title:eq(0)').trigger('click');
});