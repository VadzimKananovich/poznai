



let modalSubmit = document.querySelector('#modalSubmit');

if(modalSubmit){

  modalSubmit.addEventListener('click', function (event) {

    let name = document.querySelector('#first_last_name');
    let email = document.querySelector('#email_address');
    if(!name.value || !email.value){
      event.preventDefault();
    } else {
      return true;
    }

    if(!name.value){
      if(!name.classList.contains('error-input')){
        name.className += ' error-input';
      }
    } else {
      if(name.classList.contains('error-input')){
        name.classList.remove('error-input');
      }
    }
    if(!email.value){
      if(!email.classList.contains('error-input')){
        email.className += ' error-input';
      }
    } else {
      if(email.classList.contains('error-input')){
        email.classList.remove('error-input');
      }
    }
  });

}



(function($) {

  "use strict";

  $('#element').toggle();

  // Navigation Close on Click
  //-------------------------------------------------------------------------------
  $(document).ready(function () {
    $(".navbar-nav li a").on('click', function(event) {
      $(".navbar-collapse").collapse('hide');
    });
  });

  // Initialize Date Picker
  //-------------------------------------------------------------------------------
  $('.datepicker').datepicker({
    todayHighlight: true,
    startDate: new Date()
  }).on('changeDate', function () {
    $(this).datepicker('hide');
  });

  // Show Inquiry Modal
  //-------------------------------------------------------------------------------
  $('.show-inquiry-modal').on('click', function () {
    var object = $(this).data('object');
    if (object) {
      $("#inquiry-object").val(object);
    }
    $('#inquiryModal').modal('show');
    return false;
  });



  // Contact Form
  //-------------------------------------------------------------

  $("#contact-form").submit(function () {

    var contactFormMsg = $('#contact-form-msg');
    contactFormMsg.addClass('hidden');
    contactFormMsg.removeClass('alert-success');
    contactFormMsg.removeClass('alert-danger');

    $('#contact-form .btn-contact-submit').attr('disabled', 'disabled');

    $.ajax({
      type: "POST",
      url: "php/index.php",
      data: $("#contact-form").serialize(),
      dataType: "json",
      success: function (data) {

        if ('success' == data.result) {
          contactFormMsg.css('visibility', 'visible').hide().fadeIn().removeClass('hidden').addClass('alert-success');
          contactFormMsg.html(data.msg[0]);
          $('#contact-form .btn-contact-submit').removeAttr('disabled');
          $('#contact-form')[0].reset();
        }

        if ('error' == data.result) {
          contactFormMsg.css('visibility', 'visible').hide().fadeIn().removeClass('hidden').addClass('alert-danger');
          contactFormMsg.html(data.msg[0]);
          $('#contact-form .btn-contact-submit').removeAttr('disabled');
        }

      }
    });

    return false;
  });


  // Inquiry Form
  //-------------------------------------------------------------

  $("#inquiry-form").submit(function () {

    var inquiryFromMsg = $('#inquiry-form-msg');
    inquiryFromMsg.addClass('hidden');
    inquiryFromMsg.removeClass('alert-success');
    inquiryFromMsg.removeClass('alert-danger');

    $('#inquiry-form .btn-inquiry-submit').attr('disabled', 'disabled');

    $.ajax({
      type: "POST",
      url: "php/index.php",
      data: $("#inquiry-form").serialize(),
      dataType: "json",
      success: function (data) {

        if ('success' == data.result) {
          inquiryFromMsg.css('visibility', 'visible').hide().fadeIn().removeClass('hidden').addClass('alert-success');
          inquiryFromMsg.html(data.msg[0]);
          $('#inquiry-form .btn-inquiry-submit').removeAttr('disabled');
          $('#inquiry-form')[0].reset();

          setTimeout(function(){
            inquiryFromMsg.addClass('hidden');
            $('#inquiryModal').modal('hide');
          }, 2000);
        }

        if ('error' == data.result) {
          inquiryFromMsg.css('visibility', 'visible').hide().fadeIn().removeClass('hidden').addClass('alert-danger');
          inquiryFromMsg.html(data.msg[0]);
          $('#inquiry-form .btn-inquiry-submit').removeAttr('disabled');
        }

      }
    });

    return false;
  });



})(jQuery);
