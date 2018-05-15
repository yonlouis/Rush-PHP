<?php
session_start();

?>
	<body>
		<h1><link rel="stylesheet" type="text/css" href="stylesheets/style.css" target="_blank">Admin Menu</a></h1>

		<div class="content">
	  <div class="admin-panel"><label for="toggle" class="admin-text">Admin Fields</label></div>
	  <input type="checkbox" id="toggle">
	  <label class="cog octicon octicon-gear" for="toggle"></label>
	  <div class="menu">
		<div class="arrow"></div>
			<a href="user.php">Users <span class="icon octicon octicon-person"></span></a>
      <a href="user.php">Products <span class="icon octicon octicon-person"></span></a>
			<a href="category.php">category <span class="icon octicon octicon-person"></span></a>
		</div>
	</div>
</div>
