<?php
class Model_Acl extends Model_Table {
	var $table= "acl";
	function init(){
		parent::init();
		$this->addField('name');
		$this->addField('Level');
		$this->hasMany('Member','acl_id');
	}
}