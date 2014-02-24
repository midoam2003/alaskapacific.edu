jQuery(document).ready(function ($) { 



    $('.degrees ul').mixitup({
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
    onMixEnd: function () { 

       // console.log('filtering ended')

        // $('html, body').animate({
        //          scrollTop: $('.degrees .current').offset().top - 100
        //     }, 500);


        // if ($('.degrees li').hasClass('current')) {

           
        //     //console.log('remove current')
        // }

            

    }
});

$('.degrees li').on('click', function() {

    var self = this;

    if ($('.degrees li').hasClass('current')) {

        $('#apply-page .step:not(#step-1)').fadeTo(300,0, function() { $(this).hide() });


        $(this).parent()[0].config['onMixEnd'] = function () { console.log('filtering ended') 


            $('html, body').animate({
                 scrollTop: $('.degrees .current').offset().top - 30
            }, 500);

            $('.degrees .current').removeClass('current');

            $(self).parent()[0].config['onMixEnd'] = null;

        };

        console.log('show em all')

        //var currentIndex = $('.degrees .current').index();

        //$('.degrees .current').removeClass('current');

        $('.degrees ul').mixitup('filter','all');

        $('.degrees h2, .degrees h3').fadeTo(200,1, function() { $(this).show(); });

        // //console.log($current.offset().top);

        // $('html, body').animate({
        //      scrollTop: $('.degrees li').eq(currentIndex).offset().top
        // }, 500);

        
    $('#step-2').attr('data-switch','');
        

    } else {

        $('#apply-page .step').show().fadeTo(300,1)

        console.log('hide em all')

        var portal = $(this).attr('data-portal');
        var program = $(this).attr('data-program');


        switch (program)
        {
            case "accelerated-ba-in-business-administration-and-management":
            case "executive-mba-in-information-and-communication-technology":
            case "executive-mba-in-strategic-leadership": 
            case "master-of-business-administration":
            case "mba-concentration-health-services-administration":
            case "master-of-arts-program":
                $('#step-2').attr('data-switch','other');
                break;
            case "ms-environmental-science":
            case "ms-outdoor-environmental-education":
            case "ms-counseling-psychology": 
            case "psyd-counseling-psychology":
                $('#step-2').attr('data-switch',program);
                break;
            default: 
                $('#step-2').attr('data-switch',portal);
                break;
        }

        switch (portal)
        {
            case "cup":
                $('#step-3 .sign-up').attr('href','https://applicant.alaskapacific.edu/undergraduate/ceCreateAccount.asp');
                $('#step-3 .login').attr('href','https://applicant.alaskapacific.edu/undergraduate/login.asp');
                break;
            case "ps":
                $('#step-3 .sign-up').attr('href','https://applicant.alaskapacific.edu/professionalstudies/ceCreateAccount.asp');
                $('#step-3 .login').attr('href','https://applicant.alaskapacific.edu/professionalstudies/login.asp');
                break;
            case "doct":
                $('#step-3 .sign-up').attr('href','https://applicant.alaskapacific.edu/graduate/ceCreateAccount.asp');
                $('#step-3 .login').attr('href','https://applicant.alaskapacific.edu/graduate/login.asp');
                break;
            case "ehp":
                $('#step-3 .sign-up').attr('href','https://applicant.alaskapacific.edu/earlyhonors/ceCreateAccount.asp');
                $('#step-3 .login').attr('href','https://applicant.alaskapacific.edu/earlyhonors/login.asp');
                break;
            case "grad":
                $('#step-3 .sign-up').attr('href','https://applicant.alaskapacific.edu/graduate/ceCreateAccount.asp');
                $('#step-3 .login').attr('href','https://applicant.alaskapacific.edu/graduate/login.asp');
                break;
            case "non":
                $('#step-3 .sign-up').attr('href','https://applicant.alaskapacific.edu/nondegree/ceCreateAccount.asp');
                $('#step-3 .login').attr('href','https://applicant.alaskapacific.edu/nondegree/ceCreateAccount.asp');
                break;
            default: 
                break;
        }



        



        $(this).addClass('current');

        $('.degrees ul').mixitup('filter','current');

        $('.degrees h2, .degrees h3').fadeTo(200,0, function() { $(this).hide(); });

        $('html, body').animate({
            scrollTop: $('.splash').offset().top
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
