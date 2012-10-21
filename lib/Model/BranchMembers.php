<?php
class Model_BranchMembers extends Model_Member {
	function init(){
		parent::init();
		$this->addCondition('branch_id',$this->api->auth->model['branch_id']);
	}
}