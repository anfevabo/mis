<?php
class Model_Member extends Model_MembersAll{

	function init(){
		parent::init();

		$this->addCondition('is_active',true);
	}
}