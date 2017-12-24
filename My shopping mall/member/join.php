<?
	include "../php/config.php";	//Session 및 DB 연결설정
	include "../php/util.php";		//각종 유틸리티 함수
	
	//mysql 연결
	$connect = my_connect($host, $dbid, $dbpass, $dbname);
?>
<html>
<head>
<title>회원가입 폼</title>
<meta http-equiv="content-type" content="text/html;charset=euc-kr">
<link rel="stylesheet" href="../common/global.css">
<script language="javascript" src="../common/global.js"></script>
<script language="javascript" src="../common/member.js"></script>
</head>
<body>
<?
	include "../include/top_menu.php";
?>
<br>
<table width="938" cellspacing="0" cellpadding="0" style="border-width:1; border-style:solid;" border="0">
<tr>
	<td width="210" height="376" valign="top">
		<?
			include "../include/left_login.php";
			include "../include/main_left.php";
		?>
	</td>
	<td width="728" height="576" valign="top">
	<table width="100%" border="0"cellspacing="0" cellpadding="0">
		<tr>
			<td height="30" style="padding:10 0 0 14px">
				<a href="#">홈</a>
				&gt; 회원정보 &gt;<a href="/member/join.php">회원가입</a>
			</td>
		</tr>
		</table>

<form name="form1" method="post" action="join_post.php">
<table width="100%" border="0" cellspacing="1" cellpadding="2">
<tr>
<td colspan="3" class="line-t" height="1" bgcolor="#e1e1e1"></td>
</tr>

<tr>
<td class="line-n" valign="top" bgcolor="#f8f8f7">아이디</td>
<td class="line"><input type="text" name="id" class="InputStyle1">
<a href="javascript:check_ID_Window('id_check.php')">[중복확인]</a>
<br>
특수문자, 한글, 공백을 포함할 수 없으며<br>
모두 소문자와 숫자만 입력됩니다.(4~10자 사이)
</td>
<td rowspan="2"></td>
</tr>

<tr>
<td class="line-n" valign="top" bgcolor="#f8f8f7">비밀번호</td>
<td class="line"><input type="password" name="passwd" class="InputStyle1" maxlength="10" size="16">
<br>
특수문자, 공백을 포함할 수 없으며<br>
대, 소문자를 구분합니다.(4~10자 사이)
</td>
<td></td>
</tr>

<tr>
<td class="line-n" valign="top" bgcolor="#f8f8f7">비밀번호 재입력</td>
<td class="line">
<input type="password" name="passwd2" class="InputStyle1" maxlength="10" size="16">
<br>
특수문자, 공백을 포함할 수 없으며<br>
대, 소문자를 구분합니다.(4~10자 사이)
</td>
<td></td>
</tr>

<tr>
<td class="line-n" valign="top" bgcolor="#f8f8f7">이름</td>
<td class="line">
<input type="text" name="name" size="16" class="InputStyle1">
</td>
<td></td>
</tr>

<tr>
<td class="line-n" valign="top" bgcolor="#f8f8f7">주민등록번호</td>
<td class="line">
<input type="text" name="jumin1" size="6" class="InputStyle1" onkeyup="focus_move()">
-
<input type="text" name="jumin2" size="7" class="InputStyle1">
</td>
<td></td>
</tr>

<tr>
<td class="line-n" valign="top" bgcolor="#f8f8f7">E-mail</td>
<td class="line">
<input type="text" name="email" size="25" class="InputStyle1" >
</td>
<td></td>
</tr>

<tr>
<td class="line-n" valign="top" bgcolor="#f8f8f7">우편번호</td>
<td class="line">
<input type="text" name="zipcode1" size="3" class="InputStyle1">
-
<input type="text" name="zipcode2" size="3" class="InputStyle1">
<a href="javascript:ZipWindow('zip_search.php')">[우편번호 검색]</a>
</td>
<td></td>
</tr>


<tr>
<td class="line-n" valign="top" bgcolor="#f8f8f7">주소</td>
<td class="line">
<input type="text" name="address1" size="35" class="InputStyle1">
(동까지 입력)<br>
<input type="text" name="address2" size="35" class="InputStyle1" maxlength="50">
(나머지 입력)
</td>
<td></td>
</tr>


<tr>
<td class="line-n" valign="top" bgcolor="#f8f8f7">전화번호</td>
<td class="line">
<input type="text" name="phone1" size="3" class="InputStyle1">
-
<input type="text" name="phone2" size="4" class="InputStyle1">
-
<input type="text" name="phone3" size="4" class="InputStyle1">
(자택 또는 회사)
</td>
<td></td>
</tr>

<tr>
<td class="line-n" valign="top" bgcolor="#f8f8f7">휴대폰</td>
<td class="line">
<select name="hphone1" class="InputStyle1">
	<option value="">선택</option>
	<option value="010">010</option>
	<option value="011">011</option>
	<option value="016">016</option>
	<option value="017">017</option>
	<option value="018">018</option>
	<option value="019">019</option>
</select>
-
<input type="text" name="hphone2" size="4" class="InputStyle1">
-
<input type="text" name="hphone3" size="4" class="InputStyle1">
</td>
<td></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center">
<a href="javascript:checkInput()"><img src="../img/butn_ok.gif" border="0"></a>
<a href="/index.php">
<img src="../img/btn_cancel.gif" hspace="4" border="0"></a>
</td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</body>
</html>