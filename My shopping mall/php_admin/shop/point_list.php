<?
	include "../../php/auth.php";	
	include "../../php/config.php";	
	include "../../php/util.php";	
	$connect = my_connect($host, $dbid, $dbpass, $dbname);

	if($mode=="search") {
		if($id_fk) {
			$sear_char = "where id_fk like '%$id_fk%'";
		}
	}

	$query = "select * from mileage $sear_char";
	$result = mysql_query($query, $connect);
	$total_bnum = mysql_num_rows($result);
?>
<html>
<head>
<title>마일리지 내역 보기</title>
<meta http-equiv="content-type" content="text/html;charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="javascript" src="../../common/global.js"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000">


<table width="750" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>
	<table width="90%" border="0" cellspacing="0" cellpadding="3">
	<tr class="text">
		<td>총 <?=number_format($total_bnum) ?> 건</td>
	</tr>
	</table>
</td>
</tr>

<tr>
	<td bgcolor="#666666">
	<table width="100%" border="0" cellspacing="1" cellpadding="2">
	<tr bgcolor="#D9D9D9" align="center">
		<td width="5%">번호</td>
		<td width="15%">아이디</td>
		<td width="15%">포인트</td>
		<td width="45%">포인트내역</td>
		<td width="25%">생성일</td>
	</tr>	

<?
	if(!$page) {
		$page = 1;
	}

	$p_scale = 10; //화면에 표시되는 갯수
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


	$query2 = "select * from mileage $sear_char
			   order by num desc limit 	$cline, $p_scale1";
	$result2 = mysql_query($query2, $connect);

	for($i=1; $rows2=mysql_fetch_array($result2); $i++) {

		$bunho = $total_bnum - ($i - $cline) + 1;
?>
	<tr align="center" bgcolor="#FFFFFF">
		<td>&nbsp;&nbsp; <?=$bunho?> </td>
		<td>&nbsp;&nbsp; <?=$rows2[id_fk]?> </td>
		<td>&nbsp;&nbsp; <?=$rows2[mileage]?> </td>
		<td>&nbsp;&nbsp; <?=$rows2[mile_desc]?> </td>
		<td>&nbsp;&nbsp; <?=$rows2[wdate]?> </td>
	</tr>

<?	} //for
	
	mysql_free_result($result2);

	if($total_bnum==0) { ?>
	
	<tr bgcolor="#FFFFFF" align="center">
		<td colspan="5">등록된 포인트가 없습니다.</td>
	</tr>
<?	} ?>

<form action="point_list.php" method="post">
<tr bgcolor="#FFFFFF">
	<td colspan="10">
		<input type="hidden" name="mode" value="search">
		아이디 <input type="text" name="id_fk" size="16" class="input">
		<input type="submit" value="검색" class="submit">
	</td>
</tr>
</form>
</table>
</td>
</tr>
</table>
</body>
</html>















	</table>
	</td>

</tr>








</table>

