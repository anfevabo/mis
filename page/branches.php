<?php
class page_branches extends Page {
	function init(){
		parent::init();
		$m=$this->add('Model_Branch');

		$crud=$this->add('CRUD');
		$crud->setModel($m);
	}
}