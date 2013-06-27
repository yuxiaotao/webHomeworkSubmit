<?php
class doctor extends admin{


  function __construct(){
    parent::__construct();
	$this->tplVars['menuTitle'] = '医生管理';
	$this->tplVars['currentMenu'] = 4;
	$this->tplVars['operateMenu'] = array('查看全部医生' => '?m=doctor&o=list','增加一个医生' => '?m=doctor&o=add');
  }

  function doctorList(){
	$pagesize = 10;
	$this->tplVars['mainTitle'] = '查看全部医生';
	$keys = array();
	$this->url = '?m=doctor&o=list&p=';
	$urls = array();
	if(!empty($this->p['rid'])){
		$room = $this->db->selectOne('room','`rid` = '.$this->safe->intSafe($this->p['rid']));
		if(!$room)
		  $this->adminMsg('没有这个科室！');
		$keys[] = '`rid` = '.$room['rid'];
		$this->urls['rid'] = $room['rid'];
	    $this->tplVars['mainTitle'] = $room['name'].' 医生列表';

	}
	$limit = $this->getLimit($pagesize);
	$rows = $this->db->selectDate('doctor',$keys,'',$limit,'did');
	$pages = '';
    if($rows){
	  for($i = 0;$i < count($rows);$i++){
	    $rows[$i]['room'] = $this->db->selectOne('room','`rid` = '.$rows[$i]['rid']);
	  }
	  $allnum = $this->db->getNum('doctor',$keys);
	  $pages = $this->createPages($this->p['page'],$allnum,$pagesize);
	}
	$this->mainTpl = 'doctorList';
	$this->tplVars['list'] = $rows;
	$this->tplVars['pages'] = $pages;
  }
  
