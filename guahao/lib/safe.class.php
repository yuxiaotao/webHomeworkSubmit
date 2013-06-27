<?php
class safe{
	
  function __construct(){
     $this->checkPost();
  }

  function checkPost(){//验证表单提交来路
    if($_SERVER['REQUEST_METHOD'] == "POST" && (empty($_SERVER['HTTP_REFERER']) || preg_replace("/https?:\/\/([^\:\/]+).*/i","\\l", $_SERVER['HTTP_REFERER']) !== preg_replace("/([^\:]+).*/","\\l",$_SERVER['HTTP_HOST'])))
      return false;
	return true;
  }

  function intSafe($i,$len = '',$min = '',$max = ''){
    $i = intval($i);
	if($len != '')
	  if(strlen($i) > $len)
		msg('wronginput');
	return $i;
  }
  
  function strSafe($str){
    return $str;
  }


function strFilter($str){ 

  $farr = array( 
  "/\s+/", //过滤多余的空白 
  "/<(\/?)(script|i?frame|style|html|body|title|link|meta|\?|\%)([^>]*?)>/isU",
  "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU", //过滤javascript的on事件 
  ); 

  $tarr = array(" ", 
	"＜\\1\\2\\3＞", //如果要直接清除不安全的标签，这里可以留空 
    "\\1\\2"
  ); 

  $str = preg_replace($farr,$tarr,$str); 
  return $str; 
} 



 



}



?>