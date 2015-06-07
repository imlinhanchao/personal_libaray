<?php
if(isset($_common['localPath']))
	$localPath = $_common['localPath'];
else
    $localPath = ".";
require_once($localPath.'/config.php');
require_once($localPath.'/include/class_com_sql.php'); // a mysql class.

class isa_book_lend
{
    private $_BookId = "";
    private $_LendMan = "";
    private $_Valid = "";

    function __construct($data)
    {
        if(isset($data["BookId"]))
            $this->setBookId($data["BookId"]);
        if(isset($data["LendMan"]))
            $this->setLendMan($data["LendMan"]);
        if(isset($data["Valid"]))
            $this->setValid($data["Valid"]);
        else
            $this->setValid("1");
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

    function BackBook()
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->insert("cc_web_book", $this->getBackBook(), ["book_id" => $this->_BookId, "lend_valid" => "1"]);
        return $result;
    }

    function GetLendRecords()
	{
		$db = new cSql();
		$db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$sql = $this->getList();
		$result = $db->query($sql);
		return $result;
	}
	
	function setLendMan($name)
	{
		$this->_LendMan = $this->Format($name);
	}
	
	function setBookId($dbId)
	{
		$this->_BookId = $this->Format($dbId);
	}

	function setValid($author)
	{
		$this->_Valid = $this->Format($author);
	}

	protected function Format($value)
	{
		$value = htmlspecialchars($value, ENT_QUOTES);
		$value = addslashes($value);
		return $value;
	}
	
	protected function getList()
	{
		$sql = "select * from `cc_web_lend` where `book_id` = '" . $id . "' order by `lend_date` desc";
		return $sql;
	}

    protected function getBackBook()
    {
        $data["book_id"] 	    =	$this->_BookId;
        $data["lend_valid"] 	=	0;
        $data["lend_back"] 	    = 	"now()";

        return $data;
    }

	protected function getInsert()
	{
        $data["book_id"] 	    =	$this->_BookId;
        $data["lend_Man"]		=	$this->_LendMan;
        $data["lend_valid"] 	=	$this->_Valid;
        $data["lend_date"] 	    = 	"now()";

        return $data;
	}

	protected function getById($id)
	{
		$sql = "select * from `cc_web_lend` where `book_id` = '" . $id . "' order by `lend_date` desc limit 1";
		return $sql;
	}

}
?>