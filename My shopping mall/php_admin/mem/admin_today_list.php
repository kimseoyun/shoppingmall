<?
	include "../../php/auth.php";	
	include "../../php/config.php";	
	include "../../php/util.php";	
	$connect = my_connect($host, $dbid, $dbpass, $dbname);
?>
<html>
<head>
<title>오늘 가입한 회원목록</title>
<meta http-equiv="content-type" content="text/html;charset=euc-kr">
<link rel="stylesheet" href="../../common/global.css">
<script language="javascript" src="../../common/global.js"></script>
<script language="javascript">
	function open_win(theURL, winName, features) {
		window.open(theURL, winName, features);
	}
</script>
</head>
<body>

<table width="100%" border="0"cellspacing="0" cellpadding="2">
<tr>
	<td height="40" class="title">회원 관리</td>
</tr>

</table>

<?
	if($mode=='search') {
		if($id) {
			$sear_char .= " and id='$id'";
		}
		if($mobile) {
			$sear_char .= " and mobile like '%$mobile%'";
		}
		if($name) {
			$sear_char .= " and name like '%$name%'";
		}
		if($jnumber) {
			$sear_char .= " and jnumber like '%$jnumber%'";
		}
		if($email) {
			$sear_char .= " and email like '%$email%'";
		}
		if($phone) {
			$sear_char .= " and phone like '%$phone%'";
		}
	}

	$time = date('Y-m-d');
	$query = "select * from member 
			  where date_format(reg_date, '%Y-%m-%d')='$time' $sear_char";
	$result = mysql_query($query, $connect);
	$total = mysql_num_rows($result);
?>

<form name="mb" method="post" action="admin_member_list.php">
<input type="hidden" name="mode" value="search">
<div align="center">

<table width="95%" border="0" cellspacing="0" cellpadding="0">

<tr class="text">
	<td width="150" height="20" align="center" bgcolor="#F1F1F1">
		<b>아이디</b>
	</td>
	<td width="250" height="20">
<input type="text" name="id" value="<?=$id?>" size=20 class="input">
	</td>

	<td width="150" height="20" align="center" bgcolor="#F1F1F1">
		<b>휴대폰</b>
	</td>
	<td width="250" height="20">
<input type="text" name="mobile" value="<?=$mobile?>" size=20 class="input">
	</td>
</tr>

<tr class="text">
	<td width="150" height="20" align="center" bgcolor="#F1F1F1">
		<b>이름</b>
	</td>
	<td width="250" height="20">
<input type="text" name="name" value="<?=$name?>" size=20 class="input">
	</td>

	<td width="150" height="20" align="center" bgcolor="#F1F1F1">
		<b>주민등록번호</b>
	</td>
	<td width="250" height="20">
<input type="text" name="jnumber" value="<?=$jnumber?>" size=20 class="input">
	</td>
</tr>

<tr class="text">
	<td width="150" height="20" align="center" bgcolor="#F1F1F1">
		<b>이메일</b>
	</td>
	<td width="250" height="20">
<input type="text" name="email" value="<?=$email?>" size=20 class="input">
	</td>

	<td width="150" height="20" align="center" bgcolor="#F1F1F1">
		<b>연락처</b>
	</td>
	<td width="250" height="20">
<input type="text" name="phone" value="<?=$phone?>" size=20 class="input">
	</td>
</tr>

<tr>
	<td colspan="4">
<center><input type="submit" value="검색" class="input"> </center>
	</td>
</tr>
</table>
</div>
</form>

<table width="100%" border="0"cellspacing="0" cellpadding="0">
<tr class="text">
	<td align="right">
		회원 <?=number_format($total)?>명
	</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#999999">
<tr align="center" class="text">
	<td height="25" bgcolor="#f5f5f5"><strong>번호</strong></td>
	<td height="25" bgcolor="#f5f5f5"><strong>아이디</strong></td>
	<td height="25" bgcolor="#f5f5f5"><strong>이름</strong></td>
	<td height="25" bgcolor="#f5f5f5"><strong>주민번호</strong></td>
	<td height="25" bgcolor="#f5f5f5"><strong>가입날짜</strong></td>
	<td height="25" bgcolor="#f5f5f5"><strong>연락처</strong></td>
	<td height="25" bgcolor="#f5f5f5"><strong>휴대폰</strong></td>
	<td height="25" bgcolor="#f5f5f5"><strong>삭제</strong></td>
</tr>

<?
	if(!$page) {
		$page = 1;
	}

	$p_scale = 30; //화면에 표시되는 갯수
	$cpage = intval($page);
	$totalpage=intval($total/$p_scale);

	if($totalpage*$p_scale!=$total) {
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

	if($limit>=$total) {
		$limit = $total;
	}

	$p_scale1 = $limit - $cline;

$query3 = "select * from member 
		  where date_format(reg_date, '%Y-%m-%d')='$time' $sear_char
		  order by seq_num desc limit $cline, $p_scale1";
	$result3 = mysql_query($query3, $connect);

	for($i=1; $rows3 = mysql_fetch_array($result3); $i++) {
		$bunho = $total - ($i + $cline) + 1;
?>
	<tr bgcolor="#ffffff" class="text">
		<td align="center"><?=$bunho?></td>
		<td align="center">
		<a href="javascript:open_win('member_view.php?num=<?=$rows3[seq_num]?>','nwin','scrollbars=no, width=600, height=400')">
			<?=$rows3[id]?></a>		
		</td>
		<td align="center"><?=$rows3[name]?></td>
		<td align="center"><?=$rows3[jnumber]?></td>
		<td align="center"><?=$rows3[reg_date]?></td>
		<td align="center"><?=$rows3[phone]?></td>
		<td align="center"><?=$rows3[mobile]?></td>
		<td align="center">
<a href="member_del.php?m_num=<?=$rows3[seq_num]?>&page=<?=$page?>" onclick="return confirm('삭제를 하게되면 이 회원의 모든 정보가 삭제됩니다. \n 정말 삭제하시겠습니까?')">
삭제</a>
		</td>
	</tr>
<?	} 
	mysql_free_result($result3);
?>	
</table>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="40" align="center" class="text">
<?
		$url="admin_member_list.php?id=$id&mode=$mode&jnumber=$jnumber&email=$email&phone=$phone&name=$name&mobile=$mobile";
		page_avg($totalpage, $cpage, $url);
?>
	</td>
</tr>
</table>
</body>
</html>