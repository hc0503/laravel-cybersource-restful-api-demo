$(function () {
  var today = new Date();
  var y = today.getFullYear();
  var m = today.getMonth();
  var d = today.getDate();

  var eventList = [{
    title: 'All Day Event',
    start: new Date(y, m, d - 12)
  },
  {
    title: 'Long Event',
    start: new Date(y, m, d - 8),
    end: new Date(y, m, d - 5),
    className: 'fc-event-warning'
  },
  {
    id: 999,
    title: 'Repeating Event',
    start: new Date(y, m, d - 6, 16, 0)
  },
  {
    id: 999,
    title: 'Repeating Event',
    start: new Date(y, m, d + 1, 16, 0),
    className: 'fc-event-success',
  },
  {
    title: 'Conference',
    start: new Date(y, m, d - 4),
    end: new Date(y, m, d - 2),
  },
  {
    title: 'Meeting',
    start: new Date(y, m, d - 3, 10, 30),
    end: new Date(y, m, d - 3, 12, 30),
    className: 'fc-event-danger'
  },
  {
    title: 'Lunch',
    start: new Date(y, m, d  - 3, 12, 0),
    className: 'fc-event-info'
  },
  {
    title: 'Meeting',
    start: new Date(y, m, d - 3, 14, 30),
    className: 'fc-event-dark'
  },
  {
    title: 'Happy Hour',
    start: new Date(y, m, d - 3, 17, 30)
  },
  {
    title: 'Dinner',
    start: new Date(y, m, d - 3, 20, 0)
  },
  {
    title: 'Birthday Party',
    start: new Date(y, m, d - 2, 7, 0)
  },
  {
    title: 'Background event',
    start: new Date(y, m, d + 5),
    end: new Date(y, m, d + 7),
    rendering: 'background'
  },
  {
    title: 'Click for Google',
    url: 'http://google.com/',
    start: new Date(y, m, d + 13)
  }];

  // Default view
  // color classes: [ fc-event-success | fc-event-info | fc-event-warning | fc-event-danger | fc-event-dark ]
  var defaultCalendar = new Calendar($('#fullcalendar-default-view')[0], {
    plugins: [
      calendarPlugins.bootstrap,
      calendarPlugins.dayGrid,
      calendarPlugins.timeGrid,
      calendarPlugins.interaction
    ],
    dir: $('html').attr('dir') || 'ltr',

    // Bootstrap styling
    themeSystem: 'bootstrap',
    bootstrapFontAwesome: {
      close: ' ion ion-md-close',
      prev: ' ion ion-ios-arrow-back scaleX--1-rtl',
      next: ' ion ion-ios-arrow-forward scaleX--1-rtl',
      prevYear: ' ion ion-ios-arrow-dropleft-circle scaleX--1-rtl',
      nextYear: ' ion ion-ios-arrow-dropright-circle scaleX--1-rtl'
    },

    header: {
      left: 'title',
      center: 'dayGridMonth,timeGridWeek,timeGridDay',
      right: 'prev,next today'
    },

    defaultDate: today,
    navLinks: true, // can click day/week names to navigate views
    selectable: true,
    weekNumbers: true, // Show week numbers
    nowIndicator: true, // Show "now" indicator
    firstDay: 1, // Set "Monday" as start of a week
    businessHours: {
      dow: [1, 2, 3, 4, 5], // Monday - Friday
      start: '9:00',
      end: '18:00',
    },
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    events: eventList,

    views: {
      dayGrid: {
        eventLimit: 5
      }
    },

    select: function (selectionData) {
      $('#fullcalendar-default-view-modal')
        .on('shown.bs.modal', function() {
          $(this).find('input[type="text"]').trigger('focus');
        })
        .on('hidden.bs.modal', function() {
          $(this)
            .off('shown.bs.modal hidden.bs.modal submit')
            .find('input[type="text"], select').val('');
          defaultCalendar.unselect();
        })
        .on('submit', function(e) {
          e.preventDefault();
          var title = $(this).find('input[type="text"]').val();
          var className = $(this).find('select').val() || null;

          if (title) {
            var eventData = {
              title: title,
              start: selectionData.startStr,
              end: selectionData.endStr,
              className: className
            }
            defaultCalendar.addEvent(eventData);
          }

          $(this).modal('hide');
        })
        .modal('show');
    },

    eventClick: function(calEvent) {
      alert('Event: ' + calEvent.event.title);
    }
  });

  defaultCalendar.render();

  // List view
  // color classes: [ fc-event-success | fc-event-info | fc-event-warning | fc-event-danger | fc-event-dark ]
  var listCalendar = new Calendar($('#fullcalendar-list-view')[0], {
    plugins: [
      calendarPlugins.bootstrap,
      calendarPlugins.list
    ],
    dir: $('html').attr('dir') || 'ltr',

    // Bootstrap styling
    themeSystem: 'bootstrap',
    bootstrapFontAwesome: {
      close: ' ion ion-md-close',
      prev: ' ion ion-ios-arrow-back scaleX--1-rtl',
      next: ' ion ion-ios-arrow-forward scaleX--1-rtl',
      prevYear: ' ion ion-ios-arrow-dropleft-circle scaleX--1-rtl',
      nextYear: ' ion ion-ios-arrow-dropright-circle scaleX--1-rtl'
    },

    header: {
      left: 'title',
      center: 'listDay,listWeek,listMonth',
      right: 'prev,next today'
    },

    // customize the button names,
    views: {
      listDay: {
        buttonText: 'list day'
      },
      listWeek: {
        buttonText: 'list week'
      },
      listMonth: {
        buttonText: 'month'
      }
    },

    defaultView: 'listMonth',
    firstDay: 1, // Set "Monday" as start of a week
    navLinks: true, // can click day/week names to navigate views
    events: eventList
  });

  listCalendar.render();

  // List view
  // color classes: [ fc-event-success | fc-event-info | fc-event-warning | fc-event-danger | fc-event-dark ]
  var timelineCalendar = new Calendar($('#fullcalendar-timeline-view')[0], {
    plugins: [
      calendarPlugins.bootstrap,
      calendarPlugins.interaction,
      calendarPlugins.timeline
    ],
    dir: $('html').attr('dir') || 'ltr',

    // Bootstrap styling
    themeSystem: 'bootstrap',
    bootstrapFontAwesome: {
      close: ' ion ion-md-close',
      prev: ' ion ion-ios-arrow-back scaleX--1-rtl',
      next: ' ion ion-ios-arrow-forward scaleX--1-rtl',
      prevYear: ' ion ion-ios-arrow-dropleft-circle scaleX--1-rtl',
      nextYear: ' ion ion-ios-arrow-dropright-circle scaleX--1-rtl'
    },

    header: {
      left: 'title',
      center: 'timelineYear,timelineMonth,timelineWeek,timelineDay',
      right: 'prev,next today'
    },

    defaultView: 'timelineMonth',
    firstDay: 1, // Set "Monday" as start of a week
    navLinks: true, // can click day/week names to navigate views
    editable: true,
    events: eventList
  });

  timelineCalendar.render();
});
