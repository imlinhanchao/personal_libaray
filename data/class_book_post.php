<?php
if(isset($_common['localPath']))
	$localPath = $_common['localPath'];
else
    $localPath = ".";
require_once($localPath.'/config.php');
require_once($localPath.'/include/class_com_sql.php'); // a mysql class.

class isa_book_post
{
    private $_dbId = "";
    private $_image = "";
    private $_name = "";
    private $_author = "";
	private $_publisher = "";
    private $_pages = "";
    private $_ISBN = "";
    private $_pubDate = "";

    function __construct($dbId = "", $image = "", $name = "", $author = "", $pages = "", $publisher = "", $ISBN = "", $pubDate = "")
    {
        $this->setDbId($dbId);
        $this->setImage($image);
        $this->setName($name);
        $this->setAuthor($author);
        $this->setPages($pages);
        $this->setPublisher($publisher);
        $this->setISBN($ISBN);
        $this->setPubDate($pubDate);
    }

    function __destruct()
	{
	}
	
	function Insert()
	{
		$db = new cSql();
		$db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$result = $db->insert("cc_web_book", $this->getInsert());
		return $result;
	}
	
	function GetBooks()
	{
		$db = new cSql();
		$db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$sql = $this->getList();
		$result = $db->query($sql);
		return $result;
	}

	function GetBookById($id)
	{
		$db = new cSql();
		$db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$sql = $this->getById($id);
		$result = $db->query($sql);
		return $result;
	}
	
	function GetBookByDbId()
	{
		$db = new cSql();
		$db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$sql = $this->getByDouBan($this->_dbId);
		$result = $db->query($sql);
		return $result;
	}
	
	function setName($name)
	{
		$this->_name = $this->Format($name);
	}
	
	function setDbId($dbId)
	{
		$this->_dbId = $this->Format($dbId);
	}

	function setImage($image)
	{
		$this->_image = $this->Format($image);
	}

	function setAuthor($author)
	{
		$this->_author = $this->Format($author);
	}

	function setPages($pages)
	{
		$this->_pages = $this->Format($pages);
	}

	function setPublisher($publisher)
	{
		$this->_publisher = $this->Format($publisher);
	}

	function setISBN($ISBN)
	{
		$this->_ISBN = $this->Format($ISBN);
	}

	function setPubDate($ISBN)
	{
		$this->_pubDate = $this->Format($ISBN);
	}

    function translateStatus($status)
    {
        switch($status)
        {
            case -1: return "正在看";
            case  0: return "還沒看";
            case  1: return "看完了";
        }
    }

	protected function Format($value)
	{
		$value = htmlspecialchars($value, ENT_QUOTES);
		$value = addslashes($value);
		return $value;
	}
	
	protected function getList()
	{
		$sql = "select *, !ISNULL((select `lend_id` from `cc_web_lend` as ld where ld.`book_id` = bk.`book_id` and `lend_valid` = 1)) isLend from `cc_web_book` as bk";
		return $sql;
	}

	protected function getInsert()
	{
        $data["book_dbId"] 	    =	$this->_dbId;
        $data["book_img"]		=	$this->_image;
        $data["book_name"] 	    =	$this->_name;
        $data["book_author"] 	=	$this->_author;
        $data["book_publisher"] =	$this->_publisher;
        $data["book_pages"]     =	$this->_pages;
        $data["book_ISBN"] 	    =	$this->_ISBN;
        $data["book_pubdate"] 	=	$this->_pubDate;
        $data["book_create"] 	= 	"now()";

        return $data;
	}

	protected function getById($id)
	{
		$sql = "select * from `cc_web_book` where `book_id` = '" . $id . "' limit 1";
		return $sql;
	}
	
	protected function getByDouBan($dbid)
	{
		$sql = "select * from `cc_web_book`  where `book_dbId` = '" . $dbid . "' limit 1";
		return $sql;
	}

}
?>