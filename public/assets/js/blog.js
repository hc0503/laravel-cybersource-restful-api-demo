$(function() {
  // Slider
  //

  $('#blog-slider').each(function() {
    var blogSlider = new Swiper(this, {
      slidesPerView: 3,
      spaceBetween: 5,
      speed: 600,
      loop: true,
      centeredSlides: true,
      threshold: 50,
      loopedSlides: 5,
      autoplay: {
        delay: 5000,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      navigation: {
        prevEl: $('#blog-slider-prev')[0],
        nextEl: $('#blog-slider-next')[0]
      }
    });
    blogSlider.update();
  });

  // Nav
  //

  $('.blog-nav .navbar-search-input > input').on('focus', function() {
    $('.blog-nav .navbar-search-box').addClass('active');
  });
  $('.blog-nav .navbar-search-cancel').on('click', function(e) {
    e.preventDefault();
    $('.blog-nav .navbar-search-box').removeClass('active');
  });

  // Subnav
  //

  var subnavShowTreshold = 160; // In pixels
  var $subnavWrapper = $('#blog-subnav-wrapper');
  var $subnav = $('#blog-subnav');

  // Set wrapper height

  var curSubnavHeight;

  function updateDimensions() {
    var height = $subnav.outerHeight();
    if (height !== curSubnavHeight) {
      curSubnavHeight = height;
      $subnavWrapper.height(height);
      $subnav.css('top', (-1 * height) - 10);
    }
  }

  updateDimensions();
  $(window).on('resize', updateDimensions);

  // Subnav behaviour

  var lastScrollPos = 0;
  var scrollUpDelta = 0;

  function updateSubnavPorition() {
    var fixTopPoint = $subnavWrapper.offset().top;
    var fixBottomPoint = fixTopPoint + curSubnavHeight;
    var scrollTop = $(document).scrollTop();

    if (!$subnav.hasClass('subnav-fixed')) {
      if (scrollTop > fixBottomPoint) {
        $subnav.addClass('subnav-fixed');
        scrollUpDelta = 0;
      }

    } else {
      if (scrollTop < fixTopPoint) {
        $subnav.removeClass('subnav-fixed subnav-shown');

      } else if (scrollTop < fixBottomPoint) {
        $subnav.addClass('subnav-shown');

      } else if (scrollTop < lastScrollPos) {
        scrollUpDelta += lastScrollPos - scrollTop;

        if (scrollUpDelta > subnavShowTreshold) {
          $subnav.addClass('subnav-shown');
        }

      } else {
        $subnav.removeClass('subnav-shown');
        scrollUpDelta = 0;
      }
    }

    lastScrollPos = scrollTop;
  }

  updateSubnavPorition();
  $(document).on('scroll', updateSubnavPorition);
  $(window).on('resize', updateSubnavPorition);
});
