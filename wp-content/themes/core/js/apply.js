jQuery(document).ready(function ($) { 



    $('#mix').mixitup({
    targetSelector: 'li',
    filterSelector: '.filter',
    sortSelector: '.sort',
    buttonEvent: 'click',
    effects: ['fade'],
    listEffects: null,
    easing: 'smooth',
    layoutMode: 'list',
    targetDisplayGrid: 'inline-block',
    targetDisplayList: 'block',
    gridClass: '',
    listClass: '',
    transitionSpeed: 600,
    showOnLoad: 'all',
    sortOnLoad: false,
    multiFilter: false,
    filterLogic: 'or',
    resizeContainer: true,
    minHeight: 0,
    failClass: 'fail',
    perspectiveDistance: '3000',
    perspectiveOrigin: '50% 50%',
    animateGridList: true,
    onMixLoad: null,
    onMixStart: null,
    onMixEnd: null
});

    $('#mix2').mixitup({
    targetSelector: 'li',
    filterSelector: '.filter',
    sortSelector: '.sort',
    buttonEvent: 'click',
    effects: ['fade'],
    listEffects: null,
    easing: 'smooth',
    layoutMode: 'list',
    targetDisplayGrid: 'inline-block',
    targetDisplayList: 'block',
    gridClass: '',
    listClass: '',
    transitionSpeed: 600,
    showOnLoad: 'all',
    sortOnLoad: false,
    multiFilter: false,
    filterLogic: 'or',
    resizeContainer: true,
    minHeight: 0,
    failClass: 'fail',
    perspectiveDistance: '3000',
    perspectiveOrigin: '50% 50%',
    animateGridList: true,
    onMixLoad: null,
    onMixStart: null,
    onMixEnd: null
});

$('.degrees li').on('click', function() { 

    if ($('.degrees li').hasClass('current')) {

        $('.degrees .current').removeClass('current');
        $('#mix').mixitup('filter','all');
    $('#mix2').mixitup('filter','all');
$('.degrees h2').fadeTo(200,1, function() { $(this).show(); });



    } else {

        $(this).addClass('current');
    $('#mix').mixitup('filter','current');
    $('#mix2').mixitup('filter','current');
    $('.degrees h2').fadeTo(200,0, function() { $(this).hide(); });
    $('html, body').animate({
    scrollTop: $(".splash").offset().top
 }, 500);


    }
    
});
    // $('#degrees').isotope({
    //   // options
    //   itemSelector : 'li',
    //   layoutMode : 'vertical'
    // });


 //    $('#degrees li').on('click', function() { 
 //        console.log(this);
 //        $degreeLists.addClass('hide');
 //        $(this).clone().appendTo('#selected');

 //        $('#main').removeClass();
 //       $('#main').addClass($(this).parent().attr('data-portal'));
        
 //        $('html, body').animate({
 //    scrollTop: $("#splash").offset().top
 // }, 500);

 //    });

 //    $('#selected').on('click', function() { 
 //        console.log(this);
 //        $degreeLists.removeClass('hide');
 //        $(this).empty();
        
 //    });


});
