<?
function authenticate() 
{ 
      Header( "WWW-authenticate: basic realm=\"ADMIN영역\" "); 
      Header( "HTTP/1.0 401 Unauthorized"); 
      echo("이곳에 들어오시려면 관리자 아이디 암호가 필요합니다.");
      exit; 
} 

if(!isset($PHP_AUTH_USER) || ($PHP_AUTH_USER!='mirim' || $PHP_AUTH_PW!='1234')) {
	authenticate();
}
?>