<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./styles.css">
    <link rel="icon" href="favicon.ico">
    <script src="./functions.js" charset="utf-8"></script>
    <title>php_oop</title>
  </head>

  <body>

  <div class="main">
    <?php 
      require_once './functions/common_functions.php';
      require_once './functions/kama_create_csv_file.php';
      require_once './functions/kama_parse_csv_file.php';
      require_once './constants.php';
    ?>
    <br>
    <?php vd(BOILERPLATE_ARR_FOR_CARDS); ?>

    <div><a href="./create_new_scope.php" target="_blank">create new scope</a></div>
    <div><a href="./create_new_deck.php" target="_blank">create new deck</a></div>
    <div><a href="./create_new_card.php" target="_blank">create new card</a></div>
  </div>

  </body>
</html>