<?
	include "../../php/auth.php";	
	include "../../php/config.php";	
	include "../../php/util.php";	
	$connect = my_connect($host, $dbid, $dbpass, $dbname);

	$query = "select * from products_category2
			  where category_code_fk = '$sub_code'";
	$result = mysql_query($query, $connect);
	$total_count = mysql_num_rows($result);
?>
<html>
<head>
<title>중분류 목록 보기</title>
<meta http-equiv="content-type" content="text/html;charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="javascript" src="../../common/global.js"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<center>
<form method="post" action="sub_list.php">
<table width="700" border="0" cellspacing="0" cellpadding="3">
	<tr class="hanmii">
		<td align="right"> <? echo($total_count)?> 건</td>
	</tr>
</table>

<table width="700" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td bgcolor="#666666">
	<table width="100%" border="0" cellspacing="1" cellpadding="2">
	<tr align="center" bgcolor="#d9d9d9" class="hanamii">
		<td width="10%">번호</td>
		<td width="15%">코드</td>
		<td width="30%">카테고리 이름</td>
		<td width="20%">등록된 상품수</td>
		<td width="25%">관리</td>
	</tr>
<?
	for($i=0; $rows=mysql_fetch_array($result); $i++) {
		$query1 = "select * from products 
				   where l_category_fk='$rows[code]'";
		$result1 = mysql_query($query1, $connect);
		$products_count = mysql_num_rows($result1);

		mysql_free_result($result1);

		if($i%2==0) {
			$bgcolor = "#FFFFFF";
		}
		else {
			$bgcolor = "#F5F5F5";
		} ?>
<tr bgcolor="<?=$bgcolor?>" align="center" class="hanamii">
	<td><?=($i+1)?></td>	
	<td><?=$rows[code]?></td>	
	<td><?=$rows[name]?></td>	
	<td><?=$products_count?> 개</td>	
	<td>
	<a href='sub_write.php?mode=update&id=<?=$rows[id]?>&h_code=<?=$rows[category_code_fk]?>'>
	수정</a>
	<a href='sub_delete.php?id=<?=$rows[id]?>&h_code=<?=$rows[category_code_fk]?>' onclick="return confirm('정말로 삭제하시겠습니까?')">삭제</a>
	</td>	
</tr>
<?	} //for
	mysql_free_result($result);

	if($total_count==0) { ?>
		<tr bgcolor="#FFFFFF" align="center" class="hanamii">	
			<td colspan="6">등록된 분류가 없습니다.</td>
		</tr>
<?	} //if  ?>
	</table>
	</td>
</tr>
</table>

<table width="700" border="0" cellspacing="0" cellpadding="3">
<tr>
	<td align="center">
<input type="button" value="등록하기" onclick="location='sub_write.php?h_code=<?=$sub_code?>'">
<input type="button" value="상위항목" onclick="location='list.php'">
	</td>
</tr>
</table>
</form>
</center>
</body>
</html>


