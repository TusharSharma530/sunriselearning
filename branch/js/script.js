
//main slider
$('.slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    autoplay: true
});

//news slider
$('.widget-news-row').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    autoplay: false,
    responsive: [ { breakpoint: 992, settings: 
        { slidesToShow: 3 }
    },
    { breakpoint: 768, settings: 
        { slidesToShow: 2 }
    },
    { breakpoint: 576, settings: 
        { slidesToShow: 2 }
    },
    { breakpoint: 420, settings: 
        { slidesToShow: 1 }
    } ]
});


//awards & latest achievement slider
$('.awards-slider, .achievements-slider, .onlinecourses-slider').slick({
    infinite: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    autoplay: false,
    responsive: [ { breakpoint: 992, settings:
        { slidesToShow: 3 }
    },
    { breakpoint: 768, settings:
        { slidesToShow: 2 }
    },
    { breakpoint: 576, settings:
        { slidesToShow: 1 }
    } ]
});


//recuiters slider
// $('.recruiters').slick({
//     infinite: true,
//     slidesToShow: 5,
//     slidesToScroll: 1,
//     arrows: false,
//     dots: false,
//     autoplay: true,
//     responsive: [ { breakpoint: 992, settings: 
//         { slidesToShow: 4 }
//     },
//     { breakpoint: 768, settings: 
//         { slidesToShow: 2 }
//     },
//     { breakpoint: 576, settings: 
//         { slidesToShow: 2 }
//     },
//     { breakpoint: 420, settings: 
//         { slidesToShow: 2 }
//     } ]
// });


//association slider
$('.association-img').slick({
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    autoplay: true,
    autoplaySpeed: 2000,
    speed: 800,
    pauseOnHover: false,
    responsive: [ { breakpoint: 992, settings: 
        { slidesToShow: 4 }
    },
    { breakpoint: 768, settings: 
        { slidesToShow: 3 }
    },
    { breakpoint: 576, settings: 
        { slidesToShow: 2 }
    },
    { breakpoint: 420, settings: 
        { slidesToShow: 1 }
    } ]
});


//announce slider
$('.announceslider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    autoplay: true,
    responsive: [ { breakpoint: 992, settings: 
        { slidesToShow: 1 }
    },
    { breakpoint: 768, settings: 
        { slidesToShow: 2 }
    },
    { breakpoint: 576, settings: 
        { slidesToShow: 2 }
    },
    { breakpoint: 420, settings: 
        { slidesToShow: 1 }
    } ]
});
$(document).ready(function () {

    $('.creativityslider').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        autoplay: true,
        responsive: [
            { breakpoint: 992, settings: { slidesToShow: 3 } },
            { breakpoint: 768, settings: { slidesToShow: 2 } },
            { breakpoint: 576, settings: { slidesToShow: 2 } },
            { breakpoint: 420, settings: { slidesToShow: 1 } }
        ]
    });

    if($('.testimonials-slider .testimonial-card').length > 1){
    $('.testimonials-slider').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        autoplay: true,
        responsive: [
            { breakpoint: 992, settings: { slidesToShow: 2 } },
            { breakpoint: 768, settings: { slidesToShow: 1 } },
            { breakpoint: 576, settings: { slidesToShow: 1 } }
        ]
    });
    } else {
        $('.testimonials-slider').css({'display':'flex','justify-content':'center','gap':'30px','flex-wrap':'wrap'});
    }

    if($('.testimonials-cards .testimonial-text-card').length > 1){
    $('.testimonials-cards').slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        autoplay: false,
        responsive: [
            { breakpoint: 992, settings: { slidesToShow: 2 } },
            { breakpoint: 768, settings: { slidesToShow: 1 } },
            { breakpoint: 576, settings: { slidesToShow: 1 } }
        ]
    });
    }

    $('.media-gallery-slider').slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 4,
        arrows: true,
        dots: true,
        autoplay: false,
        responsive: [
            { breakpoint: 992, settings: { slidesToShow: 3, slidesToScroll: 3 } },
            { breakpoint: 768, settings: { slidesToShow: 2, slidesToScroll: 2 } },
            { breakpoint: 576, settings: { slidesToShow: 1, slidesToScroll: 1 } }
        ]
    });

});


// hidden submenu in sidemenu panel
$(document).on('click', '.mobmenutoggle a', function(event){
    $('.bottomheadermenu').addClass('active');
})

// hidden submenu in sidemenu panel
$(document).on('click', '.mobmenuclose', function(event){
    $('.bottomheadermenu').removeClass('active');
})


