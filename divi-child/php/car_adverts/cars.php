<?php
/* function - save_cars */
function save_cars () {
  /* wp globals */
  global $table_prefix, $wpdb;
  /* wp globals */
  
  /* insert to post table */
  
    /* table name */
    $table_name = 'qth_posts';
    /* table name */
    
    /* insert first the row */
    
      /* initialize temp_array */
      $temp_array = array();
      /* initialize temp_array */

      /* create the data to be inserted */
      $temp_array['post_author'] = $_REQUEST['user_id'];
      $temp_array['post_date'] = date('Y-m-d h:i:s');
      $temp_array['post_date_gmt'] = date('Y-m-d h:i:s');
      $temp_array['post_content'] = 'test';
      $temp_array['post_title'] = $_REQUEST['car_name'];
      $temp_array['post_status'] = 'publish';
      $temp_array['comment_status'] = 'close';
      $temp_array['ping_status'] = 'close';
      $temp_array['post_name'] = strtolower(str_replace(' ','-',$_REQUEST['car_name']));
      $temp_array['post_parent'] = 0;
      $temp_array['menu_order'] = 0;
      $temp_array['post_type'] = 'car';
      $temp_array['comment_count'] = 0;
      /* create the data to be inserted */
      
      /* run a query */
      $results = $wpdb->insert($table_name,$temp_array);
      /* run a query */
      
      /* unset the variable */
      unset($temp_array);
      /* unset the variable */

    /* insert first the row */
    
    /* update the post with the guid using the inserted id */
    
      /* get insert id */
      $insert_id = $wpdb->insert_id;
      /* get insert id */
      
      /* run a query */
      $results = $wpdb->update( $table_name, array('guid'=>get_home_url() . '/?post_type=car&#038;p=' . $insert_id), array('id'=>$insert_id) );
      /* run a query */
    
    /* update the post with the guid using the inserted id */     

  /* insert to post table */
  
  /* insert to post_meta table */
    
    /* table name */
    $table_name = 'qth_postmeta';
    /* table name */
    
    /* upload a file */
      if (isset($_FILES['car_image']) && $_FILES['car_image']['name'] != '') {
        //if ($_FILES['ATTACH_FILE']['type'] == 'application/pdf') {
          //if ($_FILES['ATTACH_FILE']['size'] < 5000000) {
            /* set upload folder */
            $target_path = get_stylesheet_directory() . "/php/car_adverts/";
            /* set upload folder */
            
            /* create file string to upload */
            $target_path = $target_path . basename( $_FILES['car_image']['name']);
            /* create file string to upload */ 
            
            /* upload the file */
            move_uploaded_file($_FILES['car_image']['tmp_name'], $target_path);
            /* upload the file */
            
            /* create the data to be inserted */
            $temp_array['post_id'] = $insert_id;
            $temp_array['meta_key'] = 'car_image';
            $temp_array['meta_value'] = $target_path;
            /* create the data to be inserted */
            
          /*} else {
            echo 'pdfsize';
            $err_count++;
          }*/
        /*} else {
          echo 'pdf';
          $err_count++;
        }*/
      }

      /* run a query */
      $results = $wpdb->insert($table_name,$temp_array);
      /* run a query */
      
      /* unset variable */
      unset($temp_array);
      /* unset variable */
      
    /* upload a file */
  
    foreach($_REQUEST as $key=>$val) {
      /* initialize temp_array */
      $temp_array = array();
      /* initialize temp_array */

      if ($key == 'car_modification') {
        $temp_mod = '';

        /* create the data to be inserted */
        $temp_array['post_id'] = $insert_id;
        $temp_array['meta_key'] = $key;
        /* create the data to be inserted */
        
        for ($i=0;$i<sizeOf($_REQUEST['car_modification']);$i++) {
          $temp_mod .= $_REQUEST['car_modification'][$i] . ',';
        }
        
        $temp_array['meta_value'] = $temp_mod;
      } else if ($key == 'car_work_required') {
        $temp_mod = '';

        /* create the data to be inserted */
        $temp_array['post_id'] = $insert_id;
        $temp_array['meta_key'] = $key;
        /* create the data to be inserted */
        
        for ($i=0;$i<sizeOf($_REQUEST['car_work_required']);$i++) {
          $temp_mod .= $_REQUEST['car_work_required'][$i] . ',';
        }
        
        $temp_array['meta_value'] = $temp_mod;
      } else if ($key == 'car_fuel') {
        $temp_mod = '';

        /* create the data to be inserted */
        $temp_array['post_id'] = $insert_id;
        $temp_array['meta_key'] = $key;
        /* create the data to be inserted */
        
        for ($i=0;$i<sizeOf($_REQUEST['car_fuel']);$i++) {
          $temp_mod .= $_REQUEST['car_fuel'][$i] . ',';
        }
        
        $temp_array['meta_value'] = $temp_mod;
      } else if ($key == 'car_gearbox') {
        $temp_mod = '';

        /* create the data to be inserted */
        $temp_array['post_id'] = $insert_id;
        $temp_array['meta_key'] = $key;
        /* create the data to be inserted */
        
        for ($i=0;$i<sizeOf($_REQUEST['car_gearbox']);$i++) {
          $temp_mod .= $_REQUEST['car_gearbox'][$i] . ',';
        }
        
        $temp_array['meta_value'] = $temp_mod;
      } else if ($key == 'car_body_type') {
        $temp_mod = '';

        /* create the data to be inserted */
        $temp_array['post_id'] = $insert_id;
        $temp_array['meta_key'] = $key;
        /* create the data to be inserted */
        
        for ($i=0;$i<sizeOf($_REQUEST['car_body_type']);$i++) {
          $temp_mod .= $_REQUEST['car_body_type'][$i] . ',';
        }
        
        $temp_array['meta_value'] = $temp_mod;
      } else if ($key == 'bike_body_type') {
        $temp_mod = '';

        /* create the data to be inserted */
        $temp_array['post_id'] = $insert_id;
        $temp_array['meta_key'] = $key;
        /* create the data to be inserted */
        
        for ($i=0;$i<sizeOf($_REQUEST['bike_body_type']);$i++) {
          $temp_mod .= $_REQUEST['bike_body_type'][$i] . ',';
        }
        
        $temp_array['meta_value'] = $temp_mod;
      } else if ($key == 'bike_body_type') {
        $temp_mod = '';

        /* create the data to be inserted */
        $temp_array['post_id'] = $insert_id;
        $temp_array['meta_key'] = $key;
        /* create the data to be inserted */
        
        for ($i=0;$i<sizeOf($_REQUEST['bike_body_type']);$i++) {
          $temp_mod .= $_REQUEST['bike_body_type'][$i] . ',';
        }
        
        $temp_array['meta_value'] = $temp_mod;
      } else {
        /* create the data to be inserted */
        $temp_array['post_id'] = $insert_id;
        $temp_array['meta_key'] = $key;
        $temp_array['meta_value'] = $val;
        /* create the data to be inserted */
      }
              
      /* run a query */
      $results = $wpdb->insert($table_name,$temp_array);
      /* run a query */
      
      /* unset variable */
      unset($temp_array);
      /* unset variable */
    }
    
    /* create responses for the datatable */
    $response['status'] = !empty($results) ? $results : 'error';        
    /* create responses for the datatable */
    
    /* send data back as json with appropriate headers */
    wp_send_json($response);
    /* send data back as json with appropriate headers */      

  /* insert to post_meta table */
      
  /* to prevent displaying 0 when doing an ajax call */
  die();
  /* to prevent displaying 0 when doing an ajax call */    
}
/* function - save_cars */

