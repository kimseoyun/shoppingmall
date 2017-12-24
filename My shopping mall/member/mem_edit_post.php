<?
	include "../php/config.php";	//Session 및 DB 연결설정
	include "../php/util.php";		//각종 유틸리티 함수
	
	//mysql 연결
	$connect = my_connect($host, $dbid, $dbpass, $dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])) {
	err_msg("로그인 정보가 없습니다. 다시 로그인해 주세요..");
}

	$name = addslashes($name);
	$eamil = addslashes($email);
	$address1 = addslashes($address1);
	$address2 = addslashes($address2);
	$phone = $phone1."-".$phone2."-".$phone3;
	$hphone = $hphone1."-".$hphone2."-".$hphone3;
	$zipcode = $zipcode1."-".$zipcode2;
	
	$query = "update member
			  set passwd = '$passwd',
			      name = '$name',
				  email = '$email',
				  phone = '$phone',
				  mobile = '$hphone',
				  zipcode = '$zipcode',
				  address1 = '$address1',
  				  address2 = '$address2'
              where id = '$_SESSION[p_id]' ";
	$result = mysql_query($query, $connect);

	if(!$result) {
		err_msg("데이터베이스 오류가 발생하였습니다.");
	}
	else {
		//세션을 다시 부여
		$_SESSION["p_name"] = $name;
		$_SESSION["p_email"] = $email;

		echo "
		<script>
			window.alert('정상적으로 정보가 수정되었습니다.');
		</script>";
echo "<meta http-equiv='Refresh'content='0;url=mem_edit.php'>";
	}
?>