  function doctorAdd(){
	$days = array('周日','周一','周二','周三','周四','周五','周六');
	$this->tplVars['msg'] = array('name' => '',
	                              'rid' => '',
	                              'type' => '',
								  'result' => '');
	if(!empty($this->p['did'])){
	   $this->tplVars['mainTitle'] = '编辑一个医生';
	   $this->tplVars['doctor'] = $this->db->selectOne('doctor','`did` = '.$this->safe->intSafe($this->p['did'],10));
	   if(!$this->tplVars['doctor'])
		 $this->adminMsg('没有这个医生的记录！');
	   $this->tplVars['doctor']['schedules'] = array();
	   if(!isset($_POST['submit'])){
	     $schedules = $this->db->selectDate('schedule','`rid` = '.$this->tplVars['doctor']['rid'].' AND `did` = '.$this->tplVars['doctor']['did']);
	     if($schedules){
	       foreach($schedules as $schedule)
		     $this->tplVars['doctor']['schedules'][$schedule['week'].$schedule['noon']] = $schedule['limit'];
		 }
	   }
	 }
	 else{
	   $this->tplVars['mainTitle'] = '增加一个医生';
	   $this->tplVars['doctor'] = array('rid' => 0,
	                                 'type' => '',
									 'name' => '',
									 'schedules' => array());
	 }
	 
	if(isset($_POST['submit'])){
	  $check = 1;
	  if(empty($_POST['name'])){
		 $check = 0;
		 $this->tplVars['msg']['name'] = '请填写医生姓名！';
	  }
	  elseif(strlen($_POST['name']) > 100){
		 $check = 0;
		 $this->tplVars['msg']['name'] = '姓名字数过长！！';
	  }
	  if(empty($_POST['rid'])){
		 $check = 0;
		 $this->tplVars['msg']['rid'] = '请选择医生所属科室！';
	  }
	  else{
	    $room = $this->db->selectOne('room','`rid` ='.$this->safe->intSafe($_POST['rid'],4));
		if(!$room){
		  $check = 0;
		  $this->tplVars['msg']['rid'] = '科室选择有误！';
		}
		else{
		  $this->tplVars['doctor']['rid'] = $_POST['rid'];
		}
	  }
	  for($i= 0;$i < 7;$i++){
	    if(!empty($_POST['aam'.$i])){
		  $this->tplVars['doctor']['schedules'][$days[$i].'上午'] = intval($_POST['aam'.$i]);
		}
		if(!empty($_POST['apm'.$i])){
		  $this->tplVars['doctor']['schedules'][$days[$i].'下午'] = intval($_POST['apm'.$i]);
		}
	  }
	  if($check){
		if(empty($this->tplVars['doctor']['did'])){
	      $did = $this->db->insertDate('doctor',array('name' => $_POST['name'],'rid' => $_POST['rid'],'type' => $_POST['type']));
		  if($did){
			 if(!empty($this->tplVars['doctor']['schedules']))
			   foreach($this->tplVars['doctor']['schedules'] as $time => $limit)
			     $this->db->insertDate('schedule',array('rid' => $_POST['rid'],'did' => $did,'week' => substr($time,0,6),'noon' => substr($time,6,6),'limit' => $limit));
			 $this->adminMsg('恭喜你，添加医生成功！','?m=doctor&o=list');
		  }
		  else
		    $this->tplVars['msg']['result'] = '医生添加失败，请稍后再试！';
		}
		else{
		  $this->db->updateDate('doctor','`did` = '.$this->tplVars['doctor']['did'],array('name' => $_POST['name'],'rid' => $_POST['rid'],'type' => $_POST['type']));
		  $this->db->deleteDate('schedule','`rid` = '.$this->tplVars['doctor']['rid'].' AND `did` = '.$this->tplVars['doctor']['did']);
		  foreach($this->tplVars['doctor']['schedules'] as $time => $limit)
			 $this->db->insertDate('schedule',array('rid' => $this->tplVars['doctor']['rid'],'did' => $this->tplVars['doctor']['did'],'week' => substr($time,0,6),'noon' => substr($time,6,6),'limit' => $limit));
		  $this->tplVars['msg']['result'] = '编辑医生成功！';
		}
	  }
	  $this->tplVars['doctor']['name'] = $_POST['name'];
	  $this->tplVars['doctor']['rid'] = $_POST['rid'];
	  $this->tplVars['doctor']['type'] = $_POST['type'];
	}
	$rooms = $this->db->selectDate('room');
	foreach($rooms as $room)
	  $this->tplVars['rooms'][$room['rid']] = $room['name'];
	$this->mainTpl = 'doctorAdd';
	
	$this->tplVars['schedules'] = '';
	for($i = 0;$i < 7;$i++){
	  $this->tplVars['schedules'] .= $days[$i].'上午 <input type="text" name="aam'.$i.'" value="';
	  if(empty($this->tplVars['doctor']['schedules'][$days[$i].'上午']))
	    $this->tplVars['schedules'] .= '0';
	  else
	    $this->tplVars['schedules'] .= $this->tplVars['doctor']['schedules'][$days[$i].'上午'];
	  $this->tplVars['schedules'] .= '" /> ';
	  
	  $this->tplVars['schedules'] .= $days[$i].'下午 <input type="text" name="apm'.$i.'" value="';
	  if(empty($this->tplVars['doctor']['schedules'][$days[$i].'下午']))
	    $this->tplVars['schedules'] .= '0';
	  else
	    $this->tplVars['schedules'] .= $this->tplVars['doctor']['schedules'][$days[$i].'下午'];
	  $this->tplVars['schedules'] .= '" /><br />';
	  
	}
	
  }
  
  function doctorEdit(){
    $this->doctorAdd();
  }

  
  function doctorDelete(){
    if(empty($this->p['did']))
	  $this->adminMsg('参数丢失！');
	$this->p['step'] = empty($this->p['step']) ? 1 : $this->p['step'];
	if($this->p['step'] == 1)
	  $this->confirm('确定要删除这个医生吗？','?m=doctor&o=delete&p=did,'.$this->p['did'].'|step,2');
	elseif($this->p['step'] == 2){
	  $doctor = $this->db->deleteDate('doctor','`did` = '.$this->safe->intSafe($this->p['did']),1);
	  $this->adminMsg('删除医生成功！','?m=doctor&o=list');
	}
  }


}
?>