<?
	include "../php/config.php";	//Session 및 DB 연결설정
	include "../php/util.php";		//각종 유틸리티 함수
	
	//mysql 연결
	$connect = my_connect($host, $dbid, $dbpass, $dbname);
?>
<html>
<head>
<title>학교 소개</title>
<meta http-equiv="content-type" content="text/html;charset=euc-kr">
<link rel="stylesheet" href="../common/global.css">
<script language="javascript" src="../common/global.js"></script>
<script language="javascript" src="../common/member.js"></script>
</head>
<body bgcolor="#C4E0E5">
<?
	include "../include/top_menu.php";
?>
<br>
<table width="1000" cellspacing="0" cellpadding="0" style="border-width:1; border-style:solid;" border="0" align="center" bgcolor="White">
<tr>
	<td width="210" height="376" valign="top">
		<?
			include "../include/left_login.php";
			include "../include/main_left.php";
		?>
	</td>
	<td width="728" height="576" valign="top">
	<table width="100%" border="0"cellspacing="0" cellpadding="0">
		<tr>
			<td height="30" style="padding:10 0 0 14px">
				<a href="#">홈</a> &gt;<a href="/school/main.php">학교소개</a>
			</td>
		</tr>
		<tr align="center" width="90%">
	<td >
	<br>
		<a href="http://e-mirim.hs.kr"><img src="/img/campus_img.jpg"></a><br><br>
		미림여자정보과학고등학교
		<hr>
		서울시 관악구 호암로 546 (신림동)
		<hr><br>

		뉴미디어솔루션과 &nbsp; | &nbsp; 뉴미디어디자인과 &nbsp; | &nbsp; 인터랙티브미디어과	</td>
	</tr>
		</table>
		
	


</td>

</tr>

</table>
</body>
</html>