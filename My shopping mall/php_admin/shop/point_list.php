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
<title>���ϸ��� ���� ����</title>
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
		<td>�� <?=number_format($total_bnum) ?> ��</td>
	</tr>
	</table>
</td>
</tr>

<tr>
	<td bgcolor="#666666">
	<table width="100%" border="0" cellspacing="1" cellpadding="2">
	<tr bgcolor="#D9D9D9" align="center">
		<td width="5%">��ȣ</td>
		<td width="15%">���̵�</td>
		<td width="15%">����Ʈ</td>
		<td width="45%">����Ʈ����</td>
		<td width="25%">������</td>
	</tr>	

<?
	if(!$page) {
		$page = 1;
	}

	$p_scale = 10; //ȭ�鿡 ǥ�õǴ� ����
	$cpage = intval($page);
	$totalpage=intval($total_bnum/$p_scale);

	if($totalpage*$p_scale!=$total_bnum) {
		$totalpage = $totalpage+1;
	}

	//�ᱹ $cline�� $p_scale1 ���� ���ϴ� ���ĵ�

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
		<td colspan="5">��ϵ� ����Ʈ�� �����ϴ�.</td>
	</tr>
<?	} ?>

<form action="point_list.php" method="post">
<tr bgcolor="#FFFFFF">
	<td colspan="10">
		<input type="hidden" name="mode" value="search">
		���̵� <input type="text" name="id_fk" size="16" class="input">
		<input type="submit" value="�˻�" class="submit">
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
		<td>������ġ : <a href="list.php?level=1">ó��</a> &gt;	</td>
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
	<td><b>ī�װ����� �����ϼ���</b><br>
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
	<td width="5%">��ȣ</td>
	<td width="15%">������(������)</td>
	<td width="25%">��ǰ��</td>
	<td width="15%">�Һ��� ����</td>
	<td width="15%">�ǸŰ���</td>
	<td width="13%">�̺�Ʈ</td>
	<td width="12%">�Ż�ǰ</td>
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
<td><?=number_format($rows3[cust_price])?> ��</td>
<td><?=number_format($rows3[price])?> ��</td>
<td>
	<? if($rows3[option1_chk]=='Y') {
			echo("<font color='red'>�����</font>");		
			echo("<a href='delete1.php?p_num=$rows3[num]&mode=del&category_code_fk=$rows3[category_fk]&page=$page&l_category_fk=$rows3[l_category_fk]&ch=option1_chk&level=$level'>
			<����></a>");
	   } //if
	   else {
			echo("
	<a href='delete1.php?p_num=$rows3[num]&mode=insert&category_code_fk=$rows3[category_fk]&page=$page&l_category_fk=$rows3[l_category_fk]&ch=option1_chk&level=$level'>		
			���
		</a>	
			");	
	   }
?>
</td>

<td>
	<? if($rows3[option2_chk]=='Y') {
			echo("<font color='red'>�����</font>");		
			echo("<a href='delete1.php?p_num=$rows3[num]&mode=del&category_code_fk=$rows3[category_fk]&page=$page&l_category_fk=$rows3[l_category_fk]&ch=option2_chk&level=$level'>
			<����></a>");
	   } //if
	   else {
			echo("
	<a href='delete1.php?p_num=$rows3[num]&mode=insert&category_code_fk=$rows3[category_fk]&page=$page&l_category_fk=$rows3[l_category_fk]&ch=option2_chk&level=$level'>		
			���
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
		<td colspan="11">��ϵ� ��ǰ�� �����ϴ�.</td>
	</tr>	
<?	} //if
?>

<form action="list.php" name="f" method="post">
<tr bgcolor="#FFFFFF" align="center">
	<td colspan="10">
		<select name="key">
			<option value="company">����ȸ��</option>
			<option value="price">�ǸŰ���</option>
			<option value="name">��ǰ��</option>
		</select>
<input type="hidden" name="mode" value="search">
<input type="hidden" name="l_category_fk" value="<?=$l_category_fk?>">
<input type="hidden" name="category_code_fk" value="<?=$category_code_fk?>">
<input type="hidden" name="level" value="<?=$level?>">
<input type="text" name="key_value" size="16">
<input type="submit" value="�˻�">
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
		<input type="button" value="��ǰ���" onclick="location='write.php?level=<?=$level?>&category_code_fk=<?=$category_code_fk?>&page=<?=$page?>&l_category_fk=<?=$l_category_fk?>'">
		<input type="button" value="�ٽ��б�" onclick="location='list.php?level=<?=$level?>&category_code_fk=<?=$category_code_fk?>&page=<?=$page?>&l_category_fk=<?=$l_category_fk?>'">
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