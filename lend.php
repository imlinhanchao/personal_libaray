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
$lend_type = "1";

if(isset($_POST["lend_id"]))
{
    if(isset($_POST["lend_type"]))
        $lend_type = $_POST["lend_type"];
    if($lend_type == "1")
    {
        require_once("./admin/verify.php");
    }
    $lend_id = $_POST["lend_id"];
    $lend = new isa_book_lend(["BookId"=>$lend_id, "LendMan"=>$_POST["lend_man"], "Valid"=>$lend_type]);
    $result = $lend->Insert();
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
    $book = new isa_book_post();
    $theBook = $book->GetBookById($lend_id);
    if($theBook->num_rows > 0)
        $lend_book = $theBook->fetch_assoc()["book_name"];
    else
        $lend_id = "";
}

require($_common['localPath'] . '/content/header.php');

?>

<div id="section" class="form_submit">
	<form action="lend.php" method="post">
		<p>
			<label for="lend_man" class="txt_title">我是</label>
			<input type="text" name="lend_man" class="txt_noBorder" id="lend_man" maxlength="10" />
		</p>
		<p>
			<label for="lend_book" class="txt_title">想借</label>
			<input type="text" readonly name="lend_book" class="txt_noBorder" id="lend_book" maxlength="50" value="<?=$lend_book; ?>" />
			<input type="hidden" name="lend_id" id="lend_id" value="<?=$lend_id; ?>" />
			<input type="hidden" name="lend_type" id="lend_type" value="<?=$lend_type; ?>" />
		</p>
		<p>
			<input type="submit" name="lend_submit" id="lend_submit" class="form_btn" value="<?=($lend_type == 1 ? '借出':'订了')?>" />
			<input type="button" name="lend_cancel" id="lend_cancel" class="form_btn" value="算了" />
		</p>
	</form>
</div>
