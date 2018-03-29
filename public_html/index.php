<?php
// load in a bootstrap file
require_once __DIR__ . '/modules/bootstrap.php';

    // now that we have the $request variable created in modules/bootstrap.php
    // we can look for that item in the nav and get the correct page from it
    if (array_key_exists('p', $request) && in_array($request['p'], $navItems) && file_exists(__DIR__ . '/'. $request['p'].'.php')) {
        $page = $request['p'];
    } else {
        $page = 'home';
    }

?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo  $navTitles[array_search($page, $navItems)]; ?></title>
<link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="sidenav">
<?php echo $navigation; ?>
	<!--
	No need for these any more.
	<a href="index.php">Home</a>
    <a href="aboutus.php">About us</a>
    <a href="contact.php">Contact Us</a> -->
  </div>
  <?php
    include_once __DIR__ . '/' . $page . '.php';
  ?>
</body>
</html>
