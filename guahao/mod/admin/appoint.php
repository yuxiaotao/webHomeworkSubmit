<?php
class appoint extends admin{

  function __construct(){
    parent::__construct();
	$this->tplVars['menuTitle'] = '预约管理';
	$this->tplVars['currentMenu'] = 1;
	$this->tplVars['operateMenu'] = array('全部预约' => '?m=appoint&o=list','已挂号' => '?m=appoint&o=list&p=state,1','已就诊' => '?m=appoint&o=list&p=state,2','已取消' => '?m=appoint&o=list&p=state,3','爽约' => '?m=appoint&o=list&p=state,4');
  }
  
  function appointList(){
	$pagesize = 10;
	$this->tplVars['mainTitle'] = '预约记录';
	$keys = array();
	$this->url = '?m=appoint&o=list&p=';
	$matters = array();
	$urls = array();
	if(!empty($this->p['state'])){
	  if($this->p['state'] == 1){
		$keys[] = '`state` = 1';
		$this->urls['state'] = 1;
	    $this->tplVars['mainTitle'] = '已挂号记录';
	  }
	  elseif($this->p['state'] == 2){
		$keys[] = '`state` = 2';
		$this->urls['state'] = 2;
	    $this->tplVars['mainTitle'] = '已就诊记录';
	  }
	  elseif($this->p['state'] == 3){
		$keys[] = '`state` = 3';
		$this->urls['state'] = 3;
	    $this->tplVars['mainTitle'] = '已取消记录';
	  }
	  elseif($this->p['state'] == 4){
		$keys[] = '`state` = 4';
		$this->urls['state'] = 4;
	    $this->tplVars['mainTitle'] = '已爽约记录';
	  }

	}
	
	
	if(!empty($this->p['did'])){
		$keys[] = "`did` = ".intval($this->p['did']);
	    $this->urls['did'] = intval($this->p['did']);
	}
	if(!empty($this->p['rid'])){
		$keys[] = "`rid` = ".intval($this->p['rid']);
	    $this->urls['rid'] = intval($this->p['rid']);
	}
	if(!empty($this->p['uid'])){
		$keys[] = "`uid` = ".intval($this->p['uid']);
	    $this->urls['uid'] = intval($this->p['uid']);
	}
	$limit = $this->getLimit($pagesize);
	$rows = $this->db->selectDate('appoint',$keys,'',$limit,'day');
	$pages = '';
    if($rows){
	  for($i = 0;$i < count($rows);$i++){
	    $rows[$i]['user'] = $this->db->selectOne('user','`uid` = '.$rows[$i]['uid']);
	    $rows[$i]['room'] = $this->db->selectOne('room','`rid` = '.$rows[$i]['rid']);
	    $rows[$i]['doctor'] = $this->db->selectOne('doctor','`did` = '.$rows[$i]['did']);
	  }
	  $allnum = $this->db->getNum('appoint',$keys);
	  $pages = $this->createPages($this->p['page'],$allnum,$pagesize);
	}
	$this->mainTpl = 'appointList';
	$this->tplVars['list'] = $rows;
	$this->tplVars['pages'] = $pages;
  }
  
  function appointEdit(){
    if(empty($this->p['aid'])){
	  $this->adminMsg('参数不全！');
	}
	$appoint = $this->db->selectOne('appoint','`aid` = '.intval($this->p['aid']));
	  if(!$appoint)
	     $this->adminMsg('非法操作！');
	if(isset($_POST['submit'])){
	  $_POST['state'] = intval($_POST['state']);
	  $this->db->updateDate('appoint','`aid` = '.$appoint['aid'],array('state' => intval($_POST['state'])),1);
	  $this->adminMsg('编辑成功！');
	}
    $this->tplVars['mainTitle'] = '编辑预约记录';
	$this->mainTpl = 'appointEdit';
    $this->tplVars['appoint'] = $appoint;
	$this->tplVars['appoint']['week'] = getWeek($this->tplVars['appoint']['day']);
    $this->tplVars['states'] = array(1 => '已挂号',2 => '已到诊',3 => '已取消',4 => '已爽约');
	$this->tplVars['user'] = $this->db->selectOne('user',"`uid` = ".$appoint['uid']);
	$this->tplVars['room'] = $this->db->selectOne('room',"`rid` = ".$appoint['rid']);
	$this->tplVars['doctor'] = $this->db->selectOne('doctor',"`did` = ".$appoint['did']);
  }
  
  function appointDelete(){
    if(empty($this->p['aid'])){
	  $this->adminMsg('参数不全！');
	}
	$appoint = $this->db->selectOne('appoint','`aid` = '.intval($this->p['aid']));
	  if(!$appoint)
	     $this->adminMsg('非法操作！');
	$this->db->deleteDate('appoint','`aid` = '.$appoint['aid'],1);
	$this->adminMsg('该预约记录已成功删除！');
  }

}
?>