<?php
session_start();

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

$bdd = connect_db('localhost', 'root', 'Aeqdwcrfv0106', '3306', 'pool_php_rush');
$querry = $bdd->prepare('SELECT * FROM users ORDER BY id');
?>

<!DOCTYPE html>
<html>
  <head>
  	<link href="stylesheets/user_css.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
 		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
 		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <title>Admin panel</title>
  </head>
  <body>
  <nav class="blue">
    <div class="nav-wrapper">
      <a href="index.php" class="brand-logo center"><img src="https://www.dominiquetian.fr/images/Logo-les-Republicains.png"></a>
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <a class="waves-effect waves-light btn" href="index.php">HOME</a>
          <?php
                if($_SESSION['admin'] == 1) {
                  echo "<li><a class='waves-effect waves-light btn' href='user.php'>ADMIN</a></li>";
                }
                else {
                  echo "";
                }

          ?>
          <a class = "btn dropdown-button" href = "#" data-activates = "dropdown">CATEGORIES</a>
          <i class = "mdi-navigation-arrow-drop-down right"></i></a>
          <ul id = "dropdown" class = "dropdown-content">
            <li><a href = "#">Books</a></li>
            <li><a href = "#!">Movies</a></li>
            <li><a href = "#">Plush</a></li>
          </ul>
        </ul>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <a class="waves-effect waves-light btn" href="login.php">LOGOUT</a>
          <li><a href="#"></a></li><br />
        </div>
        </ul>
    </nav> <br/> <br/> <br/>
    <table class="striped">
      <thead>
        <tr>
          <th>USERNAME</th>
          <th>EMAIL</th>
          <th>UPDATE</th>
        </tr>
      </thead>

      <?php
        $querry->execute();
        $fetch = $querry->fetchAll();
        sort($fetch);
        foreach($fetch as $value) {
          echo "<tr>";
          echo "<td>".$value['username']."</td>";
          echo "<td>".$value['email']."</td>";
          echo "<td><a href=\"edit_user.php?id=$value[id]\">Edit</a> | <a href=\"delete_user.php?id=$value[id]\" onClick=\"return confirm('Are you sure you want to delete this user ?')\">Delete</a></td>";
        }
      ?>

    </table><br/>
    <a href="create_user.php" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">add</i></a>  <br/> <br/><br/><br/>

    <table class="striped">
      <thead>
        <tr>
          <th>NAME OF THE PRODUCT</th>
          <th>PRICE (€)</th>
          <th>QUICK DESCRIPTION</th>
          <th>CATEGORY</th>
          <th>UPDATE</th>
        </tr>
      </thead>

      <?php
        $querry = $bdd->prepare('SELECT * FROM products ORDER BY id');
        $querry->execute();
        $fetch = $querry->fetchAll();
        sort($fetch);
        foreach($fetch as $value) {
          echo "<tr>";
          echo "<td>".$value['name']."</td>";
          echo "<td>".$value['price']."</td>";
          echo "<td>".$value['description']."</td>";
          echo "<td>".$value['category_id']."</td>";
          echo "<td><a href=\"edit_product.php?id=$value[id]\">Edit</a> | <a href=\"delete_product.php?id=$value[id]\" onClick=\"return confirm('Are you sure you want to delete this user ?')\">Delete</a></td>";
        }
      ?>

    </table><br/>
    <a href="create_user.php" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">add</i></a>

  </body>
</html>
