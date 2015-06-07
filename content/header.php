<?php
$title = "我的书 | 书是人类灵魂的阶梯";
$head = "";
$type = "logo";
$localPath = ".";
if(isset($_common['title']))
	$title = $_common['title'];
if(isset($_common['type']))
    $type = $_common['type'];
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
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
  <link href="<?php echo LOCALHOST; ?>/css/common.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo LOCALHOST; ?>/css/styles.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo LOCALHOST; ?>/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo LOCALHOST; ?>/js/common.js" ></script>
  <?php echo $head; ?>
  <script type="text/javascript">
	jQuery(document).ready(function($){
	
	});
  </script>
  <!--[if lt IE 8]>
  <script type="text/javascript" src="<?php echo LOCALHOST; ?>/js/IEPNG-min.js"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('#logo');
  </script>
  <![endif]-->
  <!--[if !IE]><!-->
  	
  <!--<![endif]-->
 </head>
 <body>
 <?php
    if(!isset($_common['type']) || "lite" == $_common['type'])
    switch($type)
    {
        case "logo":
 ?>
	<div id="header">
		<a href="<?php echo LOCALHOST; ?>/" id="logo">
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
