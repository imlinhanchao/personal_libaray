<?php
class Book_Api
{
	// add book:http://book.douban.com/new_subject?cat=1001
	// Api detail:http://developers.douban.com/wiki/?title=book_v2
	function getById($id)
	{
		$json = @file_get_contents("http://api.douban.com/v2/book/".$id);
		if($json == null) $json = '{"msg":"book_not_found","code":6000,"request":"GET \/v2\/book\/'.$id.'"}';
		// echo $json;
		$array = json_decode($json, true);
		return $array;
	}
	
	function getByISBN($isbn)
	{
		$json = @file_get_contents("http://api.douban.com/v2/book/isbn/".$isbn);
		if($json == null) $json = '{"msg":"book_not_found","code":6000,"request":"GET \/v2\/book\/isbn\/'.$isbn.'"}';
		// echo $json;
		$array = json_decode($json, true);
		return $array;
	}
}
$BookInfo = new Book_Api();

/** Debug */
$array = [];
if(isset($_GET["dbid"])) 
{
	$id = $_GET["dbid"];
	$array = $BookInfo->getById($id);
}

if(isset($_GET["dbisbn"])) 
{
	$isbn = $_GET["dbisbn"];
	$array = $BookInfo->getByISBN($isbn);
}
if(isset($_GET["dbisbn"]) || isset($_GET["dbid"]))
	var_dump($array);

?>