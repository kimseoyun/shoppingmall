<?
	include "../../php/auth.php";	
	include "../../php/config.php";	
	include "../../php/util.php";	
	$connect = my_connect($host, $dbid, $dbpass, $dbname);

	if($mode=='update') {
		$query = "select * from products
		          where num='$p_num'";
		$result = mysql_query($query, $connect);
		$rows = mysql_fetch_array($result);

	}
	else {
		$mode = "insert";
	}
?>
<html>
<head>
<title>상품 등록 및 수정 폼</title>
<meta http-equiv="content-type" content="text/html;charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="javascript" src="../../common/global.js"></script>
<script language="javascript" src="../../common/member.js"></script>
<script>
	function WorkChange() {
		document.form1.action = "write.php";
		document.form1.submit();
	}

	function send_post() {
		var form = document.form1;

		if(!form.name.value) {
			alert("상품명을 입력하세요.");
			form.name.focus();
			return;
		}
		if(!form.price.value) {
			alert("상품가격을 입력하세요.");
			form.price.focus();
			return;
		}
		if(form.price.value) {
			if(!IsNumber(form.price.name)) {
				alert("상품가격은 숫자로 입력하세요.");
				form.price.focus();
				return;
			}
		}
		if(form.mileage.value) {
			if(!IsNumber(form.mileage.name)) {
				alert("포인트는 숫자로 입력하세요.");
				form.mileage.focus();
				return;
			}
		}

		form.submit();
	}
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<center>
<form name="form1" method="post" enctype="multipart/form-data" action="insert.php">
<table width="700" border="1" cellspacing="0" cellpadding="3" align="center">
	<tr class="hanmii">
		<td width="30%" bgcolor="#D9D9D9" align="center">
			상품등록 관리
		</td>
		<td width="70%" bgcolor="#FFFFFF">
<input type="radio" name="del_chk" value="N"
<?if(($mode=='insert')||($rows[del_chk]=='N')) echo("checked")?>>
등록
<input type="radio" name="del_chk" value="Y"
<?if(($rows[del_chk]=='Y')) echo("checked")?>>판매중지
		</td>
	</tr>

	<tr class="hanmii">
		<td width="30%" bgcolor="#D9D9D9" align="center">
			대분류명
		</td>
		<td width="70%" bgcolor="#FFFFFF">
<select name="category_code_fk" onchange="WorkChange()">
<?
		$query1 = "select * from products_category1";
		$result1 = mysql_query($query1, $connect);
		
		for($i=0; $rows1=mysql_fetch_array($result1); $i++)	{
			if($rows1[code]==$category_code_fk) {
?>			
<option value="<? echo($rows1[code])?>" selected><?=$rows1[name]?></option>
<?			} //if
			else { ?>
<option value="<? echo($rows1[code])?>" ><?=$rows1[name]?></option>
<?			} //else
} //for
	mysql_free_result($result1);
?>
			</select>
		</td>
	</tr>


<tr class="hanmii">
		<td width="30%" bgcolor="#D9D9D9" align="center">
			중분류명
		</td>
		<td width="70%" bgcolor="#FFFFFF">
		<select name="l_category_fk">
			<option>선택하세요</option>

<?
	$query2 = "select * from products_category2 
	           where category_code_fk='$category_code_fk'";
	$result2 = mysql_query($query2, $connect);
	for($i=0; $rows2=mysql_fetch_array($result2); $i++) {
		if($rows2[code]==$l_category_fk) { ?>
<option value="<? echo($rows2[code])?>" selected><?=$rows2[name]?></option>
<?		} //if
		else { ?>
<option value="<? echo($rows2[code])?>"><?=$rows2[name]?></option>
<?		} //else
	} //for
	mysql_free_result($result2);
?>
</select>
		</td>
	</tr>
<tr class="hanmii">
		<td width="30%" bgcolor="#D9D9D9" align="center">
			상품명
		</td>
		<td width="70%" bgcolor="#FFFFFF">
			<input type="text" name="name" value="<? echo($rows[name])?>">
		</td>
</tr>

