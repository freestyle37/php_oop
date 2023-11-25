<?php
require_once '../functions/common_functions.php';
require_once '../functions/kama_create_csv_file.php';
require_once '../functions/kama_parse_csv_file.php';
require_once '../constants.php';

//vd($_POST);


$post_arr = [];
$arr_for_written_to_file = [];
$deck_csv_file_path = '../files/decks.csv';
$deck_id = 1;

foreach($_POST as $key => $val) {
  array_push($post_arr, $val);
}

//vd($post_arr);

if (file_exists($deck_csv_file_path)) {
  $arr_for_written_to_file = kama_parse_csv_file( $deck_csv_file_path );
  $deck_id = $arr_for_written_to_file[count($arr_for_written_to_file) - 1][0] + 1;
} else {
  $arr_for_written_to_file = BOILERPLATE_ARR_FOR_DECKS;
}

array_unshift($post_arr, $deck_id);
array_push($arr_for_written_to_file, $post_arr);

kama_create_csv_file( $arr_for_written_to_file, $deck_csv_file_path );

echo '<div><a href="../create_new_card.php" target="_blank">create new card</a></div>';