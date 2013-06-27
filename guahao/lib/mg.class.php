<?php
class mg{
	

	public $cfg;
	public $db;
	public $tplName;
	public $tplVars;
	public $session;
	public $p;
	
	
  
  function __construct(){
	  $this->db = new db;
	  $this->safe = new safe;
	  $this->tpl = new tpl;
	  $settings = $this->db->selectDate('setting');
	  foreach($settings as $set)
	    $this->cfg[$set['skey']] = $set['svalue'];
      
	  $this->cfg['doctorTypes'] = array('','普通','主治','专家','特殊专家');
      $this->session = $this->startSession();
	  $this->tplVars['cfg'] = $this->cfg;
	  $this->tplVars['session'] = $this->session;
	  $this->tplVars['currentMenu'] = 0;
	  $this->tplVars['htmlTitle'] = '未定义';
	  $this->tplVars['mainNav'] =  array(array('1','我要挂号','?m=room&o=list'),
                        array('2','我的预约单','?m=matter&o=list'),
                        array('3','退出系统','?m=user&o=quit'));
	  $this->tplVars['sqls'] = &$this->db->sqls;
	  if(!empty($_GET['p'])){
	    $_GET['p'] = explode('|',$_GET['p']);
		foreach($_GET['p'] as $sting){
		  $temp = explode(',',$sting);
		  @$this->p[$temp[0]] = $temp[1];
		  //echo $temp[1];
		}
	  }
      $this->p['page'] = empty($this->p['page']) ? 1 : $this->safe->intSafe($this->p['page'],3);
	  
	  $this->tplVars['userTypes'] = array('本人','父母','夫妻','其它监护人');
	  /***
	  foreach($_SERVER as $k => $v)
	    echo $k.' => '.$v.'<br/>';
***/
  }
  
  function startSession(){//开启session
	 $ip = getIp();
	 if($_GET['m'] == 'ajax'){
	   if(!empty($_GET['sid'])){
	     $_COOKIE['sid'] = $_GET['sid'];
	   }
	 }
     if(isset($_COOKIE['sid'])){
		 $s = $this->db->selectOne('session',array("`sid` = '".$_COOKIE['sid']."'","`ip` = '$ip'"));
		 if($s){
			 if($s['time'] + 60 * $this->cfg['lifetime'] < TIME)
			   $this->db->deleteDate('session',"`sid` = '".$s['sid']."' AND `ip` = '".$ip."'"); 
			 else{
			   $s['time'] = TIME;
			   $this->db->updateDate('session',array("`sid` = '".$s['sid']."'","`ip` = '".$ip."'"),array('time' => TIME),1);
			   if($s['uid'] > 0){
			     $u = $this->db->selectOne('user',"`uid` = '".$s['uid']."'");
				 if($u){
				   $s = array_merge($s,$u);
				 }
				 else{
				   $s['uid'] = 0;
				 }
			   }
			   return $s;
			 }
		 }
		   
	 }

	 $sid = random(6);
	 $this->db->insertDate('session',array('sid' => $sid,'time' => TIME,'ip' => $ip));
	 setcookie('sid',$sid,TIME+3600*24);
	 $s = array('sid' => $sid,'time' => TIME,'ip' => $ip,'uid' => 0,'username' => '','truename' => '');

	 return $s;
  }
  
  function debug(){
    $this->tplName = 'debug';
	$this->tpl->display($this->cfg['style'],$this->tplName,$this->tplVars);
	exit();
  }
  
  function isAdmin(){
	if(empty($this->session['admin']))
	  return false;
	return true;
  }
  
  function isBlack($operate,$uid = 0,$ip = '',$starttime = 0){
	  $sql = 'SELECT * FROM `'.DB_pre.'black` WHERE `operate` = '.$operate.' AND `uid` = '.$uid;
	  if($ip != '')
	    $sql .= " AND `ip` ='$ip'";
	  if($starttime > 0)
	    $sql .= " AND `addtime` > $starttime";
	  $sql .= 'ORDER BY `addtime` LIMIT 1';
	  $row = $this->db->select($sql);
	  return $row;
  }
  
