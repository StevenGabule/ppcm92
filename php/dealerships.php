<?php

/*
 * Dealership is a service controller
 * */
function fetch_dealerships()
{
  global $wpdb;

  $query = '';
  $data = array();
  $records_per_page = 10;
  $start_from = 0;
  $current_page_number = 0;

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

  if(isset($_POST["rowCount"])) {
    $records_per_page = $_POST["rowCount"];
  }

  if(isset($_POST["current"])) {
    $current_page_number = $_POST["current"];
  } else {
    $current_page_number = 1;
  }

  $start_from = ($current_page_number - 1) * $records_per_page;

  $sql = "SELECT $columns FROM $table_name WHERE (post_author='" . $currentUserId . "' AND post_type='service') ";

  if(!empty($_POST["searchPhrase"])) {
    $sql .= ' AND ((SELECT meta_value FROM '.$joined_table.' WHERE meta_key=\'service_location\' AND post_id=ID) LIKE "%'.$_POST["searchPhrase"].'%" ';
    $sql .= 'OR (SELECT meta_value FROM '.$joined_table.' WHERE meta_key=\'service_distance\' AND post_id=ID) LIKE "%'.$_POST["searchPhrase"].'%" ';
    $sql .= 'OR (SELECT meta_value FROM '.$joined_table.' WHERE meta_key=\'service_showrooms\' AND post_id=ID) LIKE "%'.$_POST["searchPhrase"].'%" ';
    $sql .= 'OR (SELECT meta_value FROM '.$joined_table.' WHERE meta_key=\'service_part_manufacturer\' AND post_id=ID) LIKE "%'.$_POST["searchPhrase"].'%"  ';
    $sql .= 'OR (SELECT meta_value FROM '.$joined_table.' WHERE meta_key=\'service_other_services\' AND post_id=ID) LIKE "%'.$_POST["searchPhrase"].'%"  ';
    $sql .= 'OR (SELECT meta_value FROM '.$joined_table.' WHERE meta_key=\'service_specialist_garage\' AND post_id=ID) LIKE "%'.$_POST["searchPhrase"].'%")  ';
  }

  $order_by = '';
  if(isset($_POST["sort"]) && is_array($_POST["sort"])) {
    foreach($_POST["sort"] as $key => $value) {
      $order_by .= ' (SELECT meta_value FROM '.$joined_table.' WHERE meta_key="'.$key.'" AND post_id=ID) '.$value.', ';
    }
  } else {
    $sql .= 'ORDER BY ID DESC ';
  }

  if($order_by != '') {
    $sql .= ' ORDER BY ' . substr($order_by, 0, -2);
  }

  if($records_per_page != -1) {
    $sql .= " LIMIT " . $start_from . ", " . $records_per_page;
  }

  $results = $wpdb->get_results($sql);
  $total_rows = $wpdb->get_results("SELECT $columns FROM $table_name WHERE post_author='" . $currentUserId . "' AND post_type='service'");


  $output = [
    'current'  => intval($_POST["current"]),
    'rowCount' => 10,
    'total' =>  !empty($total_rows) ? count($total_rows) : 0,
    'rows' => !empty($results) ? $results : [],
    'sql' => $sql
  ];

  wp_send_json($output);

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