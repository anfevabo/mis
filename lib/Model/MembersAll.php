<?php
class Model_MembersAll extends Model_Table{
		var $table="members";
	function init(){
		parent::init();

		$this->hasOne('Branch','branch_id')->mandatory("Branch is must for any member");
		$this->addField('name')->mandatory("Name is Must");
		$this->addField('username')->mandatory("Username is Must");
		$this->addField('password')->mandatory("Password is Must");
		$this->addField('joined_on')->display(array('form'=>'DatePicker','grid'=>'text'))->defaultValue(null)->mandatory("Joining Date is Must");
		$this->addField('is_active')->type('boolean')->defaultValue(true);
		$this->hasOne('Acl','acl_id')->mandatory("Please Specify Staff Access Level");
	}


}