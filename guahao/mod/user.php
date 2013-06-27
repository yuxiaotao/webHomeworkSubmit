<?php
class user extends mg{
    
  function userLogin(){
	$this->goto = empty($this->goto) ? './' : $this->goto;
	if($this->session['uid'] > 0){
	  header("Location:?m=room&o=list");
	  exit();
	}
    if(isset($_POST['submit'])){
      if(empty($_POST['checknum'])  || $_POST['checknum'] != $this->session["checknum"]){
        alertBack('验证码错误');
	  }
      if(empty($_POST['uid']))
        alertBack('请输入卡号！');
      if(empty($_POST['truename']))
        alertBack('请输入真实姓名！');
      $user = $this->db->selectOne('user',"`truename` = '".$this->safe->strSafe($_POST['truename'])."' AND `uid` = '".$this->safe->intSafe($_POST['uid'])."'");
      if(!$user)
        alertBack('卡号或姓名错误！');
      $this->db->deleteDate('session',"`time` < ".(time() - $this->cfg['lifetime']));
      $this->db->deleteDate('session',"`uid` = ".$user['uid']." OR `sid` = '".$this->session['sid']."'");

      $this->db->insertDate('session',array('sid' => $this->session['sid'],'ip' => $this->session['ip'],'uid' => $user['uid'],'time' => time()));
	  header("Location:?m=room&o=list");
      exit();
	}
  }
  
  function userReg(){
	//防连续注册，同一IP地址1小时内只允许注册2个账号，24小时内注册超过5个列入黑名单90天
	if($this->session['uid'] > 0){
	  header('Location:./');
	  exit();
	}
	if($this->isBlack('reg',0,$this->session['ip'],TIME - 90 * 24 * 3600)){
	  header('Location:./');
	  exit();
	}
	$regNum = $this->db->getNum('user',"`regIp` = '".$this->session['ip']."' AND `addtime` > ".(TIME - 2 * 3600));
	if($regNum > 1){
	  $regNum = $this->db->getNum('user',"`regIp` = '".$this->session['ip']."' AND `addtime` > ".(TIME - 24 * 3600));
	  if($regNum > 4){
	    $this->addBlack('reg',0,$this->session['ip']);
	    header('Location:./');
	    exit();
	  }
	}
	
	
	
    $this->tplName = 'userReg';
	$this->tplVars['htmlTitle'] = '注册新用户';
	$this->tplVars['msg'] = array('truename' => '','id' => '','gender' => '','tel' => '','mobile' => '','type' => '','birthday' => '','address' => '','result' => '');
	$this->tplVars['user'] = array('truename' => '','id' => '','tel' => '','gender' => 1,'mobile' => '','type' => '','birthday' => '','address' => '');
	if(isset($_POST['submit'])){
	  $check = 1;
	  

	  if(empty($_POST['truename'])){
	    $check = 0;
		$this->tplVars['msg']['truename'] = '请填写真实姓名';
	  }
	  elseif(strlen($_POST['truename']) < 4){
	    $check = 0;
		$this->tplVars['msg']['truename'] = '真实姓名过短！';
	  }
	  elseif(strlen($_POST['truename']) > 15){
	    $check = 0;
		$this->tplVars['msg']['truename'] = '真实姓名过长！';
	  }
	  
	  if(empty($_POST['mobile'])){
	    $check = 0;
		$this->tplVars['msg']['mobile'] = '请输入手机号码！';
	  }
	  else{
			if(!checkTel($_POST['mobile'])){
				$check = 0;
				$this->tplVars['msg']['mobile'] = '手机号不合法！';
			}
	  }
	  
	  if(empty($_POST['id'])){
	    $check = 0;
		$this->tplVars['msg']['id'] = '请填写身份证号！';
	  }
	  elseif(!checkId($_POST['id'])){
	    $check = 0;
		$this->tplVars['msg']['id'] = '身份证号填写有误！';
	  }
	  $_POST['gender'] = empty($_POST['gender']) ? 0 : 1;
	  
	  if(empty($_POST['birthday'])){
	    $check = 0;
		$this->tplVars['msg']['birthday'] = '请选择出生年月！';
	  }
	  elseif(strlen($_POST['birthday']) != 7){
	    $check = 0;
		$this->tplVars['msg']['birthday'] = '出生年月选择有误！';
	  }
	  
	  $this->tplVars['user'] = array('truename' => $_POST['truename'],
	                                 'id' => $_POST['id'],
		                             'gender' => $_POST['gender'],
									 'birthday' => $_POST['birthday'],
	                                 'tel' => $_POST['tel'],
	                                 'mobile' => $_POST['mobile'],
	                                 'type' => $_POST['type'],
	                                 'address' => $_POST['address']);
	  if($check){
		  $last = $this->db->selectOne('user','','','uid');
		  $insertDate = array('id' => $_POST['id'],
	                                 'truename' => $_POST['truename'],
									 'birthday' => $_POST['birthday'],
		                             'gender' => $_POST['gender'],
									 'mobile' => $_POST['mobile'],
	                                 'tel' => $_POST['tel'],
	                                 'type' => $_POST['type'],
	                                 'address' => $_POST['address'],
									 'regIp' => $this->session['ip'],
									 'addtime' => TIME);
		  if($last){
		    if($last['uid'] < $this->cfg['uidstart'])
			  $insertDate['uid'] = $this->cfg['uidstart'];
		  }
		  else
			  $insertDate['uid'] = $this->cfg['uidstart'];
	    $reg = $this->db->insertDate('user',$insertDate);
									 
		if($reg){
			$send = $this->sendMsg($_POST['mobile'],'您已成功开通'.$this->cfg['sitename'].'网上预约服务，请牢记您的账号信息。卡号：'.$reg.' 姓名：'.$_POST['truename'].'。');
			$sendMsg = $send ? '（卡号信息已成功发送至您的手机）' : '（因系统原因或您的手机号码填写有误，卡号信息未能发送至您的手机）';
			alertGoto('./','注册成功，请记下您的账户信息后再点击确定！卡号：'.$reg.'，姓名：'.$_POST['truename'].'。'.$sendMsg);
		}
		$this->tplVars['msg']['result'] = '注册失败，请稍后再试！';
	  }
	  else{
	    $this->tplVars['msg']['result'] = '注册失败！';
	  }
	}
  }

  function userQuit(){
    if($this->session['uid'] != 0){
		$this->db->deleteDate('session',"`uid` = ".$this->session['uid']);
	}
	  header('Location:./');
	  exit();
  }
}
?>