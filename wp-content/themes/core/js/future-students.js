jQuery(document).ready(function ($) { 

     $(function(){
        $('.testimonials ul li:gt(0)').hide();
        setInterval(function(){
          $('.testimonials ul li:first-child').fadeOut()
             .next('li').fadeIn()
             .end().appendTo('.testimonials ul');}, 
          5500);
    });

});