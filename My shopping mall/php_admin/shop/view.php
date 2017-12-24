<?
	include "../../php/auth.php";	
	include "../../php/config.php";	
	include "../../php/util.php";	
	$connect = my_connect($host, $dbid, $dbpass, $dbname);

	$query = "select * from products where num = $p_num";
	$result = mysql_query($query, $connect);
	$rows = mysql_fetch_array($result);


?>
<html>
<head>
<title>상품정보 상세 보기</title>
<meta http-equiv="content-type" content="text/html;charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="javascript" src="../../common/global.js"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<center>
<table width="700" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td>
	<table width="100%" border="0" cellspacing="1" cellpadding="2">
	<tr>
	<td width="20%" bgcolor="#D9D9D9" align="center">상품카테고리</td>
	<td width="80%" bgcolor="#F5F5F5">
<?
	$query1 = "select * from products_category1 
			   where code = '$category_code_fk'";
	$result1 = mysql_query($query1, $connect);
	$rows1 = mysql_fetch_array($result1);
	mysql_free_result($result1);

	echo "$rows1[name]";

	if($rows[l_category_fk]) {


	$query2 = "select * from products_category2
	           where code = '$rows[l_category_fk]'";
	$result2 = mysql_query($query2, $connect);
	$rows2 = mysql_fetch_array($result2);
	mysql_free_result($result2);

	echo " >> ";
	echo "$rows2[name]";
	}
?>
</td>	
</tr>
<tr>
	<td width="20%" bgcolor="#D9D9D9" align="center">상품명</td>
	<td width="80%" bgcolor="#F5F5F5"><?=$rows[name]?></td>
</tr>
<tr>
<td width="20%" bgcolor="#D9D9D9" align="center">제조회사(생산지)</td>
<td width="80%" bgcolor="#F5F5F5"><?=$rows[company]?></td>
</tr>

<tr>
<td width="20%" bgcolor="#D9D9D9" align="center">소비자 가격</td>
<td width="80%" bgcolor="#F5F5F5"><?=number_format($rows[cust_price])?> 원</td>
</tr>
<tr>
<td width="20%" bgcolor="#D9D9D9" align="center">판매 가격</td>
<td width="80%" bgcolor="#F5F5F5"><?=number_format($rows[price])?> 원</td>
</tr>

<tr>
<td width="20%" bgcolor="#D9D9D9" align="center">포인트</td>
<td width="80%" bgcolor="#F5F5F5"><?=number_format($rows[mileage])?> POINT</td>
</tr>	
	
<tr>
<td width="20%" bgcolor="#D9D9D9" align="center">선택사항</td>
<td width="80%" bgcolor="#F5F5F5"><?=$rows[size]?></td>
</tr>	

<tr>
<td width="20%" bgcolor="#D9D9D9" align="center">이미지(소)</td>
<td width="80%" bgcolor="#F5F5F5">
<?
	if($rows[s_image]=='Y') { ?>
<img src="../../upload/p_image/s/<?=$rows[prod_code]?>.<?=$rows[s_image_ty]?>">	
<?	} ?>
</td>
</tr>	

<tr>
<td width="20%" bgcolor="#D9D9D9" align="center">이미지(중)</td>
<td width="80%" bgcolor="#F5F5F5">
<?
	if($rows[m_image]=='Y') { ?>
<img src="../../upload/p_image/m/<?=$rows[prod_code]?>.<?=$rows[m_image_ty]?>">	
<?	} ?>
</td>
</tr>	
	
<tr>
<td width="20%" bgcolor="#D9D9D9" align="center">이미지(중)</td>
<td width="80%" bgcolor="#F5F5F5">
<?
	if($rows[b_image]=='Y') { ?>
<img src="../../upload/p_image/b/<?=$rows[prod_code]?>.<?=$rows[b_image_ty]?>">	
<?	} ?>
</td>
</tr>		
	
<tr>
<td width="20%" bgcolor="#D9D9D9" align="center">상품설명</td>
<td width="80%" bgcolor="#F5F5F5">
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

<tr>
<td width="20%" bgcolor="#D9D9D9" align="center">이벤트상품 여부</td>
<td width="80%" bgcolor="#F5F5F5"><?=$rows[option1_chk]?></td>
</tr>	
	
<tr>
<td width="20%" bgcolor="#D9D9D9" align="center">신상품 여부</td>
<td width="80%" bgcolor="#F5F5F5"><?=$rows[option2_chk]?></td>
</tr>		

<tr>
<td width="20%" bgcolor="#D9D9D9" align="center">판매정지 여부</td>
<td width="80%" bgcolor="#F5F5F5"><?=$rows[del_chk]?></td>
</tr>		

<tr>
<td width="20%" bgcolor="#D9D9D9" align="center">등록일자</td>
<td width="80%" bgcolor="#F5F5F5"><?=$rows[created]?></td>
</tr>		
</table>
</td>
</tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td align="center">
<a href="list.php?level=<?=$level?>&category_code_fk=<?=$category_code_fk ?>&page=<?=$page?>&l_category_fk=<?=$l_category_fk?>">		
		목록보기</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     
<a href="write.php?mode=update&p_num=<?=$p_num?>& level=<?=$level?>&category_code_fk=<?=$category_code_fk ?>&page=<?=$page?>&l_category_fk=<?=$l_category_fk?>">		
		수정하기</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="delete.php?p_num=<?=$p_num?>& level=<?=$level?>&category_code_fk=<?=$category_code_fk ?>&page=<?=$page?>&l_category_fk=<?=$l_category_fk?>" 
onclick="return confirm('정말 삭제하시겠습니까?')">		
		삭제하기</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</td>
</tr>


</table>





