<?php
$page = "home";
if(isset($_common['page']))
	$page = $_common['page'];
	
switch ($page)
{
	case "home":
?>
	
<?php 
	break;
	case "admin":
?>
	<div id="nav">
			<ul class="nav_list">
				<li class="nav_item pending"><a href="./admin/lends.php" title="借阅管理">借阅管理</a></li>
				<li class="nav_item booklist"><a href="./admin/list.php" title="书籍管理">书籍管理</a></li>
				<li class="nav_item newbook"><a href="./admin/index.php" title="新增书籍">新增书籍</a></li>
				<li class="nav_item setting"><a href="./admin/base.php" title="系统设置">系统设置</a></li>
				<li class="nav_item logout"><a href="./admin/logout.php" title="退出">退出</a></li>
			</ul>
	</div>
<?php
	break;
	default: break;
}
?>