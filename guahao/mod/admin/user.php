<?php
class user extends admin{


  function __construct(){
    parent::__construct();
	$this->tplVars['menuTitle'] = '用户管理';
	$this->tplVars['currentMenu'] = 2;
	$this->tplVars['operateMenu'] = array('用户管理' => '?m=user&o=list','添加用户' => '?m=user&o=add','管理员' => '?m=user&o=admin');
	
  }
  
  function userLogin(){
	if($this->session['uid'] > 0){
	  if(!empty($this->session['admin']))
	    header("Location:?m=appoint&o=list");
	    exit();
	}
    if(isset($_POST['submit'])){
      if(empty($_POST['checknum'])  || $_POST['checknum'] != $this->session["checknum"]){
        alertBack('验证码错误！');
	  }
      if(empty($_POST['username']))
        alertBack('请输入用户名！');
      if(empty($_POST['password']))
        alertBack('请输入密码');
      $user = $this->db->selectOne('admin',"`username` = '".$this->safe->strSafe($_POST['username'])."' AND `password` = '".md5($_POST['password'])."'");
      if(!$user)
        alertBack('用户名或密码错误！');
      $this->db->deleteDate('session',"`time` < ".(time() - $this->cfg['lifetime']));
      $this->db->deleteDate('session',"`uid` = ".$user['uid']." OR `sid` = '".$this->session['sid']."'");
      $this->db->insertDate('session',array('sid' => $this->session['sid'],'ip' => $this->session['ip'],'uid' => $user['uid'],'time' => time()));
	  header("Location:?m=appoint&o=list");
      exit();
	}
	exit(file_get_contents('tpl/admin/userLogin.htm'));
  }

  function userList(){
	$pagesize = 10;
	$this->tplVars['mainTitle'] = '用户管理';
	$this->url = '?m=user&o=list&p=';
	$urls = array();
	$limit = $this->getLimit($pagesize);
	$rows = $this->db->selectDate('user','','',$limit,'addtime');
	$pages = '';
    if($rows){
	  $allnum = $this->db->getNum('user');
	  $pages = $this->createPages($this->p['page'],$allnum,$pagesize);
	}
	$this->mainTpl = 'userList';
	$this->tplVars['list'] = $rows;
	$this->tplVars['pages'] = $pages;
  }

  function userAdmin(){
	$this->tplVars['mainTitle'] = '管理员';
	$this->mainTpl = 'userAdmin';
	if(isset($_POST['submit'])){
	  if(empty($_POST['password']))
	    $this->adminMsg('管理员密码不能为空！');
	  if(empty($_POST['password2']))
	    $this->adminMsg('确认密码不能为空！');
	  if($_POST['password'] != $_POST['password2'])
	    $this->adminMsg('两次输入的密码不一致！');
	  if(strlen($_POST['password']) < 6)
	    $this->adminMsg('管理员密码不能短于6位！');
	  if(strlen($_POST['password']) > 12)
	    $this->adminMsg('管理员密码不能超过12位！');
	  $this->db->updateDate('admin','',array('password' => md5($_POST['password'])));
	  $this->adminMsg('管理员密码修改成功！');
	}

  }
  
  function userAdd(){
	if(!empty($this->p['uid'])){
	  $user = $this->db->selectOne('user','`uid` = '.$this->safe->intSafe($this->p['uid']));
	  if(!$user)
	    $this->adminMsg('没有这个用户的记录！');
	  $this->tplVars['mainTitle'] = '编辑用户';
	}
	else{
	  $this->tplVars['mainTitle'] = '添加用户';
	  $user = array('uid' => '','truename' => '','id' => '','gender' => '','tel' => '','mobile' => '','type' => '','birthday' => '','address' => '','result' => '');
	}
	  
	$this->mainTpl = 'userAdd';
	$this->tplVars['msg'] = array('uid' => '','truename' => '','id' => '','gender' => '','tel' => '','mobile' => '','type' => '','birthday' => '','address' => '','result' => '');
	if(isset($_POST['submit'])){
		
		$check = 1;
	 
	  if(empty($this->p['uid'])){
	    if(empty($_POST['uid'])){
	      $check = 0;
		  $this->tplVars['msg']['uid'] = '请填写就诊卡号';
	    }
		else{
		  $_POST['uid'] = intval($_POST['uid']);
	      if($this->db->selectOne('user','`uid` = '.$_POST['uid'])){
	        $check = 0;
		    $this->tplVars['msg']['uid'] = '该就诊卡号已存在！';
		  }
		}
	  }

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
									 
	  $this->tplVars['user']['uid'] = empty($this->p['uid']) ? $_POST['uid'] : $user['uid'];
	  if($check){
	    if(empty($this->p['uid'])){
	      if($this->db->insertDate('user',
			                  array('uid' => $_POST['uid'],
							         'id' => $_POST['id'],
	                                 'truename' => $_POST['truename'],
									 'birthday' => $_POST['birthday'],
		                             'gender' => $_POST['gender'],
									 'mobile' => $_POST['mobile'],
	                                 'tel' => $_POST['tel'],
	                                 'type' => $_POST['type'],
	                                 'address' => $_POST['address'])
								))
	        $this->adminMsg('添加用户成功！','?m=user&o=list');
		  else{
	        $this->tplVars['msg']['result'] = '添加用户失败！';
		  }
		}
		else{
	      if($this->db->updateDate('user',
			                  '`uid` = '.$user['uid'],
			                  array('id' => $_POST['id'],
	                                 'truename' => $_POST['truename'],
									 'birthday' => $_POST['birthday'],
		                             'gender' => $_POST['gender'],
									 'mobile' => $_POST['mobile'],
	                                 'tel' => $_POST['tel'],
	                                 'type' => $_POST['type'],
	                                 'address' => $_POST['address']),
			                  1)
		  )
	        $this->tplVars['msg']['result'] = '编辑用户成功！';
		  else
	        $this->tplVars['msg']['result'] = '添加用户失败！';
		  
		}
	  }
	  
									 
	  
	}
	else{
	  $this->tplVars['user'] = $user;
	}
	
  }  
  
  function userEdit(){
	  $this->userAdd();
  }  
  
  
  function userDelete(){
    if(empty($this->p['uid']))
	  $this->adminMsg('参数丢失！');
	$user = $this->db->selectOne('user','`uid` = '.$this->safe->intSafe($this->p['uid'],8));
	if(!$user)
	  $this->adminMsg('没有这个用户的记录！');
    $this->db->deleteDate('user','`uid` = '.$user['uid'],1);
    $this->db->deleteDate('appoint','`uid` = '.$user['uid']);
	$this->adminMsg('删除会员成功！','?m=user&o=list');
  }
  


}
?>