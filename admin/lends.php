<?php 
require_once("./verify.php");

//page define 
$_common['page'] = "admin";
$_common['localPath'] = '..';

require_once($_common['localPath'] . '/data/class_book_base.php');

$_common['title'] = "借阅管理 &laquo; ".isa_book_base::Get("WebName");
$_common['head'] =
'<script type="text/javascript" src="./js/admin.js" ></script>
<script type="text/javascript" src="./js/jquery.fancybox.pack.js" ></script>
<link rel="stylesheet" type="text/css" href="./css/jquery.fancybox.css" />
<style type="text/css">.fancybox-inner{overflow: auto!important;}</style>';

require_once($_common['localPath'] . '/content/header.php');
require_once($_common['localPath'] . '/data/class_book_lend.php');

$search = "";
if(isset($_GET['s']))
	$search = $_GET['s'];

?>
<form action="#" methon="post">
	<div id="lend_list">
		<table id="book_list">
			<tr>
				<th class="th_number">序号</th>
				<th class="th_bookname">书名</th>
				<th class="th_status">状态</th>
                <th class="th_man">借阅者</th>
				<th class="th_date">借出日期</th>
				<th class="th_date">归还日期</th>
				<th class="th_manager">管理</th>
			</tr>
<?php
        $lend = new isa_book_lend();
        $bookList = $lend->GetAllRecords($search);
        for($i = 0; $i < $bookList->num_rows; $i++)
        {
            $row = $bookList->fetch_assoc();
            $alt = "";
            if(1 == $i % 2) $alt = ' class="alt"';
            $status = $lend->translateLend($row['lend_valid']);

            $lend_action = "lend";
            $lend_word = "借出";
            $lend_id = $row['book_id'];
            switch($row['lend_valid'])
            {
                case  1: $lend_action = "back";  $lend_word = "归还"; $lend_id = $row['lend_id']; break;
                case -1: $lend_action = "agree"; $lend_word = "审批"; $lend_id = $row['lend_id']; break;
                case -2: $lend_action = "agree"; $lend_word = "重审"; $lend_id = $row['lend_id']; break;
                default: $lend_action = "null";  $lend_word = "N/A";  break;
            }?>
            <tr <?=$alt?>>
                <td><?=$i?></td><td><?=$row["book_name"]?></td>
                <td><?=$status?></td>
                <td><?=$row['lend_Man']?></td>
                <td><?=substr($row['lend_date'], 0, 10)?></td>
                <td><?=substr($row['lend_back'], 0, 10)?></td>
                <td>
                    <a class="control_link" href="#<?=$lend_action?>_<?=$lend_id?>"><?=$lend_word?></a>
                </td>
            </tr>
<?php   } ?>
        </table>

	</div>
</form>
<?php require($_common['localPath'] . '/content/footer.php'); ?>
