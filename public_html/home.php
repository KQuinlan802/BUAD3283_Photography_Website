<?php
echo "Home";
?>
<html lang=en>
<head>
<title><?php echo  $navTitles[array_search($page, $navItems)]; ?></title>
<link rel="stylesheet" href="style.css">

</head>
<body>
<div id="header" >
<h1 style="text-align:center;"> Precious Moments Photography</h1>
<h3 style="text-align:center;"> Welcome to my website! At Precious Moments we love to capture the moments in your life that make it special </h3>
</div>
<div class="gallery">
  <a target="_blank" href="wedding.jpg">
    <img src="wedding.jpg" alt="Weddings" width="300" height="200">
  </a>
  <div class="desc">Weddings</div>
</div>
<div class="gallery">
  <a target="_blank" href="engagement.jpeg">
    <img src="engagement.jpeg" alt="Engagement" width="300" height="200">
  </a>
  <div class="desc">Engagements</div>
</div>
<div class="gallery">
  <a target="_blank" href="portrait2.jpeg">
    <img src="portrait2.jpeg" alt="Portraits" width="300" height="200">
  </a>
  <div class="desc">Portraits</div>
</div>
<div class="gallery">
  <a target="_blank" href="professional.jpeg">
    <img src="professional.jpeg" alt="Professional" width="300" height="200">
  </a>
  <div class="desc">Professional</div>
</div>
<div class="gallery">
  <a target="_blank" href="mountain.jpeg">
    <img src="mountain.jpeg" alt="Mountains" width="300" height="200">
  </a>
  <div class="desc">Landscapes</div>
</div>
<div class="gallery">
  <a target="_blank" href="baby.jpeg">
    <img src="baby.jpeg" alt="Newborn" width="300" height="200">
  </a>
  <div class="desc">Newborns</div>
</div>
<div class="gallery">
  <a target="_blank" href="sessions.jpeg">
    <img src="sessions.jpeg" alt="Sessions" width="300" height="200">
  </a>
  <div class="desc">Sessions</div>
</div>
<div class="gallery">
  <a target="_blank" href="graduaion.jpeg">
    <img src="graduaion.jpeg" alt="Graduations" width="300" height="200">
  </a>
  <div class="desc">Graduations</div>
</div>
</div>
</body>
