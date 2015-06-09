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

$search = "";
if(isset($_GET['s']))
	$search = $_GET['s'];

?>
<form action="#" methon="post">
	<div id="admin_list">
		<table id="bool_list">
			<tr>
				<th class="th_number">序号</th>
				<th class="th_bookname">书名</th>
				<th class="th_status">状态</th>
				<th class="th_manager">管理</th>
			</tr>
<?php
$book = new isa_book_post();
$booklist = $book->GetBooks($search);
for($i = 0; $i < $booklist->num_rows; $i++)
{
	$row = $booklist->fetch_assoc();
	$alt = "";
	if(1 == $i % 2) $alt = ' class="alt"';
	$status = $row['isLend'] ? "借人了" : "还在家";
	$status .= '/' . $book->translateStatus($row['book_isRead']);
	echo '<tr '.$alt.'><td>'.$i.'</td><td>'.$row["book_name"].'</td>';
	echo '<td>'.$status.'</td>';
	echo '<td>'.
	'<a class="control_link" href="#read_'.$row['book_id'].'">已阅</a>'.
	'<a class="control_link" href="#lend_'.$row['book_id'].'">'.($row['isLend'] ? '归还' : '借出').'</a>'.
	'<a class="control_link" href="#del_'.$row['book_id'].'">删除</a>'.
	'</td>';
	
}
?>
		</table>

	</div>
</form>
<?php
require($_common['localPath'] . '/content/footer.php');
?>
