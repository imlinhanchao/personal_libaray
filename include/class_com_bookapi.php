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

    function getSearch($s)
    {
        $json = @file_get_contents("https://api.douban.com/v2/book/search?q=".urlencode($s));
        if($json == null) $json = '{"count": 0,"start": 0,"total": 0,"books": []}';
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
    $dump = true;
}

if(isset($_GET["dbisbn"])) 
{
	$isbn = $_GET["dbisbn"];
	$array = $BookInfo->getByISBN($isbn);
    $dump = true;
}

if(isset($_GET["dbs"]))
{
	$s = $_GET["dbs"];
	$array = $BookInfo->getSearch($s);
    $dump = true;
}

if(isset($dump))
	var_dump($array);

?>