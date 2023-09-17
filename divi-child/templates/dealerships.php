<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->
<!--<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>-->
<!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.css"/>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.js"></script>
<link href="<?php echo get_home_url() . '/wp-content/themes/divi-child/style.css?random='.uniqid(); ?>" rel="stylesheet">


<style>
</style>

<div class="d-flex justify-content-between" style="align-items: center">
  <div class="d-flex flex-column">
    <h3>Dealership/Showroom Management System</h3>
    <p class="text-muted" style="width: 60%;font-size: 15px">Easily track and manage the available products in the showroom, including
      their quantities, prices, and specifications. Keep real-time updates on stock levels and reorder points.</p>
  </div>
  <a class="btn btn-small btn-default px-5 mb-0 align-item-center text-black" style="align-self: center;padding: 10px 20px"
     href="/account/?action=dealerships&add_new=true"><span>New</span></a>
</div>

<br/>

<div class="table-listing">
  <table class="table table-striped table-sm table-bordered align-middle" id="datatable_dealerships">
    <thead>
    <tr class="table-header">
      <th class="text-center" data-column-id="ID" data-type="numeric">Id</th>
      <th class="text-center" data-column-id="service_location">Location</th>
      <th class="text-center" data-column-id="service_distance">Distance</th>
      <th class="text-center" data-column-id="service_showrooms">Showroom</th>
      <th class="text-center" data-column-id="service_part_manufacturer">Manufacturer</th>
      <th class="text-center" data-column-id="service_specialist_garage">Garage</th>
      <th class="text-center" data-column-id="service_other_services">Other</th>
      <th class="text-center" data-column-id="commands" data-formatter="commands" data-sortable="false">Actions</th>
    </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <form action="" class="modal-content" id="createNewDealershipFrm">
      <div class="modal-header">
        <h1 class="modal-title modal-title-edit fs-5" id="modalAddLabel">Add New Service</h1>
        <button type="button" class="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row g-3">
            <div class="col-md-12">
              <label for="serviceLocation" class="form-label">Location: <strong class="text-danger">*</strong></label>
              <!--              <input type="text" class="form-control" name="service_location" id="serviceLocation">-->
              <input type="text" id="SearchServiceLocation" placeholder="Enter a location"/><br>
            </div>

            <div class="col-md-12">
              <label for="serviceDistance" class="form-label">Distance: <strong class="text-danger">*</strong></label>
              <input type="text" class="form-control" name="service_distance" id="serviceDistance">
            </div>

            <div class="col-md-6">
              <label for="serviceShowRoom" class="form-label">Show rooms: <strong class="text-danger">*</strong></label>
              <select class="form-select" aria-label="Default select example" id="serviceShowRoom"
                      name="service_showrooms">
                <option value="">-- Select one --</option>
                <option value="Show rooms 1">Show rooms 1</option>
                <option value="Show rooms 2">Show rooms 2</option>
                <option value="Show rooms 3">Show rooms 3</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="servicePartManufacturer" class="form-label">Part Manufacturer: <strong
                  class="text-danger">*</strong></label>
              <select class="form-select" aria-label="Default select example" name="service_part_manufacturer"
                      id="servicePartManufacturer">
                <option value="">-- Select one --</option>
                <option value="Audio">Audio</option>
                <option value="Brakes">Brakes</option>
                <option value="Car Care">Car Care</option>
                <option value="Exhaust">Exhaust</option>
                <option value="Exterior">Exterior</option>
                <option value="Interior">Interior</option>
                <option value="Lighting">Lighting</option>
                <option value="Other">Other</option>
                <option value="Performance">Performance</option>
                <option value="Suspension">Suspension</option>
              </select>
            </div>

            <div class="col-md-12">
              <label for="serviceSpecialistGarage" class="form-label">Specialist Garage: <strong
                  class="text-danger">*</strong></label>
              <select class="form-select" aria-label="Default select example" name="service_specialist_garage"
                      id="serviceSpecialistGarage">
                <option value="">-- Select one --</option>
                <option value="Audio">Audio</option>
                <option value="Bodywork">Bodywork</option>
                <option value="Brakes">Brakes</option>
                <option value="Car Care">Car Care</option>
                <option value="Exhaust">Exhaust</option>
                <option value="Exterior">Exterior</option>
                <option value="General">General</option>
                <option value="Interior">Interior</option>
                <option value="Lighting">Lighting</option>
                <option value="Manufacturer Specialists">Manufacturer Specialists</option>
                <option value="Other">Other</option>
                <option value="Performance">Performance</option>
                <option value="Suspension">Suspension</option>
              </select>
            </div>

            <div class="col-md-12">
              <label for="serviceOtherServices" class="form-label">Other Services: <strong
                  class="text-danger">*</strong></label>
              <select class="form-select" aria-label="Default select example" name="service_other_services"
                      id="serviceOtherServices">
                <option value="">-- Select one --</option>
                <option value="Car cleaning">Car cleaning</option>
                <option value="Health check">Health check</option>
                <option value="Other">Other</option>
                <option value="Recovery">Recovery</option>
                <option value="Safety">Safety</option>
              </select>
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
<div class="modal delete-dealerships-modal" tabindex="-1" role="dialog">
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
        <button type="button" class="btn btn-primary button_delete_dealerships">Yes</button>
        <button type="button" class="btn btn-default exit-modal">No</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= get_home_url() . '/wp-content/themes/divi-child/js/utils.js?random=' . uniqid(); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="<?= get_home_url() . '/wp-content/themes/divi-child/js/notifications.js?random=' . uniqid(); ?>"></script>
<script src="<?= get_home_url() . '/wp-content/themes/divi-child/js/dealerships.js?random=' . uniqid(); ?>"></script>
<script>
  $(document).ready(function () {
    let post_id = 0;

    const added = "<?= isset($_SESSION['added']) ?>";
    const updated = "<?= isset($_SESSION['updated']) ?>";

    var dealershipable = $('#datatable_dealerships').bootgrid({
      ajax: true,
      rowSelect: true,
      post: function () {
        return {};
      },
      url: '../wp-admin/admin-ajax.php?action=fetch_dealerships&user_id=' + $('input[name="user_id"]').val(),
      formatters: {
        "commands": function (column, row) {
          return `<div class="d-grid gap-2 mb-2">
                       <a href="/account/?action=dealerships&edit_dealership=true&post_id=${row.ID}" class="btn btn-default text-black" data-id="${row.ID}"  data-process="services">
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
      dealershipable.find(".delete_show_modal").on("click", function (event) {
        let el = $(this);
        $('.delete-dealerships-modal').modal('show');
        post_id = el.attr('data-id');
        $("input[name='delete_post_id']").val(post_id)
        $('.delete-dealerships-modal .modal-body').html(`<p>Do you really want to delete item?</p>`);
        return false; /* always return false so that when clicked it will not scroll up */
      })
    })

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
