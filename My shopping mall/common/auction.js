<!--

function form_save(){
  var form = document.form1;
  
  if(!form.prod_name.value){
	alert('등록상품명을 입력하지 않았습니다.');
	form.prod_name.focus();
	return;
  }

  if(!form.start_amt.value){
	alert('경매 시작가격을 입력하지 않았습니다.');
	form.start_amt.focus();
	return;
  }

  if(!form.join_amt.value){
	alert('경매입찰 단위를 입력하지 않았습니다.');
	form.join_amt.focus();
	return;
  }

  if(!form.total_cnt.value){
	alert('총 판매수량을 입력하지 않았습니다.');
	form.total_cnt.focus();
	return;
  }

  form.submit();
}


function auct_send(){
  var form = document.form1;
  var amt1, amt2 , amt3 , cnt1 , cnt2;
  
  if(!form.join_cnt.value){
	alert('입찰수량을 입력하지 않았습니다.');
	form.join_cnt.focus();
	return;
  }
  
  if(!form.join_amt.value){
	alert('입찰가격을 입력하지 않았습니다.');
	form.join_amt.focus();
	return;
  }

  amt1 = parseInt(form.join_amt.value);
  amt2 = parseInt(form.join_amt_1.value);
  amt3 = parseInt(form.limit_amt.value);

  cnt1 = parseInt(form.join_cnt.value);
  cnt2 = parseInt(form.join_cnt_1.value);
  
  if(amt1 < amt2){
    alert('입찰가격은 최소 입찰가격 이상 입력하셔야 합니다.');
	form.join_amt.focus();
	return;
  } 
  // 즉구가가 있을때
  if(form.limit_type.value=='1'){
	  if(amt1 > amt3){
		alert('즉시구매가 이상 입력할 수 없습니다.');
		form.join_amt.focus();
		return;
	  } 
  }
  
  if(cnt1 < 1){
    alert('입찰수량은 한개 이상이어야 합니다.');
	form.join_cnt.focus();
	return;
  } 


  if(cnt1 > cnt2){
    alert('입찰가능한 수량보다 많이 입력하였습니다.');
	form.join_cnt.focus();
	return;
  } 

  if(!confirm('입찰하시겠습니까?')){
    return;
  }

  form.action = "auct_join_post.php";
  form.submit();

}

function brd_send_post(){
  var form = document.form1;
  
  if(!form.subject.value){
	alert('제목을 입력하지 않았습니다.');
	form.subject.focus();
	return;
  }
  
  if(!form.contents.value){
	alert('내용을 입력하지 않았습니다.');
	form.contents.focus();
	return;
  }
 form.submit();
}
//-->
