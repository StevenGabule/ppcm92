<link href="<?= get_home_url() . '/wp-content/themes/divi-child/tools/bootstrap-5.1.1-dist/css/bootstrap.min.css'; ?>" rel="stylesheet">
<link href="<?= get_home_url() . '/wp-content/themes/divi-child/tools/datatables/datatables.min.css'; ?>" rel="stylesheet">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="<?= get_home_url() . '/wp-content/themes/divi-child/style.css?random='.uniqid(); ?>" rel="stylesheet">

<div class="d-flex justify-content-between" style="align-items: center">
  <h3>Dealership/Showroom Management System</h3>
  <a class="btn btn-small btn-primary px-5 mb-0 align-item-center" style="align-self: center" href="/account/?action=dealerships&add_new=true"><span>New</span></a>
</div>

<br />

<div class="table-listing">
  <table class="table table-striped table-sm table-bordered align-middle" id="datatable_dealerships">
    <thead>
    <tr class="table-header">
      <td class="text-center">Id</td>
      <td class="text-center">Location</td>
      <td class="text-center">Distance</td>
      <td class="text-center">Showroom</td>
      <td class="text-center">Manufacturer</td>
      <td class="text-center">Garage</td>
      <td class="text-center">Other</td>
      <td class="text-center">Actions</td>
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
              <input type="text" id="SearchServiceLocation" placeholder="Enter a location"  /><br>
            </div>

            <div class="col-md-12">
              <label for="serviceDistance" class="form-label">Distance: <strong class="text-danger">*</strong></label>
              <input type="text" class="form-control" name="service_distance" id="serviceDistance">
            </div>

            <div class="col-md-6">
              <label for="serviceShowRoom" class="form-label">Show rooms: <strong class="text-danger">*</strong></label>
              <select class="form-select" aria-label="Default select example" id="serviceShowRoom" name="service_showrooms">
                <option value="">-- Select one --</option>
                <option value="Show rooms 1">Show rooms 1</option>
                <option value="Show rooms 2">Show rooms 2</option>
                <option value="Show rooms 3">Show rooms 3</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="servicePartManufacturer" class="form-label">Part Manufacturer: <strong class="text-danger">*</strong></label>
              <select class="form-select" aria-label="Default select example" name="service_part_manufacturer" id="servicePartManufacturer">
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
              <label for="serviceSpecialistGarage" class="form-label">Specialist Garage: <strong class="text-danger">*</strong></label>
              <select class="form-select" aria-label="Default select example" name="service_specialist_garage" id="serviceSpecialistGarage">
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
              <label for="serviceOtherServices" class="form-label">Other Services: <strong class="text-danger">*</strong></label>
              <select class="form-select" aria-label="Default select example" name="service_other_services" id="serviceOtherServices">
                <option value="">-- Select one --</option>
                <option value="Car cleaning">Car cleaning</option>
                <option value="Health check">Health check</option>
                <option value="Other">Other</option>
                <option value="Recovery">Recovery</option>
                <option value="Safety">Safety</option>
              </select>
            </div>

            <input type="hidden" name="user_id" value="<?= get_current_user_id(); ?>" />
            <input type="hidden" name="post_id" value="" />

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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary button_delete_dealerships">Yes</button>
        <button type="button" class="btn btn-default close">No</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= get_home_url() . '/wp-content/themes/divi-child/js/utils.js?random='.uniqid(); ?>"></script>
<script src="<?= get_home_url() . '/wp-content/themes/divi-child/tools/bootstrap-5.1.1-dist/js/bootstrap.min.js'; ?>"></script>
<script src="<?= get_home_url() . '/wp-content/themes/divi-child/tools/datatables/datatables.min.js'; ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" ></script>
<script src="<?= get_home_url() . '/wp-content/themes/divi-child/js/notifications.js?random='.uniqid(); ?>"></script>
<script src="<?= get_home_url() . '/wp-content/themes/divi-child/js/dealerships.js?random='.uniqid(); ?>"></script>
<script>
  const added = "<?= isset($_SESSION['added']) ?>";
  const updated = "<?= isset($_SESSION['updated']) ?>";

  if (added) {
    $.notification(
      ["You successfully added a new record."],
      { position: ['top', 'right'],messageType: 'success',}
    )
  }

  if (updated) {
    $.notification(
      ["You successfully updated the existing record."],
      { position: ['top', 'right'],messageType: 'success',}
    )
  }
</script>
<?php
  if (isset($_SESSION['added'])) unset($_SESSION['added']);
  if (isset($_SESSION['updated'])) unset($_SESSION['updated']);
?>
