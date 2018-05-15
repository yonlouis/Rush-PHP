<?php
session_start();

if(isset($_POST['username'], $_POST['email'], $_POST['password'], $_GET['id']))
{
  echo "je rentre et c'est ,a joie";
  $newid = intval($_GET['id']);
  $_SESSION['id']=$_GET['id'];
  $newid = intval($_SESSION['id']);

  $bdd = connect_db('localhost', 'root', 'Aeqdwcrfv0106', '3306', 'pool_php_rush');
    $queryModif = $bdd->prepare("UPDATE users SET username = ?, email = ?, password = ?, admin = ? WHERE id = ?");
    if (!$queryModif->execute(array($_POST['username'], $_POST['email'], $_POST['password'], 1, $newid)))
      echo "Execute failed.";
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    var_dump($newid);
    header("Location: user.php");
}


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
  $checkMail = $this->bdd->prepare('SELECT email FROM users');
  $checkMail->execute();
  $userMail = $checkMail->fetchAll();
  foreach($userMail as $value) {
   if(isset($mail) && ($mail == $value['email']))
   {
     echo "Email already taken";
     return FALSE;
   }
 }
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
        <legend>username</legend>
        <input type="text" placeholder="Put login" title="Between 3 and 10 characters." name='username' id="username" required>
  <br>

        <legend>email</legend>
        <input type="text" placeholder="Put email" title="Between 3 and 15 characters." name='email' id="email" multiple>
<br>

        <legend>password</legend>
        <input name='password' type="password" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;" placeholder="Put Password" id="password" >
<br>

      <div class="intro-text">
        <p>
        <input type="checkbox" id="test5" />
        <label for="test5">Admin</label>
        </p>
      </div>
<br>
      <input type="submit" value="submit">
    </form>
  </div>
  </body>
</html>
