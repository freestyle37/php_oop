<?php
require_once '../functions/common_functions.php';
require_once '../functions/kama_create_csv_file.php';
require_once '../functions/kama_parse_csv_file.php';
require_once '../constants.php';

//vd($_POST);


$post_arr = [];
$arr_for_written_to_file = [];
$scope_csv_file_path = '../files/scopes.csv';
$scope_id = 1;

foreach($_POST as $key => $val) {
  array_push($post_arr, $val);
}

//vd($post_arr);

if (file_exists($scope_csv_file_path)) {
  $arr_for_written_to_file = kama_parse_csv_file( $scope_csv_file_path );
  $scope_id = $arr_for_written_to_file[count($arr_for_written_to_file) - 1][0] + 1;
} else {
  $arr_for_written_to_file = BOILERPLATE_ARR_FOR_SCOPES;
}

array_unshift($post_arr, $scope_id);
array_push($arr_for_written_to_file, $post_arr);

kama_create_csv_file( $arr_for_written_to_file, $scope_csv_file_path );