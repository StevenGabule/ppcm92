<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.css"/>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.js"></script>
  <link href="<?php echo get_home_url() . '/wp-content/themes/divi-child/style.css?random='.uniqid(); ?>" rel="stylesheet">

  <style>
    .form-control {
      display: block !important;
      width: 100% !important;
      padding: 0.375rem 0.75rem !important;
      font-size: 1rem !important;
      font-weight: 400 !important;
      line-height: 1.5 !important;
      color: #212529 !important;
      -webkit-appearance: none !important;
      -moz-appearance: none !important;
      appearance: none !important;
      background-color: #fff !important;
      background-clip: padding-box !important;
      border: 1px solid #dee2e6 !important;
      border-radius: var(--bs-border-radius) !important;
      transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out !important;
    }
  </style>
</head>
<div class="d-flex justify-content-between" style="align-items: center">
  <div class="d-flex flex-column">
    <h3>Parts Management System</h3>
    <p class="text-muted" style="width: 60%;font-size: 15px"> Easily track and manage the available products in the
      showroom, including
      their quantities, prices, and specifications. Keep real-time updates on stock levels and reorder points.</p>
  </div>
  <button role="button" class="btn btn-small btn-default px-5 mb-0 align-item-center text-black show-modal-parts"
          id="btn_add_show"
          style="padding: 10px;width: 100px;font-weight: bold;background-color: transparent;border-color: #adadad;font-size: 13px;">
    New
  </button>
</div>

<br/>

<div class="table-listing">
  <table class="table table-striped table-sm table-bordered align-middle" id="datatable_parts">
    <thead>
    <tr class="table-header">
      <th class="text-center" data-column-id="ID" data-type="numeric">Id</th>
      <th class="text-center" data-column-id="part_name">Title</th>
      <th class="text-center" data-column-id="part_model">Model</th>
      <th class="text-center" data-column-id="part_related_car">Relater Car</th>
      <th class="text-center" data-column-id="part_audio">Manufacturer</th>
      <th class="text-center" data-column-id="part_body_work">Garage</th>
      <th class="text-center" data-column-id="commands" data-formatter="commands" data-sortable="false">Actions</th>
    </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>


<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <form action="" class="modal-content" id="createNewPartFrm">
      <div class="modal-header">
        <h1 class="modal-title modal-title-edit fs-5" id="modalAddLabel" style="padding-left: 30px !important;">Add New Part</h1>
        <button type="button" class="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="width: 100%">
        <div class="container" style="width: 100%">
          <div class="row g-3">
            <div class="col-md-12">
              <label for="partName" class="form-label" style="font-size: 16px !important;font-weight: bold;text-align: left">Part Name</label>
              <input type="text" class="form-control" name="part_name" id="partName" style="font-size: 16px !important;">
            </div>
            <div class="col-md-6">
              <label for="partModel" class="form-label" style="  font-size: 16px !important;font-weight: bold;text-align: left;">Part Model</label>
              <input type="text" class="form-control" name="part_model" id="partModel" style="font-size: 16px !important;">
            </div>
            <div class="col-md-6">
              <label for="partCarRelated" class="form-label" style="  text-align: left;  font-size: 16px !important;font-weight: bold;">Part car related</label>
              <select class="form-select" id="partRelatedCar" name="part_related_car[]" required multiple
                      aria-label="Multiple select example" style="font-size: 16px !important;">
                <option value="manufacturer">Manufacturer</option>
                <option value="model">Model</option>
                <option value="model variant">Model Variant</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="partAudio" class="form-label" style="font-size: 16px !important;font-weight: bold;text-align: left;">Part Audio</label>
              <input type="text" class="form-control" id="partAudio" name="part_audio" placeholder="" style="font-size: 16px !important;">
            </div>
            <div class="col-md-6">
              <label for="partBodyWork" class="form-label" style="font-size: 16px !important;font-weight: bold;text-align: left;">Part Body Work</label>
              <input type="text" class="form-control" name="part_body_work" id="partBodyWork" style="font-size: 16px !important;">
            </div>

            <div class="col-md-4">
              <label for="partExhaust" class="form-label" style="font-size: 16px !important;font-weight: bold;text-align: left;">Part Exhaust</label>
              <input type="text" class="form-control" name="part_exhaust" id="partExhaust" style="font-size: 16px !important;">
            </div>
            <div class="col-md-4">
              <label for="partExterior" class="form-label" style="font-size: 16px !important;font-weight: bold;text-align: left;">Part Exterior</label>
              <input type="text" class="form-control" name="part_exterior" id="partExterior" style="font-size: 16px !important;">
            </div>
            <div class="col-md-4">
              <label for="partInterior" class="form-label" style="font-size: 16px !important;font-weight: bold;text-align: left;">Part Interior</label>
              <input type="text" class="form-control" name="part_interior" id="partInterior" style="font-size: 16px !important;">
            </div>

            <div class="col-md-6">
              <label for="partLighting" class="form-label" style="font-size: 16px !important;font-weight: bold;text-align: left;">Part Lighting</label>
              <input type="text" class="form-control" name="part_lighting" id="partLighting" style="font-size: 16px !important;">
            </div>

            <div class="col-md-6">
              <label for="partOther" class="form-label" style="font-size: 16px !important;font-weight: bold;text-align: left;">Part other</label>
              <input type="text" class="form-control" name="part_other" id="partOther" style="font-size: 16px !important;">
            </div>

            <div class="col-md-12">
              <label for="partPerformance" class="form-label" style="font-size: 16px !important;font-weight: bold;text-align: left;">Performance</label>
              <textarea class="form-control" style="font-size: 16px !important;" name="part_performance" rows="3" id="partPerformance"></textarea>
            </div>

            <div class="col-md-12">
              <label for="partSuspension" class="form-label" style="font-size: 16px !important;font-weight: bold;text-align: left;">Suspension</label>
              <textarea class="form-control" style="font-size: 16px !important;" name="part_suspension" rows="3" id="partSuspension"></textarea>
            </div>

            <input type="hidden" name="user_id" value="<?= get_current_user_id(); ?>"/>
            <input type="hidden" name="post_id" value=""/>

            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-edit">Submit</button>
            </div>

          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- delete modal -->
