<?php
/*
Template Name:set_windows_size
*/


echo "sssss = ".$_POST['windowSize']."<BR>";


$_SESSION['windowSize'] = $_POST['windowSize'];
die();
?>