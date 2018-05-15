<?php
session_start();
$host = "localhost";
$username = "root";
$password = "Aeqdwcrfv0106";
$database = "pool_php_rush";
$message = "";

try
{
     $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
     $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     if(isset($_POST["login"]))
     {
          if(empty($_POST["username"]) || empty($_POST["password"]))
          {
               $message = '<label>All fields are required</label>';
          }
          else
          {
               $query = "SELECT * FROM users WHERE username = :username AND password = :password";
               $statement = $connect->prepare($query);
               $statement->execute(
                    array(
                         ':username'     =>     $_POST["username"],
                         ':password'     =>     $_POST["password"]
                    )
               );

               $fetch = $statement->fetchAll();
              // var_dump($fetch);

              $_SESSION['admin'] = $fetch[0]['admin'];
               ($_SESSION['admin']);
               $count = $statement->rowCount();
               if($count > 0)
               {
                    $_SESSION["username"] = $_POST["username"];
                    header("Location: index.php");
               }
               else
               {
                    $message = '<label>T\'as fais une erreur ...</label>';
               }
          }
     }
}
catch(PDOException $error)
{
     $message = $error->getMessage();
}

?>
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

      <h5 class="blue-text">Please, login into your account</h5>
      <div class="section"></div>

      <div class="container">
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

          <form class="col s12" method="post">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class="form-control" style='line-height' type='text' name='username' id='username' required/>
                <label for='username' data-error="wrong username" data-success="right username">Enter your login / email</label>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class="form-control" type='password' name='password' id='password' required>
                <label for='password'>Enter your password</label>
              </div>
              <label style='float: right;'>
								<a class='pink-text' href='#!'><b>Forgot Password?</b></a>
							</label>
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
      <a href="register.php">Create account now</a>
    </center>

    <div class="section"></div>
    <div class="section"></div>
  </main>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
</body>

</html>
