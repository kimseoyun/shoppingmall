<!--
  function form_reset(){
    document.gume.reset();
  }

function num_plus(num){
	gnum = parseInt(num.products_count.value);
	if (gnum > 1000) {
		alert(' 제품재고량(1,000개)을 초과하였습니다. ');
		num.products_count.value = 1000;
		return;
	}
	num.products_count.value = gnum + 1;
	return;
}
function num_minus(num){

	gnum = parseInt(num.products_count.value);
	if( gnum > 1 ){
		num.products_count.value = gnum - 1;
	}
	else {
		alert('본 제품의 최소 구매수량은 (1개)입니다.');
	}
	return;
}

function is_number(){
	if ((event.keyCode<48)||(event.keyCode>57)){
		alert("\n\n수량은 숫자만 입력하셔야 합니다.\n\n");
		event.returnValue=false;
	}
}


function cart_edit(form) {
  
  if(!form.products_count.value){
		alert('수량을 입력하지 않았습니다.');
		form.products_count.focus();
		return;
	}
  
  if(form.products_count.value) {
	  if(!IsNumber(form.products_count.name)){
         alert("수량은 숫자이어야 합니다!");
	     form.products_count.focus();
	     return;
	  }
  }

  form.action="cart_update.php?chk=2";
  form.submit();
}



function goCart(form) {

  if(!form.products_count.value){
		alert('수량을 입력하지 않았습니다.');
		form.products_count.focus();
		return;
	}
  
  if(form.products_count.value) {
	  if(!IsNumber(form.products_count.name)){
         alert("수량은 숫자이어야 합니다!");
	     form.products_count.focus();
	     return;
	  }
  }
  

  form.action="cart_update.php";
  form.submit();
}

function goOrder(form) {
  
  if(!form.products_count.value){
		alert('수량을 입력하지 않았습니다.');
		form.products_count.focus();
		return;
	}
  
  if(form.products_count.value) {
	  if(!IsNumber(form.products_count.name)){
         alert("수량은 숫자이어야 합니다!");
	     form.products_count.focus();
	     return;
	  }
  }

  form.action="cart_update.php?chk=2";
  form.submit();
}

function equalRecipient()
{
   var form = document.purchase;
   if(form.equ.checked == true){
	   form.recipient_name.value = form.buyer_name.value;
	   form.recipient_phone01.value = form.buyer_phone01.value;
	   form.recipient_phone02.value = form.buyer_phone02.value;
	   form.recipient_phone03.value = form.buyer_phone03.value;
	   form.recipient_hphone01.value = form.buyer_hphone01.value;
	   form.recipient_hphone02.value = form.buyer_hphone02.value;
	   form.recipient_hphone03.value = form.buyer_hphone03.value;
	   form.recipient_zipcode01.value = form.buyer_zipcode01.value;
	   form.recipient_zipcode02.value = form.buyer_zipcode02.value;
	   form.recipient_address01.value = form.buyer_address01.value;
	   form.recipient_address02.value = form.buyer_address02.value;
	}
	if(form.equ.checked == false){
		form.recipient_name.value = "";
	   form.recipient_phone01.value = "";
	   form.recipient_phone02.value = "";
	   form.recipient_phone03.value = "";
	   form.recipient_hphone01.value = "";
	   form.recipient_hphone02.value = "";
	   form.recipient_hphone03.value = "";
	   form.recipient_zipcode01.value = "";
	   form.recipient_zipcode02.value = "";
	   form.recipient_address01.value = "";
	   form.recipient_address02.value = "";
	}
  	
}


function mny_function(){

  form = document.purchase;
   
   var cost1,cost2,cost3,cost4;

	if(form.mileage_use.value) {
	  if(!IsNumber1(form.mileage_use.name)){
         alert("포인트는 숫자로 입력하셔야 합니다!");
		 form.mileage_use.value="";
	     form.mileage_use.focus();
	     return;
	  }
     cost1 = parseInt(form.mileage_use.value);
    }
    else{
      cost1 = 0;
     }
   
    cost2 = parseInt(form.mileage_tot.value);

    if(cost1 > cost2){
	  alert("포인트 사용금액이 보유액보다 클 수 없습니다!");
	  form.mileage_use.value="";
	  form.mileage_use.focus();
	  return;
	}
	else{
	  cost3 = parseInt(form.amount.value);
      cost4 = cost3 - cost1;
	  form.real_mny.value=cost4;
	}
   
}



function sendOrder(form)
{
        if(!confirm('결제를 하시겠습니까?')){
                return;
        }
	if(!form.buyer_name.value){
		alert('구매자명을 입력하지 않았습니다.');
		form.buyer_name.focus();
		return;
	}
	if(!form.buyer_phone01.value){
		alert('구매자 전화번호를 입력하지 않았습니다.');
		form.buyer_phone01.focus();
		return;
	}
    if(!form.buyer_phone02.value){
		alert('구매자 전화번호를 입력하지 않았습니다.');
		form.buyer_phone02.focus();
		return;
	}
	if(!form.buyer_phone03.value){
		alert('구매자 전화번호를 입력하지 않았습니다.');
		form.buyer_phone03.focus();
		return;
	}
	if(!form.buyer_email.value){
		alert('이메일을 입력하지 않았습니다.');
		form.buyer_email.focus();
		return;
	}
    if (form.buyer_email.value.indexOf("@") < 0){
       alert('이메일 주소 형식이 틀립니다.');
       form.buyer_email.focus();
	   return; 
     }

   if (form.buyer_email.value.indexOf("/") >= 0){
      alert('이메일 주소 형식이 틀립니다.');
      form.buyer_email.focus();
      return; 
   }
    

	if(!form.recipient_name.value){
		alert('수령자명을 입력하지 않았습니다.');
		form.recipient_name.focus();
		return;
	}
	if(!form.recipient_phone01.value){
		alert('수령자 전화번호를 입력하지 않았습니다.');
		form.recipient_phone01.focus();
		return;
	}
	if(!form.recipient_phone02.value){
		alert('수령자 전화번호를 입력하지 않았습니다.');
		form.recipient_phone02.focus();
		return;
	}
	if(!form.recipient_phone03.value){
		alert('수령자 전화번호를 입력하지 않았습니다.');
		form.recipient_phone03.focus();
		return;
	}
	if(!form.recipient_zipcode01.value || !form.recipient_zipcode02.value){
		alert('수령자 우편번호를 입력하지 않았습니다.');
		form.recipient_zipcode01.focus();
		return;
	}
	if(!form.recipient_address01.value){
		alert('수령자 주소를 입력하지 않았습니다.');
		form.recipient_address01.focus();
		return;
	}

	form.submit();
}

  function IsNumber(formname) {
     var form=eval("document.products_info." + formname);

	 for(var i=0; i < form.value.length; i++) {
	     var chr = form.value.substr(i,1);
		 if((chr < '0' || chr > '9')) {
		    return false;
		 }
     }
     return true;
  }

  function IsNumber1(formname) {
     var form=eval("document.purchase." + formname);

	 for(var i=0; i < form.value.length; i++) {
	     var chr = form.value.substr(i,1);
		 if((chr < '0' || chr > '9')) {
		    return false;
		 }
     }
     return true;
  }

function ZipWindow(ref,what) {
     var window_left = (screen.width-640)/2;
	 var window_top = (screen.height-480)/2;
	 ref = ref + "?what=" + what;
	 window.open(ref,"zipWin",'width=470,height=262,status=no,scrollbars=yes,top=' + window_top + ',left=' + window_left + '');
  }

//-->
