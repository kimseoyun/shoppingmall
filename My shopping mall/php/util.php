<?
function err_msg($msg,$bool="1")
{
if ($bool)
{
echo "
<script>
window.alert('$msg');
history.go(-1);
</script>
";
exit;
}
}

function msg($msg) {
echo("
        <script>
	    window.alert('$msg')
	    </script>
	    ");
 }


function err_close($msg)
{
echo "
<script>
window.alert('$msg');
self.close();
</script>
";
exit;
}


function err_msg2($msg,$to,$bool="1")
{
if ($bool)
{
echo "
<script>
window.alert('$msg');
window.open('$to','_self');
</script>
";
exit;
}
}

// 요청하는 페이지로 이동
function redirect($re_url)
{
 echo "<meta http-equiv='Refresh' content='0; URL=$re_url'>";
 exit;
}

// MYSQL 연결
function my_connect($host,$id,$pass,$db)
{
	$connect=mysql_connect($host,$id,$pass);
	mysql_select_db($db);
	return $connect;
}

// HTML Tag를 제거하는 함수
function del_html( $str )
{
  $str = str_replace( ">", "&gt;",$str );
  $str = str_replace( "<", "&lt;",$str );
  $str = str_replace( "\"", "&quot;",$str );
  return $str;
}


// 각종 HTML 태그를 이용한 테러방지
function avoid_crack($str)
{
  $str=eregi_replace("<","&lt;",$str);
  $str=eregi_replace("&lt;div","<div",$str);
  $str=eregi_replace("&lt;p ","<p ",$str);
  $str=eregi_replace("&lt;font","<font",$str);
  $str=eregi_replace("&lt;b","<b",$str);
  $str=eregi_replace("&lt;marquee","<marquee",$str);
  $str=eregi_replace("&lt;img","<img",$str);
  $str=eregi_replace("&lt;a ","<a ",$str);
  $str=eregi_replace("&lt;embed","<embed",$str);
 
  $str=eregi_replace("&lt;/div","</div",$str);
  $str=eregi_replace("&lt;/p ","</p ",$str);
  $str=eregi_replace("&lt;/font","</font",$str);
  $str=eregi_replace("&lt;/b","</b",$str);
  $str=eregi_replace("&lt;/marquee","</marquee",$str);
  $str=eregi_replace("&lt;/img","</img",$str);
  $str=eregi_replace("&lt;/a>","</a>",$str);
  $str=eregi_replace("&lt;/embed","</embed",$str);  
  $str=eregi_replace("&gt;",">",$str);
  return $str;
}
	

function page_avg($totalpage,$cpage,$url){

  	if(!$pagenumber) {	       
     		$pagenumber = 10;
     	}
  
     	$startpage = intval(($cpage - 1) / $pagenumber) * $pagenumber +1  ;
     	$endpage = intVal(((($startpage -1) +  $pagenumber) / $pagenumber) * $pagenumber) ;

    	if ($totalpage <= $endpage)
       		$endpage = $totalpage;

    		if ( $cpage > $pagenumber) {

			$curpage = intval($startpage - 1);
			   $url_page = "<a href='$url"."&page=$curpage'>";
       			echo ("$url_page");
				echo("◀</a> .. ");
       		}
			else{
			  echo("◀</a>  ");
			}

      		$curpage = $startpage;
           
      		while ($curpage <= $endpage):      

       			if ($curpage == $cpage) {
       				echo "<b>$cpage</b>";
       			} else {
       			  $url_page = "<a href='$url"."&page=$curpage'>";
       			  echo ("$url_page");
				  echo("[$curpage]</a>");
       			}
       			$curpage++;
     
 		endwhile ;

       	if ( $totalpage > $endpage) {
      		$curpage = intval($endpage + 1);  
      		$url_page = " .. <a href='$url"."&page=$curpage'>";
       		echo ("$url_page");
			echo("▶</a>");
      	}
		else{
		  echo("  ▶");
		}
  }


// 현재 시간보다 마감일자가 늦을경우 경매완료
function end_exe($connect){
  $now_t = date('YmdH');
  $qry = "update auct_master set end_chk='Y' where auct_end <= $now_t ";
  $res = mysql_query($qry,$connect);
}


// 블로그의 기본정로를 넘김
function blog_info_fnc($blog_id,$connect){
  
  $qry  = "select * from blog_info where user_id='$blog_id' ";
  $res  = mysql_query($qry,$connect);
  $rows = mysql_fetch_array($res);

  return $rows;
}

// 본인 블로그의 방문기록 저장
function blog_visit_fnc($blog_id,$visit_id,$cookie_val,$connect){

   $n_date = date('Ymd');

   //하루동안 부여하는 쿠키가 없을때 즉 오늘 첨 올때
   if(!$cookie_val){
     $chk = "select vnum from blog_visit_count where user_id    = '$blog_id' And
	                                                 visit_date = '$n_date' ";
	 $cres = mysql_query($chk,$connect);
	 $crows = mysql_fetch_array($cres);
	 // 해당 일자의 카운터가 존재할 경우엔 업데이트
	 if($crows){
        $qry2 = "update blog_visit_count set visit_count = visit_count + 1 
		         where user_id    = '$blog_id' And
	                   visit_date = '$n_date' ";
	    $res2 = mysql_query($qry2,$connect);
	 }
	 else{  // 데이터가 없을 경우 INSERT
	    $qry2 = "insert into blog_visit_count(user_id,visit_date,visit_count)
				 values('$blog_id','$n_date',1) ";
		$res2 = mysql_query($qry2,$connect);
	 }
   }
   else{  
      //부여된 쿠키가 오늘 부여된것이 아닐경우
   	  if($cookie_val != $n_date){
         $qry2 = "insert into blog_visit_count(user_id,visit_date,visit_count)
		 		  values('$blog_id','$n_date',1) ";
		 $res2 = mysql_query($qry2,$connect);
	  }
   }
   
   //새로 쿠키를 부여
   SetCookie("v_id",$n_date,time()+3600*24,"/");
      
   //본인이 아닌 로그인된 사용자가 접속했을때
   if($visit_id && ($visit_id != $blog_id)){
	 //오늘 일자로 접속한 유저가 있는지 확인
     $chk = "select mnum from blog_visit_member where user_id    = '$blog_id' And
	                                                  visit_date = '$n_date' And 
													  visit_id   = '$visit_id' ";
	 $cres = mysql_query($chk,$connect);
	 $crows = mysql_fetch_array($cres);
	 // 해당 일자에 방문기록이 없을 경우에만 저장
	 if(!$crows){  
	    $qry2 = "insert into blog_visit_member(user_id,visit_date,visit_id)
		         values('$blog_id','$n_date','$visit_id') ";
	    $res2 = mysql_query($qry2,$connect);
	 }
   }
}


// 배송비 계산
function trans_cul($money){
  if((int)$money < 0){
	 $a_money = 3000;
  }
  else{
     $a_money = 0;
  }
    
  return $a_money;
}


/* 날짜데이터 형식 변환 : 20020512 --> 2002-05-12 */
function shortdate($strvalue) {
	$date_str = substr($strvalue, 0, 4) . "-" . substr($strvalue, 4, 2) . "-" . substr($strvalue, 6, 2);
	return $date_str;
}

/* 한글 문자열 자르기 함수 */
function shortenStr($str, $maxlen) { 

  if ( strlen($str) <= $maxlen ) 
	return $str; 

  $effective_max = $maxlen - 3; 
  $remained_byte = $effective_max; 
  $retStr=""; 

  $hanStart=0; 

  for ( $i=0; $i < $effective_max; $i++ ) { 
	$char=substr($str,$i,1); 

	if ( ord($char) <= 127 ) { 
		$retStr .= $char; 
		$remained_byte--; 
		continue; 
	} 

	if ( !$hanStart && $remained_byte > 1 ) { 
		$hanStart = true; 
		$retStr .= $char; 
		$remained_byte--; 
		continue; 
	} 

	if ( $hanStart ) { 
		$hanStart = false; 
		$retStr .= $char; 
		$remained_byte--; 
	} 
  } 
  return $retStr .= "..."; 
} 

?>