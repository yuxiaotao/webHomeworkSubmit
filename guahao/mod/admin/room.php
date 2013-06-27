<?php
class room extends admin{


  function __construct(){
    parent::__construct();
	$this->tplVars['menuTitle'] = '科室管理';
	$this->tplVars['currentMenu'] = 3;
	$this->tplVars['operateMenu'] = array('科室列表' => '?m=room&o=list','增加一个科室' => '?m=room&o=add');
  }

  function roomList(){
	$pagesize = 20;
	$this->tplVars['mainTitle'] = '科室列表';
	$this->url = '?m=room&o=list&p=';
	$limit = $this->getLimit($pagesize);
	$rows = $this->db->selectDate('room','','',$limit);
	$pages = '';
    if($rows){
	  $allnum = $this->db->getNum('room');
	  $pages = $this->createPages($this->p['page'],$allnum,$pagesize);
	}
	$this->mainTpl = 'roomList';
	$this->tplVars['list'] = $rows;
	$this->tplVars['pages'] = $pages;
  }
  
  
  function roomAdd(){
	
	if($_GET['o'] == 'add'){
	   $this->tplVars['mainTitle'] = '增加一个科室';
	   $this->tplVars['room'] = array('name' => '','intro' => '');
	}
	elseif($_GET['o'] == 'edit'){
	  if(empty($this->p['rid']))
	    $this->adminMsg('参数不全！');
	  $room = $this->db->selectOne('room',"`rid` = '".intval($this->p['rid'])."'");
	  if(!$room)
	    $this->adminMsg('没有这个科室的记录！');
	  $this->tplVars['room'] = $room;
	}
	 
	if(isset($_POST['submit'])){
	  if(empty($_POST['name']))
	    $this->adminMsg('请输入科室名称！');
	  if($_GET['o'] == 'add'){
		  if($this->db->selectOne('room',"`name` = '".$_POST['name']."'"))
		  $this->adminMsg('该科室已存在！');
	      if(!$this->db->insertDate('room',array('name' => $_POST['name'])))
	        $this->adminMsg('添加科室失败，请稍后再试！');
	      $this->adminMsg('添加科室成功！','?m=room&o=list');
	  }
	  elseif($_GET['o'] == 'edit'){
		  $this->db->updateDate('room','`rid` = '.$room['rid'],array('name' => $_POST['name'],'intro' => $_POST['intro']),1);
	      $this->adminMsg('更新科室成功！','?m=room&o=edit&p=rid,'.$room['rid']);
	  }
		
	 
	}
	$this->mainTpl = 'roomAdd';
	
  }
  
  function roomEdit(){
	  $this->roomAdd();
  }
  
  function roomDelete(){
    if(empty($this->p['rid']))
	  $this->adminMsg('参数丢失！');
	$this->p['step'] = empty($this->p['step']) ? 1 : $this->p['step'];
	if($this->p['step'] == 1)
	  $this->confirm('确定要删除这个科室吗？该科室下的所有医生和预约记录将被一并删除！','?m=room&o=delete&p=rid,'.$this->p['rid'].'|step,2');
	elseif($this->p['step'] == 2){
	  $this->db->deleteDate('room',"`rid` = '".$this->p['rid']."'",1);
	  $this->db->deleteDate('doctor',"`rid` = '".$this->p['rid']."'");
	  $this->db->deleteDate('appoint',"`rid` = '".$this->p['rid']."'");
	  $this->adminMsg('删除科室成功！','?m=room&o=list');
	}
  }


}
?>