<?php
session_start();

if(isset($_POST['name'], $_POST['price'], $_POST['description'], $_POST['category_id'], $_GET['id']))
{
  $newid = intval($_GET['id']);
  $_SESSION['id']=$_GET['id'];
  $newid = intval($_SESSION['id']);

  $bdd = connect_db('localhost', 'root', 'Aeqdwcrfv0106', '3306', 'pool_php_rush');
    $queryModif = $bdd->prepare("UPDATE products SET name = ?, price = ?, category_id = ?,description = ? WHERE id = ?");
    if (!$queryModif->execute(array($_POST['name'], $_POST['price'], $_POST['category_id'], $_POST['description'], $newid)))
      echo "Execute failed.";
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['price'] = $_POST['price'];
    $_SESSION['category_id'] = $_POST['category_id'];
    $_SESSION['description'] = $_POST['description'];

    header("Location: user.php");
}

function connect_db($host, $username, $password, $port, $db)
{
  try {
    $bdd = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8;", $username, $password);
    return $bdd;
  }
  catch (Exception $error) {
    echo $error->getMessage();
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Hello guys!</title>
    <meta content="text/html"; charset="UTF-8">
      <link href="style.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
      <title>Homepage</title>
  </head>
  <body>
    <div class="okbro">
    <form method='POST'>
        <legend>Product's name</legend>
        <input type="text" placeholder="Put name" title="Between 3 and 10 characters." name='username' id="username" required>
  <br>

        <legend>Price</legend>
        <input type="text" placeholder="Put price" title="Between 3 and 15 characters." name='email' id="email" multiple>
<br>

        <legend>Description</legend>
        <input type="text" placeholder="Put description" title="Between 3 and 300 characters." name='description' id="description" multiple>
<br>

        <legend>Category</legend>
        <input type="text" placeholder="Put category ID" title="Between 3 and 10 characters." name='description' id="description" multiple>
<br>

      <div class="intro-text">

      </div>
<br>
      <input type="submit" value="submit">
    </form>
  </div>
  </body>
</html>
