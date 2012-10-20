<?php 
class Model_product extends Model_ProductAll{
	function init(){
		parent::init();
		$this->addCondition('is_active',true);
	}
}