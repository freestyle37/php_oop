<?php
  require_once '../functions/common_functions.php';
  require_once '../functions/kama_create_csv_file.php';
  require_once '../functions/kama_parse_csv_file.php';
  require_once '../constants.php';

  $some_file_path = '../files/cards.csv';
  $logFile = "../view.log";
  $id = $_POST['id'];
  $res;
  $info = [];
  
  if (file_exists($some_file_path)) {
    $arr_for_written_to_file = kama_parse_csv_file( $some_file_path );
    //$card_id = $arr_for_written_to_file[count($arr_for_written_to_file) - 1][0] + 1;
    foreach($arr_for_written_to_file as $key => $val) {
      if($key === 0) {
        continue;
      }
      
      if((int)$val[0] === (int)$id) {
        unset($arr_for_written_to_file[$key]);
        //array_push($info, $val[0], gettype($val[0]), $id, gettype($id), $val);
        //$res = $val;
      }
      
    }

    kama_create_csv_file( $arr_for_written_to_file, $some_file_path );
  }
  file_put_contents($logFile, json_encode($arr_for_written_to_file , JSON_UNESCAPED_UNICODE));
  echo $id;