/* hook call - wp_ajax_ */
add_action('wp_ajax_save_cars', 'save_cars');
/* hook call - wp_ajax_ */

/* function - update_cars */
function update_cars () {
  /* wp globals */
  global $table_prefix, $wpdb;
  /* wp globals */
  
  /* initialize variable */
  $temp_array = array();
  /* initialize variable */
  
  /* prepare data to be updated */
  //$temp_array[]
  /* prepare data to be updated */
  
  /* run a query */
  $results = $wpdb->update($table_name,$temp_array,array('id'=>$_REQUEST['id']));
  /* run a query */

  /* create responses for the datatable */
  $response = !empty($results) ? $results : [];        
  /* create responses for the datatable */
  
  /* send data back as json with appropriate headers */
  wp_send_json($response);
  /* send data back as json with appropriate headers */
  
  /* to prevent displaying 0 when doing an ajax call */
  die();
  /* to prevent displaying 0 when doing an ajax call */    
}
/* function to update the row */

/* hook call - wp_ajax_ */
add_action('wp_ajax_update_cars', 'update_cars');
/* hook call - wp_ajax_ */

/* function - delete_cars */
function delete_cars () {
  /* wp globals */
  global $table_prefix, $wpdb;
  /* wp globals */
  
  /* delete from posts table first */

    /* initialize table name */
    $table_name = 'qth_posts';
    /* initialize table name */
    
    /* pass id to delete */
    $temp_array = array('ID'=>$_REQUEST['post_id']);
    /* pass id to delete */
    
    /* run a query */
    $results = $wpdb->delete($table_name,$temp_array);
    /* run a query */

  /* delete from posts table first */
  
  /* delete from post_meta table */
  
    /* initialize table name */
    $table_name = 'qth_postmeta';
    /* initialize table name */
    
    /* pass id to delete */
    $temp_array = array('post_id'=>$_REQUEST['post_id']);
    /* pass id to delete */
    
    /* run a query */
    $results = $wpdb->delete($table_name,$temp_array);
    /* run a query */
  
  /* delete from post_meta table */
  
  /* create responses for the datatable */
  $response['status'] = !empty($results) ? $results : 'error';        
  /* create responses for the datatable */
  
  /* send data back as json with appropriate headers */
  wp_send_json($response);
  /* send data back as json with appropriate headers */
  
  /* to prevent displaying 0 when doing an ajax call */
  die();
  /* to prevent displaying 0 when doing an ajax call */    
}
/* function - delete_cars */

