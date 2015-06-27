<?php 
require_once("./verify.php");

//page define
$_common['page'] = "admin";
$_common['localPath'] = '..';

require($_common['localPath'] . '/data/class_book_base.php');

$_common['title'] = "系统设置 &laquo; ".isa_book_base::Get("WebName");
$_common['head'] = '<script type="text/javascript" src="./js/admin.js" ></script>';

require($_common['localPath'] . '/content/header.php');
require($_common['localPath'] . '/data/class_book_post.php');

$search = "";
if(isset($_GET['s']))
	$search = $_GET['s'];

$ReadOn = isa_book_base::Get("ReadCtrl") == 1;

?>
<form action="#" method="post">
    <div id="base_ctrl">
        <h2 class="title">
            网站基本设置
        </h2>
        <p>
            <label for="">网站名称：</label>
            <input type="text" maxlength="25" name="base_name" id="base_name" />
        </p>
        <p>出版社: <?=$dbInfo['publisher'] ?></p>
        <p>页数: <?=$dbInfo['pages'] ?></p>
        <p>出版日期: <?=$dbInfo['pubdate'] ?></p>
        <p>ISBN: <?=$dbInfo['isbn13'] ?></p>
        <p class="hide">
            <input type="hidden" name="dbid" value="<?=$dbInfo['id']; ?>"/>
            <input type="hidden" name="bookimg" value="<?=$dbInfo['images']['large']; ?>"/>
            <input type="hidden" name="bookname" value="<?=$dbInfo["title"]; ?>"/>
            <input type="hidden" name="bookauthor" value="<?=$dbInfo["author"][0]; ?>"/>
            <input type="hidden" name="bookpublisher" value="<?=$dbInfo["publisher"]; ?>"/>
            <input type="hidden" name="bookpages" value="<?=$dbInfo["pages"]; ?>"/>
            <input type="hidden" name="bookisbn" value="<?=$dbInfo["isbn13"]; ?>"/>
            <input type="hidden" name="bookpubdate" value="<?=$dbInfo["pubdate"]; ?>"/>
        </p>
        <p class="submit"><input type="submit" value="添加" class="btn"/></p>
    </div>
</form>
<?php require($_common['localPath'] . '/content/footer.php'); ?>
