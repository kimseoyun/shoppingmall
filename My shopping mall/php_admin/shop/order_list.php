<?
	include "../../php/auth.php";	
	include "../../php/config.php";	
	include "../../php/util.php";	
	$connect = my_connect($host, $dbid, $dbpass, $dbname);

	if(!$level) {
		$level = 1;
	}
?>
<html>
<head>
<title>전체 주문목록 보기</title>
<meta http-equiv="content-type" content="text/html;charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="javascript" src="../../common/global.js"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<table width="780" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td valign="top">
	<form action="order_list.php" method="post">

<?
	if($mode=='search') {
		$query = "select orderid from mall_order
		          where cancel='N' and
				  $key like '%$key_value%'";
	} //if
	else {
		$query = "select orderid from mall_order
		          where cancel='N'";
	}

	$result = mysql_query($query, $connect);
	$total_bnum = mysql_num_rows($result);


	if(!$page) {
		$page = 1;
	}

	$p_scale = 15; //화면에 표시되는 갯수
	$cpage = intval($page);
	$totalpage=intval($total_bnum/$p_scale);

	if($totalpage*$p_scale!=$total_bnum) {
		$totalpage = $totalpage+1;
	}

	//결국 $cline와 $p_scale1 값을 구하는 공식들

	if($cpage==1) {
		$cline=0;
	}
	else {
		$cline = ($cpage*$p_scale) - $p_scale;
	}

	$limit = $cline + $p_scale;

	if($limit>=$total_bnum) {
		$limit = $total_bnum;
	}

	$p_scale1 = $limit - $cline;
?>

<table width="99%" border="0" cellspacing="2" cellpadding="1">
<tr>
	<td height="25" align="center">
		<font color="blue" size="3"><b>상품 주문현황</b></td>
	</td>
</tr>
</table>

<table width="99%" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#3A9EDF">
	<td>
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	<tr bgcolor="#CBE2F5">
		<td align="center" height="20"> <b>주문번호</b></td>
		<td align="center" height="20"> <b>ID</b></td>
		<td align="center" height="20"> <b>주문일</b></td>
		<td align="center" height="20"> <b>구매자</b></td>
		<td align="center" height="20"> <b>수령자</b></td>
		<td align="center" height="20"> <b>주문방식</b></td>
		<td align="center" height="20"> <b>주문액</b></td>
		<td align="center" height="20"> <b>처리상태</b></td>
		<td align="center" height="20"> <b>삭제</b></td>
	</tr>
<?
	if($mode=='search') {
		$query1 = "select * from mall_order 
		           where cancel='N' and 
				   $key like '%$key_value%'
				   order by num desc";
	}
	else {
		$query1 = "select * from mall_order 
		           where cancel='N'
				   order by num desc limit $cline, $p_scale1 ";
	}

	$a_pay_type['1'] = "무통장입금";
	$a_pay_type['2'] = "신용카드";
	$a_pay_type['3'] = "휴대폰결재";

	$result1 = mysql_query($query1, $connect);

	for($i=0; $rows1 = mysql_fetch_array($result1); $i++) {
		
		if($rows1[status]=="3") {  //입금확인전
			$c_color = "#FFFFFF";
			$status_now = "입금확인전";
		}

		if($rows1[status]=="5") {  //입금확인
			$c_color = "#E0FFE0";
			$status_now = "입금확인";
		}

		if($rows1[status]=="7") {  //배송중
			$c_color = "#EFFCFC";
			$status_now = "배송중";
		}
		if($rows1[status]=="8") {  //배송완료
			$c_color = "#FFFCCC";
			$status_now = "배송완료";
		}
?>
<tr bgcolor="<?=$c_color?>">
<td align="center">
<a href="order_read.php?oid=<?=$rows1[num]?>&page=<?=$page?>">
	<?=$rows1[orderid]?>
</a>
</td>

<td align="center"><?=$rows1[user_id]?></td>
<td align="center"><?=$rows1[createdate]?></td>
<td align="center"><?=$rows1[buyer_name]?></td>
<td align="center"><?=$rows1[recipient_name]?></td>
<td align="center"><?=$a_pay_type[$rows1[payment_type]]?></td>
<td align="center"><?=number_format($rows1[amount])?> 원</td>
<td align="center"><?=$status_now?></td>
<td align="center">
<a href="order_delete.php?oid=<?=$rows1[num]?>&page=<?=$page?>" onclick="return confirm('주문을 취소하겠습니까?')">
삭제
</a>
</td>
</tr>
<?	} //for
?>

<tr bgcolor="#F2F9FF">
<td colspan="10">

	<table width="100%" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td align="center">
				<?	
$url = "$PHP_SELF?mode=$mode&key=$key&key_value=$key_value";
page_avg($totalpage, $cpage, $url);
				?>
			</td>
		</tr>
	</table>
</td>
</tr>

<tr bgcolor="#CBE2F5">
	<td colspan="10" align="left">
		<select name="key">	
			<option value="user_id">아이디</option>
			<option value="buyer_name">구매자 이름</option>
			<option value="orderid">상품코드</option>
		</select>
		<input type="hidden" name="mode" value="search">
		<input type="text" name="key_value" size="16">
		<input type="submit" value="검색">
</td>
</tr>
</table>
</td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</body>
</html>