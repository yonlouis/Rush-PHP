<?php
include("config.php");

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table

//redirecting to the display page (index.php in our case)
$db = new PDO('mysql:host=localhost;dbname=pool_php_rush', 'root', 'Aeqdwcrfv0106');
   $msg = $db->prepare('SELECT id FROM products');
   $msg->execute();
   $count = $msg->rowCount();
   $query = $db->prepare('DELETE FROM products WHERE id=?');
   $query->execute(array($_GET['id']));
   header("Location:product.php");
?>
