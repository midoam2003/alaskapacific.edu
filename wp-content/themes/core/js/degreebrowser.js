jQuery(function($) {
    // WebFont.load({
    //     google: {
    //         families: ['Oswald']
    //     },
    //     active: function() {
    //          $('#degrees .box h2').each(function() {
    //                 $(this).responsiveHeadlines({ useThrottleDebounce: false, container: 'box', maxFontSize: 24 });
    //              });
    //     }
    // });
});

jQuery(document).ready(function ($) { 

});

jQuery(document).ready(function ($) { 

 console.log($);

    $('#degrees').isotope({
          // options
          itemSelector : '.box',
          layoutMode : 'fitRows',
          animateEngine: 'best-available'
      },
          function () {


            $(this).css('opacity',1);
          }
    );



    $('.box').hover(
        function() {
            $(this).addClass( "hover" );
        
            var $slideshow = $(this).find('.slideshow');
            //$('.fadein img').hide();

            $slideshow.find('li:eq(0)').addClass('active');

            window.degreeSlideshow = setInterval(
                function () { 
                    //$('.active', $slideshow).removeClass('active').next('li').addClass('active');

                    var $cur = $('.active', $slideshow).removeClass('active');
                    var $next = $cur.next().length?$cur.next():$slideshow.children().eq(0);
                    $next.addClass('active');
                }, 700
            );

        }, function() {
            $(this).removeClass( "hover" );
            var $slideshow = $(this).find('.slideshow');

            $slideshow.find('li').removeClass('active').eq(0).addClass('active');
           
            clearInterval(window.degreeSlideshow);
    });


    $('.filters a').click(function (e) { 

        e.preventDefault();
        var filter = $(this).attr('href').substring(1);
        $('#degrees').removeClass().addClass('isotope ' + filter);
        
        $('.filters a').removeClass('activated');
        $(this).addClass('activated');

        var selector = $(this).attr('data-filter');
        $('#degrees').isotope({ filter: selector });
        //return false;


    });

    $('#degrees .box h2 a').each(function() {
        $(this).responsiveHeadlines({ useThrottleDebounce: false, container: 'box', maxFontSize: 24 });
    });

      


});
