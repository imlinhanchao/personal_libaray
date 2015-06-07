<?php
$page = "home";
if(isset($_common['page']))
	$page = $_common['page'];
	
switch ($page)
{
	case "home":
?>
	<a href="" id="donate" class="newbook">
		<p>我要借书</p>
	</a>
<?php 
	break;
	case "admin":
?>
	<div id="nav">
			<ul class="nav_list">
				<li class="nav_item pending"><a href="javascript:void(0)" title="尚未支持">借阅管理</a></li>
				<li class="nav_item booklist"><a href="list.php" title="书籍管理">书籍管理</a></li>
				<li class="nav_item newbook"><a href="index.php" title="新增书籍">新增书籍</a></li>
				<li class="nav_item setting"><a href="javascript:void(0)" title="尚未支持">系统设置</a></li>
				<li class="nav_item logout"><a href="<?php echo LOCALHOST; ?>/admin/logout.php" title="退出">退出</a></li>
			</ul>
	</div>
<?php
	break;
	default: break;
}
?>