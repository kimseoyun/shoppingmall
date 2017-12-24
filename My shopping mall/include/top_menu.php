<table width="939" height="150" cellspacing="0" cellpadding="0"  border="0" align="center">
	<tr>
		<td bgcolor="white" >
			<a href="../index.php"><img src="/img/topmenu.jpg" width="939" height="150"> </a>
		</td>
	</tr>
	<tr>
		<td align="middle" width="597" height="20">
		<font color="black">
<?
		if(!$_SESSION[p_id] || !$_SESSION[p_name]) { //비회원 
?>
		<a href="/member/join.php"><font color="white"><b>JOIN</b></font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/school/main.php"><font color="white"><b>INTRODUCE</b></font></a>     
<?			} //if
		else {	//회원
?>
		<a href="/member/mem_edit.php"><font color="white"><b>EDIT</b></font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/school/main1.php"><font color="white"><b>SCHEDULE</b></font></a> 

<?			} //else 
?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="/shopping/shop_main.php">
		<font color="white"><b>SHOPPING</b></font></a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/auction/auct_main.php"><font color="white"><b>REVIEW</b></font></a> 
		<?
		if($_SESSION[p_id]=='choi')	{ ?>
		<font color="black">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><a href="../php_admin/index.php" target='_blank'><font color="white"><b>ADMIN</b></font></a> 
			
<? } ?>
		</td>

	</tr>
</table>