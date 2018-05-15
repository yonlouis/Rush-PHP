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
  /*$checkMail = $this->bdd->prepare('SELECT email FROM users');
  $checkMail->execute();
  $userMail = $checkMail->fetchAll();
  foreach($userMail as $value) {*/
   if(isset($mail) && ($mail == $value['email']))
   {
     echo "Email already taken";
     return FALSE;
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
if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['category_id'])) {
    $bdd = connect_db('localhost', 'root', 'Aeqdwcrfv0106', '3306', 'pool_php_rush');
    $sql = $bdd->prepare('INSERT INTO products (name, price, category_id) VALUES (?, ?, ?)');
    $sql->bindParam(1, $_POST['name']);
    $sql->bindParam(2, $_POST['price']);
    $sql->bindParam(3, $_POST['category_id']);
    if ($sql->execute())
      {

        header("location: product.php");
      }
      else {
        echo "user insertion failed";
      }

}


?>
<<!DOCTYPE html>
 <html>
   <head>
     <!--Import Google Icon Font-->
     <link href="bonus.css" rel="stylesheet" type="text/css">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

     <!--Import materialize.css-->
     <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

     <!--Let browser know website is optimized for mobile-->
     <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   </head>

   <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

   <body>
     <div class="container">
       <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

         <form class="col s12" method="post">
           <div class='row'>
             <div class='col s12'>
             </div>
           </div>

           <div class='row'>
             <div class='input-field col s12'>
               <input class="form-control" style='line-height' type='text' name='name' id='name' required/>
               <label for='name'>Enter product's name</label>
             </div>
           </div>

           <div class='row'>
             <div class='input-field col s12'>
               <input class="form-control" type='text' name='category_id' id='category_id' required>
               <label for='category_id'>Enter product's category</label>
             </div>



           <div class='row'>
             <div class='input-field col s12'>
               <input class="form-control" type='text' name='pricz' id='price' required>
               <label for='price'>Enter product's price</label>
             </div>

             <div class='row'>
               <div class='input-field col s12'>
                 <input class="form-control" type='text' name='description' id='description' required>
                 <label for='description'>Enter product's description</label>
               </div>


           <br />
           <center>
             <div class='row'>
               <button type='submit' name='login' class='col s12 btn btn-large waves-effect #42a5f5 blue lighten-1' value="login">Login</button>
             </div>
           </center>
         </form>
       </div>
     </div>

       <legend>Price</legend>
       <input name='price' type="text" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;" placeholder="Put Price" id="price" required>

   </fieldset><br>
   <fieldset>
       <legend>Desciption</legend>
       <textarea name='description' type="text" placeholder="Put the product's description" id="description" required></textarea>

   </fieldset><br>
   <input type="submit" value="submit">
   </form>
 </body>
</html>
