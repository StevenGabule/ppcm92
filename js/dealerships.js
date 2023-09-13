let dealerShipDataTable;
let post_id;

$(document).on('submit', '#createNewDealershipFrm', function (e) {

  e.preventDefault();
  let form = new FormVerification('#createNewDealershipFrm');
  let errors = form.verify();

  if (errors === 0) {
    const postId = $("input[name='post_id']").val();
    const form_body = $('#createNewDealershipFrm')[0];
    const formData = new FormData(form_body);

    formData.append('action', postId !== "" ? 'update_dealerships' : 'save_dealerships');
    formData.append('service_lat_lng', `${lat},${lng}`)
    let ajax = new Ajax('../wp-admin/admin-ajax.php', formData);

    let is_success = ajax.run();

    if (is_success) {
      form_body.reset();
      window.location.href = "/account/?action=dealerships"
    }
  }
})

$(document).on('click', '.close', function () {
  $('#createNewDealershipFrm')[0].reset();
  $('.modal').modal('hide');
  return false;
});

function resetValidateForm() {
  $('#serviceLocation,#serviceDistance,#serviceShowRoom,#servicePartManufacturer,#serviceSpecialistGarage,#serviceOtherServices')
    .removeClass('error')
    .next('label.error')
    .remove();
}

$(document).on('click', '#btn_add_show', function () {
  post_id = '';
  $('input[name="post_id"]').val('');
  resetValidateForm();
  $('#createNewDealershipFrm')[0].reset();
  $('.btn-edit').text('Submit');
  $('.modal-title-edit').text('Add New Dealership');
  $('#modalAdd').modal('show');
  return false;
});

// ** MODAL CONFIRMATION FOR DELETE
$(document).on('click', '.delete_show_modal', function () {
  let el = $(this);
  $('.delete-dealerships-modal').modal('show');
  post_id = el.attr('data-id');
  $('.delete-dealerships-modal .modal-body').html(`<p>Do you really want to delete item?</p>`);
  return false; /* always return false so that when clicked it will not scroll up */
});

// ** MODAL FOR EDIT
$(document).on('click', '.edit_show_modal', function () {
  resetValidateForm();

  let el = $(this);
  const currentPostId = el.attr('data-id');
  const user_id = $('input[name="user_id"]').val();
  let ajax = new Ajax(`../wp-admin/admin-ajax.php?action=fetch_dealership&post_id=${currentPostId}&user_id=${user_id}`);
  const { service_location, service_distance, service_showrooms, service_part_manufacturer, service_specialist_garage, service_other_services } = ajax.showData();
  $('.modal-title-edit').text('Edit Dealership')
  $('input[name="service_location"]').val(service_location);
  $('input[name="service_distance"]').val(service_distance);
  $('#serviceShowRoom').val(service_showrooms);
  $('#servicePartManufacturer').val(service_part_manufacturer);
  $('#serviceSpecialistGarage').val(service_specialist_garage);
  $('#serviceOtherServices').val(service_other_services);
  $('input[name="post_id"]').val(currentPostId);

  $('.btn-edit').text('Update');

  $('#modalAdd').modal('show');
  return false; /* always return false so that when clicked it will not scroll up */
});


/* bind - delete */
$(document).on('click', '.button_delete_dealerships', function () {
  const form_data = new FormData();
  form_data.append('action', 'delete_dealerships');
  form_data.append('post_id', post_id);
  let ajax = new Ajax('../wp-admin/admin-ajax.php', form_data);
  ajax.run();

  $('.delete-dealerships-modal').modal('hide');

  $.notification(
    ["You successfully remove the existing record."],
    { position: ['top', 'right'],messageType: 'success',}
  )
  dealerShipDataTable.ajax.reload();
  post_id = '';
  return false;  /* always return false so that when clicked it will not scroll up */
});

function load_data_dealerships() {
  dealerShipDataTable = $('#datatable_dealerships').DataTable(
    {
      ajax: '../wp-admin/admin-ajax.php?action=fetch_dealerships&user_id=' + $('input[name="user_id"]').val(),
      responsive: true,
      serverSide: true,
      processing: true,
      columns: [
        {data: 'ID', title: 'ID'},
        {data: 'service_location', title: 'Location'},
        {data: 'service_distance', title: 'Distance'},
        {data: 'service_showrooms', title: 'Showroom'},
        {data: 'service_part_manufacturer', title: 'Part Manufacturer'},
        {data: 'service_specialist_garage', title: 'Specialist Garage'},
        {data: 'service_other_services', title: 'Other Services'},
        {
          data: 'ID',
          title: 'Actions',
          render: function (data, type, row, meta) {
            return `<div class="d-grid gap-2 mb-2"> 
                       <a href="/account/?action=dealerships&edit_dealership=true&post_id=${row.ID}" class="btn btn-primary" data-id="${row.ID}"  data-process="services"> 
                        Edit 
                       </a> 
                    </div> 
                    <div class="d-grid gap-2"> 
                      <button type="button" class="btn btn-danger delete_show_modal" data-id="${row.ID}" > 
                        Delete 
                      </button> 
                    </div>`;
          }
        },
      ]
    });
}


$(document).ready(function () {
  load_data_dealerships();

  $("#createNewDealershipFrm").validate({
    rules: {
      service_location: 'required',
      service_distance: 'required',
      service_showrooms: 'required',
      service_part_manufacturer: 'required',
      service_specialist_garage: 'required',
      service_other_services: 'required',
    },
    messages: {
      service_location: "Location is required field.",
      service_distance: "Distance is required field.",
      service_showrooms: "Showroom is required field.",
      service_part_manufacturer: "Part manufacturer is required field.",
      service_specialist_garage: "Specialist garage is required field.",
      service_other_services: "Other Services is required field.",
    }
  })
});