<?php
$page = "home";
if(isset($_common['page']))
	$page = $_common['page'];

if(isset($_common['localPath']))
    $localPath = $_common['localPath'];
else
    $localPath = ".";

switch ($page)
{
	case "home":
?>
	
<?php 
	break;
	case "admin":
    {
        require_once($localPath . '/data/class_book_lend.php');
        $lend = new isa_book_lend();
        $result = $lend->GetApplyRecords();
?>
	<div id="nav">
			<ul class="nav_list">
				<li class="nav_item pending">
                    <span class="nav_tip"><?=$result->num_rows?></span>
                    <a href="./admin/lends.php" title="借阅管理"><span class="hide">借阅管理</span></a>
                </li>
				<li class="nav_item booklist"><a href="./admin/list.php" title="书籍管理"><span class="hide">书籍管理</span></a></li>
				<li class="nav_item newbook"><a href="./admin/index.php" title="新增书籍"><span class="hide">新增书籍</span></a></li>
				<li class="nav_item setting"><a href="./admin/base.php" title="系统设置"><span class="hide">系统设置</span></a></li>
				<li class="nav_item logout"><a href="./admin/logout.php" title="退出"><span class="hide">退出</span></a></li>
			</ul>
	</div>
<?php
	break;
    }
	default: break;
}
?>