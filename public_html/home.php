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
<h3> Welcome to my website! At Precious Moments we love to capture the moments in your life that make it special </h3>
</div>
<div class="gallery">
  <a target="_blank" href="wedding.jpg">
    <img src="wedding.jpg" alt="Weddings" width="300" height="200">
  </a>
  <div class="desc">Weddings</div>
</div>

<div class="gallery">
  <a target="_blank" href="portraits.jpeg">
    <img src="portraits.jpeg" alt="Portraits" width="200" height="300">
  </a>
  <div class="desc">Portraits</div>
</div>

<div class="gallery">
  <a target="_blank" href="mountain.jpeg">
    <img src="mountain.jpeg" alt="Mountains" width="300" height="200">
  </a>
  <div class="desc">Landscapes</div>
</div>
<div class="gallery">
  <a target="_blank" href="baby.jpeg">
    <img src="baby.jpeg" alt="Newborn" width="200" height="300">
  </a>
  <div class="desc">Newborns</div>
</div>
</div>
</body>
