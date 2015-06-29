<?php
if(isset($_common['localPath']))
	$localPath = $_common['localPath'];
else
    $localPath = "..";
require_once($localPath.'/config.php');
require_once($localPath.'/include/class_com_sql.php'); // a mysql class.

class isa_book_base
{
    static function Get($key)
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->query(isa_book_base::Read(isa_book_base::Format($key)));
        if($result->num_rows > 0)
            return $result->fetch_assoc()["base_value"];
        return "";
    }

    static function Set($key, $value)
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->query(isa_book_base::Write(isa_book_base::Format($key), isa_book_base::Format($value)));
        return $result;
    }

    static protected function Read($key)
    {
        $sql = "SELECT `base_id`, `base_name`, `base_value`, `base_update`, `base_valid` FROM `cc_web_base`
                WHERE `base_valid` = 1 AND `base_name` = '".$key."' LIMIT 1 ;";
        return $sql;
    }

    static protected function Write($key, $value)
    {
        $sql = "CALL `SetBase`('".$key."', '".$value."');";
        return $sql;
    }

    static protected function Format($value)
    {
        $value = htmlspecialchars($value, ENT_QUOTES);
        $value = addslashes($value);
        return $value;
    }

}
?>