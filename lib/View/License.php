<?php
class View_License extends View {
	function init(){
		parent::init();
		$l=$this->add('Model_License');
		$l->tryLoadAny();

		if(!$l->loaded() or $l['license']!="XBCCS"){
			// You are in demo mode
			$this->template->del('licensed');
			$this->template->trySet('validtill',$l['demo_date']);
			$this->template->trySet('code',$l['code']);

			if(strtotime($l['demo_date']) < strtotime(date('Y-m-d'))){
				// $this->add('HelloWorld',null,unlicensed);
				$this->js(true)->univ()->redirect('logout');
			}

		}else{
			// Yopu are in licened mode
			$this->template->del('unlicensed');
			
		}
	}

	function defaultTemplate(){
		return array('view/license');
	}
}