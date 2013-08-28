<?php
error_reporting (E_ALL);

if (version_compare(phpversion(), '5.1.0', '<') == true) { die ('PHP5.1 Only'); }

define ('DIRSEP', DIRECTORY_SEPARATOR);


//path to site dir

$site_path = realpath(dirname(__FILE__) . DIRSEP . '..' . DIRSEP) . DIRSEP . 'blog' . DIRSEP;

define ('site_path', $site_path);
include 'includes/config.php';
?>

