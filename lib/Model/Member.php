<?php
class Model_Member extends Model_MemberAll{

	function init(){
		parent::init();

		$this->addCondition('is_active',true);
	}
}