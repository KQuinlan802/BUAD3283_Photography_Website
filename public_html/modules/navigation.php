<?php
/** @var array $navItems The list of navigation items to use as links */
$navItems = ['home','aboutus','contact'];
/** @var array $navTitles The list of navigation item titles */
$navTitles = ['Home', 'About us', 'Contact Us'];
/** @var array $navListOutput returned formatted navigation items */
$navListOutput = array_map(function($i) use ($navItems, $navTitles){
    return '    <a href="index.php?p='. $navItems[$i] .'">'. $navTitles[$i] .'</a>' . PHP_EOL;
}, array_keys($navItems));
// Now you can implode the $navListOutput and echo the result.
$navigation = implode('', $navListOutput);
