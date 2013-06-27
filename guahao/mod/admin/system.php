<?php
class system extends admin{


  function __construct(){
    parent::__construct();
	$this->tplVars['menuTitle'] = '系统设置';
	$this->tplVars['currentMenu'] = 5;
	$this->tplVars['operateMenu'] = array('基本设置' => '?m=system&o=set&p=set,basic','邮箱设置' => '?m=system&o=set&p=set,smtp','挂号设置' => '?m=system&o=set&p=set,appoint');
  }
  
  function systemSet(){
	  
	if(empty($this->p['set'])){
	  $this->adminMsg('参数有误');
	}
	$sets = array();
	if($this->p['set'] == 'basic'){
	  $this->tplVars['mainTitle'] = '基本设置';
	  $sets = array('sitename','domain','root','style','serviceTel','serviceQQ','serviceAdd','lifetime','autoupdate');
	
	}
	elseif($this->p['set'] == 'smtp'){
	  $this->tplVars['mainTitle'] = '邮箱设置';
	  $sets = array('smtpCount','smtpPas','smtpPort','result');
	
	}
	elseif($this->p['set'] == 'appoint'){
	  $this->tplVars['mainTitle'] = '挂号设置';
	  $sets = array('uidstart','appointDay','maxAppointTimes');
	
	}
	else
	  $this->adminMsg('参数有误');
	  
	$this->tplVars['msg'] = array();
	foreach($sets as $set){
	  $this->tplVars['msg'][$set] = '';
	}
	$this->tplVars['msg']['result'] = '';
	
	
	if(isset($_POST['submit'])){
	  $check = 1;
	  if($this->p['set'] == 'basic'){
		  $_POST['root'] = trim($_POST['root'],'/');
		  $_POST['serviceQQ'] = str_replace('，',',',$_POST['serviceQQ']);
		  $_POST['lifetime'] = intval($_POST['lifetime']);
		  $_POST['autoupdate'] = intval($_POST['autoupdate']);
		  if($_POST['lifetime'] < 1){
			$check = 0;
		    $this->tplVars['msg']['lifetime'] = '修改失败，登陆保持时间最小不能少于1分钟！';
		  }
	
	  }
	  elseif($this->p['set'] == 'smtp'){
		  
		  $_POST['lifetime'] = intval($_POST['smtpPort']);
	
	  }
	  elseif($this->p['set'] == 'appoint'){
	    foreach($_POST as $k => $v){
		  if($k == 'submit')
		    continue;
		  $_POST[$k] = intval($v);
		  if($_POST[$k] < 1){
			$check = 0;
		    $this->tplVars['msg']['result'] = '修改失败，不能出现小于1的设置！';
		  }
		}
	
	  }
	  foreach($_POST as $k => $v){
		if($k == 'submit')
		  continue;
	    $this->tplVars['set'][$k] = $v;
		if($check == 1){
		  $this->db->updateDate('setting',"`skey` = '$k'",array('svalue' => $v),1);
		  $this->tplVars['msg']['result'] = '修改成功！';
		}
	  }
	  
	}
	else{
	  $this->tplVars['set'] = $this->cfg;
	}
	$this->mainTpl = 'set'.ucfirst($this->p['set']);
	
  }  
  


}
?>