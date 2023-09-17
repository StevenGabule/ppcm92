<?php

function fetch_parts()
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
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_name' AND post_id=ID) AS part_name,
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_model' AND post_id=ID) AS part_model,
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_related_car' AND post_id=ID) AS part_related_car,
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_audio' AND post_id=ID) AS part_audio,
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_body_work' AND post_id=ID) AS part_body_work";

    if(isset($_POST["rowCount"])) {
      $records_per_page = $_POST["rowCount"];
    }

    if(isset($_POST["current"])) {
      $current_page_number = $_POST["current"];
    } else {
      $current_page_number = 1;
    }


    $start_from = ($current_page_number - 1) * $records_per_page;

    $sql = "SELECT $columns FROM $table_name WHERE (post_author='" . $currentUserId . "' AND post_type='part') ";

    if(!empty($_POST["searchPhrase"])) {
      $sql .= ' AND ((SELECT meta_value FROM '.$joined_table.' WHERE meta_key=\'part_name\' AND post_id=ID) LIKE "%'.$_POST["searchPhrase"].'%" ';
      $sql .= 'OR (SELECT meta_value FROM '.$joined_table.' WHERE meta_key=\'part_model\' AND post_id=ID) LIKE "%'.$_POST["searchPhrase"].'%" ';
      $sql .= 'OR (SELECT meta_value FROM '.$joined_table.' WHERE meta_key=\'part_related_car\' AND post_id=ID) LIKE "%'.$_POST["searchPhrase"].'%" ';
      $sql .= 'OR (SELECT meta_value FROM '.$joined_table.' WHERE meta_key=\'part_audio\' AND post_id=ID) LIKE "%'.$_POST["searchPhrase"].'%"  ';
      $sql .= 'OR (SELECT meta_value FROM '.$joined_table.' WHERE meta_key=\'part_body_work\' AND post_id=ID) LIKE "%'.$_POST["searchPhrase"].'%")  ';
    }

    $total_rows = $wpdb->get_results("SELECT $columns FROM $table_name WHERE post_author='" . $currentUserId . "' AND post_type='part'");
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
    $total_rows = $wpdb->get_results("SELECT $columns FROM $table_name WHERE post_author='" . $currentUserId . "' AND post_type='part'");

    $output = [
      'current'  => intval($_POST["current"]),
      'rowCount' => 10,
      'total' =>  !empty($total_rows) ? count($total_rows) : 0,
      'rows' => !empty($results) ? $results : [],
      'sql' => $sql
    ];

    wp_send_json($output);

//  if (isset($_REQUEST['start'])) {
//        $results = $wpdb->get_results("SELECT $columns FROM $table_name WHERE post_author='" . $currentUserId . "' AND post_type='part' ORDER BY ID DESC LIMIT " . $_REQUEST['start'] . "," . $_REQUEST['length']);
//    } else {
//        $results = $wpdb->get_results("SELECT $columns FROM $table_name WHERE post_author='" . $currentUserId . "' AND post_type='part' ORDER BY ID DESC ");
//    }
//
//    /* create responses for the datatable */
//    $response['data'] = !empty($results) ? $results : [];
//    $response['recordsTotal'] = !empty($total_rows) ? count($total_rows) : 0;
//    $response['recordsFiltered'] = !empty($total_rows) ? count($total_rows) : 0;
//    wp_send_json($response);
    die(); // to enclose 0 return;
}

