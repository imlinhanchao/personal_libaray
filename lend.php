<?php
$_common['title'] = "我要借书";
$_common['page'] = "lend";
$_common['localPath'] = '.';
$_common['type'] = "lite";

$_common['script'] = '
            document.getElementById("lend_man").focus();
            $("#lend_cancel").click(function(){
                   parent.$.fancybox.close();
            });
';

// get book info API
require($_common['localPath'] . '/data/class_book_post.php');
require($_common['localPath'] . '/data/class_book_lend.php');

$lend_id = "";
$lend_book = "";
$lend_Man = "";
$lend_type = "1";
$lend_button = "借出";

if(isset($_POST["lend_id"]))
{
    if(isset($_POST["lend_type"]))
        $lend_type = $_POST["lend_type"];
    if($lend_type > 0) // 大于零为管理员权限，如：1（借出），2（同意）
    {
        require_once("./admin/verify.php");
    }
    $lend_id = $_POST["lend_id"];
    if($lend_type != 2)
    {
        $lend = new isa_book_lend(["BookId"=>$lend_id, "LendMan"=>$_POST["lend_man"], "Valid"=>$lend_type]);
        $result = $lend->Insert();
    }
    else
    {
        $lend = new isa_book_lend(["Id"=>$lend_id, "LendMan"=>$_POST["lend_man"], "Valid"=>$_POST["lend_check"]]);
        $result = $lend->Agree();
    }
    if($result > 0)
    {
        $_common['script'] =
        'parent.updateStatus('.$lend_id.');
        parent.$.fancybox.close();';
    }
}
else if(isset($_GET["id"]))
{
    if(isset($_GET["t"]))
        $lend_type = $_GET["t"];
    $lend_id = $_GET["id"];

    switch($lend_type)
    {
        case -1: $lend_button = "订了"; break;
        case  1: $lend_button = "借出"; break;
        case  2: $lend_button = "审批"; break;
    }

    if($lend_type != 2)
    {
        $book = new isa_book_post();
        $theBook = $book->GetBookById($lend_id);
        if($theBook->num_rows > 0)
            $lend_book = $theBook->fetch_assoc()["book_name"];
        else
            $lend_id = "";
    }
    else
    {
        $lend = new isa_book_lend(["Id"=>$lend_id]);
        $theLend = $lend->GetLendRecords();
        $theLend= $theLend->fetch_assoc();
        $lend_book = $theLend["book_name"];
        $lend_Man = $theLend["lend_Man"];
    }

}

require($_common['localPath'] . '/content/header.php');

?>

<div id="section" class="form_submit">
	<form action="lend.php" method="post">
		<p>
			<label for="lend_man" class="txt_title">我是</label>
			<input type="text" name="lend_man" class="txt_noBorder v_noempty" id="lend_man" maxlength="10" value="<?=$lend_Man?>" />
		</p>
		<p>
			<label for="lend_book" class="txt_title">想借</label>
			<input type="text" readonly name="lend_book" class="txt_noBorder v_noempty" id="lend_book" maxlength="50" value="<?=$lend_book?>" />
			<input type="hidden" name="lend_id" id="lend_id" value="<?=$lend_id?>" />
			<input type="hidden" name="lend_type" id="lend_type" value="<?=$lend_type?>" />
        </p>
        <p>
        <?php if($lend_type == 2){?>
            <input type="radio" name="lend_check" id="lend_check_yes" value="1" checked/>
            <label for="lend_check_yes" class="radio_label">可以</label>
            <input type="radio" name="lend_check" id="lend_check_no" value="-2" />
            <label for="lend_check_no" class="radio_label">不行</label>
            <?php }?>
		</p>
		<p>
			<input type="submit" name="lend_submit" id="lend_submit" class="form_btn" value="<?=$lend_button?>" />
			<input type="button" name="lend_cancel" id="lend_cancel" class="form_btn" value="算了" />
		</p>
	</form>
</div>
