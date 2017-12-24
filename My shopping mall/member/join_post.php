<?
	include "../php/config.php";	//Session 및 DB 연결설정
	include "../php/util.php";		//각종 유틸리티 함수
	
	//mysql 연결
	$connect = my_connect($host, $dbid, $dbpass, $dbname);
	
	$jnumber = $jumin1."-".$jumin2;
	$id = addslashes($id);

$query = "select id from member where id = '$id' or jnumber='$jnumber'";
$result = mysql_query($query, $connect);
$total_num = mysql_num_rows($result);

if($total_num) {
	echo "
		<script>
			window.alert('아이디나 주민번호 중 중복된 값이 있습니다.');
			history.go(-1);
		</script>
		exit; ";
}
else {
	$email = addslashes($email);
	$address1 = addslashes($address1);
	$address2 = addslashes($address2);
	$phone = $phone1."-".$phone2."-".$phone3;
	$hphone = $hphone1."-".$hphone2."-".$hphone3;
	$zipcode = $zipcode1."-".$zipcode2;

$query1 = "insert into member(id,passwd,email,name,jnumber,phone,mobile,zipcode,address1,address2,reg_date)
values('$id','$passwd','$email','$name','$jnumber', '$phone', '$hphone', '$zipcode', '$address1', '$address2', now())";

$result1 = mysql_query($query1, $connect);

if(!$result1) {
	err_msg("데이터베이스 오류가 발생하였습니다.");
}
else {
	echo "<script>
			window.alert('정상적으로 회원가입이 되었습니다. 로그인 후 사용하세요..!');
		</script>";
echo "<meta http-equiv='Refresh' content='0;url=/index.php'>";
}
}
?>