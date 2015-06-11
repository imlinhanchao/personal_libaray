<?php 
require_once("./verify.php");

//page define 
$_common['title'] = "书籍管理 &laquo; 创软图书馆";
$_common['page'] = "admin";
$_common['localPath'] = '..';
$_common['head'] =
'<script type="text/javascript" src="./js/admin.js" ></script>
<script type="text/javascript" src="./js/jquery.fancybox.pack.js" ></script>
<link rel="stylesheet" type="text/css" href="./css/jquery.fancybox.css" />
<style type="text/css">.fancybox-inner{overflow: auto!important;}</style>';

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
$bookList = $book->GetBooks($search);
for($i = 0; $i < $bookList->num_rows; $i++)
{
	$row = $bookList->fetch_assoc();
	$alt = "";
	if(1 == $i % 2) $alt = ' class="alt"';
	$status = $book->translateLend($row['isLend']);
	$status .= '/' . $book->translateStatus($row['book_isRead']);

    $lend_action = "lend";
    $lend_word = "借出";
    switch($row['isLend'])
    {
        case  1: $lend_action = "back"; $lend_word = "归还"; break;
        case  0: $lend_action = "lend"; $lend_word = "借出"; break;
        case -1: $lend_action = "agree"; $lend_word = "审批"; break;
    } ?>
            <tr <?=$alt?>>
                <td><?=$i?></td><td><?=$row["book_name"]?></td>
                <td><?=$status?></td>
                <td>
                    <?php switch($row['book_isRead']) {
                          case 0: ?>
                    <a class="control_link" href="#begin_<?=$row['book_id']?>">开始看</a> <?php break;
                          case -1: ?>
                    <a class="control_link" href="#read_<?=$row['book_id']?>">已　阅</a>    <?php break;
                          case 1: ?>
                    <a class="control_link" href="#begin_<?=$row['book_id']?>">重新看</a> <?php } ?>
                    <a class="control_link" href="#<?=$lend_action?>_<?=$row['book_id']?>"><?=$lend_word?></a>
                    <a class="control_link" href="#del_<?=$row['book_id']?>">删除</a>
                </td>
            </tr>
<?php } ?>
        </table>

	</div>
</form>
<?php
require($_common['localPath'] . '/content/footer.php');
?>
