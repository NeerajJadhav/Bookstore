<?php
require_once 'core/init.php';
$key=$_GET['key'];
$con= mysql_connect("localhost","root","");
$db= mysql_select_db("bookstore",$con);
$query= mysql_query("select * from books where Title LIKE '%{$key}%'");
while($row = mysql_fetch_assoc($query))
{
    $array[] = '<a href="single.php?BookID='.$row['BookID'].'">'.$row['Title'].'</a>';
}
echo json_encode($array);
?>
