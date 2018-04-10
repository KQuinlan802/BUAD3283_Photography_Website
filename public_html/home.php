<?php
echo "Home";
?>
<!DOCTYPE html>
<html lang=en>
<head>
<title><?php echo  $navTitles[array_search($page, $navItems)]; ?></title>
<link rel="stylesheet" href="style.css">

</head>
<body>
<div id="header">
<h1> Precious Moments Photography</h1>
</div>
<div class="article column1">
  <p> Weddings </p>
  <img src="wedding.jpg" alt= "Weddings" width="250" height="350"/>
</div>
<div class="article column2">
  <p> Portraits </p>
  <img src="portraits.jpeg" alt= "Portraits" width="350" height="250"/>
</div>
<div class="article column3">
  <p> Landscapes </p>
</div>
</div>
</body>
