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
<title>장바구니 목록 보기</title>
<meta http-equiv="content-type" content="text/html;charset=euc-kr">
<link rel="stylesheet" href="../common/global.css">
<script language="javascript" src="../common/global.js"></script>
<script language="javascript" src="../common/shopping.js"></script>
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
	$query = "select * 
			  from products p, products_cart c
			  where c.user_sid='$_COOKIE[p_sid]' and p.num=c.product_fk
			  order by c.cart_id desc";
	$result = mysql_query($query, $connect);
	$total_count = mysql_num_rows($result);

	$tot_money = 0;
	$tot_mny1 = 0;

	if(!$total_count) { ?>
<table width="95%" border="0"cellspacing="0" cellpadding="0">
<tr>
	<td align="center" class="line">
		장바구니에 상품이 존재하지 않습니다.
	</td>
</tr>
</table>

<?	}
	else { ?>

<table width="95%" border="0"cellspacing="0" cellpadding="0">
<tr bgcolor="#EDEDED">

	<td colspan="2" align="center" class="line2">
		<font color="#666666"><strong>상품명</strong></font>
	</td>
<td width="1" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>
	<td width="80" align="center" class="line2">
		<font color="#666666"><strong>판매가격</strong></font>
	</td>
<td width="1" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>

	<td width="80" align="center" class="line2">
		<font color="#666666"><strong>수량</strong></font>
	</td>
<td width="1" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>

	<td width="80" align="center" class="line2">
		<font color="#666666"><strong>합계</strong></font>
	</td>
<td width="1" class="line2"><img src="../img/line1.gif" width="1"height="23"></td>

	<td width="80" align="center" class="line2">
		<font color="#666666"><strong>삭제</strong></font>
	</td>
</tr>

<?
	for($i=1; $rows=mysql_fetch_array($result); $i++) {
		$s_tot = (int)$rows[volume] * (int)$rows[amount];
		$tot_money = $tot_money + $s_tot;
?>
	<form name='basket<?=$i?>' method="post" action="cart_update.php">
	<input type="hidden" name="from" value="basket">
<tr>
<td width="100" height="70" align="center" class="line">
<a href="details.php?pnum=<?=$rows[num]?>&l_code=<?=$rows[category_fk]?>">
<img src="/upload/p_image/s/<?=$rows[prod_code]?>.<?=$rows[s_image_ty]?>"
width="50" height="50" border="0" onerror="this.src='../img/noimage.gif'">
</a>
</td>

<td class="line"><?=$rows[name]?> </td>
<td width="1" class="line2"><img src="../img/line1.gif" width="1"height="23"></td>

<td class="line"><?=$rows[price]?> </td>
<td width="1" class="line2"><img src="../img/line1.gif" width="1"height="23"></td>

<td align="center" class="line">

	<table border="0">
	<tr>	
		<td>
		<input type="text" name="products_count" value="<?=$rows[volume]?>" class="input3" size="2" maxlength="3">
		</td>
		<td width="16" valign="bottom">
<a href="javascript:num_plus(document.basket<?=$i?>);">
<img src="../img/order_top.gif" width="9" height="9" border="0">
</a>
<br>
<a href="javascript:num_minus(document.basket<?=$i?>);">
<img src="../img/order_down.gif" width="9" height="9" border="0">
</a>
</td>
<td>
	<input type="hidden" name="md" value="edit">
	<input type="hidden" name="cart_id" value="<?=$rows[cart_id]?>">
	<input type="image" src="../img/bt_change.gif">
</td>
</tr>
</table>
</td>
<td width="1" class="line2"><img src="../img/line1.gif" width="1"height="23"></td>
<td align="center" class="line"> <?=number_format($s_tot)?> </td>
<td width="1" class="line2"><img src="../img/line1.gif" width="1"height="23"></td>

<td align="center" class="line">
<a href="cart_update.php?md=del&cart_id=<?=$rows[cart_id]?>&from=basket">
	<img src="../img/bt_del.gif" width="14" height="13" border="0">
</a>
</td>
</tr>
</form>
<?	} //for
?>


<table width="95%" border="0"cellspacing="0" cellpadding="0">
<tr bgcolor="#EBEDD3">
	<td width="70%" height="30" bgcolor="#EBEDD3">&nbsp;</td>
	<td width="30%">
		<strong>총 결재금액 :
		<font color="#AE3E0D">
		<?=number_format($tot_money)?> 원
		</font>
		</strong>
	</td>
</tr>
</table>

<?
	if($total_count==0) {
		$go_purcharse = "javascript:alert('장바구니에 상품이 없습니다.')";
	} //if
	else {
		$go_purcharse = "purchase.php?from=basket";
	}
?>

<table width="95%" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#FFFFFF">
	<td width="100%" height="30" align="center">
		<a href=<?=$go_purcharse?>>
		<img src="../img/bt_buy.gif" border="0">
		</a>
		&nbsp;&nbsp;&nbsp;
		<a href="shop_main.php">
		<img src="../img/bt_cart1.gif" border="0">
		</a>
	</td>
</tr>
</table>
<?	} //else
?>

</td>
</tr>
</table>
</body>
</html>





