<?php

function vd($data) {
  echo "<pre>";
  print_r( $data );
  echo "</pre>";
}

function createListOfOptionTagFromArr($arr) {
  $list_of_option = '';
  foreach($arr as $key => $val) {
    if($key !== 0) {
      $list_of_option .= '<option value="'. $val[0] .'">'. $val[1] .'</option>';
    }
  }
  return $list_of_option;
}