// web hooks with callback function
add_action('wp_ajax_fetch_parts', 'fetch_parts');
function fetch_part_show()
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
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_name' AND post_id=ID) AS part_name,
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_model' AND post_id=ID) AS part_model,
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_related_car' AND post_id=ID) AS part_related_car,
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_audio' AND post_id=ID) AS part_audio,
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_body_work' AND post_id=ID) AS part_body_work,
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_related_car' AND post_id=ID) AS part_related_car,
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_exhaust' AND post_id=ID) AS part_exhaust,
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_exterior' AND post_id=ID) AS part_exterior,
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_interior' AND post_id=ID) AS part_interior,
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_lighting' AND post_id=ID) AS part_lighting,
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_other' AND post_id=ID) AS part_other,
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_performance' AND post_id=ID) AS part_performance,
              (SELECT meta_value FROM $joined_table WHERE meta_key='part_suspension' AND post_id=ID) AS part_suspension";

    $sqlStr = "SELECT $columns FROM $table_name WHERE post_author='" . $currentUserId . "' AND post_type='part' AND id = " . $postId;
    $results = $wpdb->get_results($sqlStr . " ORDER BY ID DESC LIMIT 1");

    /* create responses for the datatable */
    $response = !empty($results) ? $results[0] : null;
    wp_send_json($response);
    die(); // to enclose 0 return;
}

// web hooks with callback function
add_action('wp_ajax_fetch_part_show', 'fetch_part_show');


function save_parts()
{
    global $wpdb, $part_related_car;
    $table_name = 'qth_posts';
    $temp_array = array();

    $temp_array['post_author'] = $_REQUEST['user_id'];
    $temp_array['post_date'] = date('Y-m-d h:i:s');
    $temp_array['post_date_gmt'] = date('Y-m-d h:i:s');
    $temp_array['post_content'] = 'test';
    $temp_array['post_title'] = $_REQUEST['part_name'];
    $temp_array['post_status'] = 'publish';
    $temp_array['comment_status'] = 'close';
    $temp_array['ping_status'] = 'close';

    $temp_array['post_name'] = strtolower(str_replace(' ', '-', $_REQUEST['part_name']));
    $temp_array['post_parent'] = 0;
    $temp_array['menu_order'] = 0;
    $temp_array['post_type'] = 'part';
    $temp_array['comment_count'] = 0;

    $wpdb->insert($table_name, $temp_array);

    unset($temp_array);
    $insert_id = $wpdb->insert_id;

    $wpdb->update($table_name, array('guid' => get_home_url() . '/?post_type=part&#038;p=' . $insert_id), array('id' => $insert_id));

    $table_name = 'qth_postmeta';

    foreach ($_REQUEST as $keyColumn => $valueColumn) {
        $temp_array = [];
        $temp_array['post_id'] = $insert_id;
        $temp_array['meta_key'] = $keyColumn;
        if ($keyColumn == 'part_related_car') {
            $related = array();
            foreach ($valueColumn as $val) {
                $related[] = $val;
            }
            $temp_array['meta_value'] = implode(',', $related);
        } else {
            $temp_array['meta_value'] = $valueColumn;
        }
        $results = $wpdb->insert($table_name, $temp_array);
        unset($temp_array);
    }

    $response['status'] = !empty($results) ? $results : 'error';
    wp_send_json($response);
    die();
}

add_action('wp_ajax_save_parts', 'save_parts');

function update_parts()
{
    global $wpdb;

    $table_name = 'qth_posts';
    $postId = $_REQUEST['post_id'];
    $temp_array['post_title'] = $_REQUEST['part_name'];
    $temp_array['post_name'] = strtolower(str_replace(' ', '-', $_REQUEST['part_name']));
    $wpdb->update($table_name, $temp_array, ['id' => $postId]);
    $table_name = 'qth_postmeta';

    foreach ($_REQUEST as $keyColumn => $valueColumn) {
        $temp_array = [];
        if ($keyColumn == 'part_related_car') {
            $related = array();
            foreach ($valueColumn as $val) {
                $related[] = $val;
            }
            $temp_array['meta_value'] = implode(',', $related);
        } else {
            $temp_array['meta_value'] = $valueColumn;
        }
         $wpdb->update($table_name, $temp_array, ['meta_key' => $keyColumn, 'post_id' => $postId]);
        unset($temp_array);
    }

    wp_send_json(true);

    die();
}

add_action('wp_ajax_update_parts', 'update_parts');

function delete_parts()
{
    global  $wpdb;
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
        $response['status'] =$e->getMessage();
        wp_send_json($response);
    }
    die();
}

/* hook call - wp_ajax_ */
add_action('wp_ajax_delete_parts', 'delete_parts');