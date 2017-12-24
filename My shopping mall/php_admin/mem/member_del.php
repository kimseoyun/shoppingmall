<?
	include "../../php/auth.php";	
	include "../../php/config.php";	
	include "../../php/util.php";	
	$connect = my_connect($host, $dbid, $dbpass, $dbname);

	$query = "select * from member where seq_num='$m_num'";
	$result = mysql_query($query, $connect);
	$rows = mysql_fetch_array($result);

	if($rows) {
		$query1 = "delete from member where seq_num='$m_num'";
		mysql_query($query1, $connect);	
	}

	//추후 상품구매 진행후 DB 삭제코드 추가


	echo "<script>
			window.alert('회원정보가 삭제되었습니다.');
		</script>";
	echo "<meta http-equiv='Refresh' content='0;url=admin_member_list.php?page=$page'>";

?>