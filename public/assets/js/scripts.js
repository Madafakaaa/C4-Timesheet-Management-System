// Disable submit button when submit
function submitButtonDisable(button_id) {
  // Disable button first
  $('#'+button_id).attr("disabled", true);
}

//
// Bootstrap Notify
//

function notify(title, message, type){
  $.notify({
    // options
    title: '<strong>'+title+'</strong><br>',
    message: message,
  },{
    // settings
    element: 'body',
    type: type,
    allow_dismiss: true,
    placement: {
      from: "top",
      align: "center"
    },
    delay: 4000,
    mouse_over:"pause",
    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
              '<button type="button" aria-hidden="true" class="close" data-notify="dismiss"></button>' +
              '<span data-notify="icon"></span> ' +
              '<span data-notify="title">{1}</span> ' +
              '<span data-notify="message">{2}</span>' +
              '</div>'
  });
}

//
// Bootstrap Datepicker
//

var Datepicker = (function() {
  // Variables
  var $datepicker = $('.datepicker');
  // Methods
  function init($this) {
    var options = {
      disableTouchKeyboard: true,
      autoclose: false,
      format: "yyyy-mm-dd",
      weekStart: 1
    };
    $this.datepicker(options);
  }
  // Events
  if ($datepicker.length) {
    $datepicker.each(function() {
      init($(this));
    });
  }
})();

var Monthpicker = (function() {
  // Variables
  var $monthpicker = $('.monthpicker');
  // Methods
  function init($this) {
    var options = {
      disableTouchKeyboard: true,
      autoclose: false,
      format: "yyyy-mm",
      viewMode: "months",
      minViewMode: "months",
    };
    $this.datepicker(options);
  }
  // Events
  if ($monthpicker.length) {
    $monthpicker.each(function() {
      init($(this));
    });
  }
})();

