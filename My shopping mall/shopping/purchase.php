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
<title>주문정보 화면</title>
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

<form name="purchase" method="post" action="purchase_post.php">
<table width="95%" border="0"cellspacing="0" cellpadding="0">
<tr bgcolor="#EDEDED">
	<td align="center" class="line2">상품명</td>
<td width="1" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>

<td width="100" align="center" class="line2">판매가격</td>
<td width="1" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>
<td width="80" align="center" class="line2">수량</td>
<td width="1" class="line2"><img src="../img/line1.gif" width="1" height="23"></td>
<td width="100" align="center" class="line2">합계</td>
</tr>

<?
	if($from=="detail") {
		$query = "select * 
				  from products p, products_cart c 
				  where user_sid='$_COOKIE[p_sid]' and 
				  p.num = c.product_fk
				  order by c.cart_id desc limit 0, 1";
	}
	else if($from=="basket") {
		$query = "select * 
				  from products p, products_cart c 
				  where user_sid='$_COOKIE[p_sid]' and 
				  p.num = c.product_fk
				  order by c.cart_id desc";
	}

	$result = mysql_query($query, $connect);
	$jumun_tot = mysql_num_rows($result);

	$sub_tot = 0;
	$sub_point = 0;


for($i=0; $rows=mysql_fetch_array($result); $i++) {
	$s_tot = (int)$rows[volume] * (int)$rows[amount];
?>
<tr>
<td height="40" align="center" class="line"> 
	<?=$rows[name]?>
</td>
<td valign="bottom" class="line">
	<img src="../img/line1.gif" width="1" height="23">
</td>

<td height="40" align="center" class="line"> 
	<?=number_format($rows[amount])?>
</td>
<td valign="bottom" class="line">
	<img src="../img/line1.gif" width="1" height="23">
</td>

<td height="40" align="center" class="line"> 
	<?=number_format($rows[volume])?>
</td>
<td valign="bottom" class="line">
	<img src="../img/line1.gif" width="1" height="23">
</td>
<td height="40" align="center" class="line"> 
	<?=number_format($s_tot)?> 원
</td>
</tr>

<input type="hidden" name="products_fk[]" value="<?=$rows[num]?>">
<input type="hidden" name="products_name[]" value="<?=$rows[name]?>">
<input type="hidden" name="products_kind[]" value="<?=$rows[p_size]?>">
<input type="hidden" name="products_count[]" value="<?=$rows[volume]?>">
<input type="hidden" name="products_price[]" value="<?=$rows[amount]?>">
<input type="hidden" name="products_point[]" value="<?=$rows[mileage]?>">

<?
	$sub_tot = $sub_tot + $s_tot;
	$sub_point = $sub_point + (int)$rows[mileage];

} //for

	//배송비
	$trans_cost = 3000;
	$last_cost = $sub_tot + $trans_cost;
?>

<input type="hidden" name="trans_cost" value="<?=$trans_cost?>">
<input type="hidden" name="amount" value="<?=$last_cost?>">

<table width="95%" border="0"cellspacing="0" cellpadding="0">
<tr bgcolor="#EBEDD3">
	<td width="70%" height="30" bgcolor="#EBEDD3">&nbsp;</td>
	<td width="30%">
		<strong>총 주문금액 :
		<font color="#AE3E0D">
		<?=number_format($last_cost)?> 원
		</font>
		</strong>
	</td>
</tr>
</table>
<br>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#CCCCCC">
	<td>
		-- 주문자 정보 --
	</td>
</tr>
</table>
<br>




<?
	if($_SESSION[p_id]) {
		$m_qry = "select * from member 
		          where id = '$_SESSION[p_id]'";
		$m_res = mysql_query($m_qry, $connect);
		$m_rows = mysql_fetch_array($m_res);

		$resnumber = explode("-", $m_rows[jnumber]);
		$aphone = explode("-", $m_rows[phone]);
		$ahphone = explode("-", $m_rows[mobile]);
		$azipcode = explode("-", $m_rows[zipcode]);
	}
