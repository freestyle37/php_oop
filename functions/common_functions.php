<?php
require_once __DIR__.'/kama_create_csv_file.php';
require_once __DIR__.'/kama_parse_csv_file.php';

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

function createListOfOptionTagFromArr_2($arr) {
  $list_of_option = '';
  foreach($arr as $key => $val) {
    $list_of_option .= '<option value="'. $val .'">'. $key .'</option>';
  }
  return $list_of_option;
}

function returnCardArr($card_csv_file_path, $deck_csv_file_path) {
  $parse_csv_card_arr = [];
  $parse_csv_deck_arr = [];
  $arr_of_unique_deck_ids = [];
  $assoc_arr_of_decks = [];
  $arr_of_cards_with_deck_info = [];

  if (file_exists($card_csv_file_path)) {
    $parse_csv_card_arr = kama_parse_csv_file($card_csv_file_path);

    foreach($parse_csv_card_arr as $key => $val) {
      if ($key === 0) {
        continue;
      }
      if (!in_array($val[4], $arr_of_unique_deck_ids)) {
        array_push($arr_of_unique_deck_ids, $val[4]);
      }
    }

  } else {
    echo '<div>no cards found</div>';
    return false;
  }

  if (file_exists($deck_csv_file_path)) {
    $parse_csv_deck_arr = kama_parse_csv_file($deck_csv_file_path);

    foreach($parse_csv_deck_arr as $key => $val) {
      if ($key === 0) {
        continue;
      }
      if (!in_array($val[0], $arr_of_unique_deck_ids)) {
        continue;
      }
      foreach($arr_of_unique_deck_ids as $k => $v) {
        if($v === $val[0]) {
          $assoc_arr_of_decks += [$val[1]=>$v];
        };
      }
    }

  } else {
    echo '<div>no decks found</div>';
    return false;
  }

  foreach($parse_csv_card_arr as $key => $val) {
    if ($key === 0) {
      array_push($parse_csv_card_arr[0], 'deck_title');
    }
    foreach($assoc_arr_of_decks as $k => $v) {
      if($parse_csv_card_arr[$key][4] === $v) {
        array_push($parse_csv_card_arr[$key], $k);
      }
    }
  }

  array_unshift($parse_csv_card_arr, $assoc_arr_of_decks);
  return $parse_csv_card_arr;
}

function displayListOfCards($prepared_arr_of_cards) {
  $deck_ar = $prepared_arr_of_cards[0];

  unset($prepared_arr_of_cards[0]);
  unset($prepared_arr_of_cards[1]);

  foreach($deck_ar as $key => $val) {
    echo '<div class="deck">
    <h4 class="deck-tit">'. $key .'</h4>';
    foreach($prepared_arr_of_cards as $k => $v) {
      if($val === $v[4]) {
        echo '<div class="card" data-card_id="'. $v[0] .'">'. 
        '<h5 class="card-tit">'. $v[1] .'</h5>' . 
        '<div class="card-quest">'. $v[2] .'</div>' . 
        '<button class="remove-card" type="button">remove</button>'
        .'</div>';
      }
    }
    echo '</div>';
  }
}

function displayListOfCards_2($prepared_arr_of_cards) {
  //vd($prepared_arr_of_cards);
  $deck_ar = $prepared_arr_of_cards[0];

  unset($prepared_arr_of_cards[0]);
  unset($prepared_arr_of_cards[1]);

  foreach($deck_ar as $key => $val) {
    echo '<div class="deck deck-rem" data-display_status="hide" data-deck_id="'. $val .'">
    <h4 class="deck-tit">'. $key .'</h4>';
    foreach($prepared_arr_of_cards as $k => $v) {
      if($val === $v[4]) {
        echo '<div class="card" data-card_id="'. $v[0] .'" data-display_status="hide">'. 
        '<h5 class="card-tit">'. $v[1] .'</h5>' . 
        '<div class="card-quest">'. $v[2] .'</div>' . 
        '<div class="card-answ" data-display_status="hide">'. $v[3] .'</div>' .
        '<button class="show-answer-but" type="button">show answer</button>'
        .'</div>';
      }
    }
    echo '</div>';
  }
}