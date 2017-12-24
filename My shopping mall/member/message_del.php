<?
	include "../php/config.php";	//Session 및 DB 연결설정
	include "../php/util.php";		//각종 유틸리티 함수
	
	//mysql 연결
	$connect = my_connect($host, $dbid, $dbpass, $dbname);

	if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])) {
		err_msg("로그인 정보가 없습니다. 다시 로그인 해주세요..");
	}

	if($mode=='view')  {
		if($gb=='1') {
			$query = "update message_info
			          set receive_del='Y'
					  where mnum='$mnum'";
			$result = mysql_query($query, $connect);
	echo "<meta http-equiv='Refresh' content='0;url=message_1.php'>";

		}
		else if($gb=='2') {
			$query = "update message_info
			          set send_del='Y'
					  where mnum='$mnum'";
			$result = mysql_query($query, $connect);
	echo "<meta http-equiv='Refresh' content='0;url=message_2.php'>";
		}
	}
	else {
		if($gb=='1') {
			for($i=0; $i<sizeof($mnum); $i++) {
				$query = "update message_info
			          set receive_del='Y'
					  where mnum='$mnum[$i]'";
				$result = mysql_query($query, $connect);
			}
echo "<meta http-equiv='Refresh' content='0;url=message_1.php'>";
		}
	else if($gb=='2') {
			for($i=0; $i<sizeof($mnum); $i++) {
				$query = "update message_info
			          set send_del='Y'
					  where mnum='$mnum[$i]'";
				$result = mysql_query($query, $connect);
			}
echo "<meta http-equiv='Refresh' content='0;url=message_2.php'>";
		}


} ?>