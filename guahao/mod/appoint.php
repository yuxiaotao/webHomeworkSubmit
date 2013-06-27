<?php
class appoint extends mg{

  function __construct(){
    parent::__construct();
	if($this->session['uid'] == 0)
	  alertGoto('./','请先登录系统！');
  }  
  
  function appointAdd(){
	  if(empty($this->p['sid']) || empty($this->p['date']))
	    alertBack('参数不全！');
	  if($this->db->getNum('appoint','`uid` = '.$this->session['uid'].' AND `addtime` > '.mktime(0,0,0,date('m',TIME),date('d',TIME),date('Y',TIME))) >= $this->cfg['maxAppointTimes'])
	    alertBack('很抱歉，一天最多只能挂号'.$this->cfg['maxAppointTimes'].'次！');
	  $schedule = $this->db->selectOne('schedule',"`sid` = '".intval($this->p['sid'])."'");
	  if(!$schedule)
	    alertBack('非法操作！');
	  if(strlen($this->p['date']) != 10)
	    alertBack('非法操作！');
	  if($this->p['date'] < date('Y-m-d',TIME + 24 * 3600))
	    alertBack('非法操作！');
	  if($this->p['date'] > date('Y-m-d',TIME + $this->cfg['appointDay'] * 24 * 3600))
	    alertBack('非法操作！');
	  if($schedule['week'] != getWeek($this->p['date']))
	    alertBack('非法操作！');
		  
	  if(empty($_POST['submit'])){
	    $this->tplVars['htmlTitle'] = '选择来院时间';
		$this->tplName = 'appointTime'; 
	    $this->tplVars['mins'] = array();
		for($i= 0;$i < 60;$i++)
		 $this->tplVars['mins'][] = $i;
	    $this->tplVars['hours'] = array();
		if($schedule['noon'] == '上午'){
		  $s = 9;$f = 12;
		}
		else{
		  $s = 14;$f = 17;
		}
		for($i = $s;$i <= $f;$i++)
	      $this->tplVars['hours'][$i] = $i;
	    $this->tplVars['htmlTitle'] = '选择来院时间';
	    $this->tplVars['schedule'] = $schedule;
		$this->tplVars['date'] = $this->p['date'];
	  }
	  else{
	    if(empty($_POST['h']))
	      alertBack('请选择正确的时间！');
		$_POST['h'] = intval($_POST['h']);
		$_POST['m'] = @intval($_POST['m']);
		if($schedule['noon'] == '上午'){
		  if($_POST['h'] < 9 || $_POST['h'] > 12)
	        alertBack('请选择正确的时间！');
		}
		else{
		  if($_POST['h'] < 14 || $_POST['h'] > 17)
	        alertBack('请选择正确的时间！');
		}
		if($_POST['m'] < 0 || $_POST['m'] > 59)
	        alertBack('请选择正确的时间！');
		if($_POST['h'] < 10)
		  $_POST['h'] = '0'.$_POST['h'];
		if($_POST['m'] < 10)
		  $_POST['m'] = '0'.$_POST['m'];
		
	    $this->db->insertDate('appoint',array('uid' => $this->session['uid'],'rid' => $schedule['rid'],'did' => $schedule['did'],'day' => $this->p['date'],'noon' => $schedule['noon'],'time' => $_POST['h'].':'.$_POST['m'],'state' => 1,'addtime' => TIME));
	    $room = $this->db->selectOne('room',"`rid` = ".$schedule['rid']);
	    $doctor = $this->db->selectOne('doctor',"`did` = ".$schedule['did']);
	    $this->sendMsg($this->session['mobile'],'尊敬的'.$this->session['truename'].'，您已成功通过网上预约平台完成挂号操作，预约科室：'.$room['name'].'，预约医生'.$doctor['name'].'，预约日期：'.$this->p['date'].'，时间段：'.$schedule['noon'].$_POST['h'].':'.$_POST['m'].'。请如期赴我院到诊。');
	    alertGoto('?m=appoint&o=list','在线预约成功！');
	  }
  }
  
  function appointList(){

	$pagesize = 10;
	$this->tplVars['htmlTitle'] = '预约记录';
	$this->url = '?m=appoint&o=list&p=';
	
	$limit = $this->getLimit($pagesize);
	$rows = $this->db->selectDate('appoint','`uid` = '.$this->session['uid'],'',$limit,'day');
	$pages = '';
    if($rows){
	  for($i = 0;$i < count($rows);$i++){
	    $rows[$i]['week'] = getWeek($rows[$i]['day']);
	    $rows[$i]['room'] = $this->db->selectOne('room','`rid` = '.$rows[$i]['rid']);
	    $rows[$i]['doctor'] = $this->db->selectOne('doctor','`did` = '.$rows[$i]['did']);
	  }
	  $allnum = $this->db->getNum('appoint','`uid` = '.$this->session['uid']);
	  $pages = $this->createPages($this->p['page'],$allnum,$pagesize);
	}
	$this->tplName = 'appointList';
	$this->tplVars['list'] = $rows;
	$this->tplVars['pages'] = $pages;
  }
  
  function appointCancel(){
	
	
	  if(empty($this->p['aid']))
	    alertBack('参数不全！');
	  $appoint = $this->db->selectOne('appoint','`aid` = '.intval($this->p['aid']).' AND `uid` = '.$this->session['uid'].' AND `state` = 1');
	  if(!$appoint)
	    alertBack('非法操作！');
	  $this->db->updateDate('appoint','`aid` = '.$appoint['aid'].' AND `state` = 1',array('state' => 3),1);
	  $room = $this->db->selectOne('room',"`rid` = ".$appoint['rid']);
	  $doctor = $this->db->selectOne('doctor',"`did` = ".$appoint['did']);
	  $this->sendMsg($this->session['mobile'],'尊敬的'.$this->session['truename'].'，您已成功通过网上预约平台取消了挂号操作，预约科室：'.$room['name'].'，预约医生'.$doctor['name'].'，预约日期：'.$appoint['day'].'，时间段：'.$appoint['noon'].'。');
	  alertGoto('?m=appoint&o=list','取消预约成功！');
	
  }

}
?>