// Dropdown menu handling (click & hover for desktop, side drawer for mobile)
var menuHoverTimeout;
var menuLockedByClick = false;

// show / toggle submenu on click
$(document).on('click', '.menu-anchor', function(event){
    var $this = $(this);
    var $submenu = $this.next('.submenu');
    var $parentLi = $this.closest('.menu-list');

    if ($submenu.length) {
        event.preventDefault();

        if ($(window).width() >= 992) {
            clearTimeout(menuHoverTimeout);
            var wasActive = $submenu.hasClass('active');
            $('.bottomheadermenu .submenu').removeClass('active');
            $('.bottomheadermenu .menu-list').removeClass('active');

            if (!wasActive) {
                $parentLi.addClass('active');
                $submenu.addClass('active');
                menuLockedByClick = true;
            } else {
                menuLockedByClick = false;
            }
        } else {
            $(".submenu").each(function(){
                $(this).removeClass('active');
            });
            $submenu.addClass('active');
        }
    }
});

// close dropdown when clicking outside on desktop
$(document).on('click', function(event){
    if ($(window).width() >= 992) {
        if (!$(event.target).closest('.bottomheadermenu').length) {
            clearTimeout(menuHoverTimeout);
            menuLockedByClick = false;
            $('.bottomheadermenu .submenu').removeClass('active');
            $('.bottomheadermenu .menu-list').removeClass('active');
        }
    }
});

// hover with smooth grace period for transit across multi-row menu on desktop
$(document).on('mouseenter', '.bottomheadermenu .menu-list', function(){
    if ($(window).width() >= 992) {
        clearTimeout(menuHoverTimeout);
        var $submenu = $(this).find('> .submenu');
        if ($submenu.length) {
            $('.bottomheadermenu .menu-list').not(this).removeClass('active');
            $('.bottomheadermenu .submenu').not($submenu).removeClass('active');
            $(this).addClass('active');
            $submenu.addClass('active');
        } else if (!menuLockedByClick) {
            menuHoverTimeout = setTimeout(function(){
                if (!menuLockedByClick) {
                    $('.bottomheadermenu .menu-list').removeClass('active');
                    $('.bottomheadermenu .submenu').removeClass('active');
                }
            }, 300);
        }
    }
});

$(document).on('mouseleave', '.bottomheadermenu .menu-list', function(){
    if ($(window).width() >= 992) {
        if (menuLockedByClick) return;
        var $li = $(this);
        var $submenu = $li.find('> .submenu');
        if ($submenu.length) {
            menuHoverTimeout = setTimeout(function(){
                if (!menuLockedByClick && !$li.is(':hover') && !$submenu.is(':hover')) {
                    $li.removeClass('active');
                    $submenu.removeClass('active');
                }
            }, 350);
        }
    }
});

$(document).on('mouseenter', '.bottomheadermenu .submenu', function(){
    if ($(window).width() >= 992) {
        clearTimeout(menuHoverTimeout);
    }
});

$(document).on('mouseleave', '.bottomheadermenu .submenu', function(){
    if ($(window).width() >= 992) {
        if (menuLockedByClick) return;
        var $submenu = $(this);
        var $li = $submenu.closest('.menu-list');
        menuHoverTimeout = setTimeout(function(){
            if (!menuLockedByClick && !$li.is(':hover') && !$submenu.is(':hover')) {
                $li.removeClass('active');
                $submenu.removeClass('active');
            }
        }, 350);
    }
});

// hidden submenu in sidemenu panel
$(document).on('click', '.sublist-back', function(event){
    $(".submenu").each(function(){
        $(this).removeClass('active');
    })
})

            

$(window).on('scroll', function(){
  var top=window.scrollY;
  if(top>150){$('.centerheader, .bottomheader').addClass('fix');}else{$('.centerheader, .bottomheader').removeClass('fix');}
})



$(document).ready(function(){
function fetchJobs(query){
    $.ajax({
        url: window.location.href, type: "POST", data: {setJobs:1, query: query}, success: function(result){
            console.log(result);
            $('#fetchjob-wrapper').html(result);
        }
    })
}
fetchJobs("");



$('#searchjob').on('input', function(){
    var query =$(this).val();
    fetchJobs(query);
})


$('.blog-popups').on('click', function(){
    $(this).addClass('unactive');
})

$('.popup-close').on('click', function(){
    $('.blog-popups').addClass('unactive');
})

$('#getpopup').on('click', function(){
    $('.blog-popups').removeClass('active');
})

$('.blog-popups .inner-popup').on('click', function(e){
    e.stopPropagation();
})







})







