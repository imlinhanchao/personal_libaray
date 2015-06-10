<?php
$title = "我的书 | 书是人类灵魂的阶梯";
$head = "";
$script = "";
$type = "logo";
$base = LOCALHOST;
$localPath = ".";
if(isset($_common['title']))
	$title = $_common['title'];
if(isset($_common['type']))
    $type = $_common['type'];
if(isset($_common['head']))
	$head = $_common['head'];
if(isset($_common['script']))
	$script = $_common['script'];
if(isset($_common['base']))
    $base = $_common['base'];
if(isset($_common['localPath']))
	$localPath = $_common['localPath'];
require_once($localPath . '/config.php');
?>
<!DOCTYPE HTML>
<html lang="zh_cn">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <base href="<?=$base; ?>/">
  <title> <?=$title; ?> </title>
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
  <link href="./css/common.css" rel="stylesheet" type="text/css" />
  <link href="./css/styles.css" rel="stylesheet" type="text/css" />
  <script src="./js/jquery.min.js"></script>
  <script type="text/javascript" src="./js/common.js" ></script>
  <?=$head; ?>
  <script type="text/javascript">
	jQuery(document).ready(function($){
        <?=$script; ?>
	});
  </script>
 </head>
 <body>
 <?php
    if(!isset($_common['type']))
		switch($type)
		{
			case "logo":
 ?>
		<div id="header">
			<a href="./" id="logo">
				<h1>我的图书</h1>
			</a>
			<?php
				require($localPath . '/content/nav.php');
			?>
		</div>
 <?php
			break;
			default:break;
		}
 ?>