  function addBlack($operate,$uid = 0,$ip = ''){
	  $date = array('operate' => $operate,'uid' => $uid);
	  if($ip != '')
	    $date['ip'] = $ip;
	  $date['addtime'] = TIME;
	  return $this->db->insertDate('black',$date);
  }

function getLimit($size = 10){
   $limit = (($this->p['page'] - 1) * $size).','.$size;
   return $limit;
}


function sendMsg($mobile,$msg){
	$url = 'http://www.mxtong.net.cn:8080/GateWay/Services.asmx/DirectSend?UserID=887157&Account=admin&Password=YLpKCC&Phones='.$mobile.';&Content='.urlencode($msg).'&SendTime=&SendType=1&PostFixNumber=1';
	$msg = file_get_contents($url);
	if(!$msg)
	  return false;
	return strpos($msg,'Sucess');
}

function  createPages($page = 1,$allnum = 0,$pagesize = 10){
		  $url = $this->url;
		  if(!empty($this->urls))
			  foreach($this->urls as $k => $v)
				 $url .= $k.','.$v.'|';

          $allpages = ceil($allnum / $pagesize);
		  if($allpages <= 1)
		    return '';
		  $prev = $page - 1;
		  $next = $page + 1;
		  $prevpage = "";
		  $nextpage = "";
		  if($page > 1)
		    $prevpage = '<a href="'.$url.'|page,'.$prev.'" title="上一页"><<</a>';
		  if($page < $allpages)
		    $nextpage = '<a href="'.$url.'|page,'.$next.'" title="下一页">>></a>';
		  $pagelist = '';
		  for($i = 1;$i <= $allpages;$i++)
		  {
		    $pagelist .= '<a href="'.$url.'|page,'.$i.'"';
			if($i == $page)
			  $pagelist .= ' class="current"';
			$pagelist .= ' title="第'.$i.'页">'.$i.'</a> ';
		  }
		  return $prevpage.$pagelist.$nextpage;
}


public function  createOptions($options,$default = "",$dim = "",$test = ""){
	      $select = "";
		  if($dim == "")
		    $dim = getmaxdim($options);
		  if($dim == 1){
            foreach($options as $option){
		      $select .= "<option value=\"".$option."\"";
			  if($option == $default)
			    $select .= " selected='selected'";
			  $select .= ">".$option."</option>";
		    }
          }
		  else{
            foreach($options as $k => $v){
		      $select .= "<option value=\"".$k."\"";
			  if($k == $default){
			    $select .= " selected=\"selected\"";}
			  $select .= ">".$v."</option>";
		    }
		  }
		  return $select;
}

public function  createAMenu($name,$options){

		  $all = 0;
		  $menu = '';
		  $url = $this->url;
		  $current = isset($this->urls[$name]) ? $this->urls[$name] : '';
		  if(!empty($this->urls)){
			$urls = $this->urls;
		    if(array_key_exists($name,$urls))
		      unset($urls[$name]);
			if(!empty($urls))
			  foreach($urls as $k => $v)
				 $url .= $k.','.$v.'|';
		  }
            foreach($options as $k => $v){
		      $menu .= '<a href="'.$url.$name.','.$k.'"';
			  if($k == $current){
			    $menu .= ' class="selected"';
			    $all = 1;
			  }
			  $menu .= '>'.$v.'</a>';
		    }

		  $menu = $all ? "<a href=\"".$url."\" class=\"all\">全部</a>".$menu : "<a href=\"".$url."\" class=\"selected all\">全部</a>".$menu;
		  return $menu;
}


public function display(){
	       if($this->tplName == '')
		     msg('notpl');

		  require_once('smarty/Smarty.class.php');
	      $this->tplVars['tplDir'] = 'tpl/'.$this->cfg['style']."/";
	      $this->tplVars['imgDir'] = 'tpl/'.$this->cfg['style']."/images/";
		  
		  $this->smarty = new Smarty;
		  $this->smarty->debugging = false;
		  $this->smarty->caching = false;
		  $this->smarty->cache_lifetime = 120;
		  $this->smarty->setTemplateDir($this->tplVars['tplDir']);
          $this->smarty->setCacheDir('cache/tplcache/');
		  $this->smarty->setCompileDir('cache/tpl_c/');
		  $this->smarty->setPluginsDir(array('lib/smarty/plugins','lib/smarty/mg'));
		  foreach($this->tplVars as $k => $v)
		    $this->smarty->assign($k,$v);
		  $this->smarty->assign('sqls', '<p id="sqls">'.$this->tplVars['sqls']."</p>");
           $this->smarty->display($this->tplName.'.htm');
}

}
?>