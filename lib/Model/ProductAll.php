<?php
class Model_ProductAll extends Model_Table{
	var $table="products";
	function init(){
		parent::init();
		$this->addField('name')->mandatory("Product Name is Must");
		$this->addField('is_active')->type('boolean')->defaultValue(true);
		$this->addField('is_renewable')->type('boolean');
	}
}