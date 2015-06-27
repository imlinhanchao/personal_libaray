<?php
session_start();
require_once("./config.php");

$_common['localPath'] = '.';
$_common['page'] = "home";

require($_common['localPath'] . '/data/class_book_base.php');
$_common['title'] = isa_book_base::Get("WebName");

$_common['head'] =
'<script type="text/javascript" src="./js/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" type="text/css" href="./css/jquery.fancybox.css" />
<style type="text/css">.fancybox-inner{overflow: auto!important;}</style>';

require($_common['localPath'] . '/content/header.php');
// get book info API
require($_common['localPath'] . '/include/class_com_bookapi.php');
require($_common['localPath'] . '/data/class_book_post.php');


$search = "";
if(isset($_GET['s']))
	$search = $_GET['s'];

$isAdmin = false;
if (isset ($_SESSION['sess_user']))
{
	$isAdmin = true;
}

$ReadOn = isa_book_base::Get("ReadCtrl") == 1;
$ReadLink = "";
$ReadLinkClose = "";

?>
    <div id="section">
        <ul class="book_list">
<?php
        $book = new isa_book_post();
        $lstBook = $book->GetBooks($search);
        for($i = 0; $i < $lstBook->num_rows; $i++)
        {
            $row = $lstBook->fetch_assoc();
            $isRead = $book->translateStatus($row['book_isRead']);
            $isLend = $book->translateLend($row['isLend']);

            if($isAdmin && $row['book_isRead'] < 1)
            {
                $ReadLink = '<a class="control_link" href="#read_'.$row["book_id"].'">';
                $ReadLinkClose = '</a>';
            }?>
			<li class="book_item">
				<a href="http://book.douban.com/subject/<?=$row["book_dbid"]?>/" class="book_img" rel="nofollow" target="_blank"><img src="<?=$row['book_img']?>" alt="<?=$row['book_name']?>"/></a>
				<div class="book_desc">
					<h2 class="t_over title"><a href="http://book.douban.com/subject/<?=$row["book_dbid"]?>/" title="<?=$row['book_name']?>" target="_blank"><?=$row['book_name']?></a></h2>
					<p>作者:  <?=$row['book_author']?></p>
					<p>出版社: <?=$row['book_publisher']?></p>
					<p>页数: <?=$row['book_pages']?></p>
					<p>ISBN: <?=$row['book_ISBN']?></p>
				</div>
                <div class="book_status" id="book_<?=$row["book_id"]?>">
                    <span class="sp_btn">這本書</span>
                    <?php if($ReadOn){ ?>
					<?=$ReadLink?>
						<span class="sp_btn book_isRead" data-status="<?=$row['book_isRead']?>"><?=$isRead?></span>
					<?=$ReadLinkClose?>
                    <?php } ?>
                    <a class="control_link" href="#order_<?=$row["book_id"]?>" title="想借這本書？" data-status="<?=$row['isLend']?>">
                        <span class="sp_btn book_isLend" data-status="<?=$row['isLend']?>"><?=$isLend?></span>
                    </a>
                </div>
			</li>
  <?php } ?>
        </ul>
    </div>
<?php
require($_common['localPath'] . '/content/footer.php');
?>