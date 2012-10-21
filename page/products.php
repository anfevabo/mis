<?php
class page_products extends Page {
	function init(){
		parent::init();
		$m=$this->add('Model_ProductsAll');

		$crud=$this->add('CRUD');
		$crud->setModel($m);
	}
}