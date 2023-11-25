<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./styles.css">
    <link rel="icon" href="favicon.ico">
    <script src="./functions.js" charset="utf-8"></script>
    <title>create new deck</title>
  </head>

  <body>

<?php
  require_once './functions/common_functions.php';
  require_once './functions/kama_create_csv_file.php';
  require_once './functions/kama_parse_csv_file.php';
  require_once './constants.php';

  $scope_csv_file_path = './files/scopes.csv';
  if (file_exists($scope_csv_file_path)) {
    $parse_csv_scope = kama_parse_csv_file( $scope_csv_file_path );
    //vd($parse_csv_scope);
  } else {
    echo 'До заполнения формы вам нужно создать хотя бы 1 scope' . 
    '<br>' . 
    '<div><a href="./create_new_scope.php" target="_blank">create new scope</a></div>';
  }
  
  
?>

<form action="./actions/create_new_deck_action.php" method="post" name="create_new_deck_form">
    <h3>Create new deck:</h3>

    <div style="margin-bottom: 20px;">
      <div><label for="deck_title">Title:</label></div>
      <input name="deck_title" id="deck_title" type="text" required minlength="2" style="width: 414px; max-width: 100%;">
    </div>

    <div style="margin-bottom: 20px;">
      <label for="scope_id">Choose a scope:</label>

      <select name="scope_id" id="scopes_select" required>
        <?php 
          if (isset($parse_csv_scope)) {
            $option_list = createListOfOptionTagFromArr($parse_csv_scope);
            echo $option_list;
          }
        ?>

      </select>

    </div>

    <button type="submit">Create</button>
</form>

</body>
</html>