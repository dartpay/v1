(function ($) {
  "user strict";


  $('.header-bar').on('click', function () {
    $(this).toggleClass('active');
    $('.mean-menu').toggleClass('active');
  });

   wind = $(window);

  // Var Background image
  var pageSection = $(".bg-img, section");
  pageSection.each(function (indx) {
    if ($(this).attr("data-background")) {
      $(this).css("background-image", "url(" + $(this).data("background") + ")");
    }
  });

  $(".show_hide_password .show-pass").on('click', function(event) {
    event.preventDefault();
    if($(this).parent().find("input").attr("type") == "text"){
        $(this).parent().find("input").attr('type', 'password');
        $(this).find("i").addClass( "fa-eye-slash" );
        $(this).find("i").removeClass( "fa-eye" );
    }else if($(this).parent().find("input").attr("type") == "password"){
        $(this).parent().find("input").attr('type', 'text');
        $(this).find("i").removeClass( "fa-eye-slash" );
        $(this).find("i").addClass( "fa-eye" );
    }
  });

  $(window).on('scroll',function() {
      if ($(this).scrollTop() > 120){  
          $('.navbar-area').addClass("is-sticky");
      }
      else{
          $('.navbar-area').removeClass("is-sticky");
      }
  });
  // Preloader Js
  $(window).on('load', function () {
    $('.preloader').fadeOut(1000);
    var img = $('.bg_img');
    img.css('background-image', function () {
      var bg = ('url(' + $(this).data('background') + ')');
      return bg;
    });
  });
  $(document).ready(function () {
    // Nice Select
    $('.select-bar').niceSelect();
    // PoPuP 
    $('.popup').magnificPopup({
      disableOn: 700,
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: false,
      fixedContentPos: false,
      disableOn: 300
    });
    $("body").each(function () {
      $(this).find(".img-pop").magnificPopup({
        type: "image",
        gallery: {
          enabled: true
        }
      });
    });
    // aos js active
    new WOW().init();
    $(".brand-slider").slick({
        fade: false,
        slidesToShow: 9,
        slidesToScroll: 1,
        infinite: true,
        autoplay: true,
        pauseOnHover: true,
        centerMode: false,
        dots: false,
        arrows: false,
        nextArrow: '<i class="las la-arrow-right arrow-right"></i>',
        prevArrow: '<i class="las la-arrow-left arrow-left"></i> ',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 7,
                },
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 6,
                },
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 5,
                },
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 4,
                },
            },
        ],
    });
    //Faq
    AOS.init({ duration: 1200, });
    $('.faq-wrapper .faq-title').on('click', function (e) {
      var element = $(this).parent('.faq-item');
      if (element.hasClass('open')) {
        element.removeClass('open');
        element.find('.faq-content').removeClass('open');
        element.find('.faq-content').slideUp(300, "swing");
      } else {
        element.addClass('open');
        element.children('.faq-content').slideDown(300, "swing");
        element.siblings('.faq-item').children('.faq-content').slideUp(300, "swing");
        element.siblings('.faq-item').removeClass('open');
        element.siblings('.faq-item').find('.faq-title').removeClass('open');
        element.siblings('.faq-item').find('.faq-content').slideUp(300, "swing");
      }
    });
    //Menu Dropdown Icon Adding
    $("ul>li>.sub-menu").parent("li").addClass("menu-item-has-children");
    // drop down menu width overflow problem fix
    $('ul').parent('li').hover(function () {
      var menu = $(this).find("ul");
      var menupos = $(menu).offset();
      if (menupos.left + menu.width() > $(window).width()) {
        var newpos = -$(menu).width();
        menu.css({
          left: newpos
        });
      }
    });
    $('.menu li a').on('click', function (e) {
      var element = $(this).parent('li');
      if (element.hasClass('open')) {
        element.removeClass('open');
        element.find('li').removeClass('open');
        element.find('ul').slideUp(300, "swing");
      } else {
        element.addClass('open');
        element.children('ul').slideDown(300, "swing");
        element.siblings('li').children('ul').slideUp(300, "swing");
        element.siblings('li').removeClass('open');
        element.siblings('li').find('li').removeClass('open');
        element.siblings('li').find('ul').slideUp(300, "swing");
      }
    })
    $('.category-list .category-title').on('click', function (e) {
      var elementT = $(this).parent('.category-item');
      if (elementT.hasClass('open')) {
        elementT.removeClass('open');
        elementT.find('.category-content').removeClass('open');
        elementT.find('.category-content').slideUp(300, "swing");
      } else {
        elementT.addClass('open');
        elementT.children('.category-content').slideDown(300, "swing");
        elementT.siblings('.category-item').children('category-title').slideUp(300, "swing");
        elementT.siblings('.category-item').removeClass('open');
        elementT.siblings('.category-item').find('category-title').removeClass('open');
        elementT.siblings('.category-item').find('.category-content').slideUp(300, "swing");
      }
    });
    // Scroll To Top 
    var scrollTop = $(".scrollToTop");
    $(window).on('scroll', function () {
      if ($(this).scrollTop() < 500) {
        scrollTop.removeClass("active");
      } else {
        scrollTop.addClass("active");
      }
    });
    //Click event to scroll to top
    $('.scrollToTop').on('click', function () {
      $('html, body').animate({
        scrollTop: 0
      }, 500);
      return false;
    });
    //Header Bar
    $('.header-bar').on('click', function () {
      $(this).toggleClass('active');
      $('.overlay').toggleClass('active');
      $('.menu').toggleClass('active');
    })
    //Header Bar
    $('.overlay').on('click', function () {
      $(this).removeClass('active');
      $('.header-bar').removeClass('active');
      $('.menu').removeClass('active');
      $('.header-top-area').removeClass('active');
    })
    $('.ellipsis-bar').on('click', function () {
      $('.header-top-area').toggleClass('active');
      $('.overlay').addClass('active');
    })
    //Header
    var fixed_top = $(".header-bottom");
    $(window).on('scroll', function () {
      if ($(this).scrollTop() > 500) {
        fixed_top.addClass("fixed__header animated fadeInDown");
      } else {
        fixed_top.removeClass("fixed__header fadeInDown");
      }
    });
    //Tab Section
    // $('.tab ul.tab-menu').addClass('active').find('> li:eq(0)').addClass('active');
    $('.tab ul.tab-menu li').on('click', function (g) {
      var tab = $(this).closest('.tab'),
        index = $(this).closest('li').index();
      tab.find('li').siblings('li').removeClass('active');
      $(this).closest('li').addClass('active');
      tab.find('.tab-area').find('div.tab-item').not('div.tab-item:eq(' + index + ')').hide(10);
      tab.find('.tab-area').find('div.tab-item:eq(' + index + ')').fadeIn(10);
      g.preventDefault();
    });
    //Odometer
    $(".counter-item").each(function () {
      $(this).isInViewport(function (status) {
        if (status === "entered") {
          for (var i = 0; i < document.querySelectorAll(".odometer").length; i++) {
            var el = document.querySelectorAll('.odometer')[i];
            el.innerHTML = el.getAttribute("data-odometer-final");
          }
        }
      });
    }); //client slider
    var swiper = new Swiper('.service-slider', {
      slidesPerView: 3,
      loop: true,
      spaceBetween: 30,
      breakpoints: {
          991: {
            slidesPerView: 2,
          },
          767: {
            slidesPerView: 1,
          },
      },
      speed: 300, 
      pagination: {
        el: '.common-pagination',
        clickable: true,
      },
      loop: true,
      autoplay: {
          delay: 2500,
          disableOnInteraction: true,
      },
    });
    var swiper = new Swiper('.sponsor-slider', {
      slidesPerView: 6,
      loop: true,
      spaceBetween: 30,
      breakpoints: {
          1199: {
            slidesPerView: 5,
          },
          991: {
            slidesPerView: 3,
          },
          767: {
            slidesPerView: 2,
          },
          500: {
            slidesPerView: 1,
          },
      },
      speed: 300,
      loop: true,
      autoplay: {
          delay: 1000,
          disableOnInteraction: false,
      },
    }); 
    var swiper = new Swiper(".client-slider", {
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        autoplay: {
            speed: 11000,
            delay: 31000,
        },
        speed: 1000,
        breakpoints: {
            '480': {
                slidesPerView: 1,
                spaceBetween: 30,
            },
            '768': {
                slidesPerView: 1,
                spaceBetween: 30,
            },
            '991': {
                slidesPerView: 2,
                spaceBetween: 20,
            },
        },
    });
    var swiper = new Swiper('.team-slider', {
      loop: true,
      slidesPerView: 3,
      spaceBetween: 30,
      autoplay: {
        delay: 2000,
        disableOnInteraction: false,
      },
      breakpoints: {
        991: {
          slidesPerView: 2,
        },
        767: {
          slidesPerView: 1,
        },
      },
    });
    const NOTICE = document.getElementById('top-notice');
    if (NOTICE) {
      $(".notice-close").on("click", function () {
        if (!localStorage.getItem('NOTICE_BAR_CLOSED')) {
          localStorage.setItem('NOTICE_BAR_CLOSED', true);
        }
        NOTICE.remove();
      });
      $(".cookie-btn").on("click", function () {
        alert('asa');
        if (!localStorage.getItem('NOTICE_BAR_CLOSED')) {
          localStorage.setItem('NOTICE_BAR_CLOSED', true);
          $('.cookies-card').remove();
        }
        NOTICE.remove();
      });

      if (localStorage.getItem('NOTICE_BAR_CLOSED')) {
        NOTICE.remove();
      }
    }

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
  });
})(jQuery);
