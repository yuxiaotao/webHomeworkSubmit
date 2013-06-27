<?php

function  getIp()
{
          $ip = "";
          if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'),'unknow'))
		  {
		    $ip = getenv('HTTP_CLIENT_IP');
		  }
		  elseif(getenv('REMOTE_ADD') && strcasecmp(getenv('REMOTE_ADD'),'unknow'))
		  {
		    $ip = getenv('REMOTE_ADD');
		  }
		  elseif(isset($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'],'unknow'))
		  {
		    $ip = $_SERVER['REMOTE_ADDR'];
		  }
		  return $ip;
}


function  strsReplace($str,$replaces)
{
	      foreach($replaces as $k => $v)
		    $subject = str_replace($k,$v,$str);
		  return $str;
}

function  tripFilename($filename)
{
	      return strs_replace(array("/","\\","?","*","<",">","\"","|"),"",$filename);
}



function getMaxDim($vDim)
        {
                if(!is_array($vDim)) return 0;
                else
                {
                        $max1 = 0;
                        foreach($vDim as $item1)
                        {
                            $t1 = getmaxdim($item1);
                            if( $t1 > $max1) $max1 = $t1;
                        }
                        return $max1 + 1;
                }
        }




function  fee($fee,$size = 2){
            $fee = trim($fee);
			if(empty($fee))
			  return '0.00';
			if(!is_numeric($fee))
			  return 'err';
			return number_format($fee,$size,'.','');
}

function random($length, $numeric = 0) {
	PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
	if($numeric) {
		$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
	} else {
		$hash = '';
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
	}
	return $hash;
}

function msg($msg = ''){
   global $m;
   $url = '?m=msg&o=display&p=msg,'.$msg;
   if($m->goto != '')
	   $url .= '&goto='.urlencode($m->goto);
   if($m->back != '')
	   $url .= '&back='.urlencode($m->back);

   header('Location:./'.$url);
   exit();
}


function  alertBack($msg = "")
{
          $html = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
		           <script type=\"text/javascript\" charset=\"utf-8\">
                      alert('".$msg."');
		              window.history.back(-1);
                   </script>";
		  echo $html;
		  exit();
}

function  alertGoto($url,$msg)
{
          $html = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
		           <script type=\"text/javascript\" charset=\"utf-8\">
                      alert('".$msg."');
		              top.location = \"".$url."\";
                   </script>";
		  echo $html;
		  exit();
}

function  createDir($path)
{
          if(!file_exists($path))
		  {
            createDir(dirname($path));
            mkdir($path);
          }
}


function  deleteDir($dir)
{
          $dh = opendir($dir);
          while($file = readdir($dh))
            if($file!="." && $file!="..")
			{
              $fullpath = $dir."/".$file;
              if(!is_dir($fullpath))
                unlink($fullpath);
              else
                deleteDir($fullpath);
            }
          closedir($dh);
          if(rmdir($dir))
            return true;
          else
            return false;
}

function getFileType($filename) { 
    if (substr_count($filename, ".") == 0) {        // 检查文件名中是否有.号。 
        return;                // 返回空
    } else if (substr($filename, -1) == ".") {        // 检查是否以.结尾，即无扩展名 
        return;                // 返回空 
    } else {  
        $fileType = strrchr ($filename, ".");    // 从.号处切割 
        $fileType = substr($fileType, 1);    // 去除.号  
        return $fileType;            // 返回  
    }  
} 

function checkTel($tel){
  if(strlen($tel) != 11)
    return false;
  return preg_match('/^1(3|5|8)[0-9]{9}$/', $tel);
   
}

function checkEmail($email){
	if($email == '')
	  return false;
	if(eregi("^[_\.0-9a-z]+@([0-9a-z][0-9a-z]+\.)+[a-z]{2,3}$",$email))
	  return true;
	return false;

}



function sendMail($mail){
    global $m;
	if($m->cfg['mailMethod'] == 'mail()'){
	}
	
	if($m->cfg['mailMethod'] == 'smtp'){
		include_once "lib/smtp.class.php";
		$smtpserver = $m->cfg['smtpServer']; //您的smtp服务器的地址
		$port = empty($m->cfg['smtpPort']) ? '25' : $m->cfg['smtpPort'] ; //smtp服务器的端口，一般是 25 
		$smtpuser = $m->cfg['smtpCount']; //您登录smtp服务器的用户名
		$smtppwd = $m->cfg['smtpPas']; //您登录smtp服务器的密码
		$mailtype = "HTML"; //邮件的类型，可选值是 TXT 或 HTML ,TXT 表示是纯文本的邮件,HTML 表示是 html格式的邮件
		$sender = $m->cfg['smtpCount']; //发件人,一般要与您登录smtp服务器的用户名($smtpuser)相同,否则可能会因为smtp服务器的设置导致发送失败
		$smtp = new smtp($smtpserver,$port,true,$smtpuser,$smtppwd,$sender); 
		$smtp->debug = true; //是否开启调试,只在测试程序时使用，正式使用时请将此行注释
		$send=$smtp->sendmail($mail['to'],$sender,$mail['subject'],$mail['body'],$mailtype);
		if($send==1)
		  return true;
		return $this->smtp->logs;
	}
}

function checkId($id_card) 
{ 
if(strlen($id_card) == 18) 
{ 
return idcard_checksum18($id_card); 
} 
elseif((strlen($id_card) == 15)) 
{ 
$id_card = idcard_15to18($id_card); 
return idcard_checksum18($id_card); 
} 
else 
{ 
return false; 
} 
} 
// 计算身份证校验码，根据国家标准GB 11643-1999 
function idcard_verify_number($idcard_base) 
{ 
if(strlen($idcard_base) != 17) 
{ 
return false; 
} 
//加权因子 
$factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2); 
//校验码对应值 
$verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'); 
$checksum = 0; 
for ($i = 0; $i < strlen($idcard_base); $i++) 
{ 
$checksum += substr($idcard_base, $i, 1) * $factor[$i]; 
} 
$mod = $checksum % 11; 
$verify_number = $verify_number_list[$mod]; 
return $verify_number; 
} 
// 将15位身份证升级到18位 
function idcard_15to18($idcard){ 
if (strlen($idcard) != 15){ 
return false; 
}else{ 
// 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码 
if (array_search(substr($idcard, 12, 3), array('996', '997', '998', '999')) !== false){ 
$idcard = substr($idcard, 0, 6) . '18'. substr($idcard, 6, 9); 
}else{ 
$idcard = substr($idcard, 0, 6) . '19'. substr($idcard, 6, 9); 
} 
} 
$idcard = $idcard . idcard_verify_number($idcard); 
return $idcard; 
} 
// 18位身份证校验码有效性检查 
function idcard_checksum18($idcard){ 
if (strlen($idcard) != 18){ return false; } 
$idcard_base = substr($idcard, 0, 17); 
if (idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1))){ 
return false; 
}else{ 
return true; 
} 
} 


function getWeek($day){
  $days = array('周日','周一','周二','周三','周四','周五','周六');
  $day = explode('-',$day);
  return $days[date('w',mktime(0,0,0,$day[1],$day[2],$day[0]))];
}

?>