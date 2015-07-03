<?php
if(isset($_common['localPath']))
	$localPath = $_common['localPath'];
else
    $localPath = ".";
require_once($localPath.'/config.php');
require_once($localPath.'/include/class_com_sql.php'); // a mysql class.

class isa_book_lend
{
    private $_Id = "";
    private $_BookId = "";
    private $_LendMan = "";
    private $_Valid = "";

    function __construct($data = [])
    {
        if(isset($data["Id"]))
            $this->setId($data["Id"]);
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
		$result = $db->insert("cc_web_lend", $this->getInsert());
		return $result;
	}

    function Agree()
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->update("cc_web_lend", $this->getUpdateStatus(), array("Lend_id" => $this->_Id));
        return $result;
    }

    function BackBook()
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->update("cc_web_lend", $this->getUpdateStatus(), array("book_id" => $this->_BookId, "lend_valid" => "1"));
        return $result;
    }

    function GetLendRecords()
	{
		$db = new cSql();
		$db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$sql = $this->getLend($this->_Id);
		$result = $db->query($sql);
		return $result;
	}

    function GetBookRecords()
	{
		$db = new cSql();
		$db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$sql = $this->getBook($this->_BookId);
		$result = $db->query($sql);
		return $result;
	}

    function GetAllRecords($Name)
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $sql = $this->getByName($Name);
        $result = $db->query($sql);
        return $result;
    }

    function translateLend($status)
    {
        switch($status)
        {
            case -2: return "拒绝了";
            case -1: return "被订了";
            case  0: return "已归还";
            case  1: return "被借了";
        }
    }

	function setLendMan($name)
	{
		$this->_LendMan = $this->Format($name);
	}
	
	function setId($Id)
	{
		$this->_Id = $this->Format($Id);
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

    protected function getData($where)
    {
        $sql = "select ld.*, `book_name`, `book_dbid` from `cc_web_lend` as ld
        left join `cc_web_book` as bk
        on ld.`book_id` = bk.`book_id` where ".$where."
        order by `lend_date` desc";
        return $sql;
    }

	protected function getBook($book_id)
	{
        $sql = $this->getData("`book_id` = '" . $book_id . "' and `book_valid` = 1");
		return $sql;
	}

	protected function getLend($id)
	{
        $sql = $this->getData("`lend_id` = '" . $id . "' and `book_valid` = 1");
		return $sql;
	}

    protected function getByName($name)
    {
        $sql = $this->getData("`book_name` like '%" . $name . "%' and `book_valid` = 1 ");
        return $sql;
    }

    protected function getUpdateStatus()
    {
        $data["Lend_id"] 	    =	$this->_Id;
        $data["lend_valid"] 	=	$this->_Valid;
        if($this->_Valid == 0)
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
}
?>