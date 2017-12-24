<?
	include "../../php/auth.php";	
	include "../../php/config.php";	
	include "../../php/util.php";	
	$connect = my_connect($host, $dbid, $dbpass, $dbname);

	if($mode=="1") {
		$query = "update mall_order
				  set status='5'
				  where num=$oid";
		$result = mysql_query($query, $connect);
	}

	if($mode=="2") {
		$query = "update mall_order
				  set status='7'
				  where num=$oid";
		$result = mysql_query($query, $connect);
	}

	if($mode=="3") {
		$query1 = "select * from mall_order
		           where num='$oid'";
		$result1 = mysql_query($query1, $connect);
		$rows1 = mysql_fetch_array($result1);

	if(((int)$rows1[mileage_use]>0) && ($rows1[user_id]!='비회원')) {
		if($rows1[status]!='8') {  //배송완료
		$mile_amt = 0 - $rows1[mileage_use];
		$query3 = "insert into mileage(id_fk, mileage, mile_desc, wdate)
				   values('$rows1[user_id]', '$mile_amt', '상품구매시 사용-$rows1[orderid]', now())";
		mysql_query($query3, $connect);
		} //if
	} //if
		
	if(((int)$rows1[mileage_add]>0) && ($rows1[user_id]!='비회원')) {
		if($rows1[status]!='8') {  //배송완료
		$query4 = "insert into mileage(id_fk, mileage, mile_desc, wdate)
				   values('$rows1[user_id]', '$rows1[mileage_add]', '상품구매시 적립-$rows1[orderid]', now())";
		mysql_query($query4, $connect);
		} //if
	} //if
		
		$query5 = "update mall_order
				  set status='8'
				  where num=$oid";
		$result5 = mysql_query($query5, $connect);
	}
echo "<meta http-equiv='Refresh'content='0;url=order_read.php?oid=$oid'>";
?>