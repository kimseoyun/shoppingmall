<table border="0" cellpadding="0" cellspacing="0" width="215" style="border:5px solid #D7D7D7">
<tr>
	<td style="padding:4 2 10">

<?
	if($_SESSION[p_id]) { ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td width="200" height="32" border="whitesmoke">
<p>
<img src="/img/game_event_icon.gif" align="absmiddle">사이트 메뉴
</p>
	</td>
	</tr>

	<tr>
	<td width="200" height="32" border="whitesmoke">
		<img src="/img/notice_icon.gif" align="absmiddle">
		<a href="/member/mem_edit.php">정보수정</a>
	</td>
	</tr>
</table>
<?	}
	else { ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td width="200" height="32" border="whitesmoke">
<p>
<img src="/img/game_event_icon.gif" align="absmiddle">사이트 메뉴
</p>
	</td>
	</tr>

	<tr>
	<td width="200" height="32" border="whitesmoke">
		<img src="/img/notice_icon.gif" align="absmiddle">
		<a href="/member/join.php">회원가입</a>
	</td>
	</tr>
</table>
<?	} ?>
</td>
</tr>
</table>