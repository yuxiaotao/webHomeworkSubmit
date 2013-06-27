<?php
class home extends mg{
  

  function __construct(){
    parent::__construct();
	if($this->session['uid'] > 0){
	  header("Location:?m=room&o=list");
	  exit();
	}
  }
  
  function homeDisplay(){
    $this->tplName = 'homeDisplay';
	$this->tplVars['htmlTitle'] = '网上挂号平台';
  }

}
?>