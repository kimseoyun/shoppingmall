<?
	include "../../php/auth.php";	
	include "../../php/config.php";	
	include "../../php/util.php";	
	$connect = my_connect($host, $dbid, $dbpass, $dbname);

$query = "select * from products_category1 where id = $id";
$result = mysql_query($query, $connect);
$rows = mysql_fetch_array($result);
mysql_free_result($result);

$code = $rows[code]; //$code = A

//products 테이블에서 삭제
$query1 = "delete from products
           where category_fk='$code'";
mysql_query($query1, $connect);

//중분류에서 코드 삭제
$query2 = "delete from products_category2
           where category_code_fk='$code'";
mysql_query($query2, $connect);

//대분류에서 코드 삭제
$query3 = "delete from products_category1
           where id='$id'";
mysql_query($query3, $connect);

echo "<meta http-equiv='Refresh'content='0;url=list.php'>";

?>