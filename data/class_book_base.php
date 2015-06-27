<?php
if(isset($_common['localPath']))
	$localPath = $_common['localPath'];
else
    $localPath = "..";
require_once($localPath.'\config.php');
require_once($localPath.'\include\class_com_sql.php'); // a mysql class.

class isa_book_base
{
    static function Get($key)
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->query(isa_book_base::Read($key));
        return $result;
    }

    static function Set($key, $value)
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->query(isa_book_base::Write($key, $value));
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
        $sql = "IF NOT EXISTS SELECT * FROM `cc_web_base` WHERE `base_name` = '".$key."'
                BEGIN
                    INSERT INTO `cc_web_base` (`base_name`, `base_value`, `base_update`, `base_valid`)
                    VALUES('".$key."', '".$value."', NOW(), 1) ;
                END
                ELSE
                BEGIN
                    UPDATE `cc_web_base` SET `base_value` = '".$value."', `base_valid` = 1
                    WHERE `base_name` = '".$key."' ;
                END";
        return $sql;
    }
}
?>