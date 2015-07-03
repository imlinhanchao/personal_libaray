<?php 
require_once("./verify.php");

//page define 
$_common['page'] = "admin";
$_common['localPath'] = '..';

require($_common['localPath'] . '/data/class_book_base.php');
require($_common['localPath'] . '/include/class_com_bookapi.php');

$_common['title'] = "管理后台 &laquo; ".isa_book_base::Get("WebName");
$_common['head'] = '<script type="text/javascript" src="./js/admin.js" ></script>';
$_common['head'] = $_common['head'] . '<script type="text/javascript" src="./js/jquery.fancybox.pack.js" ></script>';
$_common['head'] = $_common['head'] . '<link rel="stylesheet" type="text/css" href="./css/jquery.fancybox.css" />';
$_common['head'] = $_common['head'] . '<style type="text/css">.fancybox-inner{overflow: auto!important;}</style>';

require($_common['localPath'] . '/content/header.php');
?>
<form action="./admin/index.php" methon="get">
	<div id="post">
		<div class="postbook">
			<ul>
                <li class="form_item">
                    <label for="search" class="text">搜索</label>
                    <input type="text" name="s" id="search" class="text" value="<?=isset($_GET["s"]) ? $_GET["s"] : ""?>"/>
                    <button id="searchBook" class="iconbtn search"><span class="hide">添加</span></button>
                </li>
				<li class="form_item">
					<label for="dburl" class="text">豆瓣地址</label>
					<input type="text" name="" id="dburl" class="text"/>
					<button id="postdouban" class="iconbtn newbook"><span class="hide">添加</span></button>
				</li>
				<li class="form_item">
					<label for="isbn" class="text">ISBN</label>
					<input type="text" name="" id="isbn" class="text"/>
					<button id="postisbn" class="iconbtn newbook"><span class="hide">添加</span></button>
				</li>
			</ul>
		</div>
        <?php if(isset($_GET["s"])){ ?>
		<div id="article">
            <h1><?=$_GET["s"]?> 的搜索结果</h1>
			<ul class="subject_list">
                <?php
                    $result = $BookInfo->getSearch($_GET["s"]);
                    for($i = 0; $i < $result["count"]; $i++)
                    {
                        $title = trim($result["books"][$i]["title"].'：'.$result["books"][$i]["subtitle"],"：");
                ?>
				<li class="subject_item">
                    <div class="thumb">
                        <img src="<?=$result["books"][$i]["images"]["medium"]?>" alt="<?=$result["books"][$i]["title"]?>" class="min_pic"/>
                    </div>
                    <div class="info">
                        <h2 class="t_over" title="<?=$title?>">
                            <a target="_blank" href="<?=$result["books"][$i]["alt"]?>"><?=$title?></a>
                        </h2>
                        <button data-id="<?=$result["books"][$i]["id"]?>" title="添加图书 <?=$title?>" class="iconbtn newbook searchItem"><span class="hide">添加</span></button>
                        <p>作者:  <?=count($result["books"][$i]["author"]) > 0 ? $result["books"][$i]["author"][0] : "无"?></p>
                        <p>出版社: <?=$result["books"][$i]["publisher"]?></p>
                        <p>ISBN: <?=$result["books"][$i]["isbn13"]?></p>
                    </div>

                </li>
                <?php } ?>
			</ul>
		</div>
    <?php } ?>
	</div>
</form>
<?php
require($_common['localPath'] . '/content/footer.php');
?>