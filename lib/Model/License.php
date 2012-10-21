<?php
class Model_License extends Model_Table{
	var $table="license";
	
	function init(){
		parent::init();

		$this->addField('code');
		$this->addField('license');
		$this->addField('demo_date');
	}
}