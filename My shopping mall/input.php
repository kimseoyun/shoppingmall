<html>
<head>
<title></title>
<script language="javascript">
function check() {
	if(document.form1.id.value=="") {
		alert("아이디를 입력하세요");
		document.form1.id.focus();
		return;
	}
	if(document.form1.pass.value=="") {
		alert("비밀번호를 입력하세요");
		document.form1.pass.focus();
		return;
	}

	form1.submit();

}

</script>

</head>
<body>
<h2>로그인 폼</h2>

<form name="form1" method="get" action="proc.php">
아이디 : <input type="text" name="id"> <br>
비밀번호 : <input type="password" name="pass"> <br>
<input type="button" value="로그인" onclick="check()">
</form>

</body>
</html>