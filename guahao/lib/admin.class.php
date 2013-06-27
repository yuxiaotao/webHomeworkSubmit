<?php
class admin extends mg{
  
  protected $operates;
  public $operateMenu;
  public $mainTpl;

  function __construct(){
	parent::__construct();
	
	if($_GET['o'] != 'login'){
	  if(!$this->isAdmin()){
	    alertBack('你没有访问权限！');
	  }
	}
	
	$this->tplVars['operateTitle'] = '';
	$this->tplVars['menuTitle'] = '';
	$this->tplVars['mainTitle'] = '';
	 
	$this->operates = array('matterList' => array(1,'事项列表'),
	                        'matterCheck' => array(2,'事项审核'),
							'matterPayBack' => array(3,'事项退款'),
							'matterEdit' => array(4,'事项编辑'),
							'matterDelete' => array(5,'事项删除'),
							'd1' => array(0,''),
							'userList' => array(20,'用户列表'),
							'userEdit' => array(21,'用户编辑'),
							'userLock' => array(22,'用户屏蔽'),
							'userMatter' => array(23,'用户事项'),
							'userUnlock' => array(24,'解除屏蔽'),
							'userAdminlist' => array(25,'管理员列表'),
							'userAdminadd' => array(26,'管理员添加'),
							'userAllow' => array(27,'管理员权限'),
							'userAdmindelete' => array(28,'删除管理员'),
							//'userblackip' => array(27,'禁止IP'),
							'd3' => array(0,''),
							'systemSet' => array(60,'系统设置'),
							'd4' => array(0,''),
							'managerList' => array(80,'负责人列表'),
							'managerAdd' => array(81,'负责人添加'),
							'managerDelete' => array(82,'负责人删除'),
							'd5' => array(0,''),
							'pageList' => array(100,'页面列表'),
							'pageAdd' => array(101,'页面添加'),
							'pageEdit' => array(102,'页面编辑'),
							'pageDelete' => array(103,'页面删除'),
							'pageCatlist' => array(104,'页面分类列表'),
							'pageCatadd' => array(105,'页面分类增加'),
							'pageCatedit' => array(106,'页面分类编辑'),
							'pageCatdelete' => array(107,'页面分类删除'),
							'd2' => array(0,''),
							'wordList' => array(80,'关键词列表'),
							'wordAdd' => array(81,'关键词添加'),
							'wordDelete' => array(82,'关键词删除'),
							'd6' => array(0,''),
							'orderList' => array(120,'支付记录列表'),
							'orderView' => array(121,'支付记录查看'),
							'orderEdit' => array(122,'支付记录查看'),
							'orderDelete' => array(123,'支付记录删除'),
							'orderSetpay' => array(124,'更改支付状态'),
							'd7' => array(0,''),
							'homeDisplay' => array(900,'运营概览'),
							);
	$this->checkSafe();
	
	$this->tplVars['mainNav'] = array(array('1','挂号管理','?m=appoint&o=list'),
		                             array('2','用户管理','?m=user&o=list'),
		                             array('3','科室管理','?m=room&o=list'),
		                             array('4','医生管理','?m=doctor&o=list'),
		                             array('5','系统设置','?m=system&o=set&p=set,basic'));
  }
  
  
  //重写
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
			     $u = $this->db->selectOne('admin',"`uid` = '".$s['uid']."'");
				 if($u){
				   $s = array_merge($s,$u);
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
 
  
  function adminMsg($msg,$goto = ''){
    $this->tplVars['mainTitle'] = '操作提醒';
    $this->mainTpl = 'msg';
    $this->tplVars['msg'] = $msg;
    $this->tplVars['goto'] = empty($goto) ? (empty($_SERVER["HTTP_REFERER"]) ? 'admin.php' : $_SERVER["HTTP_REFERER"]) : $goto;;
    $this->display();
	exit();
  }
  
  function exc($method){
	  if(!method_exists($this,$method))
	    alertBack('没有这个页面！');
	  
	  $this->{$method}();
  }
  
  function checkSafe(){
	 $allow = explode(',',$this->cfg['allow']);
     if($_GET['o'] == $allow[1] && $_GET['m'] == $allow[0] && $this->db->getNum($allow[0]) > $allow[2])
	   alertBack(urldecode($this->cfg['notsafe']));
	 return true;
  }
  
  
  public  function display(){
	  
		  require_once('smarty/Smarty.class.php');
	      $this->tplVars['imgDir'] = 'tpl/admin/images/';
		  
		  $this->smarty = new Smarty;
		  $this->smarty->debugging = false;
		  $this->smarty->caching = false;
		  $this->smarty->cache_lifetime = 120;
		  $this->smarty->setTemplateDir('tpl/admin/');
          $this->smarty->setCacheDir('cache/tplcache/');
		  $this->smarty->setCompileDir('cache/tpl_c/');
		  $this->smarty->setPluginsDir(array('lib/smarty/plugins','lib/smarty/mg'));
		  foreach($this->tplVars as $k => $v)
			  $this->smarty->assign($k,$v);
		   if($this->tplVars['cfg']['showexttime']){
			   $microtime = explode(' ',microtime());
			   $this->smarty->assign('excTime', '执行耗时'.((str_replace('0.','',$microtime[0]) - MICROTIME) / 100000).'毫秒');
		   }
           else
			   $this->smarty->assign('excTime', '');
		   $this->smarty->assign('sqls', '<p id="sqls">'.$this->tplVars['sqls']."</p>");

           $this->smarty->display('header.htm');
           $this->smarty->display($this->mainTpl.'.htm');
           $this->smarty->display('footer.htm');

  }
  
  function confirm($msg,$url){
           $this->tplVars['msg'] = $msg;
           $this->tplVars['url'] = $url;
		   $this->tplVars['mainTitle'] = '操作提醒';
		   $this->mainTpl = 'confirm';
		   $this->display();
		   exit();
  }

  function _matterOperate($matter){
	 $operate = '';
	 if($matter['do'] != 4 && $matter['do'] != 6)
	    $operate .= ' <a href="?m=matter&o=edit&p=mid,'.$matter['mid'].'" class="edit">编辑</a> ';
	 if($matter['check'] == 0){
	 }
	 elseif($matter['check'] == 1)
	   $operate .= '<a href="?m=matter&o=check&p=mid,'.$matter['mid'].'">审核</a>';
	 elseif($matter['pay'] == 2)
	   $operate .= '退款';
	 if($matter['pay'] == 0)
	   $operate .= ' <a href="?m=matter&o=delete&p=mid,'.$matter['mid'].'" class="delete">删除</a>';
	 return $operate;
  }
  

}
?>