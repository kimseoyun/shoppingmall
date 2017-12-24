<?
	include "../php/config.php";	//Session 및 DB 연결설정
	include "../php/util.php";		//각종 유틸리티 함수
	
	//mysql 연결
	$connect = my_connect($host, $dbid, $dbpass, $dbname);
?>
<html>
<head>
<title>아이디 중복 확인</title>
<meta http-equiv="content-type" content="text/html;charset=euc-kr">
<link rel="stylesheet" href="../common/global.css">
<script language="javascript" src="../common/global.js"></script>
<script language="javascript">
	function send() {
		if(!document.id_check.id.value) {
			alert("ID를 입력하세요");
			document.id_check.id.focus();
			return;
		}
		document.id_check.submit();
	} //send()

	function form_send(s_id) {
		opener.document.form1.id.value = s_id;
		self.close();
	} //form_send()
</script>		
</head>
<body>

<table marginwidth="0" marginheight="0" leftmargin="0" topmargin="0">
<tr width="396" height="51">
	<td>
	<p><img src="../img/member_title3.gif" width="390" height="61" border="0"></p>
	</td>
</tr>

<?
	$query = "select id from member where id = '$id'";
	$result = mysql_query($query, $connect);
	$total_num = mysql_num_rows($result);

	if($total_num) { ?>
		<tr>
			<td width="396">
<table border="0" cellpadding="4" width="70%" align="center">
<form method="post" name="id_check" action="id_check.php">
<tr>
	<td width="296" align="center">
		<p align="left">선택하신<br>
		ID : <?=$id?>는 현재 사용중인 아이디입니다.</p>
	</td>
</tr>
<tr>
	<td>
<input type="text" name="id" size="15">
<input type="button" name="btn" onclick="javascript:send()" value='재검색'>
</td>
</tr>
</form>
</table>
</td>
</tr>
<?	}
	else { ?>
<tr>
<td>
	<table border="0" cellpadding="4" width="70%" align="center">
<tr>
	<td width="296" align="center">
		<p align="left">선택하신<br>
		ID : <b><?=$id?></b>는 회원ID로 사용하실 수 있습니다.</p>
	</td>
</tr>
<tr>
	<td width="296" align="center">
	<p align="center">
		<a href="javascript:form_send('<?=$id?>')">
		<img src="../img/member_button3.gif" width="88" height="26" border="0">
	</p>
	</td>
</tr>
<?	} ?>

<tr>
	<td width="396" height="34">
		<p align="center">
		<a href="javascript:window.close()">
		<img src="../img/member_close_button.gif" width="88" height="26" border="0">
	</p>
	</td>
</tr>
</table>
</body>
</html>