<?
/*


<tr>
	<td>
	<table border="0" cellspacing="1" cellpadding="2">
	<tr>
		<td>현재위치 : <a href="list.php?level=1">처음</a> &gt;	</td>
<?
	$query = "select * from products_category1";
	$result = mysql_query($query, $connect);

	for($i=1; $rows=mysql_fetch_array($result); $i++) {
		$category_code = $rows[code];
		$category_name = $rows[name];
?>
	<td align="center">
	<a href="list.php?level=2&category_code_fk=<?=$category_code?>">
		<?= $category_name?>		
	</a> &gt;
	</td>
<? } //for 
	mysql_free_result($result);
?>
	</tr>
	</table>
	</td>
	</tr>
<table width="100%" border="0" cellspacing="1" cellpadding="2">
<tr>
	<td><b>카테고리를 선택하세요</b><br>
<?
	if(($level==2) || ($level==3)) {
		$query1 = "select * from products_category2
				   where category_code_fk = '$category_code_fk'	
				   order by code";
		$result1 = mysql_query($query1, $connect);

		for($i=0; $rows1=mysql_fetch_array($result1);$i++) {
			if($i==0) {
				if(!$category_code) {
					$category_code = $rows1[code];
				}
			}
			else {
				echo " | ";
			}
		
		echo(" 
		<a href=list.php?level=3&l_category_fk=$rows1[code]&category_code_fk=$category_code_fk>$rows1[name]</a>");
		} //for
	} //if
?>
	</td>
</tr>
</table>
</td>
</tr>

<tr>
<td bgcolor="#666666"></td>

<table width="100%" border="0" cellspacing="1" cellpadding="2">
<tr align="center" bgcolor="#D9D9D9">
	<td width="5%">번호</td>
	<td width="15%">제조사(생산지)</td>
	<td width="25%">제품명</td>
	<td width="15%">소비자 가격</td>
	<td width="15%">판매가격</td>
	<td width="13%">이벤트</td>
	<td width="12%">신상품</td>
</tr>

<?
	if($mode=="search") {
		$sear_char = " and $key like '%$key_value%'";		
	}
	if($category_code_fk) {
		$qry_char = " and category_fk = '$category_code_fk'";
	}
	if($l_category_fk) {
		$qry_char = " and l_category_fk = '$l_category_fk'";
	}

	$query2 = "select * from products 
	           where 1 $qry_char $sear_char ";
	$result2 = mysql_query($query2, $connect);
	$total_bnum = mysql_num_rows($result2);


	$query3 = "select * from products 
	           where 1 $qry_char $sear_char
			   order by num desc limit $cline, $p_scale1";
	$result3 = mysql_query($query3, $connect);

	for($i=0; $rows3=mysql_fetch_array($result3);$i++ ) {
		$list_num = $total_bnum - ($cline + $i);
		
		if($i%2==0) {
			$bgcolor="#FFFFFF";
		}
		else {
			$bgcolor="#F5F5F5";
		}
?>
<tr bgcolor=<?=$bgcolor?> align="center">
<td>
	<a href="view.php?p_num=<?=$rows3[num]?>&level=<?=$level?>&category_code_fk=<?=$rows3[category_fk]?>&page=<?=$page?>&l_category_fk=<?=$rows3[l_category_fk]?>">	<?=$list_num?> </a>
</td>
<td><?=$rows3[company]?></td>
<td>
<a href="view.php?p_num=<?=$rows3[num]?>&level=<?=$level?>&category_code_fk=<?=$rows3[category_fk]?>&page=<?=$page?>&l_category_fk=<?=$rows3[l_category_fk]?>"> <?=$rows3[name]?> </a>

</td>
<td><?=number_format($rows3[cust_price])?> 원</td>
<td><?=number_format($rows3[price])?> 원</td>
<td>
	<? if($rows3[option1_chk]=='Y') {
			echo("<font color='red'>등록중</font>");		
			echo("<a href='delete1.php?p_num=$rows3[num]&mode=del&category_code_fk=$rows3[category_fk]&page=$page&l_category_fk=$rows3[l_category_fk]&ch=option1_chk&level=$level'>
			<해제></a>");
	   } //if
	   else {
			echo("
	<a href='delete1.php?p_num=$rows3[num]&mode=insert&category_code_fk=$rows3[category_fk]&page=$page&l_category_fk=$rows3[l_category_fk]&ch=option1_chk&level=$level'>		
			등록
		</a>	
			");	
	   }
?>
</td>

<td>
	<? if($rows3[option2_chk]=='Y') {
			echo("<font color='red'>등록중</font>");		
			echo("<a href='delete1.php?p_num=$rows3[num]&mode=del&category_code_fk=$rows3[category_fk]&page=$page&l_category_fk=$rows3[l_category_fk]&ch=option2_chk&level=$level'>
			<해제></a>");
	   } //if
	   else {
			echo("
	<a href='delete1.php?p_num=$rows3[num]&mode=insert&category_code_fk=$rows3[category_fk]&page=$page&l_category_fk=$rows3[l_category_fk]&ch=option2_chk&level=$level'>		
			등록
		</a>	
			");	
	   }
?>
</td>
</tr>
<?	} //for
	mysql_free_result($result3);

	if($total_bnum==0) { ?>
	<tr align="center" bgcolor="#FFFFFF">
		<td colspan="11">등록된 상품이 없습니다.</td>
	</tr>	
<?	} //if
?>

<form action="list.php" name="f" method="post">
<tr bgcolor="#FFFFFF" align="center">
	<td colspan="10">
		<select name="key">
			<option value="company">제조회사</option>
			<option value="price">판매가격</option>
			<option value="name">상품명</option>
		</select>
<input type="hidden" name="mode" value="search">
<input type="hidden" name="l_category_fk" value="<?=$l_category_fk?>">
<input type="hidden" name="category_code_fk" value="<?=$category_code_fk?>">
<input type="hidden" name="level" value="<?=$level?>">
<input type="text" name="key_value" size="16">
<input type="submit" value="검색">
	</td>
</tr>
</form>
</table>
</td>
</tr>
</table>
<br>
<?
if($level>=2) { ?>
<table width="90%" border="0" cellspacing="0" cellpadding="3">
<tr bgcolor="#FFFFFF" align="center">
	<td>
<?
	$url = "$PHP_SELF?l_category_fk=$l_category_fk&category_fk=$category_code_fk&level=$level&mode=$mode&key=$key&key_value=$key_value";
	page_avg($totalpage, $cpage, $url);
?>
</td>
</tr>
<tr>
	<td align="center">
		<input type="button" value="상품등록" onclick="location='write.php?level=<?=$level?>&category_code_fk=<?=$category_code_fk?>&page=<?=$page?>&l_category_fk=<?=$l_category_fk?>'">
		<input type="button" value="다시읽기" onclick="location='list.php?level=<?=$level?>&category_code_fk=<?=$category_code_fk?>&page=<?=$page?>&l_category_fk=<?=$l_category_fk?>'">
	</td>
</tr>
</table>
<?	} //if 
?>
</form>
</body>
</html>


*/
?>