<?php
require_once '../functions/common_functions.php';
require_once '../functions/kama_create_csv_file.php';
require_once '../functions/kama_parse_csv_file.php';
require_once '../constants.php';

//vd($_POST);

//vd(BOILERPLATE_ARR_FOR_CARDS);

$post_arr = [];
$arr_for_written_to_file = [];
$card_csv_file_path = '../files/cards.csv';
$card_id = 1;

foreach($_POST as $key => $val) {
  array_push($post_arr, $val);
}

if (file_exists($card_csv_file_path)) {
  $arr_for_written_to_file = kama_parse_csv_file( $card_csv_file_path );
  $card_id = $arr_for_written_to_file[count($arr_for_written_to_file) - 1][0] + 1;
} else {
  $arr_for_written_to_file = BOILERPLATE_ARR_FOR_CARDS;
}

array_unshift($post_arr, $card_id);
array_push($post_arr, "red");
//vd($post_arr);
array_push($arr_for_written_to_file, $post_arr);

kama_create_csv_file( $arr_for_written_to_file, $card_csv_file_path );

echo '<div><a href="../create_new_card.php">create new card</a></div>';