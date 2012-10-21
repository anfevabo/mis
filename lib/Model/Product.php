<?php 
class Model_Product extends Model_ProductsAll{
	function init(){
		parent::init();
		$this->addCondition('is_active',true);
	}
}