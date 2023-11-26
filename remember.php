<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Roboto Mono">
    <link rel="icon" href="favicon.ico">
    <script src="./functions.js" charset="utf-8"></script>
    <title>remember</title>
  </head>

  <body>

  <div class="main">
    <?php 
      require_once './functions/common_functions.php';
      require_once './functions/kama_create_csv_file.php';
      require_once './functions/kama_parse_csv_file.php';
      require_once './constants.php';
    ?>

    <?php 
      $res = returnCardArr('./files/cards.csv', './files/decks.csv');
      $options_list = createListOfOptionTagFromArr_2($res[0]);

      echo '
        <form class="choose_deck_f">
          <div><label for="deck_id">Choose a deck:</label></div>
          <div class="choose_deck_f-select_wr"><select name="deck_select" id="deck_id" required>' .
          $options_list
          .'</select></div>
          <div><button type="submit" id="choose_deck_f_but">choose</button></div>
        </form>
      ';

      displayListOfCards_2($res);
    ?>
  </div>

  </body>
</html>