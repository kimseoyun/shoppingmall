<!--

function blog_created(){
   var form = document.form1;
   
  if(!form.blog_name.value) {
     alert("블로그명을 입력하세요!");
	 form.blog_name.focus();
	 return;
  }

   if(!form.nick_name.value) {
     alert("닉네임을 입력하세요!");
	 form.nick_name.focus();
	 return;
   }

   if(!confirm('블로그를 생성하시겠습니까?')){
    return;
   }

   form.submit();
}


function blog_mng_edit(){
   var form = document.form1;
   
  if(!form.blog_name.value) {
     alert("블로그명을 입력하세요!");
	 form.blog_name.focus();
	 return;
  }

   if(!form.nick_name.value) {
     alert("닉네임을 입력하세요!");
	 form.nick_name.focus();
	 return;
   }

   form.submit();
}

function blog_brd_post(){
   var form = document.form1;
   
  if(!form.brd_title.value) {
     alert("분류명을 입력하세요!");
	 form.brd_title.focus();
	 return;
  }

   form.submit();
}

function blog_write_post(){
   var form = document.form1;
  
  if(form.brd_list_fk.options[0].selected){
    alert("블로그 분류를 선택하세요. \n만약 없을 경우 먼저 블로그 분류를 생성하셔야 합니다.");
    return;
  } 

  if(!form.title.value) {
     alert("제목을 입력하세요!");
	 form.title.focus();
	 return;
  }

   form.submit();
}

function checklen(form_name,limit_length){	
  msglen = 0;
  msglen2 = 0;
  total_str = "";
  l_message = 0;

  total_str=	form_name.value;

	// 문자의 갯수
	l_message = total_str.length;
	temp_page_num=1
	for(k=0;k<l_message;k++){
		t = total_str.charAt(k);
		msglen+=CheckByte(t)
			if(CheckByte(t)==2 && msglen2%75==74) {
				msglen2+=3
			}
			else {
				msglen2+=CheckByte(t)

			}

	}
    
	if(msglen > limit_length){
	  alert('입력한 값이 너무 많습니다. \n다시 입력하세요.');
	  form_name.value = "";
	  return;
	}

}

// 선택된 문자(한개)의 바이트수를 계산하는 함수
function CheckByte(temp_char)
{
	if (escape(temp_char).length > 4)
		return 2;
	else
		return 1;

}

function ShowImage(img_char) {
      ref = "show_image.php?p_image="+img_char;
	  window.open(ref,'ImageView', 'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=no,resizable=0,copyhistory=0,width=460,height=300,left=300,top=50');
}


function bg_change(){
  var form = document.form1;
  
  if(form.title_bgtype[0].checked){
     form.title_bgimg.disabled =true;
	 form.title_bgimg.style.backgroundColor = "#cccccc";		
	 form.title_bgcolor.disabled = false;
	 form.title_bgcolor.style.backgroundColor = "white";		
  }
  else if(form.title_bgtype[1].checked){
    form.title_bgimg.disabled =false;
	form.title_bgimg.style.backgroundColor = "white";		
	form.title_bgcolor.disabled = true;
	form.title_bgcolor.style.backgroundColor = "#cccccc";		
  }
}

//-->
