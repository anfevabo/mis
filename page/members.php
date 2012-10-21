<?php
class page_members extends Page {
	function init(){
		parent::init();
		
		$allow_edit=false;
		$allow_add=false;
		$allow_delete=false;

		// $this->add('H2')->set($this->api->auth->model->ref('acl_id')->get('Level'));

		if($this->api->auth->model->ref('acl_id')->get('Level') == 100){
			$allow_add=true;
			$allow_edit=true;
			$allow_delete=true;
		}elseif($this->api->auth->model->ref('acl_id')->get('Level') > 25){
			$allow_edit=true;
		}

		$model=$this->add('Model_Member');

		if($this->api->auth->model->ref('acl_id')->get('Level') != 100)
			$model->addCondition('branch_id',$this->api->auth->model['branch_id']);

		$crud=$this->add('CRUD',array('allow_edit'=>$allow_edit,'allow_del'=>$allow_delete,'allow_add'=>$allow_add));
		$crud->setModel($model);
		
	}
}