?>

<table width="88%" border="0" cellspacing="0" cellpadding="0">

<tr>
<td width="14" class="line"></td>
<td width="100" class="line">이름</td>
<td class="line">
	<input type="text" name="buyer_name" value="<?=$m_rows[name]?>" class="input3" size="10">
</td>
</tr>

<tr>
<td width="14" class="line"></td>
<td width="100" class="line">E-mail</td>
<td class="line">
	<input type="text" name="buyer_email" value="<?=$m_rows[email]?>" class="input3" size="30">
</td>
</tr>

<tr>
<td width="14" class="line"></td>
<td width="100" class="line">주소</td>
<td class="line">
	<input type="text" name="buyer_zipcode01" value="<?=$azipcode[0]?>" class="input3" size="6">
	-
	<input type="text" name="buyer_zipcode02" value="<?=$azipcode[1]?>" class="input3" size="6">

	<a href="javascript:ZipWindow('../member/zip_search.php', 2)">
	[우편번호 검색]</a>
	<br>
<input type="text" name="buyer_address01" value="<?=$m_rows[address1]?>" class="input3" size="30">
<br>
<input type="text" name="buyer_address02" value="<?=$m_rows[address2]?>" class="input3" size="50">

</td>
</tr>


<tr>
<td width="14" class="line"></td>
<td width="100" class="line">전화번호</td>
<td class="line">
	<input type="text" name="buyer_phone01" value="<?=$aphone[0]?>" class="input3" size="6">
	-
	<input type="text" name="buyer_phone02" value="<?=$aphone[1]?>" class="input3" size="6">
	-
	<input type="text" name="buyer_phone03" value="<?=$aphone[2]?>" class="input3" size="6">
</td>
</tr>

<tr>
<td width="14" class="line"></td>
<td width="100" class="line">휴대전화</td>
<td class="line">
	<input type="text" name="buyer_hphone01" value="<?=$ahphone[0]?>" class="input3" size="6">
	-
	<input type="text" name="buyer_hphone02" value="<?=$ahphone[1]?>" class="input3" size="6">
	-
	<input type="text" name="buyer_hphone03" value="<?=$ahphone[2]?>" class="input3" size="6">
</td>
</tr>

<tr>
<td width="14" class="line"></td>
<td width="100" class="line">주민등록번호</td>
<td class="line">
	<input type="text" name="buyer_resnumber01" value="<?=$resnumber[0]?>" class="input3" size="6">
	-
	<input type="text" name="buyer_resnumber02" value="<?=$resnumber[1]?>" class="input3" size="7">
</td>
</tr>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td align="center" valign="middle">
<input type="checkbox" name="equ" onclick="equalRecipient(this.purchase);">
배송장소 정보가 위와 동일합니다.
	</td>
</tr>
</table>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#CCCCCC">
	<td>
		-- 수령자 정보 --
	</td>
</tr>
</table>
<br>

<table>
<tr>
<td width="14" class="line"></td>
<td width="100" class="line">받으실분 이름</td>
<td class="line">
	<input type="text" name="recipient_name" class="input3" size="10">
</td>
</tr>

<tr>
<td width="14" class="line"></td>
<td width="100" class="line">주소</td>
<td class="line">
	<input type="text" name="recipient_zipcode01" class="input3" size="6">
	-
	<input type="text" name="recipient_zipcode02"  class="input3" size="6">

	<a href="javascript:ZipWindow('../member/zip_search.php', 3)">
	[우편번호 검색]</a>
	<br>
<input type="text" name="recipient_address01" class="input3" size="30">
<br>
<input type="text" name="recipient_address02" class="input3" size="50">

</td>
</tr>

