<?php
$_common['title'] = "我的图书";
$_common['page'] = "home";
$_common['localPath'] = '.';
require($_common['localPath'] . '/content/header.php');
// get book info API
require($_common['localPath'] . '/include/class_com_bookapi.php');
require($_common['localPath'] . '/data/class_book_post.php');

?>
    <div id="section">
        <ul class="book_list">
            <?php
            $book = new isa_book_post();
            $lstBook = $book->GetBooks();
            for($i = 0; $i < $lstBook->num_rows; $i++)
            {
                $row = $lstBook->fetch_assoc();
                $isRead = $book->translateStatus($row['book_isRead']);
                $isLend = 1 == $row['isLend'] ? "借人了" : "还在家";
                $html = <<<HTML
			<li class="book_item">
				<a href="http://book.douban.com/subject/{$row["book_dbid"]}/" class="book_img"><img src="{$row['book_img']}" alt="{$row['book_name']}"/></a>
				<div class="book_desc">
					<h2 class="t_over title"><a href="http://book.douban.com/subject/{$row["book_dbid"]}/" title="{$row['book_name']}" target="_blank">{$row['book_name']}</a></h2>
					<p>作者:  {$row['book_author']}</p>
					<p>出版社: {$row['book_publisher']}</p>
					<p>页数: {$row['book_pages']}</p>
					<p>出版日期: {$row['book_pubdate']}</p>
					<p>ISBN: {$row['book_ISBN']}</p>
				</div>
                <div class="book_status">
                    <span class="sp_btn">這本書</span>
                    <span class="sp_btn book_isRead" data-status="{$row['book_isRead']}">{$isRead}</span>
                    <a href="#lend_{$row["book_id"]}" title="想借這本書？" data-status="{$row['isLend']}">
                        <span class="sp_btn book_isLend" data-status="{$row['isLend']}">{$isLend}</span>
                    </a>
                </div>
			</li>
HTML;
                echo $html;
            }
            ?>
        </ul>
    </div>
<?php
require($_common['localPath'] . '/content/footer.php');
?>