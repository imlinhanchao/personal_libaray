<?php 
require_once("./verify.php");

//page define 
$_common['page'] = "admin";
$_common['localPath'] = '..';

require($_common['localPath'] . '/data/class_book_base.php');

$_common['title'] = "管理后台 &laquo; ".isa_book_base::Get("WebName");
$_common['head'] = '<script type="text/javascript" src="./js/admin.js" ></script>';
$_common['head'] = $_common['head'] . '<script type="text/javascript" src="./js/jquery.fancybox.pack.js" ></script>';
$_common['head'] = $_common['head'] . '<link rel="stylesheet" type="text/css" href="./css/jquery.fancybox.css" />';
$_common['head'] = $_common['head'] . '<style type="text/css">.fancybox-inner{overflow: auto!important;}</style>';

require($_common['localPath'] . '/content/header.php');
?>
<form action="#" methon="post">
	<div id="post">
		<div class="postbook">
			<ul>
				<li class="form_item">
					<label for="dburl" class="text">豆瓣地址</label>
					<input type="text" name="dburl" id="dburl" class="text"/>
					<button id="postdouban" class="iconbtn newbook"><span class="hide">添加</span></button>
				</li>
				<li class="form_item">
					<label for="isbn" class="text">ISBN</label>
					<input type="text" name="isbn" id="isbn" class="text"/>
					<button id="postisbn" class="iconbtn newbook"><span class="hide">添加</span></button>
				</li>
				<!--<li class="form_item">
					<label for="search" class="text">搜索</label>
					<input type="text" name="search" id="search" class="text"/>
					<button id="postisbn" class="iconbtn search"><span class="hide">添加</span></button>
				</li>-->
			</ul>
		</div>
		<div id="article">
			<ul class="subject_list">
				<li class="subject_item"></li>
			</ul>
		</div>
	</div>
</form>
<?php
require($_common['localPath'] . '/content/footer.php');
?>