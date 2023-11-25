<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./styles.css">
    <link rel="icon" href="favicon.ico">
    <script src="./functions.js" charset="utf-8"></script>
    <title>create new scope</title>
  </head>

  <body>
<!--display all sopes if exists-->

<form action="./actions/create_new_scope_action.php" method="post" name="create_new_scope_form">
    <h3>Create new scope:</h3>

    <div style="margin-bottom: 20px;">
      <div><label for="scope_title">Title:</label></div>
      <input name="scope_title" id="scope_title" type="text" required minlength="2" style="width: 414px; max-width: 100%;">
    </div>

    <button type="submit">Create</button>
</form>

</body>
</html>