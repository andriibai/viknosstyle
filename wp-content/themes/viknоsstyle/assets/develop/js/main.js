$(document).ready(function () {

    /*=========================POPUP===================================*/
    $(document).on('click', '.popup__btn', function () {
        $('.popup__content').fadeIn(300);
        $('.overlay').fadeIn(300);
    });

    $(document).on('click', '.popup__close', function () {
        $('.popup__content').fadeOut(300);
        $('.overlay').fadeOut(300);
    });

    $(document).on('click', '.overlay', function () {
        $('.popup__content').fadeOut(300);
        $('.overlay').fadeOut(300);
    });

    $(document).on('keydown', function (e) {
        if (e.keyCode == 27) {
            $('.popup__content').fadeOut(300);
            $('.overlay').fadeOut(300);
        }
    });

    /*==========================MOBILE MENU==============================*/
    var nav = $('.header__menu');
    var menuMobLink = $('.header__menu-mob');
    var overlay = $('.header__overlay');
    var body = $('body');
    menuMobLink.click(function (e) {
        e.preventDefault();
        menuMobLink.toggleClass('open');
        nav.toggleClass('active');
        body.toggleClass('noscroll');

        if (menuMobLink.hasClass('open')) {
            overlay.fadeIn(600);
        } else {
            overlay.fadeOut(600);
        }
    });

    overlay.click(function (e) {
        e.preventDefault();
        menuMobLink.removeClass('open');
        overlay.fadeOut(600);
        nav.toggleClass('active');
        body.toggleClass('noscroll');
    });

    $(document).on('keydown', function (e) {
        if (e.keyCode == 27) {
            menuMobLink.removeClass('open');
            overlay.fadeOut(600);
            nav.toggleClass('active');
        }
    });

    /*=========================BUTTON TOP===============================*/
    var btnTop = $('.button__top');
    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btnTop.addClass('show');
        } else {
            btnTop.removeClass('show');
        }
    });
    btnTop.on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: 0}, '300');
    });


    /*=========================BUTTONS DOWN==============================*/
    var marginTop;
    if ($(window).width() < 768) {
        marginTop = 110;
    }
    else{
        marginTop = 140;
    }

    var btnDown = $('.button__down');
    btnDown.click(function () {
        $('html,body').animate({
                scrollTop: $("#catalog").offset().top - marginTop
            },
            'slow');
    });

    var menuCatalog = $('.menu__link').parent('.catalog');
    menuCatalog.click(function () {
        $('.header__menu-mob').removeClass('open');
        overlay.fadeOut(600);
        nav.toggleClass('active');
        body.toggleClass('noscroll');
        $('html,body').animate({
                scrollTop: $("#catalog").offset().top - marginTop
            },
            'slow');
    });

    $('.stock__slider').owlCarousel({
        autoplay: true,
        autoplayTimeout: 5000,
        center: true,
        //stagePadding: 200,
        //margin:90,
        items: 1,
        //autoWidth: true,
        dots: false,
        loop: true,
        // responsive: {
        //     600: {
        //         //items:4
        //     }
        // }
    });

    $(".js-mask").inputmask({mask: "+38 (999) 999 9999"});

});
