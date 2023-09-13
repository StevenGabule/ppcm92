<head>
  <link href="<?= get_home_url() . '/wp-content/themes/divi-child/tools/bootstrap-5.1.1-dist/css/bootstrap.min.css'; ?>"
        rel="stylesheet">
  <link href="<?= get_home_url() . '/wp-content/themes/divi-child/tools/datatables/datatables.min.css'; ?>"
        rel="stylesheet">
  <link href="<?= get_home_url() . '/wp-content/themes/divi-child/style.css?random=' . uniqid(); ?>" rel="stylesheet">
  <style>
    .input-group {
      flex-wrap: nowrap !important;
    }
  </style>
</head>

<div class="d-flex justify-content-between">
  <h3>Edit Dealership</h3>
  <button class="btn btn-small btn-primary px-5" onclick="history.back()">Go Back</button>
</div>

<form action="" id="createNewDealershipFrm">
  <div class="row g-3">
    <div class="col-md-6">
      <label for="serviceLocation" class="form-label">Location: <strong class="text-danger">*</strong></label>
      <input type="text" class="form-control" id="serviceLocation" placeholder="Enter a location"
             name="service_location"/><br>
    </div>

    <div class="col-md-6">
      <label for="serviceDistance" class="form-label">Distance: <strong class="text-danger">*</strong></label>
      <div class="input-group mb-3">
        <input type="number" class="form-control w-75" name="service_distance" id="serviceDistance" onkeyup="handleRadius()"
               aria-label="service distance" aria-describedby="basic-addon2">
        <span class="input-group-text" id="basic-addon2"><small>KM</small></span>
      </div>
    </div>

    <div class="col-12">
      <div id="map" class="w-100" style="height:304px"></div>
    </div>

    <div class="col-md-4">
      <label for="serviceShowRoom" class="form-label">Show rooms: <strong class="text-danger">*</strong></label>
      <select class="form-select" aria-label="Default select example" id="serviceShowRoom" name="service_showrooms">
        <option value="">-- Select one --</option>
        <option value="Show rooms 1">Show rooms 1</option>
        <option value="Show rooms 2">Show rooms 2</option>
        <option value="Show rooms 3">Show rooms 3</option>
      </select>
    </div>

    <div class="col-md-4">
      <label for="servicePartManufacturer" class="form-label">Part Manufacturer: <strong class="text-danger">*</strong></label>
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

    <div class="col-md-4">
      <label for="serviceSpecialistGarage" class="form-label">Specialist Garage: <strong class="text-danger">*</strong></label>
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
    <input type="hidden" name="post_id"/>

    <div class="col-12 mt-lg-5">
      <button type="submit" class="btn btn-primary px-5 py-2">Update</button>
    </div>
  </div>
</form>

<script src="<?= get_home_url() . '/wp-content/themes/divi-child/js/utils.js?random=' . uniqid(); ?>"></script>
<script src="<?= get_home_url() . '/wp-content/themes/divi-child/tools/bootstrap-5.1.1-dist/js/bootstrap.min.js'; ?>"></script>
<script src="<?= get_home_url() . '/wp-content/themes/divi-child/tools/datatables/datatables.min.js'; ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="<?= get_home_url() . '/wp-content/themes/divi-child/js/dealerships.js?random=' . uniqid(); ?>"></script>

