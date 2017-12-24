<?
	include "../../php/auth.php";	
	include "../../php/config.php";	
	include "../../php/util.php";	
	$connect = my_connect($host, $dbid, $dbpass, $dbname);

	$query = "update mall_order 
	          set cancel='Y' 
			  where num = '$oid'";
	mysql_query($query, $connect);


echo "<meta http-equiv='Refresh'content='0;url=order_list.php?page=$page'>";
?>