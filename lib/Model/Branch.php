<?php
class Model_Branch extends Model_BranchAll{
	function init(){
		parent::init();
		$this->addCondition('is_active',true);
	}
}