<script>

  let pid = "<?= $_GET['post_id']; ?>"
  const user_id = "<?= get_current_user_id(); ?>";

  let ajax = new Ajax(`../wp-admin/admin-ajax.php?action=fetch_dealership&post_id=${pid}&user_id=${user_id}`);
  const {
    service_location,
    service_lat_lng,
    service_distance,
    service_showrooms,
    service_part_manufacturer,
    service_specialist_garage,
    service_other_services
  } = ajax.showData();

  $('input[name="service_location"]').val(service_location);
  $('input[name="service_distance"]').val(service_distance);
  $('#serviceShowRoom').val(service_showrooms);
  $('#servicePartManufacturer').val(service_part_manufacturer);
  $('#serviceSpecialistGarage').val(service_specialist_garage);
  $('#serviceOtherServices').val(service_other_services);
  $('input[name="post_id"]').val(post_id);

  let [lat, lng] = service_lat_lng.split(",");
  let map;
  let circle;
  let autocomplete;
  let marker;
  let serviceLocation = '';
  let infowindow;

  if (service_lat_lng) {
    function initializeMapWithPlace() {
      circle = null;
      lat = Number(lat);
      lng = Number(lng);

      // Simulate a pre-existing place and initial radius
      const preExistingPlace = {
        geometry: {
          location: {
            lat,
            lng,
          },
        },
        name: service_location,
      };


      map = new google.maps.Map(document.getElementById("map"), {center: {lat, lng}, zoom: 14});

      autocomplete = new google.maps.places.Autocomplete(document.getElementById("serviceLocation"), {
          types: ["establishment"],
          componentRestrictions: {country: "uk"},
          strictBounds: false,
        }
      );

      marker = new google.maps.Marker({map, draggable: true});

      infowindow = new google.maps.InfoWindow();

      if (preExistingPlace) {
        // Populate the input field with the pre-existing place name
        document.getElementById("serviceLocation").value = preExistingPlace.name;

        // Center the map on the pre-existing place's location
        map.setCenter(preExistingPlace.geometry.location);

        // Create and display the circle based on the initial radius
        if (service_distance > 0) {
          circle = new google.maps.Circle({
            map: map,
            center: preExistingPlace.geometry.location,
            radius: service_distance * 1000,
            fillColor: "#007bff",
            fillOpacity: 0.2,
            strokeColor: "#007bff",
            strokeOpacity: 0.8,
            strokeWeight: 2,
          });
        }
      }

      autocomplete.addListener("place_changed", function () {

        circle.setMap(null)
        circle = null;

        const place = autocomplete.getPlace();

        if (place.geometry && place.geometry.location) {

          lat = place.geometry.location.lat();
          lng = place.geometry.location.lng();

          // Move the marker to the selected place
          marker.setPosition({lat, lng});

          circle = new google.maps.Circle({
            map: map,
            center: {lat, lng}, // Center of the circle
            radius: Math.ceil(service_distance * 1000), // Radius in meters (adjust as needed)
            fillColor: "#007bff", // Fill color of the circle
            fillOpacity: 0.2, // Opacity of the circle
            strokeColor: "#007bff", // Border color of the circle
            strokeOpacity: 0.8, // Border opacity of the circle
            strokeWeight: 2, // Border width of the circle
          });

          serviceLocation = place.name

          // Update the input field with the selected place name
          document.getElementById("serviceLocation").value = serviceLocation;

          // Center the map on the selected place
          map.setCenter({lat: lat, lng: lng});

          // Display additional place details in an InfoWindow
          const content = `
            <h6>${place.name}</h6>
            <p>${place.formatted_address}</p>
          `;

          infowindow.setContent(content);
          infowindow.open(map, marker);
        }
      });

      // Add a dragend event listener to the marker
      marker.addListener("dragend", function () {

        // Get the marker's updated position (latitude and longitude)
        const markerPosition = marker.getPosition();

        // Reverse geocode to get place information
        const geocoder = new google.maps.Geocoder();
        geocoder.geocode({location: markerPosition}, function (results, status) {
          if (status === "OK" && results[0]) {
            circle.setMap(null)
            circle = null;

            const place = results[0];

            lat = place.geometry.location.lat();
            lng = place.geometry.location.lng();
            const currentPlaceName = place.name || place.plus_code.compound_code || "Location not found.";

            // Display additional place details in an InfoWindow
            const content = `
              <h6>${currentPlaceName}</h6>
              <p>${place.formatted_address}</p>
            `;

            $("#serviceLocation").val(currentPlaceName)
            infowindow.setContent(content);
            infowindow.open(map, marker);
          }
        });
      });
    }
  }


  function handleRadius() {
    lat = Number(lat);
    lng = Number(lng);

    if (circle) {
      circle.setMap(null)
      circle = null; // Set the circle reference to null
    }

    const val = $("#serviceDistance").val();

    if (circle !== null && String(val.trim()) === "") {
      circle.setMap(null)
      circle = null; // Set the circle reference to null
    } else if (String(val.trim()) !== "") {
      circle = new google.maps.Circle({
        map,
        center: {lat, lng}, // Center of the circle
        radius: Math.ceil(val * 1000), // Radius in meters (adjust as needed)
        fillColor: "#007bff", // Fill color of the circle
        fillOpacity: 0.2, // Opacity of the circle
        strokeColor: "#007bff", // Border color of the circle
        strokeOpacity: 0.8, // Border opacity of the circle
        strokeWeight: 2, // Border width of the circle
      });
    } else {
      circle.setMap(null)
      circle = null; // Set the circle reference to null
    }
  }


</script>

<script>
  function loadGoogleMaps() {
    const script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBGA8Qic326JUGpSKGHC7zA3VInj8C0DMY&libraries=places&callback=initializeMapWithPlace';
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);
  }

  loadGoogleMaps();
</script>