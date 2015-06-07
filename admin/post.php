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
	echo "no found..";
	exit(0);
}

?>
 <body class="dialog">
 <form action="#" method="post">
	<div id="post">
		<div class="post_content">
			<div class="thumb"><img src="<?php echo $dbInfo['images']['large']; ?>" alt="<?php echo $dbInfo['subtitle']; ?>" class="pic"/></div>
			<div class="info">
				<h2 class="t_over title">
				<?php echo $dbInfo["title"]; ?>
				</h2>
				<p>作者:  <?php echo $dbInfo['author'][0] ?></p>
                <p>出版社: <?php echo $dbInfo['publisher'] ?></p>
				<p>页数: <?php echo $dbInfo['pages'] ?></p>
				<p>出版日期: <?php echo $dbInfo['pubdate'] ?></p>
				<p>ISBN: <?php echo $dbInfo['isbn13'] ?></p>
				<p class="hide">
					<input type="hidden" name="dbid" value="<?php echo $dbInfo['id']; ?>"/>
					<input type="hidden" name="bookimg" value="<?php echo $dbInfo['images']['large']; ?>"/>
					<input type="hidden" name="bookname" value="<?php echo $dbInfo["title"]; ?>"/>
					<input type="hidden" name="bookauthor" value="<?php echo $dbInfo["author"][0]; ?>"/>
					<input type="hidden" name="bookpublisher" value="<?php echo $dbInfo["publisher"]; ?>"/>
					<input type="hidden" name="bookpages" value="<?php echo $dbInfo["pages"]; ?>"/>
					<input type="hidden" name="bookisbn" value="<?php echo $dbInfo["isbn13"]; ?>"/>
					<input type="hidden" name="bookpubdate" value="<?php echo $dbInfo["pubdate"]; ?>"/>
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