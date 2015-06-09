<?php
$_common['title'] = "我要借书";
$_common['page'] = "lend";
$_common['localPath'] = '.';
$_common['type'] = "lite";

$_common['script'] = 
'document.getElementById("lend_man").focus();
$("#lend_cancel").click(function(){
		parent.$.fancybox.close();
});';

require($_common['localPath'] . '/content/header.php');
// get book info API
require($_common['localPath'] . '/data/class_book_post.php');

$lend_id = "";
$lend_book = "";

if(isset($_GET["id"]))
{
    $lend_id = $_GET["id"];
    $book = new isa_book_post();
    $theBook = $book->GetBookById($lend_id);
    if($theBook->num_rows > 0)
        $lend_book = $theBook->fetch_assoc()["book_name"];
    else
        $lend_id = "";
}
?>

<div id="section" class="form_submit">
	<form action="#" method="post">
		<p>
			<label for="lend_man" class="txt_title">我是</label>
			<input type="text" name="lend_man" class="txt_noBorder" id="lend_man" maxlength="10" />
		</p>
		<p>
			<label for="lend_book" class="txt_title">想借</label>
			<input type="text" name="lend_book" class="txt_noBorder" id="lend_book" maxlength="50" value="<?php echo $lend_book; ?>" />
			<input type="hidden" name="lend_id" id="lend_id" value="<?php echo $lend_id; ?>" />
		</p>
		<p>
			<input type="submit" name="lend_submit" id="lend_submit" class="form_btn" value="借了" />
			<input type="button" name="lend_cancel" id="lend_cancel" class="form_btn" value="算了" />
		</p>
	</form>
</div>
