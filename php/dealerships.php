<?php

/*
 * Dealership is a service controller
 * */
function fetch_dealerships()
{
  global $wpdb;

  $currentUserId = $_REQUEST['user_id'];
  $table_name = 'qth_posts';
  $joined_table = 'qth_postmeta';
  $columns = "ID,
              post_author,
              post_title,
              post_date,
              (SELECT meta_value FROM $joined_table WHERE meta_key='service_location' AND post_id=ID) AS service_location,
              (SELECT meta_value FROM $joined_table WHERE meta_key='service_distance' AND post_id=ID) AS service_distance,
              (SELECT meta_value FROM $joined_table WHERE meta_key='service_showrooms' AND post_id=ID) AS service_showrooms,
              (SELECT meta_value FROM $joined_table WHERE meta_key='service_part_manufacturer' AND post_id=ID) AS service_part_manufacturer,
              (SELECT meta_value FROM $joined_table WHERE meta_key='service_other_services' AND post_id=ID) AS service_other_services,
              (SELECT meta_value FROM $joined_table WHERE meta_key='service_lat_lng' AND post_id=ID) AS service_lat_lng,
              (SELECT meta_value FROM $joined_table WHERE meta_key='service_specialist_garage' AND post_id=ID) AS service_specialist_garage";

  $sql = "SELECT $columns FROM $table_name WHERE post_author='" . $currentUserId . "' AND post_type='service'";
  $total_rows = $wpdb->get_results($sql);

  if (isset($_REQUEST['start'])) {
    $results = $wpdb->get_results("SELECT $columns FROM $table_name WHERE post_author='" . $currentUserId . "' AND post_type='service' ORDER BY ID DESC LIMIT " . $_REQUEST['start'] . "," . $_REQUEST['length']);
  } else {
    $results = $wpdb->get_results("SELECT $columns FROM $table_name WHERE post_author='" . $currentUserId . "' AND post_type='service' ORDER BY ID DESC ");
  }

  /* create responses for the datatable */
  $response['data'] = !empty($results) ? $results : [];
  $response['recordsTotal'] = !empty($total_rows) ? count($total_rows) : 0;
  $response['recordsFiltered'] = !empty($total_rows) ? count($total_rows) : 0;
  wp_send_json($response);
  die(); // to enclose 0 return;
}

// web hooks with callback function
add_action('wp_ajax_fetch_dealerships', 'fetch_dealerships');
function fetch_dealership()
{
  global $wpdb;

  $currentUserId = $_REQUEST['user_id'];
  $postId = $_REQUEST['post_id'];
  $table_name = 'qth_posts';
  $joined_table = 'qth_postmeta';
  $columns = "ID,
              post_author,
              post_title,
              post_date,
              (SELECT meta_value FROM $joined_table WHERE meta_key='service_location' AND post_id=ID) AS service_location,
              (SELECT meta_value FROM $joined_table WHERE meta_key='service_distance' AND post_id=ID) AS service_distance,
              (SELECT meta_value FROM $joined_table WHERE meta_key='service_showrooms' AND post_id=ID) AS service_showrooms,
              (SELECT meta_value FROM $joined_table WHERE meta_key='service_part_manufacturer' AND post_id=ID) AS service_part_manufacturer,
              (SELECT meta_value FROM $joined_table WHERE meta_key='service_other_services' AND post_id=ID) AS service_other_services,
              (SELECT meta_value FROM $joined_table WHERE meta_key='service_lat_lng' AND post_id=ID) AS service_lat_lng,
              (SELECT meta_value FROM $joined_table WHERE meta_key='service_specialist_garage' AND post_id=ID) AS service_specialist_garage";

  $sqlStr = "SELECT $columns FROM $table_name WHERE post_author='" . $currentUserId . "' AND post_type='service' AND id = " . $postId;
  $results = $wpdb->get_results($sqlStr . " ORDER BY ID DESC LIMIT 1");

  /* create responses for the datatable */
  $response = !empty($results) ? $results[0] : null;
  wp_send_json($response);
  die(); // to enclose 0 return;
}

// web hooks with callback function
add_action('wp_ajax_fetch_dealership', 'fetch_dealership');


function save_dealerships()
{
  global $wpdb;
  $table_name = 'qth_posts';
  $temp_array = array();
  $user_id = $_REQUEST['user_id'];
  $temp_array['post_author'] = $user_id;
  $temp_array['post_date'] = date('Y-m-d h:i:s');
  $temp_array['post_date_gmt'] = date('Y-m-d h:i:s');
  $temp_array['post_content'] = 'test';
  $temp_array['post_title'] = 'No title ' . $user_id;
  $temp_array['post_status'] = 'publish';
  $temp_array['comment_status'] = 'close';
  $temp_array['ping_status'] = 'close';

  $temp_array['post_name'] = strtolower(str_replace(' ', '-', 'No title ' . $user_id));
  $temp_array['post_parent'] = 0;
  $temp_array['menu_order'] = 0;
  $temp_array['post_type'] = 'service';
  $temp_array['comment_count'] = 0;

  $wpdb->insert($table_name, $temp_array);

  unset($temp_array);
  $post_id = $wpdb->insert_id;

  $wpdb->update($table_name, array('guid' => get_home_url() . '/?post_type=service&#038;p=' . $post_id), array('id' => $post_id));

  $table_name = 'qth_postmeta';

  foreach ($_REQUEST as $keyColumn => $valueColumn) {
    $temp_array = [];
    $temp_array['post_id'] = $post_id;
    $temp_array['meta_key'] = $keyColumn;
    $temp_array['meta_value'] = $valueColumn;
    $results = $wpdb->insert($table_name, $temp_array);
    unset($temp_array);
  }

  if(!empty($results)) {
    $_SESSION["added"] = true;
    $response['status'] = $results;
  } else {
    $response['status'] = 'error';
  }

  wp_send_json($response);
  die();
}

add_action('wp_ajax_save_dealerships', 'save_dealerships');

function update_dealerships()
{
  global $wpdb;

  $postId = $_REQUEST['post_id'];
  $table_name = 'qth_postmeta';
  $res = null;

  foreach ($_REQUEST as $keyColumn => $valueColumn) {
    $temp_array = [];
    $temp_array['meta_value'] = $valueColumn;
    $res = $wpdb->update($table_name, $temp_array, ['meta_key' => $keyColumn, 'post_id' => $postId]);
    unset($temp_array);
  }

  if (!$res) {
    $_SESSION["updated"] = true;
  }

  wp_send_json(true);
  die();
}

add_action('wp_ajax_update_dealerships', 'update_dealerships');

function delete_dealerships()
{
  global $wpdb;
  try {
    $table_name = 'qth_posts';
    $temp_array = array('ID' => $_REQUEST['post_id']);
    $wpdb->delete($table_name, $temp_array);

    $table_name = 'qth_postmeta';
    $temp_array = array('post_id' => $_REQUEST['post_id']);
    $results = $wpdb->delete($table_name, $temp_array);
    $response['status'] = !empty($results) ? $results : 'error';
    wp_send_json($response);
  } catch (Exception $e) {
    $response['status'] = $e->getMessage();
    wp_send_json($response);
  }
  die();
}

/* hook call - wp_ajax_ */
add_action('wp_ajax_delete_dealerships', 'delete_dealerships');