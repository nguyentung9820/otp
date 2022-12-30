(function ($) {
  'use strict';
  //Menu
  var ResponsiveMenu =  {
    menuType: 'desktop',
    initial: function(winWidth) {
      ResponsiveMenu.menuWidthDetect(winWidth);
      ResponsiveMenu.menuBtnClick();
      ResponsiveMenu.parentMenuClick();
    },
    menuWidthDetect: function(winWidth) {
      var currMenuType = 'desktop';
      if (matchMedia('only screen and (max-width: 991px)').matches) {
          currMenuType = 'mobile';
      }
      if ( currMenuType !== ResponsiveMenu.menuType ) {
          ResponsiveMenu.menuType = currMenuType;
          if ( currMenuType === 'mobile' ) {
              var $mobileMenu = $('#mainmenu').attr('id', 'mainmenu-mobi').hide();
              $('#header').find('.header-wrap').after($mobileMenu);
              var hasChildMenu = $('#mainmenu-mobi').find('li:has(ul)');
              hasChildMenu.children('ul').hide();
              hasChildMenu.children('a').after('<span class="btn-submenu"></span>');
              $('.btn-menu').removeClass('active');
          } else {
              var $desktopMenu = $('#mainmenu-mobi').attr('id', 'mainmenu').removeAttr('style');
              $desktopMenu.find('.sub-menu').removeAttr('style');
              $('#header').find('.btn-menu').after($desktopMenu);
              $('.btn-submenu').remove();
          }
      } // clone and insert menu
    },
    menuBtnClick: function() {
      $('.btn-menu').on('click', function() {
        $('#mainmenu-mobi').slideToggle(300);
        $(this).toggleClass('active');
      });
    }, // click on moblie button
    parentMenuClick: function() {
      $(document).on('click', '#mainmenu-mobi li .btn-submenu', function(e) {
        if ( $(this).has('ul') ) {
          e.stopImmediatePropagation()
          $(this).next('ul').slideToggle(300);
          $(this).toggleClass('active');
        }
      });
    } // click on sub-menu button
  };

  var pageSection = $('.banner-item');
  pageSection.each(function (indx) {
    if ($(this).attr('data-background-img')) {
      $(this).css('background-image', 'url(' + $(this).data('background-img') + ')');
    }
    if ($(this).attr('data-bg-position-x')) {
      $(this).css('background-position', $(this).data('bg-position-x'));
    }
    if ($(this).attr('data-height')) {
      $(this).css('height', $(this).data('height') + 'px');
    }
    var w_window = $(window).width();
    if (w_window <= 767) {
      if ($(this).attr('data-height')) {
        $(this).css('height', $(this).data('height') * 0.7 + 'px');
      }
    }
  });

  $(window).ready(function () {
    ResponsiveMenu.initial($(window).width());
    $(window).resize(function() {
      ResponsiveMenu.menuWidthDetect($(this).width());
    });

    $('.banner-slider').slick({
      autoplay: true,
      autoplaySpeed: 1500,
      arrows: false,
      dots: false,
      infinite: true,
      speed: 400,
      fade: true,
      cssEase: 'linear'
    });

    $('.category .heading2').click(function(){
      $(this).parent().find('.category-content').toggle();
    })

    $('.clients-slider').slick({
      dots: false,
      infinite: true,
      arrows:true,
      autoplay:false,
      slidesToShow: 4,
      slidesToScroll:1,
      responsive: [
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 2,
            arrows: false,
            dots: true
          }
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 3,
            arrows: true,
            dots: false
          }
        },
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 4,
            arrows: true,
            dots: false
          }
        }
      ]
    });

    $(window).scroll(function() {

    });

  });

  // **********************************************************************//
  // ! Window resize
  // **********************************************************************//
  $(window).on('resize', function () {
    var pageSection = $('.banner-item');
    pageSection.each(function (indx) {
      if ($(this).attr('data-background-img')) {
        $(this).css('background-image', 'url(' + $(this).data('background-img') + ')');
      }
      if ($(this).attr('data-bg-position-x')) {
        $(this).css('background-position', $(this).data('bg-position-x'));
      }
      if ($(this).attr('data-height')) {
        $(this).css('height', $(this).data('height') + 'px');
      }
      var w_window = $(window).width();
      if (w_window <= 767) {
        if ($(this).attr('data-height')) {
          $(this).css('height', $(this).data('height') * 0.7 + 'px');
        }
      }
    });
  });

})(jQuery);