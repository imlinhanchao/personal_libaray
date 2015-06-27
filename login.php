<?php
require_once("./config.php");
session_start() ;                   //初始session
if (isset($_SESSION['sess_user'])){
	header ("Location:".LOCALHOST."/admin/index.php") ;    //重新定向到其他页面
	exit(0);
}

$_common['localPath'] = ".";
require($_common['localPath'].'/data/class_book_base.php');

$username = isset($_POST['username']) ? $_POST['username'] : null;    //获取参数
$password = isset($_POST['password']) ? $_POST['password'] : null;
if(null != $username && null != $password)
{
	//验证管理员名称和密码是否正确,这里采用直接验证,没有连接数据库
	if ($username == isa_book_base::Get("adminUser") &&
        $password == isa_book_base::Get("adminPwd")){
		$_SESSION['sess_user'] = $username ;
		header ("Location:".LOCALHOST."/admin/index.php") ;    //登录成功重定向到管理页面
	}
	else
		echo "账号或密码错误,或者不是管理员账号";
}

?>
<!DOCTYPE HTML>
<html lang="zh_cn">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <base href="<?php echo LOCALHOST; ?>/"/>
  <title> <?=isa_book_base::Get("WebName")?> | 只为探索和好奇... </title>
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
  <link href="./css/common.css" rel="stylesheet" type="text/css" />
  <link href="./admin/style.css" rel="stylesheet" type="text/css" />
 </head>
 <body>
	<form action="login.php" method="post">
		<div id="admin">
			<div id="login">
				<a href="./" id="logo">
					<h1>管理后台</h1>
				</a>
			</div>
			<div id="section" class="login_form">
				<p><label for="username" class="user"><span class="hide">用户名</span></label><input type="text" name="username" id="username" class="text"/></p>
				<p><label for="password" class="password"><span class="hide">密码</span></label><input type="password" name="password" id="password" class="text"/></p>
				<p class="submit"><input type="submit" value="登录" class="btn"/></p>
			</div>
		</div>
	</form>
 </body>
</html>