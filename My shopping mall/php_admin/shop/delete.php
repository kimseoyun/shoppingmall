<?
	include "../../php/auth.php";	
	include "../../php/config.php";	
	include "../../php/util.php";	
	$connect = my_connect($host, $dbid, $dbpass, $dbname);

	$query = "select * from products where num = $p_num";
	$result = mysql_query($query, $connect);
	$rows = mysql_fetch_array($result);
	mysql_free_result($result);

	//작은 이미지가 있으면 삭제
	if($rows[s_image]=='Y') {
		if(file_exists("../../upload/p_image/s/".$rows[prod_code].".".$rows[s_image_ty])) {
			unlink("../../upload/p_image/s/".$rows[prod_code].".".$rows[s_image_ty]);
		} 
	}

	if($rows[m_image]=='Y') {
		if(file_exists("../../upload/p_image/m/".$rows[prod_code].".".$rows[m_image_ty])) {
			unlink("../../upload/p_image/m/".$rows[prod_code].".".$rows[m_image_ty]);
		} 
	}

	if($rows[b_image]=='Y') {
		if(file_exists("../../upload/p_image/b/".$rows[prod_code].".".$rows[b_image_ty])) {
			unlink("../../upload/p_image/b/".$rows[prod_code].".".$rows[b_image_ty]);
		} 
	}

	$query1 = "delete from products where num = $p_num";
	mysql_query($query1, $connect);

echo "<meta http-equiv='Refresh'content='0;url=list.php?level=$level&page=$page&category_code_fk=$category_code_fk&l_category_fk=$l_category_fk'>";
?>