<table border="0" cellpadding="10" cellspacing="10" width="200">
<tr>
	<td style="padding:20 10 10" align="center"><b>LOGIN</b>
	<hr>

		<table border="0" cellpadding="0" cellspacing="0" width="198">
<?
	if(!isset($_SESSION["p_id"]) || !$_SESSION["p_name"])	{
?>
	<form method="post" name="login" action="/member/login_process.php"
	onsubmit="javascript:return(login_check())">

		<tr>
			<td width="198" height="45">
				<table width="200" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height="5"></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td width="40">
	<table width="100" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="40" height="25">
			<img width="39" height="9" src="/img/login_id.gif">
		</td>
		<td>
			<input type="text" size="12" name="id">
		</td>
	</tr>
	
	<tr>
		<td height="25">
			<img width="39" height="9" src="/img/login_pass.gif">
		</td>
		<td>
			<input type="password" size="12" name="pwd">
		</td>
	</tr>
	</table>
	</td>

	<td align="middle" width="50">
<input type="image" width="45" height="46" src="/img/login_btn.gif">
	</td>
	<td></td>
	</tr>
	<tr align="middle">
	<td></td>
	<td></td>
	<td></td>
	</tr>
</table>

<table width="168" height="25" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
	<td class="chon11px">
	<img width="7" height="7" border="0" src="/img/login_blit.gif">
		<font color="#000000"><a href="/member/join.php">회원가입</a></font>
	</td>

	<td class="chon11px">
	<img width="7" height="7" border="0" src="/img/login_blit.gif">
		<font color="#000000"><a href="/member/idpass_search.php">비밀번호 찾기</a></font>
	</td>
</tr>
</table>
</td>
</tr>
</form>
<?	} //if
	else {
$query = "select count(mnum) as cnt_1 from message_info 
		  where receiveid_fk='$_SESSION[p_id]' and receive_del='N'
		  and receive_chk='N'";
$result = mysql_query($query, $connect);
$rows = mysql_fetch_array($result);
mysql_free_result($result);
?>


<tr>
	<td width="198" height="45">
	<table width="200" border="0" cellpadding="0" cellspacing="0">	
	<tr>
		<td height="5"></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="3" align="center">
		<table width="150" cellspacing="0" cellpadding="0">
		<tr>
			<td height="35" align="center">
				<?=$_SESSION[p_name] ?>님 반갑습니다.
			</td>
		</tr>
		</table>
		</td>
	</tr>

	<tr>
		<td align="middle"></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	</table>

	<table width="168" height="25" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td class="chon11px">
<img width="7" height="7" border="0" src="/img/login_blit.gif">
<font color="#000000"><a href="/member/mem_edit.php">정보수정</a></font>
		</td>
	
	<td class="chon11px">
<img width="7" height="7" border="0" src="/img/login_blit.gif">
<font color="#000000"><a href="/member/logout_process.php">로그아웃</a></font>
		</td>
	</tr>
	</table>



<table width="95%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="13">
			<img src="/img/bt_msg.gif" align="absmiddle">
		</td>
		<td width="75" class="line2">
			<a href="/member/message_1.php">새쪽지 수</a>
		</td>
		<td width="10" class="line2" align="center"> : </td>
		<td width="62" class="line2" align="right">
		<b>
<a href="/member/message_1.php"><?=number_format($rows[cnt_1])?></a>
		</b> 개</td>
	</tr>
	</table>
	</td>
</tr>
<?	} //else
?>
	</table>
</td>
</tr>
</table>