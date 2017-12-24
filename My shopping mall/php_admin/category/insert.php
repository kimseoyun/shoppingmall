<?
	include "../../php/auth.php";	
	include "../../php/config.php";	
	include "../../php/util.php";	
	$connect = my_connect($host, $dbid, $dbpass, $dbname);

	$name = addslashes($name);

	if($mode=='insert') {
		$query = "select * from products_category1 
		          where code = '$code'";
		$result = mysql_query($query, $connect);
		$count = mysql_num_rows($result);

		if($count) {
			err_msg("입력한 코드가 이미 있습니다.");
		}

		$query1 = "insert into products_category1 
		           values('', '$code', '$name')";
		mysql_query($query1, $connect);
	}
	else if($mode=='update'){
		$query2 = "update products_category1
		           set name='$name'
  				   where id = '$id'";
		mysql_query($query2, $connect);
	}

echo "<meta http-equiv='Refresh'content='0;url=list.php'>";

?>