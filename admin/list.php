<?php 
require_once("./verify.php");

//page define 
$_common['title'] = "书籍管理 &laquo; 创软图书馆";
$_common['page'] = "admin";
$_common['localPath'] = '..';
$_common['head'] = "<script type=\"text/javascript\" src=\"" . LOCALHOST . "/js/admin.js\" ></script>";
$_common['head'] = $_common['head'] . "<script type=\"text/javascript\" src=\"" . LOCALHOST . "/js/jquery.fancybox.pack.js\" ></script>";
$_common['head'] = $_common['head'] . "<link rel=\"stylesheet\" type=\"text/css\" href=\"". LOCALHOST . "/css/jquery.fancybox.css\" />";
$_common['head'] = $_common['head'] . "<style type=\"text/css\">.fancybox-inner{overflow: auto!important;}</style>";

require($_common['localPath'] . '/content/header.php');
require($_common['localPath'] . '/data/class_book_post.php');

?>
<form action="#" methon="post">
	<div id="admin_list">
		<table id="join_list">
			<tr>
				<th>序号</th>
				<th>书名</th>
				<th>状态</th>
				<th>管理</th>
			</tr>
<?php
$book = new isa_book_post();
$booklist = $book->GetBooks();
for($i = 0; $i < $booklist->num_rows; $i++)
{
	$row = $booklist->fetch_assoc();
	$alt = "";
	if(1 == $i % 2) $alt = ' class="alt"';
	echo '<tr '.$alt.'><td>'.$i.'</td><td>'.$row["book_name"].'</td>';
	echo '<td>'.$row["book_count"].'</td>';
	echo '<td>'.$row["ct"].'</td>';
	
}
?>
		</table>

	</div>
</form>
<?php
require($_common['localPath'] . '/content/footer.php');
?>