/* hook call - wp_ajax_ */
add_action('wp_ajax_delete_cars', 'delete_cars');
/* hook call - wp_ajax_ */

/* function to fetch cars */
function fetch_cars () {
  /* wp globals */
  global $table_prefix, $wpdb;
  /* wp globals */
  
  /* table name */
  $table_name = 'qth_posts';
  $joined_table = 'qth_postmeta';
  /* table name */
  
  /* columns */
  $columns = "ID,
              post_author,
              post_title,
              post_date,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_name' AND post_id=ID) AS car_name,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_model' AND post_id=ID) AS car_model,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_year' AND post_id=ID) AS car_year,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_price' AND post_id=ID) AS car_price,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_image' AND post_id=ID) AS car_image";;
  /* columns */
  
  /* get total rows */
  $total_rows = $wpdb->get_results("SELECT $columns FROM $table_name WHERE post_author='".$_REQUEST['user_id']."' AND post_type='car'"); 
  /* get total rows */
  
  if (isset($_REQUEST['start'])) {
    /* run a query */
    $results = $wpdb->get_results("SELECT $columns FROM $table_name WHERE post_author='".$_REQUEST['user_id']."' AND post_type='car' ORDER BY ID DESC LIMIT ".$_REQUEST['start'].",".$_REQUEST['length']);
    /* run a query */
  } else {
    /* run a query */
    $results = $wpdb->get_results("SELECT $columns FROM $table_name WHERE post_author='".$_REQUEST['user_id']."' AND post_type='car' ORDER BY ID DESC ");
    /* run a query */
  }
  
  /* create responses for the datatable */
  $response['data'] = !empty($results) ? $results : [];        
  $response['recordsTotal'] = !empty($total_rows) ? count($total_rows) : 0;
  $response['recordsFiltered'] = !empty($total_rows) ? count($total_rows) : 0;
  /* create responses for the datatable */
  
  /* send data back as json with appropriate headers */
  wp_send_json($response);
  /* send data back as json with appropriate headers */
  
  /* to prevent displaying 0 when doing an ajax call */
  die();
  /* to prevent displaying 0 when doing an ajax call */    
}
/* function to fetch cars */

/* hook call - wp_ajax_ */
add_action('wp_ajax_fetch_cars', 'fetch_cars');
/* hook call - wp_ajax_ */

