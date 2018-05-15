<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
  	<link href="stylesheets/index_css.css" rel="stylesheet" type="text/css">
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
          <a class="waves-effect waves-light btn" href="#">ABOUT US</a>
        </ul>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <a class="waves-effect waves-light btn" href="login.php">LOGOUT</a>
          <li><a href="#"></a></li><br />
        </ul>
      </div>
    </nav> <br/> <br/> <br/>

<div class="container">
   <div class="row">
    <div class="col s12 m4 l4">
      <div class="card z-depth-3">
        <div class="hoverable">
          <div class="card-image">
            <img class="materialboxed" width="550" src="Femme Mode ours oreille casquette peluche manteaux - Beige Achat_02.jpg">
          </div>
          <div class="card-content max-width: 70%">
            <p><span class="boldness">Peluche licorne</span> <br>Peluche de licorne très connue qui est apparue dans un dessin animé.<br>1000 €</p>
          </div>

          <div class="card-action">
            <a href="store.html">Commander</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col s12 m4 l4">
      <div class="card z-depth-3">
        <div class="hoverable">
          <div class="card-image">
            <img class="materialboxed" width="550" src="GU198165_6.jpg">
          </div>
          <div class="card-tabs">
            <ul class="tabs tabs-fixed-width">
              <li class="tab"><a href="active">The Original</a></li>
              <li class="tab"><a  src="/home/yon/Rendu/licorne/licorne-cle-usb.jpg" href="#test5">The New One</a></li>
            </ul>
          </div>
          <div class="card-content">
            <p><span class="boldness">Tasse licorne</span> <br>Parce-que coder c'est cool, mais coder avec du café c'est mieux, voici une super tasse.<br>179 €</p>
          </div>
          <div class="card-action">
            <a href="store.html">Commander</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col s12 m4 l4">
      <div class="card z-depth-3">
        <div class="hoverable">
          <div class="card-image">
            <img class="materialboxed" width="550" src="les-francais-d-abord.jpg">
          </div>
          <div class="card-content">
            <p><span class="boldness">Clé USB</span> <br>Le must de tout bon dev une clé USB, quand c'est une licorne c'est encore mieux!<br>50 €</p>
          </div>
          <div class="card-action">
            <a href="store.html">Commander</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

      <ul class="pagination center">
        <li class="waves-effect waves-red"><a href="index2.php"><i class="material-icons">chevron_left</i></a></li>
        <li class="waves-effect waves-red"><a href="index.php">1</a></li>
        <li class="waves-effect waves-red"><a href="index2.php">2</a></li>
        <li class="active waves-effect waves-light"><a href="#!">3</a></li>
        <li class="disabled"><a href="index3.php"><i class="material-icons">chevron_right</i></a></li>
      </ul>


   </body>
 </html>
