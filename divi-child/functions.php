<?php
/* get child theme directory */
$child_theme = str_replace('Divi', 'divi-child', get_template_directory());
/* get child theme directory */

/* include page related files */
require_once($child_theme . '/php/cars.php');
require_once($child_theme . '/php/dealerships.php');
require_once($child_theme . '/php/parts.php');
/* include page related files */

/* include styles and scripts */
function theme_styles_()
{
  /* divi child css */
  wp_enqueue_style('parent-style', get_theme_file_uri('./style.css'));
//  /* divi child css */
//
//  /* datatables css */
//  wp_enqueue_style('datatable-style', 'https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css');
//  wp_enqueue_style('datatable-style-bootstrap', get_theme_file_uri('./tools/bootstrap-5.1.1-dist/css/bootstrap.min.css'));
//  wp_enqueue_style('datatable-style-bootstrap-css', get_theme_file_uri('./tools/datatables/datatables.min.css'));
  /* datatables css */
}

add_action('wp_enqueue_scripts', 'theme_styles_');
/* include styles and scripts */

//function add_google_maps_script()
//{
//
//  $dependencies = array('jquery');
//  wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBGA8Qic326JUGpSKGHC7zA3VInj8C0DMY&libraries=places&callback=initAutocomplete', $dependencies);
//
//  // Add the 'async' and 'defer' attributes to the script
//  wp_script_add_data('google-maps', 'async', true);
//  wp_script_add_data('google-maps', 'defer', true);
//}

//add_action('wp_enqueue_scripts', 'add_google_maps_script');
function start_session() {
  if(!session_id()) {
    session_start();
  }
}
add_action('init', 'start_session', 1);


/* create the custom tabs for member presss */
function mepr_add_some_tabs($user)
{
  $cars_active = (isset($_GET['action']) && $_GET['action'] == 'cars') ? 'mepr-active-nav-tab' : '';
  ?>
  <span class="mepr-nav-item cars <?php echo $cars_active; ?>">
      <a href="/account/?action=cars">Cars</a>
    </span>
  <?php $parts_active = (isset($_GET['action']) && $_GET['action'] == 'parts') ? 'mepr-active-nav-tab' : ''; ?>
  <span class="mepr-nav-item parts <?php echo $parts_active; ?>">
      <a href="/account/?action=parts">Parts</a>
    </span>
  <?php $dealerships_active = (isset($_GET['action']) && $_GET['action'] == 'dealerships') ? 'mepr-active-nav-tab' : ''; ?>
  <span class="mepr-nav-item dealerships <?php echo $dealerships_active; ?>">
      <a href="/account/?action=dealerships">Dealerships</a>
    </span>
  <?php
}

add_action('mepr_account_nav', 'mepr_add_some_tabs');
/* create the custom tabs for memberpress */

/* add the custom tabs to memberpress navigation */
function mepr_add_tabs_content($action)
{
  switch ($action) {
    case 'cars':
      include('templates/cars.php');
      break;
    case 'parts':
      include('templates/parts.php');
      break;
    case 'dealerships':
      if (isset($_GET['add_new']) && $_GET['add_new']) {
        include('templates/dealership_add.php');
      } elseif (isset($_GET['edit_dealership']) && $_GET['edit_dealership'] && isset($_GET['post_id'])) {
        include('templates/dealership_edit.php');
      } else {
        include('templates/dealerships.php');
      }
      break;
    default:
      break;
  }
}

add_action('mepr_account_nav_content', 'mepr_add_tabs_content');
/* add the custom tabs to memberpress navigation */


?>