<tr>
<td width="14" class="line"></td>
<td width="100" class="line">전화번호</td>
<td class="line">
	<input type="text" name="recipient_phone01" class="input3" size="6">
	-
	<input type="text" name="recipient_phone02" class="input3" size="6">
	-
	<input type="text" name="recipient_phone03" class="input3" size="6">
</td>
</tr>

<tr>
<td width="14" class="line"></td>
<td width="100" class="line">휴대전화</td>
<td class="line">
	<input type="text" name="recipient_hphone01" class="input3" size="6">
	-
	<input type="text" name="recipient_hphone02" class="input3" size="6">
	-
	<input type="text" name="recipient_hphone03" class="input3" size="6">
</td>
</tr>
</table>
<br>

<table width="95%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td class="line"> 결재방법 </td>
	<td class="line"> 
		<input type="radio" name="pay_type" value="1" checked>온라인 입금
	</td>
	<td class="line">
		입금은행 :
		<select name="bank_name" class="input4">
			<option>국민은행 111-22-333333</option>
			<option>우리은행 444-55-666666</option>
		</select>

		입금일자 : 
		<select name="deposit_year">
<?
	for($i=1; $i<=10; $i++) {
		
		$temp_year = 2015 + $i;
		if($temp_year==date(Y)) {
			$select = "selected";
		}
		else {
			$select = "";
		} ?>
		<option value="<?echo($temp_year)?>" <? echo($select) ?>> 
			<? echo($temp_year) ?> 년 </option>
<?	} //for
?>
		</select>

		<select name="deposit_month">
<?
	for($i=1; $i<=12; $i++) {
		
		$temp_month = $i;
		if($temp_month==date(n)) {
			$select = "selected";
		}
		else {
			$select = "";
		} ?>
		<option value="<?echo($temp_month)?>" <? echo($select) ?>> 
			<? echo($temp_month) ?> 월 </option>
<?	} //for
?>
		</select>


	<select name="deposit_day">
<?
	for($i=1; $i<=31; $i++) {
		
		$temp_day = $i;
		if($temp_day==date(j)) {
			$select = "selected";
		}
		else {
			$select = "";
		} ?>
		<option value="<?echo($temp_day)?>" <? echo($select) ?>> 
			<? echo($temp_day) ?> 일 </option>
<?	} //for
?>
		</select>

	<tr bgcolor="#EEF8E9">
		<td class="line">총 주문금액 : </td>
		<td valign="bottom" colspan="2" class="line">
			&nbsp; <?= number_format($last_cost) ?> 원
		</td>
	</tr>

<?
	if($_SESSION[p_id]) {
		$query9 = "select sum(mileage) as msum
				   from mileage
				   where id_fk = '$_SESSION[p_id]'";
		$result9 = mysql_query($query9, $connect);
		$rows9 = mysql_fetch_array($result9);
		$total_sum = (int)$rows9[msum];
	} //if
	else {
		$total_sum = "0";
	}
?>

<tr bgcolor="#EEF8E9">
<td class="line">적립금 : </td>
<td colspan="2" class="line">
	<input type="text" name="mileage_use" class="input3" value="0" onkeyup="mny_function()" size="10"> 
<font color="#CC3300">(사용가능금액 : <?= number_format($total_sum)?> 원)</font>
</td>
</tr>

<tr bgcolor="#EEF8E9">
<td class="line">실제 결제금액 :  </td>
<td colspan="2" class="line">
	<input type="text" name="real_mny" class="input3" value="<?=$last_cost?>" size="10" onfocus="mny_function()" readonly> 원
</td>
</tr>
	<input type="hidden" name="mileage_tot" value="<?=$total_sum?>">
	<input type="hidden" name="mileage_add" value="<?=$sub_point?>">
</table>
<br>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="45" align="center">
		<a href="javascript:sendOrder(this.purchase);">
		<img src="../img/bt_ok1.gif" border="0">
		</a>
	</td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</body>
</html>



















