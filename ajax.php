<?php
$_common['localPath'] = '.';
require('./data/class_book_post.php');
require('./data/class_book_lend.php');
require_once("./admin/verify.php");
$book = new isa_book_post();
if(isset($_GET['r']))
{
    // read book
    echo $book->Read($_GET['r'], 1);
}
else if(isset($_GET['b']))
{
    // begin to read
    echo $book->Read($_GET['b'], -1);
}
else if(isset($_GET['d']))
{
    // delete book
    echo $book->Kill($_GET['d']);
}
else if(isset($_GET['k']))
{
    // Back Book
    $lend = new isa_book_lend(array("Id"=>$_GET['k'], "Valid"=>"0"));
    echo $lend->BackBook();
}
