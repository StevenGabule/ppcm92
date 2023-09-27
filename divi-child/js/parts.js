let partsDataTable;
let post_id;

$(document).on('submit', '#createNewPartFrm', function (e) {
  e.preventDefault();
  let form = new FormVerification('#createNewPartFrm');
  let errors = form.verify();

  if (errors === 0) {
    const postId = $("input[name='post_id']").val();
    const form_body = $('#createNewPartFrm')[0];
    const formData = new FormData(form_body);
    formData.append('action', postId !== "" ? 'update_parts' : 'save_parts');
    let ajax = new Ajax('../wp-admin/admin-ajax.php', formData);
    let is_success = ajax.run();
    if (is_success) {
      $('#modalAdd').modal('hide');
      $('#datatable_parts').bootgrid('reload');
      form_body.reset();
    }
  }
})

$(document).on('click', '.close', function () {
  $('#createNewPartFrm')[0].reset();
  $('.modal').modal('hide');
  return false;
});

function resetValidateForm() {
  $('#partName,#partModel,#partRelatedCar,#partAudio,#partBodyWork,#partExhaust,#partExterior,#partInterior,#partLighting,#partOther,#partPerformance,#partSuspension').removeClass('error').next('label.error').remove();
}

$(document).on('click', '#btn_add_show', function () {
  resetValidateForm();
  $('#createNewPartFrm')[0].reset();
  $('.btn-edit').text('Submit');
  $('.modal-title-edit').text('Add New Part');
  $('#modalAdd').modal('show');
  return false;
});

// ** MODAL CONFIRMATION FOR DELETE
$(document).on('click', '.delete_show_modal', function () {
  let el = $(this);
  $('.delete-parts-modal').modal('show');
  post_id = el.attr('data-id');
  $('.delete-parts-modal .modal-body').html(`<p>Do you really want to delete ${el.attr('data-title')}?</p>`);
  return false; /* always return false so that when clicked it will not scroll up */
});

// ** MODAL FOR EDIT
$(document).on('click', '.edit_show_modal', function () {
  resetValidateForm();

  let el = $(this);
  const currentId = el.attr('data-id');
  const user_id = $('input[name="user_id"]').val();
  let ajax = new Ajax(`../wp-admin/admin-ajax.php?action=fetch_part_show&post_id=${currentId}&user_id=${user_id}`);
  const {
    post_title,
    part_model,
    part_audio,
    part_body_work,
    part_related_car,
    part_suspension,
    part_exhaust,
    part_exterior,
    part_interior,
    part_lighting,
    part_other,
    part_performance
  } = ajax.showData();
  $('.modal-title-edit').text('Edit Part')
  $('input[name="part_name"]').val(post_title);
  $('input[name="part_model"]').val(part_model);
  $('input[name="part_audio"]').val(part_audio);
  $('input[name="part_body_work"]').val(part_body_work);
  $('input[name="part_exhaust"]').val(part_exhaust);
  $('input[name="part_exterior"]').val(part_exterior);
  $('input[name="part_interior"]').val(part_interior);
  $('input[name="part_lighting"]').val(part_lighting);
  $('input[name="part_other"]').val(part_other);
  $('input[name="post_id"]').val(currentId);

  let selectElement = $("#partRelatedCar");
  selectElement.find('option').each(function () {
    if (part_related_car.includes($(this).val())) {
      $(this).prop('selected', true);
    }
  });

  $('#partPerformance').append(part_performance);
  $('#partSuspension').append(part_suspension);
  $('.btn-edit').text('Update');

  $('#modalAdd').modal('show');
  return false; /* always return false so that when clicked it will not scroll up */
});


function load_data_parts() {
  // partsDataTable = $('#datatable_parts').DataTable(
  //   {
  //     'ajax': '../wp-admin/admin-ajax.php?action=fetch_parts&user_id=' + $('input[name="user_id"]').val(),
  //     'responsive': true,
  //     'serverSide': true,
  //     'processing': true,
  //     'columns': [
  //       {data: 'ID', title: 'ID'},
  //       {data: 'post_title', title: 'Title'},
  //       {data: 'part_model', title: 'Model'},
  //       {data: 'part_related_car', title: 'Related Car'},
  //       {data: 'part_audio', title: 'Audio'},
  //       {data: 'part_body_work', title: 'Body Work'},
  //       {
  //         data: 'ID',
  //         title: 'Actions',
  //         render: function (data, type, row, meta) {
  //           return '<div class="d-grid gap-2 mb-2">' +
  //             '<button ' +
  //             'type="button" ' +
  //             'class="btn btn-primary edit edit_show_modal" ' +
  //             'data-id="' + row.ID + '" ' +
  //             'data-process="services">' +
  //             'Edit' +
  //             '</button>' +
  //             '</div>' +
  //             '<div class="d-grid gap-2">' +
  //             '<button ' +
  //             'type="button" ' +
  //             'class="btn btn-danger delete_show_modal" ' +
  //             'data-id="' + row.ID + '" ' +
  //             'data-title="' + row.post_title + '">' +
  //             'Delete' +
  //             '</button>' +
  //             '</div>';
  //         }
  //       },
  //     ]
  //   });
}

$(document).ready(function () {
  // load_data_parts();

  $("#createNewPartFrm").validate({
    rules: {
      part_name: 'required',
      part_model: 'required',
      part_related_car: 'required',
      part_audio: 'required',
      part_body_work: 'required',
      part_exhaust: 'required',
      part_exterior: 'required',
      part_other: 'required',
      part_interior: 'required',
      part_lighting: 'required',
      part_performance: 'required',
      part_suspension: 'required'
    },
    messages: {
      part_name: "Part name is required field.",
      part_model: "Part model is required field.",
      part_related_car: "Part related car is required field.",
      part_audio: "Part audio is required field.",
      part_body_work: "Part body work is required field.",
      part_exhaust: "Part exhaust is required field.",
      part_exterior: "Part exterior is required field.",
      part_other: "Part other is required field.",
      part_interior: "Part interior is required field.",
      part_lighting: "Part lighting is required field.",
      part_performance: "Part performance is required field.",
      part_suspension: "Part suspension is required field.",
    }
  })
});