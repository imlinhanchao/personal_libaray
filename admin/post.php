<?php 
require_once("./verify.php");

//page define 
$_common['title'] = "管理后台 &laquo; 创软图书馆";
$_common['page'] = "admin";
$_common['localPath'] = '..';

require($_common['localPath'] . '/content/headlite.php');

// get book info
require($_common['localPath'] . '/include/class_com_bookapi.php');
$db_id = "";
$isbn = "";
if(isset($_GET["id"]))
	$db_id = $_GET["id"];
if(isset($_GET["isbn"]))
	$isbn = $_GET["isbn"];
	
$dbInfo = [];
if($db_id != "")
	$dbInfo = $BookInfo->getById($db_id);
else if($isbn != "")
	$dbInfo = $BookInfo->getByISBN($isbn);
if(!isset($dbInfo["id"]))
{
	echo "no found..".$db_id;
    var_dump($dbInfo);
	exit(0);
}

?>
 <body class="dialog">
 <form action="./admin/post.php?id=<?=$_GET["id"]?>" method="post">
	<div id="post">
		<div class="post_content">
			<div class="thumb"><img src="<?=$dbInfo['images']['large']; ?>" alt="<?=$dbInfo['subtitle']; ?>" class="pic"/></div>
			<div class="info">
				<h2 class="t_over title">
				<?=$dbInfo["title"]; ?>
				</h2>
				<p>作者:  <?=$dbInfo['author'][0] ?></p>
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
		</div>
	</div>
 </form>
 </body>
</html>

<?php
// Get Form
if(isset($_POST['bookname']))
{

	require($_common['localPath'] . '/data/class_book_post.php');
	$book = new isa_book_post(
        $_POST["dbid"],
        $_POST["bookimg"],
        $_POST["bookname"],
        $_POST["bookauthor"],
        $_POST["bookpages"],
        $_POST["bookpublisher"],
        $_POST["bookisbn"],
        $_POST["bookpubdate"]
    );
	try 
	{
		$book->Insert();
        echo "<script>parent.location = parent.location;</script>";
	} 
	catch (Exception $e) {
		$_warning['t'] = "error";
		$_warning['meg'] = $e->getMessage();
		require('./content/warning.php');
	}

}
?>