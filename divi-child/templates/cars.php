<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link href="<?php echo get_home_url() . '/wp-content/themes/divi-child/style.css?random='.uniqid(); ?>" rel="stylesheet">
  <style>
    #datatable_length {
      float: left;
      margin-bottom: 20px;}
    #datatable_filter {
      float: right;}
    .show-add {
      width: 0 !important;
      font-size: 16px !important;
      background: #ffdb00 !important;
      color: black !important;
      font-weight: bold !important;
    }
    .dataTables_paginate ul.paginate {
      list-style: none !important;
    }
  </style>
</head>


<div class="tools">
  <h1>Cars</h1>
  <button class="show-add"> Add Car Advert </button>
</div>

<br /><br />

<div class="table-listing">
  <table class="table table-striped table-bordered align-middle" id="datatable">
    <thead>
      <tr class="table-header">
        <td class="text-center">Details</td>
        <td class="text-center">Service</td>
        <td class="text-center">Service</td>
        <td class="text-center">Service</td>
        <td class="text-center">Service</td>
        <td class="text-center">Service</td>
      </tr> 
    </thead>
    <tbody>
    </tbody>
  </table>
</div>

<!-- add modal -->
<div class="modal add-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-size: 18px !important; padding-left: 20px">Add New Car Advert</h5>
        <button type="button" class="close" style="margin-top: -20px !important;  margin-right: 20px !important;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body " style="font-size: 16px !important;">
      
        <form action="" method="POST" enctype="multipart/form-data" name="cars-form" id="cars-form">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="car_name" value="" placeholder="Name">
          </div>
          <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" name="car_image" value="" placeholder="Image">
          </div>
          <div class="form-group">
            <label>Location</label>
            <input type="text" class="form-control" name="car_location" value="" placeholder="Location (complete address)">
          </div>
          <div class="form-group">
            <label>Vehicle Type</label>
            <select class="form-select" name="car_type" value="" placeholder="Vehicle Type">
              <option value="">Select vehicle type</option>
              <option value="Bike">Bike</option>
              <option value="Classic">Classic</option>
              <option value="Campervan">Campervan</option>
              <option value="Converted to Electric">Converted to Electric</option>
              <option value="Drift">Drift</option>
              <option value="Hot Rod">Hot Rod</option>
              <option value="Kit Car">Kit Car</option>
              <option value="Muscle">Muscle</option>
              <option value="Other">Other</option>
              <option value="Project">Project</option>
              <option value="Rally">Rally</option>
              <option value="Restored">Restored</option>
              <option value="Sleeper">Sleeper</option>
              <option value="Stock">Stock</option>
              <option value="Three Wheeled Car">Three Wheeled Car</option>
              <option value="Track">Track</option>
              <option value="Tuned">Tuned</option>
              <option value="Tuned">Tuned</option>
              <option value="Van">Van</option>
            </select>
          </div>
          <div class="form-group">
            <label>Manufacturer</label>
            <input type="text" class="form-control" name="car_manufacturer" value="" placeholder="Manufacturer">
          </div>
          <div class="form-group">
            <label>Model</label>
            <input type="text" class="form-control" name="car_model" value="" placeholder="Model">
          </div>
          <div class="form-group">
            <label>Model Variant</label>
            <input type="text" class="form-control" name="car_model_variant" value="" placeholder="Model Variant">
          </div>
          <div class="form-group">
            <label>Price</label>
            <input type="text" class="form-control" name="car_price" value="" placeholder="Price">
          </div>
          <div class="form-group">
            <label>Year</label>
            <input type="text" class="form-control" name="car_year" value="" placeholder="Year">
          </div>
          <div class="form-group">
            <label>Mileage</label>
            <input type="text" class="form-control" name="car_mileage" value="" placeholder="Mileage">
          </div>    
          <div class="form-group">
            <fieldset>      
              <legend>Modfication</legend>      
              <label><input type="checkbox" class="form-control" name="car_modification[]" value="Audio"> Audio</label>
              <label><input type="checkbox" class="form-control" name="car_modification[]" value="Bodywork"> Bodywork</label>
              <label><input type="checkbox" class="form-control" name="car_modification[]" value="Brakes"> Brakes</label>
              <label><input type="checkbox" class="form-control" name="car_modification[]" value="Exhaust"> Exhaust</label>
              <label><input type="checkbox" class="form-control" name="car_modification[]" value="Exterior"> Exterior</label>
              <label><input type="checkbox" class="form-control" name="car_modification[]" value="Interior"> Interior</label>
              <label><input type="checkbox" class="form-control" name="car_modification[]" value="Lighting"> Lighting</label>
              <label><input type="checkbox" class="form-control" name="car_modification[]" value="None"> None</label>
              <label><input type="checkbox" class="form-control" name="car_modification[]" value="Other"> Other</label>
              <label><input type="checkbox" class="form-control" name="car_modification[]" value="Performance"> Performance</label>
              <label><input type="checkbox" class="form-control" name="car_modification[]" value="Suspension"> Suspension</label>
            </fieldset>        
          </div>
          <div class="form-group">
            <fieldset>      
              <legend>Work Required</legend>      
              <label><input type="checkbox" class="form-control" name="car_work_required[]" value="Audio"> Audio</label>
              <label><input type="checkbox" class="form-control" name="car_work_required[]" value="Bodywork"> Bodywork</label>
              <label><input type="checkbox" class="form-control" name="car_work_required[]" value="Brakes"> Brakes</label>
              <label><input type="checkbox" class="form-control" name="car_work_required[]" value="Exhaust"> Exhaust</label>
              <label><input type="checkbox" class="form-control" name="car_work_required[]" value="Exterior"> Exterior</label>
              <label><input type="checkbox" class="form-control" name="car_work_required[]" value="Interior"> Interior</label>
              <label><input type="checkbox" class="form-control" name="car_work_required[]" value="Lighting"> Lighting</label>
              <label><input type="checkbox" class="form-control" name="car_work_required[]" value="None"> None</label>
              <label><input type="checkbox" class="form-control" name="car_work_required[]" value="Other"> Other</label>
              <label><input type="checkbox" class="form-control" name="car_work_required[]" value="Performance"> Performance</label>
              <label><input type="checkbox" class="form-control" name="car_work_required[]" value="Suspension"> Suspension</label>
            </fieldset>        
          </div>
          <div class="form-group">
            <label>Engine Size</label>
            <input type="text" class="form-control" name="car_engine_size" value="" placeholder="Engine Size">
          </div>
          <div class="form-group">
            <label>Stock BHP</label>
            <input type="text" class="form-control" name="car_stock_bhp" value="" placeholder="Stock BHP">
          </div>
          <div class="form-group">
            <label>Upgraded BHP</label>
            <input type="text" class="form-control" name="car_upgraded_bhp" value="" placeholder="Upgraded BHP">
          </div>          
          <div class="form-group">
            <fieldset>      
              <legend>Fuel</legend>      
              <label><input type="checkbox" class="form-control" name="car_fuel[]" value="Diesel"> Diesel</label>
              <label><input type="checkbox" class="form-control" name="car_fuel[]" value="Electric"> Electric</label>
              <label><input type="checkbox" class="form-control" name="car_fuel[]" value="Hybrid"> Hybrid</label>
              <label><input type="checkbox" class="form-control" name="car_fuel[]" value="Petrol"> Petrol</label>
            </fieldset>        
          </div>          
          <div class="form-group">
            <label>Average MPG</label>
            <div style="display: flex;">
              <input type="text" class="form-control" name="avg_mpg_from" value="" placeholder="From" style="flex-grow: 1; width: 48%; margin-right: 5px;">
              <input type="text" class="form-control" name="avg_mpg_to" value="" placeholder="To" style="flex-grow: 1; width: 48%; margin-left: 5px;">
            </div>
          </div>          
          <div class="form-group">
            <fieldset>      
              <legend>Gearbox</legend>      
              <label><input type="checkbox" class="form-control" name="car_gearbox[]" value="Automatic"> Automatic</label>
              <label><input type="checkbox" class="form-control" name="car_gearbox[]" value="Manual"> Manual</label>
              <label><input type="checkbox" class="form-control" name="car_gearbox[]" value="Semi-automatic"> Semi-automatic</label>
            </fieldset>        
          </div>
          <div class="form-group">
            <fieldset>      
              <legend>Body Type</legend>      
              <label><input type="checkbox" class="form-control" name="car_body_type[]" value="Campervan"> Campervan</label>
              <label><input type="checkbox" class="form-control" name="car_body_type[]" value="Car-derived Van"> Car-derived Van</label>
              <label><input type="checkbox" class="form-control" name="car_body_type[]" value="Convertible"> Convertible</label>
              <label><input type="checkbox" class="form-control" name="car_body_type[]" value="Coupe"> Coupe</label>
              <label><input type="checkbox" class="form-control" name="car_body_type[]" value="Estate"> Estate</label>
              <label><input type="checkbox" class="form-control" name="car_body_type[]" value="Hatchback"> Hatchback</label>
              <label><input type="checkbox" class="form-control" name="car_body_type[]" value="Limousine"> Limousine</label>
              <label><input type="checkbox" class="form-control" name="car_body_type[]" value="Minibus"> Minibus</label>
              <label><input type="checkbox" class="form-control" name="car_body_type[]" value="Other"> Other</label>
              <label><input type="checkbox" class="form-control" name="car_body_type[]" value="Panel van"> Panel van</label>
              <label><input type="checkbox" class="form-control" name="car_body_type[]" value="Pickup"> Pickup</label>
              <label><input type="checkbox" class="form-control" name="car_body_type[]" value="SUV"> SUV</label>
              <label><input type="checkbox" class="form-control" name="car_body_type[]" value="Saloon"> Saloon</label>
              <label><input type="checkbox" class="form-control" name="car_body_type[]" value="Window van"> Window van</label>
            </fieldset>        
          </div>                    
          <div class="form-group">
            <fieldset>      
              <legend>Body Type (Bike)</legend>      
              <label><input type="checkbox" class="form-control" name="bike_body_type[]" value="Adventure"> Adventure</label>
              <label><input type="checkbox" class="form-control" name="bike_body_type[]" value="Classic"> Classic</label>
              <label><input type="checkbox" class="form-control" name="bike_body_type[]" value="Cruiser"> Cruiser</label>
              <label><input type="checkbox" class="form-control" name="bike_body_type[]" value="Custom"> Custom</label>
              <label><input type="checkbox" class="form-control" name="bike_body_type[]" value="Dual-sport"> Dual-sport</label>
              <label><input type="checkbox" class="form-control" name="bike_body_type[]" value="Moped"> Moped</label>
              <label><input type="checkbox" class="form-control" name="bike_body_type[]" value="Naked"> Naked</label>
              <label><input type="checkbox" class="form-control" name="bike_body_type[]" value="Off-road"> Off-road</label>
              <label><input type="checkbox" class="form-control" name="bike_body_type[]" value="Other"> Other</label>
              <label><input type="checkbox" class="form-control" name="bike_body_type[]" value="Scooter"> Scooter</label>
              <label><input type="checkbox" class="form-control" name="bike_body_type[]" value="Sports bike"> Sports bike</label>
              <label><input type="checkbox" class="form-control" name="bike_body_type[]" value="Sports tourer"> Sports tourer</label>
              <label><input type="checkbox" class="form-control" name="bike_body_type[]" value="Tourer"> Tourer</label>
            </fieldset>        
          </div>
          <div class="form-group">
            <label>Additional Features</label>
            <input type="text" class="form-control" name="car_additional_features" value="" placeholder="Additional Features">
          </div>                              
          <div class="form-group">
            <label>Color</label>
            <input type="text" class="form-control" name="car_color" value="" placeholder="Color">
          </div>                              
          <div class="form-group">
            <label>Seller Type</label>
            <select class="form-select" name="car_seller_type" value="" placeholder="Seller Type">
              <option value="">Select seller type</option>
              <option value="Private">Private</option>
              <option value="Trade">Trade</option>
            </select>
            
            <!-- hidden fields -->
            <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">
            <!-- hidden fields -->
          </div>
          <div class="form-group">
            <label>Logbook Included</label>
            <select class="form-select" name="logbook_included" value="" placeholder="">
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
          </div>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary add">Add</button>
        <button type="button" class="btn btn-default close">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- add modal -->

<!-- delete modal -->
<div class="modal delete-modal" tabindex="-1" role="dialog">
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
        <button type="button" class="btn btn-primary delete">Yes</button>
        <button type="button" class="btn btn-default close">No</button>
      </div>
    </div>
  </div>
</div>
<!-- delete modal -->

<script src="<?php echo get_home_url() . '/wp-content/themes/divi-child/js/utils.js?random='.uniqid(); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="<?php echo get_home_url() . '/wp-content/themes/divi-child/js/cars.js?random='.uniqid(); ?>"></script>
