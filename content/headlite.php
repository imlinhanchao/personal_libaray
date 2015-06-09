<?php
// Init page param
$title = "创软图书馆 | 书是人类灵魂的阶梯";
$head = "";
$localPath = ".";
if(isset($_common['title']))
	$title = $_common['title'];
if(isset($_common['head']))
	$head = $_common['head'];
if(isset($_common['localPath']))
	$localPath = $_common['localPath'];
require_once($localPath . '/config.php'); 
?>
<!DOCTYPE HTML>
<html lang="zh_cn">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title> <?php echo $title; ?> </title>
  <base href="<?php echo LOCALHOST; ?>/">
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
  <link href="./css/common.css" rel="stylesheet" type="text/css" />
  <link href="./css/styles.css" rel="stylesheet" type="text/css" />
  <script src="./js/jquery.min.js"></script>
  <script type="text/javascript" src="./js/common.js" ></script>
  <?php echo $head; ?>
  <script type="text/javascript">
	jQuery(document).ready(function($){
	
	});
  </script>
 </head>
