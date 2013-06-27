<?php
class room extends mg{
  
  function __construct(){
    parent::__construct();
	if($this->session['uid'] == 0)
	  alertGoto('./','请先登录系统！');
  }

  
  function roomList(){
    $this->tplName = 'roomList';
	$this->tplVars['htmlTitle'] = '请选择科室';
	$this->tplVars['rooms'] = $this->db->selectDate('room');
  }
  
  function roomView(){
	if(empty($this->p['rid']))
	  alertBack('缺少参数！');
	  $room = $this->db->selectOne('room',"`rid` = '".intval($this->p['rid'])."'");
	  if(!$room)
	    $this->adminMsg('没有这个科室的记录！');
    $this->tplName = 'roomView';
	$this->tplVars['htmlTitle'] = $room['name'];
	$this->tplVars['room'] = $room;
  }
  
  function roomSelect(){
	if(empty($this->p['rid']))
	  alertBack('缺少参数！');
	$room = $this->db->selectOne('room',"`rid` = '".intval($this->p['rid'])."'");
	if(!$room)
	    $this->adminMsg('没有这个科室的记录！');
    $this->tplName = 'roomSelect';
	$this->tplVars['htmlTitle'] = '挂号'.$room['name'];
	$this->tplVars['room'] = $room;
	
	$table = '<table cellpadding="0" cellspacing="0">
	            <tbody>
				<tr>
				  <th width="80">日期</th>
				  <th width="60">时间段</th>
				  <th width="100">医生</th>
				  <th width="100">号别</th>
				  <th width="50">放号</th>
				  <th width="50">剩余</th>
				  <th>操作</th>
				</tr>';
	$noons = array('上午','下午');
	for($i = 0;$i < $this->cfg['appointDay'];$i++){
	  $day = date('Y-m-d',TIME + 24 * 3600 * ($i + 1));
	  $week = getWeek($day);
	  foreach($noons as $noon){
		$schedules = $this->db->select('SELECT s.*,d.* FROM `'.DB_pre.'schedule` AS s LEFT JOIN `'.DB_pre.'doctor` AS d ON s.did = d.did WHERE s.rid = '.$room['rid'].' AND s.week = \''.$week.'\' AND s.noon = \''.$noon.'\'');
		$doctorNum = $schedules ? count($schedules) : 0;
	    $table .= '<tr';
		if(!($i % 2))
		  $table .= ' class="tr2"';
		$table .= '>
		             <td rowspan="'.($doctorNum ? $doctorNum : 1).'">'.$day.'</td>
		             <td rowspan="'.($doctorNum ? $doctorNum : 1).'">'.$week.$noon.'</td>';
		if($doctorNum){
		  for($j = 0;$j < $doctorNum;$j++){
		    if($j != 0){
				$table .= '<tr';
				  if(!($i % 2))
				    $table .= ' class="tr2"';
				$table .= '>';
			}
			$appintNum = $this->db->getNum('appoint',"`day` = '".$day."' AND `state` = 1 AND `noon` = '".$noon."'");
			$left = $schedules[$j]['limit'] - $appintNum;
			$table .= '<td>'.$schedules[$j]['name'].'</td>
			             <td>'.$this->cfg['doctorTypes'][$schedules[$j]['type']].'</td>
			             <td>'.$schedules[$j]['limit'].'</td>
			             <td>'.$left.'</td>';
			if($left)
			  $table .= '<td><a href="javascript:confirmGo(\'?m=appoint&o=add&p=sid,'.$schedules[$j]['sid'].'|date,'.$day.'\',\'确定要挂号吗？\')">挂号</a></td>';
			else
			  $table .= '<td> 已满 </td>';
			$table .= '</tr>';
		  }
		}
		else
		  $table .= '<td colspan="5">暂无</td></tr>';
		
	  
	  }
	  
	}			  
	$table .= ' </tbody>
			  </table>';
	$this->tplVars['table'] = $table;
  }
  
  
  

}
?>