/* global variables */
let datatable;
let post_id;
/* global variables */

/* bind - show-add */
$(document).on('click', '.show-add', function () {
  /* show modal */
  $('.add-modal').modal('show');
  /* show modal */

  /* always return false so that when clicked it will not scroll up */
  return false;
  /* always return false so that when clicked it will not scroll up */
});
/* bind - show-add */

/* bind - add */
$(document).on('click', '.add', function () {
  /* create a new verification class */
  let form = new FormVerification('#cars-form');
  /* create a new verification class */

  /* initiate verification and get error count */
  let errors = form.verify();
  /* initiate verification and get error count */

  if (errors == 0) {
    /* get form */
    var form_body = $('#cars-form')[0];
    /* get form */

    /* assign form to FormData object */
    var form_data = new FormData(form_body);
    /* assign form to FormData object */

    /* append data to form object */
    form_data.append('action','save_cars');
    /* append data to form object */

    /* create a new ajax class */
    let ajax = new Ajax('../wp-admin/admin-ajax.php',form_data);
    /* create a new ajax class */

    /* run ajax call */
    let is_success = ajax.run();
    /* run ajax call */

    /* check for successfull operation */
    if (is_success.status == '1') {
      /* clear form */
      $('.form-control').val('');
      /* clear form */

      /* reload data */
      datatable.ajax.reload();
      /* reload data */

      /* hide modal */
      $('.add-modal').modal('hide');
      /* hide modal */
    }
    /* check for successfull operation */
  }

  /* always return false so that when clicked it will not scroll up */
  return false;
  /* always return false so that when clicked it will not scroll up */
});
/* bind - add */

/* bind - show-delete */
$(document).on('click', '.show-delete', function () {
  /* get element */
  let el = $(this);
  /* get element */

  /* show modal */
  $('.delete-modal').modal('show');
  /* show modal */

  /* assign post id to global */
  post_id = el.attr('data-id');
  /* assign post id to global */

  /* update modal body */
  $('.delete-modal .modal-body').html('<p>Do you really want to delete '+el.attr('data-title')+'?</p>');
  /* update modal body */

  /* always return false so that when clicked it will not scroll up */
  return false;
  /* always return false so that when clicked it will not scroll up */
});
/* bind - show-delete */

/* bind - delete */
$(document).on('click', '.delete', function () {
  /* assign form to FormData object */
  var form_data = new FormData();
  /* assign form to FormData object */

  /* append data to form object */
  form_data.append('action','delete_cars');
  form_data.append('post_id',post_id);
  /* append data to form object */

  /* create a new ajax class */
  let ajax = new Ajax('../wp-admin/admin-ajax.php',form_data);
  /* create a new ajax class */

  /* run ajax call */
  let is_success = ajax.run();
  /* run ajax call */

  /* hide modal */
  $('.delete-modal').modal('hide');
  /* hide modal */

  /* reload datatable data */
  datatable.ajax.reload();
  /* reload datatable data */

  /* always return false so that when clicked it will not scroll up */
  return false;
  /* always return false so that when clicked it will not scroll up */
});
/* bind - delete */

/* bind - close */
$(document).on('click', '.close', function () {
  /* hide modal */
  $('.modal').modal('hide');
  /* hide modal */

  /* always return false so that when clicked it will not scroll up */
  return false;
  /* always return false so that when clicked it will not scroll up */
});
/* bind - close */

/* function - load_data */
function load_data () {
  /* initiate datatable */
  datatable = $('#datatable').DataTable({
    'ajax': '../wp-admin/admin-ajax.php?action=fetch_cars&user_id='+$('input[name="user_id"]').val(),
    'responsive': true,
    'serverSide': true,
    'processing': true,
    'columns' : [
      { data:'car_image',title: 'Image', render: function (data, type, row, meta) { return '<img src="'+row.car_image.replace('/home/customer/www/ppcm92.sg-host.com/public_html','https://ppcm92.sg-host.com/')+'" style="width: 150px;">'; } },
      { data:'car_name',title: 'Name'},
      { data:'car_model',title: 'Model'},
      { data:'car_year',title: 'Year'},
      { data:'car_price',title: 'Price'},
      { data:'ID',title: 'Actions',render: function (data, type, row, meta) { return '<div class="d-grid gap-2 mb-2"><button type="button" class="btn btn-primary edit show-edit" data-id="'+row.id+'" data-process="services">Edit</button></div><div class="d-grid gap-2"><button type="button" class="btn btn-danger show-delete" data-id="'+row.ID+'" data-title="'+row.car_name+'">Delete</button></div>'; } },
    ]
  });
  /* initiate datatable */
}
/* function - load_data */

$(document).ready(function () {
  /* load data */
  load_data();
  /* load data */
});
