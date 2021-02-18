$(function() {
  // Slider
  //

  $('#portfolio-slider').each(function() {
    var slider = new Swiper(this, {
      followFinger: false,
      speed: 1000,
      threshold: 50,
      preventIntercationOnTransition: true,
      navigation: {
        prevEl: '.swiper-button-prev.portfolio-slider-nav',
        nextEl: '.swiper-button-next.portfolio-slider-nav'
      }
    });
  });

  // Header
  //

  $('.portfolio-navbar-menu-toggle').on('click', function(e) {
    e.preventDefault();

    if ($('body').hasClass('portfolio-navbar-expanded')) {
      $('.portfolio-navbar').off().removeClass('portfolio-navbar-no-transition');
      $('body').removeClass('portfolio-navbar-expanded');
    } else {
      $('.portfolio-navbar').on('webkitTransitionEnd otransitionend msTransitionEnd transitionend', function(e) {
        if (e.target === this) $(this).off().addClass('portfolio-navbar-no-transition');
      });
      $('body').addClass('portfolio-navbar-expanded');
    }
  });

  // Fix navbar on page scroll
  $(document).on('scroll', function(e) {
    if ($(document).scrollTop() > 80) {
      $('.portfolio-navbar').addClass('portfolio-navbar-alt');
    } else {
      $('.portfolio-navbar').removeClass('portfolio-navbar-alt');
    }
  });

  // Works
  //

  $('#portfolio-thumbnails').each(function() {

    var msnry = new Masonry(this, {
      itemSelector: '.portfolio-thumbnails-item:not(.d-none)',
      columnWidth: '.portfolio-thumbnails-sizer',
      originLeft: !($('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl'),
      transitionDuration: 0
    });
    var curFilter = 'all';
    var thumbnailsAnimating = false;

    $('#portfolio-filter').on('click', '.nav-link', function(e) {
      e.preventDefault();
      if (thumbnailsAnimating || $(this).attr('href') === ('#' + curFilter)) return;

      thumbnailsAnimating = true;

      var self = this;

      $('.portfolio-thumbnails-item')
        .removeClass('animate-in')
        .addClass('animate-out');

      setTimeout(function() {

        // Set active filter
        $('#portfolio-filter .nav-link.active').removeClass('active');
        $(self).addClass('active');
        curFilter = self.getAttribute('href').replace('#', '');

        // Show all
        if (curFilter === 'all') {
          $('.portfolio-thumbnails-item').removeClass('d-none');

        // Show thumbnails only with selected tag
        } else {
          $('.portfolio-thumbnails-item:not([data-tag="' + curFilter + '"])').addClass('d-none');
          $('.portfolio-thumbnails-item[data-tag="' + curFilter + '"]').removeClass('d-none');
        }

        // Relayout
        $('.portfolio-thumbnails-item').removeClass('animate-out').addClass('animate-in');
        msnry.layout();

        thumbnailsAnimating = false;
      }, 350);
    });

  });

  // Reviews
  //

  $('#portfolio-reviews-slider').each(function() {
    new Swiper(this, {
      navigation: {
        prevEl: '.swiper-button-prev.portfolio-reviews-nav',
        nextEl: '.swiper-button-next.portfolio-reviews-nav'
      }
    });
  });
});
