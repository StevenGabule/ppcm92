/* notification / messaging class */
class Msg {
  /* internal variables */
  constructor (handle,target,direction,msg) {
    /* the messaage to display */
    this.msg = msg;
    /* the messaage to display */

    /* the message / notification wrapper class */
    this.handle = handle;
    /* the message / notification wrapper class */

    /* the wrapper class of the location to display the message / notification */
    this.target = target;
    /* the wrapper class of the location to display the message / notification */

    /* display either before or after the target */
    this.direction = direction;
    /* display either before or after the target */

    /* auto hide delay */
    this.auto_hide_delay = 1000;
    /* auto hide delay */
  }
  /* internal variables */

  /* auto hide message / notification */
  auto_trash () {
    /* store class-wide variables to a function-wide variable */
    let temp_handle = this.handle
    let temp_delay = this.auto_hide_delay;
    /* store class-wide variables to a function-wide variable */

    /* create a delay process to delete the status message */
    setTimeout(function () {
      /* remove the status message */
      $(temp_handle).remove();
      /* remove the status message */
    },temp_delay);
    /* create a delay process to delete the status message */
  }
  /* auto hide message / notification */


  /* display notification / message */
  display () {
    /* display the notification / message */
    if (this.direction == 'after') {
      /* display the message */
      $(this.target).after(this.msg);
      /* display the message */
    } else {
      /* display the message */
      $(this.target).before(this.msg);
      /* display the message */
    }
    /* display the notification / message */

    /* auto remove the message */
    this.auto_trash();
    /* auto remove the message */
  }
  /* display notification / message */
}
/* notification / messaging class */

/* form verification class */
class FormVerification {
  /* internal variables */
  constructor (form) {
    /* the form element */
    this.form = form;
    /* the form element */
  }
  /* internal variables */

  /* start form verification */
  verify () {
    /* initiate error count variable */
    var errors = 0;
    /* initiate error count variable */

    /* regex number validator */
    var is_number = /^\d+$/
    /* regex number validator */

    /* regex email validator */
    var is_email = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    /* regex email validator */

    /* remove all error messages first */
    $('.error-msg').remove();
    /* remove all error messages first */

    /* assign this.form to local variable so that inner functions can access it */
    let temp_form = this.form;
    /* assign this.form to local variable so that inner functions can access it */

    /* loop through the form elements */
    $(this.form+' .form-control').each(function () {
      /* check for data-required attribute */
      if ($(this).attr('data-required') == 'yes') {
        /* check if form-control has value */
        if ($(this).val() == '') {
          if ($(this).attr('data-type') == 'confirm-box') {
            if ($(this).is(':checked') == false) {
              /* remove previous error */
              $(this).parent().next().find('.err-msg').remove();
              /* remove previous error */

              /* display error message */
              $(this).parent().after('<p class="error-msg"><small>'+$(this).attr('data-error')+'</small></p>');
              /* display error message */

              /* increment error count */
              errors++;
              /* increment error count */
            }
          } else {
            /* display error message */
            $(this).parent().after('<p class="error-msg"><small>'+$(this).attr('data-error')+'</small></p>');
            /* display error message */

            /* increment error count */
            errors++;
            /* increment error count */
          }
        } else {
          if ($(this).attr('data-type') == 'number' && is_number.test($(this).val()) == false) {
            /* remove previous error */
            $(this).parent().next().find('.err-msg').remove();
            /* remove previous error */

            /* display error message */
            $(this).parent().after('<p class="error-msg"><small>'+$(this).attr('data-type-error')+'</small></p>');
            /* display error message */

            /* increment error count */
            errors++;
            /* increment error count */
          } else if ($(this).attr('data-type') == 'email' && is_email.test($(this).val()) == false) {
            /* remove previous error */
            $(this).parent().next().find('.err-msg').remove();
            /* remove previous error */

            /* display error message */
            $(this).parent().after('<p class="error-msg"><small>'+$(this).attr('data-type-error')+'</small></p>');
            /* display error message */

            /* increment error count */
            errors++;
            /* increment error count */
          } else if ($(this).attr('data-type') == 'confirm-password') {
            if ($(this).val() != $(temp_form+' input[data-type="password"]').val()) {
              /* remove previous error */
              $(this).parent().next().find('.err-msg').remove();
              /* remove previous error */

              /* display error message */
              $(this).parent().after('<p class="error-msg"><small>'+$(this).attr('data-type-error')+'</small></p>');
              /* display error message */

              /* increment error count */
              errors++;
              /* increment error count */
            }
          }
        }
        /* check if form-control has value */
      }
      /* check for data-required attribute */
    });
    /* loop through the form elements */

    /* return error count */
    return errors;
    /* return error count */
  }
  /* start form verification */
}
/* form verification class */

/* ajax processing class */
class Ajax {
  /* internal variables */
  constructor (url,data) {
    /* url of the file to execute */
    this.url = url;
    /* url of the file to execute */

    /* data to be sent */
    this.data = data;
    /* data to be sent */
  }
  /* internal variables */

  /* run ajax call */
  run () {
    /* create variable for return value */
    var is_success = 0;
    /* create variable for return value */

    /* run an ajax call */
    $.ajax({
      url: this.url,
      data: this.data,
      async: false,
      type: 'POST',
      contentType: false, /* NEEDED, DON'T OMIT THIS (requires jQuery 1.6+) */
      processData: false, /* NEEDED, DON'T OMIT THIS */
      success: function (results) {
        is_success = results;
      },
      error: (err) => {
        console.log('errors', err)
      }
    });
    /* run an ajax call */

    /* return results */
    return is_success;
    /* return results */
  }
  showData () {
    let records= null;
    $.ajax({
      url: this.url,
      data: this.data,
      async: false,
      type: 'GET',
      contentType: false, /* NEEDED, DON'T OMIT THIS (requires jQuery 1.6+) */
      processData: false, /* NEEDED, DON'T OMIT THIS */
      success: function (results) {
        records = results;
      },
      error: (err) => {
        console.log('errors', err)
      }
    });
    /* run an ajax call */

    /* return results */
    return records;
    /* return results */
  }
  /* run ajax call */
}
/* ajax processing class */

/* load template parts */
class TemplateParts {
  /* internal variables */
  constructor (template,target) {
    /* template part to call */
    this.template = template;
    /* template part to call */

    /* target element to display */
    this.target = target;
    /* target element to display */
  }
  /* internal variables */

  /* run ajax to load a template part */
  load () {
    /* assign target to a local variable */
    var target = this.target;
    /* assign target to a local variable */

    /* build the url */
    var url = '../template_parts/' + this.template + '.php';
    /* build the url */

    /* run ajax call */
    $.ajax({
      url: url,
      async: false,
      success: function (results) {
        /* display template part */
        $(target).html(results);
        /* display template part */
      }
    });
    /* run ajax call */
  }
  /* run ajax to load a template part */
}
/* load template parts */

/* hamburger navigation */
class Hamburger {
  /* internal variables */
  constructor () {
  }
  /* internal variables */

  load () {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
      // Uncomment Below to persist sidebar toggle between refreshes
      // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
      //     document.body.classList.toggle('sb-sidenav-toggled');
      // }
      sidebarToggle.addEventListener('click', event => {
        event.preventDefault();
        document.body.classList.toggle('sb-sidenav-toggled');
        localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
      });
    }
  }
}
/* hamburger navigation */