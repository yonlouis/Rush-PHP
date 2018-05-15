<?php
 function checkName($username)
 {
   if (isset($username) && (strlen($username) < 3 || strlen($username) > 10)){
     echo "Invalid name";
     return FALSE;
   }
   else {
     return TRUE;
   }
 }
 function checkPasswd($passwd, $passwd2)
 {
   if (isset($passwd) && isset($passwd2) && ((strlen($passwd) < 3 || strlen($passwd) > 10) || $passwd != $passwd2)) {
     echo "Wrong password";
     return FALSE;
   }
   else {
     return TRUE;
   }
 }
 function checkMail($mail)
 {
   if (isset($mail) && (filter_var($mail, FILTER_VALIDATE_EMAIL) == FALSE)) {
     echo "wrong email";
     return FALSE;
   }
   else {
     return TRUE;
   }
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
 if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])) {
   if (checkName($_POST['username']) && checkMail($_POST['email']) && checkPasswd($_POST['password'], $_POST['passwordConfirm'])) {
     $bdd = connect_db('localhost', 'root', 'Aeqdwcrfv0106', '3306', 'pool_php_rush');
     $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
     $sql = $bdd->prepare('INSERT INTO users (username, password, email, admin) VALUES (?, ?, ?, 0)');
     $sql->bindParam(1, $_POST['username']);
     $sql->bindParam(2, $_POST['password']);
     $sql->bindParam(3, $_POST['email']);
     $sql->execute();
     echo "User created";
     header("Location:login.php");
   }
 }
?>

<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">

  </style>
</head>

<body>
  <div class="section"></div>
  <main>
    <center>
      <img class="responsive-img"/>
      <div class="section"></div>

      <h5 class="blue-text">Create your ID</h5>
      <div class="section"></div>

<div class="container">
<div class="row">
    <form method='POST' class="col s12" id="reg-form">
      <div class="row">

        <div class="input-field col s12">
          <input id="username" name="username" type="text" class="validate" required>
          <label for="username">Username</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" name="email" type="email" class="validate" required>
          <label for="email">E-mail</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" name="password" type="password" class="validate" minlength="6" required>
          <label for="password">Password</label>
        </div>
        <div class="input-field col s12">
          <input id="passwordConfirm" name="passwordConfirm" type="password" class="validate" minlength="6" required>
          <label for="passwordConfirm">Confirm Password</label>
        </div>
      </div>

        <div class="input-field col s6 ">
          <button class="btn btn-large btn-register waves-effect waves-light" type="submit" value="submit" name="action">Register
            <i class="material-icons right">done</i>
          </button>
        </div>
      </div>
    </form>
  </div>
  <a href="login.php" title="Login" class="ngl btn-floating btn-large waves-effect waves-light red"><i class="material-icons">input</i></a>
</div>
</center>
</main>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
</body>

</html>
