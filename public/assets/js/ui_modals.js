// Bootstrap modals
$(function() {
  $('[name=modals-default-size]').on('change', function() {
    $('#modals-default .modal-dialog').removeClass('modal-sm').removeClass('modal-lg');

    if (this.value !== 'md') {
      $('#modals-default .modal-dialog').addClass('modal-' + this.value);
    }
  });

  $('[name=modals-top-size]').on('change', function() {
    $('#modals-top .modal-dialog').removeClass('modal-sm').removeClass('modal-lg');

    if (this.value !== 'md') {
      $('#modals-top .modal-dialog').addClass('modal-' + this.value);
    }
  });

  $('[name=modals-fill-in-size]').on('change', function() {
    $('#modals-fill-in .modal-dialog').removeClass('modal-sm').removeClass('modal-lg');

    if (this.value !== 'md') {
      $('#modals-fill-in .modal-dialog').addClass('modal-' + this.value);
    }
  });
});

// Bootbox
$(function() {
  $('#bootbox-alert').on('click', function() {
    bootbox.alert({
      message:   'Hello world!',
      className: 'bootbox-sm',

      callback: function() {
        alert('Hello world callback');
      },
    });
  });

  $('#bootbox-confirm').on('click', function() {
    bootbox.confirm({
      message:   'Are you sure?',
      className: 'bootbox-sm',

      callback: function(result) {
        alert('Confirm result: ' + result);
      },
    });
  });

  $('#bootbox-prompt').on('click', function() {
    bootbox.prompt({
      title: 'What is your name?',

      callback: function(result) {
        if (result === null) {
          alert('Prompt dismissed');
        } else {
          alert('Hi ' + result + '!');
        }
      },
    });
  });

  $('#bootbox-custom').on('click', function() {
    bootbox.dialog({
      title:     'Custom title',
      message:   'I am a custom dialog',
      className: 'bootbox-lg',

      buttons: {
        success: {
          label:     'Success!',
          className: 'btn-success',

          callback: function() {
            alert('great success');
          },
        },
        danger: {
          label:     'Danger!',
          className: 'btn-danger',

          callback: function() {
            alert('uh oh, look out!');
          },
        },
        main: {
          label:     'Click ME!',
          className: 'btn-primary',

          callback: function() {
            alert('Primary button');
          },
        }
      },
    });
  });
});

// SweetAlert2
$(function() {
  $('#sweetalert-example-1').click(function() {
    Swal.fire({
      title: 'Here\'s a message!', 
      text: 'It\'s pretty, isn\'t it?',
      footer: '<a href="javascript:void(0)">Why do I have this issue?</a>'
    });
  });

  $('#sweetalert-example-2').click(function() {
    Swal.fire({
      title: 'Are you sure?',
      text: 'You will not be able to recover this imaginary file!',
      type: 'warning',
      allowOutsideClick: false,
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel plx!'
    }).then(function(result) {
      if (result.value) {
        Swal.fire('Deleted!', 'Your imaginary file has been deleted.', 'success');
      } else {
        Swal.fire('Cancelled', 'Your imaginary file is safe :)', 'error');
      }
    });
  });

  $('#sweetalert-example-3').click(function() {
    Swal.fire({
      title: 'Ajax request example',
      text: 'Submit to run ajax request',
      type: 'info',
      showCancelButton: true,
      showLoaderOnConfirm: true,
      allowOutsideClick: function () {
        return !Swal.isLoading();
      },
      preConfirm: function() {
        return new Promise(function (resolve) {
          setTimeout(function () {
            resolve(true);
          }, 2000);
        });
      }
    }).then(function(result) {
      if (result.value) {
        Swal.fire('Ajax request finished!');
      }
    })
  });

  $('#sweetalert-example-4').click(function () {
    Swal.mixin({
      input: 'text',
      confirmButtonText: 'Next &rarr;',
      showCancelButton: true,
      progressSteps: ['1', '2', '3']
    }).queue([{
        title: 'Question 1',
        text: 'Chaining swal2 modals is easy'
      },
      'Question 2',
      'Question 3'
    ]).then(function (result) {
      if (result.value) {
        Swal.fire({
          title: 'All done!',
          html: 'Your answers: <pre><code>' + JSON.stringify(result.value) + '</code></pre>',
          confirmButtonText: 'Lovely!'
        })
      }
    })
  });

  $('#sweetalert-example-5').click(function() {
    Swal.fire({
      title: 'Are you sure?!',
      text: 'You will not be able to recover this imaginary file!',
      type: 'info',
      showCancelButton: true,
      customClass: {
        confirmButton: 'btn btn-info btn-lg',
        cancelButton: 'btn btn-default btn-lg'
      }
    });
  });

  $('#sweetalert-example-6').click(function() {
    Swal.fire({
      title: 'Are you sure?', 
      text: 'You will not be able to recover this imaginary file!',
      type: 'success',
      showCancelButton: true,
      customClass: {
        confirmButton: 'btn btn-success btn-lg',
        cancelButton: 'btn btn-default btn-lg'
      }
    });
  });

  $('#sweetalert-example-7').click(function() {
    Swal.fire({
      title: 'Are you sure?', 
      text: 'You will not be able to recover this imaginary file!',
      type: 'warning',
      showCancelButton: true,
      customClass: {
        confirmButton: 'btn btn-warning btn-lg',
        cancelButton: 'btn btn-default btn-lg'
      }
    });
  });

  $('#sweetalert-example-8').click(function() {
    Swal.fire({
      title: 'Are you sure?', 
      text: 'You will not be able to recover this imaginary file!',
      type: 'error',
      showCancelButton: true,
      customClass: {
        confirmButton: 'btn btn-danger btn-lg',
        cancelButton: 'btn btn-default btn-lg'
      }
    });
  });
});
