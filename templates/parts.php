<link href="<?= get_home_url() . '/wp-content/themes/divi-child/tools/bootstrap-5.1.1-dist/css/bootstrap.min.css'; ?>" rel="stylesheet">
<link href="<?= get_home_url() . '/wp-content/themes/divi-child/tools/datatables/datatables.min.css'; ?>" rel="stylesheet">
<link href="<?= get_home_url() . '/wp-content/themes/divi-child/style.css?random='.uniqid(); ?>" rel="stylesheet">

<div class="d-flex justify-content-between">
  <h3>Parts Management System</h3>
  <button class="btn btn-small btn-primary px-5 show-modal-parts" id="btn_add_show">Add</button>
</div>

<br />

<div class="table-listing">
  <table class="table table-striped table-sm table-bordered align-middle" id="datatable_parts">
    <thead>
    <tr class="table-header">
      <td class="text-center">Id</td>
      <td class="text-center">Title</td>
      <td class="text-center">Model</td>
      <td class="text-center">Related Car</td>
      <td class="text-center">Audio</td>
      <td class="text-center">Body Work</td>
      <td class="text-center">Actions</td>
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
        <h1 class="modal-title modal-title-edit fs-5" id="modalAddLabel">Add New Part</h1>
        <button type="button" class="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row g-3">
            <div class="col-md-12">
              <label for="partName" class="form-label">Part Name</label>
              <input type="text" class="form-control" name="part_name" id="partName">
            </div>
            <div class="col-md-6">
              <label for="partModel" class="form-label">Part Model</label>
              <input type="text" class="form-control" name="part_model" id="partModel">
            </div>
            <div class="col-md-6">
              <label for="partCarRelated" class="form-label">Part car related</label>
              <select class="form-select" id="partRelatedCar" name="part_related_car[]" required multiple aria-label="Multiple select example">
                <option value="manufacturer">Manufacturer</option>
                <option value="model">Model</option>
                <option value="model variant">Model Variant</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="partAudio" class="form-label">Part Audio</label>
              <input type="text" class="form-control" id="partAudio" name="part_audio" placeholder="">
            </div>
            <div class="col-md-6">
              <label for="partBodyWork" class="form-label">Part Body Work</label>
              <input type="text" class="form-control" name="part_body_work" id="partBodyWork">
            </div>

            <div class="col-md-4">
              <label for="partExhaust" class="form-label">Part Exhaust</label>
              <input type="text" class="form-control" name="part_exhaust" id="partExhaust">
            </div>
            <div class="col-md-4">
              <label for="partExterior" class="form-label">Part Exterior</label>
              <input type="text" class="form-control" name="part_exterior" id="partExterior">
            </div>
            <div class="col-md-4">
              <label for="partInterior" class="form-label">Part Interior</label>
              <input type="text" class="form-control" name="part_interior" id="partInterior">
            </div>

            <div class="col-md-6">
              <label for="partLighting" class="form-label">Part Lighting</label>
              <input type="text" class="form-control" name="part_lighting" id="partLighting">
            </div>

            <div class="col-md-6">
              <label for="partOther" class="form-label">Part other</label>
              <input type="text" class="form-control" name="part_other" id="partOther">
            </div>

            <div class="col-md-12">
              <label for="partPerformance" class="form-label">Performance</label>
              <textarea class="form-control" name="part_performance" rows="3" id="partPerformance"></textarea>
            </div>

            <div class="col-md-12">
              <label for="partSuspension" class="form-label">Suspension</label>
              <textarea class="form-control" name="part_suspension" rows="3" id="partSuspension"></textarea>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary button_delete_parts">Yes</button>
        <button type="button" class="btn btn-default close">No</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= get_home_url() . '/wp-content/themes/divi-child/js/utils.js?random='.uniqid(); ?>"></script>
<script src="<?= get_home_url() . '/wp-content/themes/divi-child/tools/bootstrap-5.1.1-dist/js/bootstrap.min.js'; ?>"></script>
<script src="<?= get_home_url() . '/wp-content/themes/divi-child/tools/datatables/datatables.min.js'; ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" ></script>
<script src="<?= get_home_url() . '/wp-content/themes/divi-child/js/parts.js?random='.uniqid(); ?>"></script>
