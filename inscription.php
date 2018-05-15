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
 if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirmation'])) {
   if (checkName($_POST['username']) && checkMail($_POST['email']) && checkPasswd($_POST['password'], $_POST['password_confirmation'])) {
     $bdd = connect_db('localhost', 'root', 'Aeqdwcrfv0106', '3306', 'pool_php_rush');
     $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
     $sql = $bdd->prepare('INSERT INTO users (username, password, email, admin) VALUES (?, ?, ?, 0)');
     $sql->bindParam(1, $_POST['username']);
     $sql->bindParam(2, $_POST['password']);
     $sql->bindParam(3, $_POST['email']);
     $sql->execute();
     echo "User created";
     header("location:login.php");

   }
 }


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Hello guys!</title>
    <meta content="text/html"; charset="UTF-8">
  </head>
  <body>
    <form method='POST' action='inscription.php'>
    <fieldset>
        <legend>username</legend>
        <input type="text" placeholder="Put login" title="Between 3 and 10 characters." name='username' id="username" required>
    </fieldset><br>
    <fieldset>
        <legend>email</legend>
        <input type="text" placeholder="Put email" title="Between 3 and 15 characters." name='email' id="email" multiple required>
    </fieldset><br>
    <fieldset>
        <legend>password</legend>
        <input name='password' type="password" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;" placeholder="Put Password" id="password" required>
        <legend>password confirmation</legend>
        <input name='password_confirmation' type="password" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;" placeholder="Confirm Password" id="password_confirmation" required>

    </fieldset><br>
    <input type="submit" value="submit">
    </form>
  </body>
</html>
