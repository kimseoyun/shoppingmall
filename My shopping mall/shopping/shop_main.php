<?
	include "../php/config.php";
	include "../php/util.php";		
	$connect = my_connect($host, $dbid, $dbpass, $dbname);

	if(!$_COOKIE[p_sid]) {
		$SID = md5(uniqid(rand()));
		SetCookie("p_sid", $SID, 0, "/");
	}
?>
<html>
<head>
<title>쇼핑몰 메인 화면</title>
<meta http-equiv="content-type" content="text/html;charset=euc-kr">
<link rel="stylesheet" href="../common/global.css">
<script language="javascript" src="../common/global.js"></script>
</head>
<body bgcolor="#C4E0E5">
<?
	include "../include/top_menu.php";
?>
<br>
<table width="1000" cellspacing="0" cellpadding="0" style="border-width:1; border-style:solid;" border="0" bgcolor="White" align="center">
<tr>
	<td width="210" height="376" valign="top">
		<?
			include "../include/left_login.php";
			include "../include/main_left2.php";
		?>
	</td>
	<td width="728" height="576" valign="top">
	<table width="100%" border="0"cellspacing="0" cellpadding="0">
		<tr>
			<td height="30" style="padding:10 0 0 14px">
				<a href="#">홈</a>
				&gt; SHOPPING &gt;<a href="/shopping/shop_main.php">쇼핑홈</a>
			</td>
		</tr>
		</table>

<table width="100%" border="0" cellspacing="1" cellpadding="2">
<tr>
	<td class="line-t" height=1 bgcolor="#E1E1E1"></td>
</tr>
<tr>
<td class="line-t" height="20" bgcolor="#E1E1E1"> - 이벤트 상품 -
</td>
</tr>
<tr>
	<td width="100%" align="center">
		<table width="99%" border="0" cellspacing="0" cellpadding="0">
		<tr>
<?
	$query2 = "select * from products
			   where del_chk='N' and option1_chk='Y'
			   order by num desc limit 0,5";
	$result2 = mysql_query($query2, $connect);
for($kk=0; $rows2=mysql_fetch_array($result2); $kk++) { ?>
<td valign="top" width="115" height="120">
<table border="0">
<tr>
<td align="center" valign="top" width="115" height="120">

<a href="details.php?pnum=<?=$rows2[num]?>&l_code=<?=$rows2[category_fk]?>">
<img src="/upload/p_image/m/<?=$rows2[prod_code]?>.<?=$rows2[m_image_ty] ?>" width="100" height="120" border="0" onerror="this.src='../img/noimage.gif'">
</a>
</td>
</tr>
<tr>
<td class="hanamii" align="center">
	<?=stripslashes($rows2[name])?>
</td>
</tr>
<tr>
<td class="hanamii" align="center">
	<s><?=number_format($rows2[cust_price])?></s>
</td>
</tr>
<tr>
<td class="hanamii" align="center">
	<b><?=number_format($rows2[price])?></b>
</td>
</tr>
</table>
</td>
<?	} //for	
	mysql_free_result($result2);

	for($j=$kk; $j<5; $j++) { ?>
		<td width="115" height="150">
			<table border="0">
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
			</table>
		</td>
<?	} //for ?>
		</tr>
		</table>
</td>
</tr>
</table>
<br>





<table width="100%" border="0" cellspacing="1" cellpadding="2">
<tr>
	<td class="line-t" height=1 bgcolor="#E1E1E1"></td>
</tr>
<tr>
<td class="line-t" height="20" bgcolor="#E1E1E1"> - 신상품 - </td>
</tr>
<tr>
	<td width="100%" align="center">
		<table width="99%" border="0" cellspacing="0" cellpadding="0">
		<tr>
<?
	$query3 = "select * from products
			   where del_chk='N' and option2_chk='Y'
			   order by num desc limit 0,5";
	$result3 = mysql_query($query3, $connect);
for($kk=0; $rows3=mysql_fetch_array($result3); $kk++) { ?>
<td valign="top" width="115" height="120">
<table border="0">
<tr>
<td align="center" valign="top" width="115" height="120">
<a href="details.php?pnum=<?=$rows3[num]?>&l_code=<?=$rows3[category_fk]?>">
<img src="/upload/p_image/m/<?=$rows3[prod_code]?>.<?=$rows3[m_image_ty] ?>" width="100" height="120" border="0" onerror="this.src='../img/noimage.gif'">
</a>
</td>
</tr>
<tr>
<td class="hanamii" align="center">
	<?=stripslashes($rows3[name])?>
</td>
</tr>
<tr>
<td class="hanamii" align="center">
	<s><?=number_format($rows3[cust_price])?></s>
</td>
</tr>
<tr>
<td class="hanamii" align="center">
	<b><?=number_format($rows3[price])?></b>
</td>
</tr>
</table>
</td>
<?	} //for	
	mysql_free_result($result3);

	for($j=$kk; $j<5; $j++) { ?>
		<td width="115" height="150">
			<table border="0">
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
			</table>
		</td>
<?	} //for ?>
		</tr>
		</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>
































