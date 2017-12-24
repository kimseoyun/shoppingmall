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
<title>상품정보 상세 보기</title>
<meta http-equiv="content-type" content="text/html;charset=euc-kr">
<link rel="stylesheet" href="../common/global.css">
<script language="javascript" src="../common/global.js"></script>
<script language="javascript" src="../common/shopping.js"></script>
</head>
<body bgcolor="#C4E0E5">
<?
	include "../include/top_menu.php";
?>
<br>
<table width="1000" cellspacing="0" cellpadding="0" style="border-width:1; border-style:solid;" border="0" bgcolor="white" align="center">
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

<?
	$query = "select * from products where num = $pnum";
	$result = mysql_query($query, $connect);
	$rows = @mysql_fetch_array($result);
	@mysql_free_result($result);
?>

<table width="645" border="0" cellspacing="0" cellpadding="0">
<form name="products_info" method="post">
	<input type="hidden" name="from" value="details">
	<input type="hidden" name="pnum" value="<?=$pnum?>">
	<input type="hidden" name="amount" value="<?=$rows[price]?>">

<tr>
	<td width="340" height="300" align="center" valign="bottom">

<img src="/upload/p_image/m/<?=$rows[prod_code]?>.<?=$rows[m_image_ty]?>"
width="230" height="230" border="0" onerror="this.src='../img/noimage.gif'">
<br>
<?
	if($rows[b_image]=='Y') {  ?>
<a href="javascript:MM_openBrWindow('open_big_view.php?prod_code=<?=$rows[prod_code]?>&prod_ty=<?=$rows[b_image_ty]?>', 'Na', 'width=550, height=650, scrollbars=yes')">
		<img src="../img/icon_zoom.gif" width="46" height="16" border="0">
</a>
<?	} //if
	else { ?>
		<img src="../img/icon_zoom.gif" width="46" height="16" border="0">
<?	} ?>
	</td>

<td valign="top">
<table width="90%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="30" align="center" class="text5">
	<b><?=$rows[name]?></b>
	</td>
</tr>
<tr>
	<td height="5" bgcolor="#585858"></td>
</tr>
</table>
<br>
<table width="90%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="130" height="26" class="line">소비자 가격</td>
<td class="line"><s><?=number_format($rows[cust_price])?> 원</s></td>
</tr>

<tr>
<td width="130" height="26" class="line">판매 가격</td>
<td class="line"><?=number_format($rows[price])?> 원</td>
</tr>

<tr>
<td width="130" height="26" class="line">적립금</td>
<td class="line"><?=number_format($rows[mileage])?> 포인트</td>
</tr>

<? if($rows[size]) {
		$t_size = explode("|", $rows[size]);
?>
<tr>
<td width="130" height="26" class="line">옵션</td>
<td class="line">
	<select name="products_size">
<?
	for($i=0; $i<sizeof($t_size); $i++) {
		if(trim($t_size[$i])==$products_size) {
			$selected = "selected";
		} //if
		else {
			$selected = "";
		} ?>
<option value="<?=trim($t_size[$i])?>" <? echo($selected)?>>
<?=shortenStr(trim($t_size[$i]),20) ?>
</option>	

<?	} //for

?>
	</select>
</td>
</tr>
<? } //if
?>
<tr>
	<td width="130" height="26" class="line">주문수량</td>
	<td valign="bottom" class="line">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>	
		<td width="40">
		<input type="text" name="products_count" value="1" class="input3" size="4" maxlength="5" onkeypress="is_number()">
		</td>
		<td width="16" valign="bottom">
<a href="javascript:num_plus(document.products_info)">
<img src="../img/order_top.gif" width="9" height="9" border="0">
</a>
<br>
<a href="javascript:num_minus(document.products_info)">
<img src="../img/order_down.gif" width="9" height="9" border="0">
</a>
</td>
<td> 개</td>
</tr>
</table>
</td>
</tr>
<tr>
<td width="130" height="26" class="line">제조회사</td>
<td class="line"><?=$rows[company]?></td>
</tr>
<tr>
	<td height="20">&nbsp</td>
	<td>&nbsp</td>
</tr>
</table>

<table width="90%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td align="center">
	<a href="javascript:goCart(this.products_info);">	
		<img src="../img/bt_basket.gif" border="0" width="87" height="20">
	</a>&nbsp;&nbsp;&nbsp;

	<a href="javascript:goOrder(this.products_info);">	
		<img src="../img/bt_buy.gif" border="0"  width="87" height="20">
	</a>
	</td>
</tr>
</table>
</td>
</tr>
</table>
<br>

<table width="90%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td bgcolor="#F7F7F7">-- 상품 상세 정보 --</td>
</tr>
<tr>
	<td>
	<table width="100%" border="0" cellspacing="0" cellpadding="10">
	<tr>		
	<td>
<?
	if($rows[con_html]=='1') {
		echo(stripslashes($rows[contents]));
	}
	else {
	echo(nl2br(stripslashes($rows[contents])));
	}
?>
	</td>
	</tr>
	</table>
	</td>
</tr>
</form>
</table>
</td>
</tr>
</table>
</body>
</html>