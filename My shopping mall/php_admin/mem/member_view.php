<?
	include "../../php/auth.php";	
	include "../../php/config.php";	
	include "../../php/util.php";	
	$connect = my_connect($host, $dbid, $dbpass, $dbname);
?>
<html>
<head>
<title>회원정보 보기</title>
<meta http-equiv="content-type" content="text/html;charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="javascript" src="../../common/global.js"></script>
</head>
<body bgcolor="#FFFFFF">
<table width="490" height="400" border="0"cellspacing="0" cellpadding="2">
<tr>
	<td height="20" bgcolor="#FFFFFF" align="right">
	회원 정보 수정/관리
	</td>
</tr>
<?
	$query = "select * from member where seq_num=$num";
	$result = mysql_query($query, $connect);
	$rows = mysql_fetch_array($result);
?>
<form name="primary" method="post" action="member_view_edit.php">
<input type="hidden" name="num" value="<?=$num?>">

<tr>
<td colspan="2" bgcolor="#FFFFFF" style="padding:15">
<table width="480" height="250" border="0"cellspacing="0" cellpadding="0" align="center">
<tr valign="top">
<td style="padding:25">
	<table width="480" height="250" border="1"cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<tr>
<td width="150" class="margin" align="left" bgcolor="#FFF5EC">아이디</td>
<td class="margin_left"><?=$rows[id]?></td>
		</tr>

<tr>
<td width="150" class="margin" align="left" bgcolor="#FFF5EC">비밀번호</td>

<td class="margin_left">
<input type="text" name="password" class="input" value="<?=$rows[passwd]?>">
</td>
</tr>

<tr>
<td width="150" class="margin" align="left" bgcolor="#FFF5EC">이름</td>

<td class="margin_left">
<input type="text" name="name" class="input" value="<?=$rows[name]?>">
</td>
</tr>

<tr>
<td width="150" class="margin" align="left" bgcolor="#FFF5EC">주민번호</td>
<td class="margin_left">
<?=$rows[jnumber]?>
</td>
</tr>

<tr>
<td width="150" class="margin" align="left" bgcolor="#FFF5EC">E-mail</td>
<td class="margin_left">
<input type="text" name="email" size="25" class="input" value="<?=$rows[email]?>">
</td>
</tr>

<tr>
<td width="150" class="margin" align="left" bgcolor="#FFF5EC">전화번호</td>
<td class="margin_left">
<input type="text" name="phone" size="20" class="input" value="<?=$rows[phone]?>">
</td>
</tr>

<tr>
<td width="150" class="margin" align="left" bgcolor="#FFF5EC">휴대폰</td>
<td class="margin_left">
<input type="text" name="mobile" size="20" class="input" value="<?=$rows[mobile]?>">
</td>
</tr>

<tr>
<td width="150" class="margin" align="left" bgcolor="#FFF5EC">우편번호</td>
<td class="margin_left">
<input type="text" name="zipcode" size="8" class="input" value="<?=$rows[zipcode]?>">
</td>
</tr>

<tr>
<td width="150" class="margin" align="left" bgcolor="#FFF5EC">주소</td>
<td class="margin_left">
<input type="text" name="address1" size="30" class="input" value="<?=$rows[address1]?>">
<input type="text" name="address2" size="30" class="input" value="<?=$rows[address2]?>">
</td>
</tr>
</table>
<br>

<table width="480" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td>&nbsp;</td>
	<td align="right"><input type="submit" value="수정하기"></td>
</tr>
</table>
</td>
</tr>
</form>
</table>
</body>
</html>