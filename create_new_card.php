<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./styles.css">
    <link rel="icon" href="favicon.ico">
    <script src="./functions.js" charset="utf-8"></script>
    <title>create new card</title>
  </head>

  <body>
  <?php
  require_once './functions/common_functions.php';
  require_once './functions/kama_create_csv_file.php';
  require_once './functions/kama_parse_csv_file.php';
  require_once './constants.php';

  $deck_csv_file_path = './files/decks.csv';
  if (file_exists($deck_csv_file_path)) {
    $parse_csv_deck = kama_parse_csv_file( $deck_csv_file_path );
    //vd($parse_csv_deck);
  } else {
    echo 'До заполнения формы вам нужно создать хотя бы 1 deck' . 
    '<br>' . 
    '<div><a href="./create_new_deck.php" target="_blank">create new deck</a></div>';
  }
  
  
?>

<form action="./actions/create_new_card_action.php" method="post" name="create_new_card_form">
    <h3>Create new card:</h3>

    <div style="margin-bottom: 20px;">
      <div><label for="card_title">Title:</label></div>
      <input name="card_title" id="card_title" type="text" required minlength="2" style="width: 414px; max-width: 100%;">
    </div>

    <div style="margin-bottom: 20px;">
      <div><label for="question">Question:</label></div>
      <textarea required id="question" name="question" rows="3" cols="50"></textarea>
    </div>

    <div style="margin-bottom: 20px;">
      <div><label for="answer">Answer:</label></div>
      <textarea required id="answer" name="answer" rows="10" cols="50"></textarea>
    </div>

    <div style="margin-bottom: 20px;">
      <label for="deck_id">Choose a deck:</label>

      <select name="deck_id" id="decks_select" required>
        <?php
          if (isset($parse_csv_deck)) {
            $option_list = createListOfOptionTagFromArr($parse_csv_deck);
            echo $option_list;
          }
        ?>

      </select>

    </div>

    <button type="submit">Create</button>
</form>

</body>
</html>