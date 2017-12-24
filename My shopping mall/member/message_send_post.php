<?
	include "../php/config.php";	//Session 및 DB 연결설정
	include "../php/util.php";		//각종 유틸리티 함수
	
	//mysql 연결
	$connect = my_connect($host, $dbid, $dbpass, $dbname);

	if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])) {
		err_msg("로그인 정보가 없습니다. 다시 로그인 해주세요..");
	}

	$query = "select id from member where id = '$receive_id'";
	$result = mysql_query($query, $connect);
	$total_num = mysql_num_rows($result);

	if(!$total_num) {
		err_msg("존재하지 않는 아이디 입니다.");
	}
	else {
		$msg = addslashes($msg);
		$query1 = 
"insert into message_info(sendid_fk, receiveid_fk, message, send_reg)
values('$_SESSION[p_id]', '$receive_id', '$msg', now())";
		$result1 = mysql_query($query1, $connect);

		if(!$result1) {
			err_msg("데이터베이스 오류가 발생하였습니다.");
		}
		else {
			echo "
				<script>
					window.alert('메시지를 전달하였습니다.');
				</script>";
			echo "<meta http-equiv='Refresh'content='0;url=message_2.php'>";
		}
	}
?>

