<?php 
require_once("./verify.php");

//page define
$_common['page'] = "admin";
$_common['localPath'] = '..';

require_once($_common['localPath'] . '/data/class_book_base.php');

$_common['title'] = "书籍管理 &laquo; ".isa_book_base::Get("WebName");
$_common['head'] =
'<script type="text/javascript" src="./js/admin.js" ></script>
<script type="text/javascript" src="./js/jquery.fancybox.pack.js" ></script>
<link rel="stylesheet" type="text/css" href="./css/jquery.fancybox.css" />
<style type="text/css">.fancybox-inner{overflow: auto!important;}</style>';

require_once($_common['localPath'] . '/content/header.php');
require_once($_common['localPath'] . '/data/class_book_post.php');

$search = "";
if(isset($_GET['s']))
	$search = $_GET['s'];

$ReadOn = isa_book_base::Get("ReadCtrl") == 1;

?>
<form action="#" methon="post">
	<div id="admin_list">
		<table id="book_list">
			<tr>
				<th class="th_number">序号</th>
				<th class="th_bookname">书名</th>
				<th class="th_status">状态</th>
				<th class="th_manager">管理</th>
			</tr>
<?php
        $book = new isa_book_post();
        $bookList = $book->GetBooks(urldecode($search));
        for($i = 0; $i < $bookList->num_rows; $i++)
        {
            $row = $bookList->fetch_assoc();
            $alt = "";
            if(1 == $i % 2) $alt = ' class="alt"';
            $status = $book->translateLend($row['isLend']);
            if($ReadOn) $status .= '/' . $book->translateStatus($row['book_isRead']);

            $read_action = "read";
            $read_word = "借出";
            $read_id = $row['book_id'];
            switch($row['book_isRead'])
            {
                case  1: $read_action = "begin"; $read_word = "重新看"; break;
                case  0: $read_action = "begin"; $read_word = "开始看"; break;
                case -1: $read_action = "read";  $read_word = "已　阅"; break;
            }

            $lend_action = "lend";
            $lend_word = "借出";
            $lend_id = $row['book_id'];
            switch($row['isLend'])
            {
                case  1: $lend_action = "back";  $lend_word = "归还"; $lend_id = $row['Lend_Id']; break;
                case  0: $lend_action = "lend";  $lend_word = "借出"; break;
                case -1: $lend_action = "agree"; $lend_word = "审批"; $lend_id = $row['Lend_Id']; break;
            }?>
            <tr <?=$alt?>>
                <td><?=$i?></td><td><?=$row["book_name"]?></td>
                <td><?=$status?></td>
                <td>
                    <?php if($ReadOn){ ?>
                    <a class="control_link" href="#<?=$read_action?>_<?=$read_id?>"><?=$read_word?></a>
                    <?php } ?>
                    <a class="control_link" href="#<?=$lend_action?>_<?=$lend_id?>"><?=$lend_word?></a>
                    <a class="control_link" href="#del_<?=$row['book_id']?>">删除</a>
                </td>
            </tr>
<?php   } ?>
        </table>

	</div>
</form>
<?php require($_common['localPath'] . '/content/footer.php'); ?>
