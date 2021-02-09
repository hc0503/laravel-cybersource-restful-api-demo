$(function() {
  function setupTour(tour) {
    var backButtonClass = 'btn btn-sm btn-secondary md-btn-flat';
    var nextButtonClass = 'btn btn-sm btn-primary';
    var isRtl = $('html').attr('dir') === 'rtl';

    tour.addStep({
      title: 'Title of first step',
      text: '<p>Content of first step</p><p><strong>Second</strong> line</p>',
      attachTo: { element: '#tour-1', on: isRtl ? 'left' : 'right' },
      buttons: [{
        action: tour.cancel,
        classes: backButtonClass,
        text: 'Exit'
      }, {
        action: tour.next,
        classes: nextButtonClass,
        text: 'Next'
      }]
    });
    tour.addStep({
      title: 'Title of second step',
      text: 'Content of second step',
      attachTo: { element: '#tour-2', on: isRtl ? 'right' : 'left' },
      buttons: [{
        action: tour.back,
        classes: backButtonClass,
        text: 'Back'
      }, {
        action: tour.next,
        classes: nextButtonClass,
        text: 'Next'
      }]
    });
    tour.addStep({
      title: 'Title of third step',
      text: 'Content of third step',
      attachTo: { element: '#tour-3', on: 'bottom' },
      buttons: [{
        action: tour.back,
        classes: backButtonClass,
        text: 'Back'
      }, {
        action: tour.next,
        classes: nextButtonClass,
        text: 'Next'
      }]
    });
    tour.addStep({
      title: 'Title of fourth step',
      text: 'Content of fourth step',
      attachTo: { element: '#tour-4', on: 'top' },
      buttons: [{
        action: tour.back,
        classes: backButtonClass,
        text: 'Back'
      }, {
        action: tour.next,
        classes: nextButtonClass,
        text: 'Next'
      }]
    });
    tour.addStep({
      title: 'Floating modal',
      text: 'Content of floating modal step',
      buttons: [{
        action: tour.back,
        classes: backButtonClass,
        text: 'Back'
      }, {
        action: tour.next,
        classes: nextButtonClass,
        text: 'Next'
      }]
    });
    tour.addStep({
      title: 'Title of fifth step',
      text: 'Content of fifth step',
      attachTo: { element: '#tour-5', on: 'bottom' },
      buttons: [{
        action: tour.back,
        classes: backButtonClass,
        text: 'Back'
      }, {
        action: tour.next,
        classes: nextButtonClass,
        text: 'Done'
      }]
    });

    return tour;
  }

  $('#shepherd-example').click(function () {
    var tour = new Shepherd.Tour({
      includeStyles: false,

      defaultStepOptions: {
        scrollTo: false,
        cancelIcon: {
          enabled: true
        }
      },
      useModalOverlay: true
    });

    setupTour(tour).start();
  });
});