<div class="modal delete-parts-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">System Message</h5>
        <button type="button" class="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you want to delete this item?</p>
        <input type="hidden" name="delete_post_id">
      </div>
      <div class="modal-footer" style="text-align: center">
        <button type="button" class="btn btn-primary button_delete_parts">Yes</button>
        <button type="button" class="btn btn-default exit-modal">No</button>
      </div>
    </div>
  </div>
</div>


<script src="<?= get_home_url() . '/wp-content/themes/divi-child/js/utils.js?random=' . uniqid(); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="<?= get_home_url() . '/wp-content/themes/divi-child/js/notifications.js?random=' . uniqid(); ?>"></script>
<script src="<?= get_home_url() . '/wp-content/themes/divi-child/js/parts.js?random=' . uniqid(); ?>"></script>
<script>
  $(document).ready(function () {
    let post_id = 0;

    const added = "<?= isset($_SESSION['added']) ?>";
    const updated = "<?= isset($_SESSION['updated']) ?>";

    var partDataTable = $('#datatable_parts').bootgrid({
      ajax: true,
      rowSelect: true,
      post: function () {
        return {};
      },
      url: '../wp-admin/admin-ajax.php?action=fetch_parts&user_id=' + $('input[name="user_id"]').val(),
      formatters: {
        "commands": function (column, row) {
          return `<div class="d-grid gap-2 mb-2">
                       <a href="javascript:void(0)" class="btn btn-default text-black edit_show_modal" data-id="${row.ID}"  data-process="services">
                        Edit
                       </a>
                      <a href='javascript:void(0)' type="button" class="btn btn-default text-black delete_show_modal" data-id="${row.ID}" >
                        Delete
                      </a>
                    </div>`;
        }
      }
    });

    $(document).on("loaded.rs.jquery.bootgrid", function () {
      partDataTable.find(".delete_show_modal").on("click", function (event) {
        let el = $(this);
        $('.delete-parts-modal').modal('show');
        let post_id = el.attr('data-id');
        $("input[name='delete_post_id']").val(post_id)

        // $('.delete-dealerships-modal .modal-body').html(`<p>Do you really want to delete item?</p>`);
        return false; /* always return false so that when clicked it will not scroll up */
      })
    })

    $(document).on("loaded.rs.jquery.bootgrid", function () {
      partDataTable.find(".edit_show_modal").on("click", function (event) {
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
      })
    })


    /* bind - delete */
    $(document).on('click', '.button_delete_parts', function () {
      post_id = $("input[name='delete_post_id']").val();
      console.log('post_id', post_id)
      const form_data = new FormData();
      form_data.append('action', 'delete_parts');
      form_data.append('post_id', post_id);
      let ajax = new Ajax('../wp-admin/admin-ajax.php', form_data);
      ajax.run();

      $('.delete-parts-modal').modal('hide');
      $('#datatable_parts').bootgrid('reload');
      return false;  /* always return false so that when clicked it will not scroll up */
    });


    if (added) {
      $.notification(
        ["You successfully added a new record."],
        {position: ['top', 'right'], messageType: 'success',}
      )
    }

    if (updated) {
      $.notification(
        ["You successfully updated the existing record."],
        {position: ['top', 'right'], messageType: 'success',}
      )
    }
  })
</script>
<?php
if (isset($_SESSION['added'])) unset($_SESSION['added']);
if (isset($_SESSION['updated'])) unset($_SESSION['updated']);
?>