/* function to fetch cars front end */
function fetch_cars_frontend () {
  /* wp globals */
  global $table_prefix, $wpdb;
  /* wp globals */
  
  /* where clause */
  //$where = "WHERE post_type='car' AND (SELECT * FROM $joined_table WHERE meta_key='car_seller_type' AND meta_value='Trade' AND post_id=ID)";
  $where = "WHERE post_type='car'";
  /* where clause */
  
  /* table name */
  $table_name = 'qth_posts';
  $joined_table = 'qth_postmeta';
  $table_select = "$table_name LEFT JOIN $joined_table ON $table_name.ID=$joined_table.post_id"; 
  /* table name */
  
  /* columns */
  $columns = "ID,
              post_author,
              post_title,
              post_date,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_name' AND post_id=ID) AS car_name,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_model' AND post_id=ID) AS car_model,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_model_variant' AND post_id=ID) AS car_model_variant,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_type' AND post_id=ID) AS car_type,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_mileage' AND post_id=ID) AS car_mileage,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_engine_size' AND post_id=ID) AS car_engine_size,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_gearbox' AND post_id=ID) AS car_gearbox,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_fuel' AND post_id=ID) AS car_fuel,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_location' AND post_id=ID) AS car_location,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_year' AND post_id=ID) AS car_year,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_price' AND post_id=ID) AS car_price,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_image' AND post_id=ID) AS car_image,
              (SELECT meta_value FROM $joined_table WHERE meta_key='car_seller_type' AND post_id=ID) AS car_seller_type";
  /* columns */
  
  /* get total rows */
  $total_rows = $wpdb->get_results("SELECT $columns FROM $table_name $where"); 
  /* get total rows */
  
  if (isset($_REQUEST['start'])) {
    /* run a query */
    $results = $wpdb->get_results("SELECT $columns FROM $table_name $where ORDER BY ID DESC LIMIT ".$_REQUEST['start'].",".$_REQUEST['length']);
    /* run a query */
  } else {
    /* run a query */
    $results = $wpdb->get_results("SELECT $columns FROM $table_name $where ORDER BY ID DESC ");
    /* run a query */
  }
  
  /* create responses for the datatable */
  $response['data'] = !empty($results) ? $results : [];        
  $response['recordsTotal'] = !empty($total_rows) ? count($total_rows) : 0;
  $response['recordsFiltered'] = !empty($total_rows) ? count($total_rows) : 0;
  /* create responses for the datatable */
  
  /* send data back as json with appropriate headers */
  wp_send_json($response);
  /* send data back as json with appropriate headers */
  
  /* to prevent displaying 0 when doing an ajax call */
  die();
  /* to prevent displaying 0 when doing an ajax call */    
}
/* function to fetch cars front end */

/* hook call - wp_ajax_ */
add_action('wp_ajax_fetch_cars_frontend', 'fetch_cars_frontend');
/* hook call - wp_ajax_ */

/* function - fetch_filters */
function fetch_filters () {
  /* wp globals */
  global $table_prefix, $wpdb;
  /* wp globals */
  
  /* where clause */
  $where = "WHERE meta_key='".$_REQUEST['meta_key']."' GROUP BY meta_value";
  /* where clause */
  
  /* table name */
  $table_name = 'qth_postmeta';
  /* table name */
  
  /* columns */
  $columns = "meta_value";
  /* columns */
  
  /* get total rows */
  $total_rows = $wpdb->get_results("SELECT $columns FROM $table_name $where"); 
  /* get total rows */
  
  if (isset($_REQUEST['start'])) {
    /* run a query */
    $results = $wpdb->get_results("SELECT $columns FROM $table_name $where ORDER BY ID DESC LIMIT ".$_REQUEST['start'].",".$_REQUEST['length']);
    /* run a query */
  } else {
    /* run a query */
    $results = $wpdb->get_results("SELECT $columns FROM $table_name $where");
    /* run a query */
  }
  
  /* create responses for the datatable */
  $response['data'] = !empty($results) ? $results : [];        
  $response['recordsTotal'] = !empty($total_rows) ? count($total_rows) : 0;
  $response['recordsFiltered'] = !empty($total_rows) ? count($total_rows) : 0;
  /* create responses for the datatable */
  
  /* send data back as json with appropriate headers */
  wp_send_json($response);
  /* send data back as json with appropriate headers */
  
  /* to prevent displaying 0 when doing an ajax call */
  die();
  /* to prevent displaying 0 when doing an ajax call */    
}
/* function - fetch_filters */

/* hook call - wp_ajax_ */
add_action('wp_ajax_fetch_filters', 'fetch_filters');
/* hook call - wp_ajax_ */

?>
