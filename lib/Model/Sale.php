<?php
class Model_Sale extends Model_SalesAll {
	function init(){
		parent::init();
		$this->addCondition('is_active',true);
	}
}