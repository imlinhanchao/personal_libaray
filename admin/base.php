<?php 
require_once("./verify.php");

//page define
$_common['page'] = "admin";
$_common['localPath'] = '..';
$_common['message'] = '';

require_once($_common['localPath'] . '/data/class_book_base.php');

if(isset($_POST["base_name"]) && $_POST["base_name"] != "")
{
    isa_book_base::Set("WebName", $_POST["base_name"]);
    isa_book_base::Set("ReadCtrl", isset($_POST["base_read"]));
    $_common['message'] = "修改成功！";
}

if (isset($_POST["base_oldpwd"]) &&
    $_POST["base_oldpwd"] == isa_book_base::Get("adminPwd") &&
    isset($_POST["base_newpwd"]) &&
    "" != $_POST["base_newpwd"])
{
    isa_book_base::Set("adminUser", $_POST["base_user"]);
    if(isset($_POST["base_newpwd"]) && "" == $_POST["base_newpwd"])
    {
        $_common['message'] = "新密码不能为空！";
    }
    else
    {
        isa_book_base::Set("adminPwd", $_POST["base_newpwd"]);
    }
}
else if(isset($_POST["base_oldpwd"]) && $_POST["base_oldpwd"] != "")
{
    $_common['message'] = "原密码错误！";
}

$_common['title'] = "系统设置 &laquo; ".isa_book_base::Get("WebName");
$_common['head'] = '<script type="text/javascript" src="./js/admin.js" ></script>';

require_once($_common['localPath'] . '/content/header.php');
require_once($_common['localPath'] . '/data/class_book_post.php');

$search = "";
if(isset($_GET['s']))
	$search = $_GET['s'];

$ReadOn = isa_book_base::Get("ReadCtrl") == 1;
?>
<form action="./admin/base.php" method="post" xmlns="http://www.w3.org/1999/html">
    <div id="base_ctrl" class="form">
        <?php if("" !=$_common['message']){ ?>
        <p class="admin_tip"><?=$_common['message']?></p>
        <?php } ?>
        <h2 class="title">
            网站基本设置
        </h2>
        <p>
            <label for="base_name" class="text">网站名称：</label>
            <input type="text" maxlength="25" name="base_name" id="base_name" value="<?=isa_book_base::Get("WebName")?>" class="text v_noempty"/>
        </p>
        <p>
            <label for="base_read" class="text">开启阅读：</label>
            <span class="checkbox">
                <input type="checkbox" name="base_read" id="base_read" <?=$ReadOn ? "checked" : "" ?> value="1"/>
            </span>
        </p>
        <h2 class="title">
            管理员设置
        </h2>
        <p>
            <label for="base_user" class="text">账号名：</label>
            <input type="text" maxlength="25" name="base_user" id="base_user" value="<?=isa_book_base::Get("adminUser")?>" class="text"/>
        </p>
        <p>
            <label for="base_oldpwd" class="text">原密码：</label>
            <input type="password" maxlength="25" name="base_oldpwd" id="base_oldpwd" value="<?=isset($_POST["base_oldpwd"]) ? $_POST["base_oldpwd"] : ""?>" class="text"/>
        </p>
        <p>
            <label for="base_newpwd" class="text">新密码：</label>
            <input type="password" maxlength="25" name="base_newpwd" id="base_newpwd" value="<?=isset($_POST["base_newpwd"]) ? $_POST["base_newpwd"] : ""?>" class="text"/>
        </p>
        <p class="submit"><input type="submit" value="确　定" class="btn"/></p>
    </div>
</form>
<?php require($_common['localPath'] . '/content/footer.php'); ?>