<tr class="hanmii">
	<td width="30%" bgcolor="#D9D9D9" align="center">
			제조사(생산지)
	</td>
	<td width="70%" bgcolor="#FFFFFF">
	<input type="text" name="company" value="<? echo($rows[company])?>">
	</td>
</tr>

<tr class="hanmii">
	<td width="30%" bgcolor="#D9D9D9" align="center">
			소비자가격
	</td>
	<td width="70%" bgcolor="#FFFFFF">
	<input type="text" name="cust_price" value="<? echo($rows[cust_price])?>">원(숫자로 기입)
	</td>
</tr>

<tr class="hanmii">
	<td width="30%" bgcolor="#D9D9D9" align="center">
			상품가격
	</td>
	<td width="70%" bgcolor="#FFFFFF">
	<input type="text" name="price" value="<? echo($rows[price])?>">원(숫자로 기입)
	</td>
</tr>

<tr class="hanmii">
	<td width="30%" bgcolor="#D9D9D9" align="center">
			포인트
	</td>
	<td width="70%" bgcolor="#FFFFFF">
	<input type="text" name="mileage" value="<? echo($rows[mileage])?>">POINT(숫자로 기입)
	</td>
</tr>

<tr class="hanmii">
	<td width="30%" bgcolor="#D9D9D9" align="center">
			선택사항
	</td>
	<td width="70%" bgcolor="#FFFFFF">
	<input type="text" name="size" value="<? echo($rows[size])?>">
	구분은 "|" 하세요 (예:255mm|260mm|265mm)
	</td>
</tr>

<tr class="hanmii">
	<td width="30%" bgcolor="#D9D9D9" align="center">
			상품이미지(소:리스트)
	</td>
	<td width="70%" bgcolor="#FFFFFF">
		<input type="file" name="s_image" size="30">
	</td>
</tr>

<tr class="hanmii">
	<td width="30%" bgcolor="#D9D9D9" align="center">
			상품이미지(중:상세보기)
	</td>
	<td width="70%" bgcolor="#FFFFFF">
		<input type="file" name="m_image" size="30">
	</td>
</tr>

<tr class="hanmii">
	<td width="30%" bgcolor="#D9D9D9" align="center">
			상품이미지(대:확대)
	</td>
	<td width="70%" bgcolor="#FFFFFF">
		<input type="file" name="b_image" size="30">
	</td>
</tr>

<tr class="hanmii">
	<td width="30%" bgcolor="#D9D9D9" align="center">
			상품 상세설명<br>
<input type="radio" name="con_html" value="1" 
<? if($rows[con_html]=='1') echo("checked")?>>HTML
<input type="radio" name="con_html" value="2" 
<? if(($mode=='insert')||($rows[con_html]=='2')) echo("checked")?>>TEXT
	</td>
	<td width="70%" bgcolor="#FFFFFF">
		<textarea name="contents" cols="50" rows="7">
		<?=stripslashes($rows[contents]) ?>
		</textarea>
	</td>
</tr>

<tr class="hanmii">
	<td width="30%" bgcolor="#D9D9D9" align="center">
			등록분류
	</td>
	<td width="70%" bgcolor="#FFFFFF">
<input type="checkbox" name="option1_chk" value="Y"
<? if($rows[option1_chk]=='Y') echo("checked"); ?>>이벤트 상품
<input type="checkbox" name="option2_chk" value="Y"
<? if($rows[option2_chk]=='Y') echo("checked"); ?>>신상품
	</td>
</tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="3" align="center">
<tr>
	<td align="center">
<input type="hidden" name="mode" value="<? echo($mode)?>">
<input type="hidden" name="p_num" value="<? echo($p_num)?>">
<input type="hidden" name="level" value="<? echo($level)?>">
<input type="hidden" name="page" value="<? echo($page)?>">
<input type="hidden" name="old_l_cate" value="<?= $rows[l_category_fk]?>">
<input type="button" value="상품등록" onclick="javascript:send_post()">
<input type="reset" value="다시쓰기">
<input type="button" value="취소하기" onclick="location='list.php?level=<?=$level?>&category_code_fk=<?=$category_code_fk?>&page=<?=$page?>&l_category_fk=<?=$l_category_fk?>'">
	</td>
</tr>
</table>
</form>
</body>
</html>