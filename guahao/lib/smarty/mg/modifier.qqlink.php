<?php

function smarty_modifier_qqlink($qq){
	if($qq == '')
	  return '';
	$qq = explode(',',$qq);
	$r = '';
	foreach($qq as $q)
	  $r .= '<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='.$q.'&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:'.$q.':41 &r=0.5047965456319756" alt="点击这里与客服沟通" title="点击这里与客服沟通"></a> ';
	return $r;
}
?>