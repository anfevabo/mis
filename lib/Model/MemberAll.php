<?php
class Model_MemberAll extends Model_Table{
		var $table="members";
	function init(){
		parent::init();

		$this->hasOne('branch','branch_id');
		$this->addField('name')->mandatory("Name is Must");
		$this->addField('username')->mandatory("Username is Must");
		$this->addField('password')->mandatory("Password is Must");
		$this->addField('joined_on')->mandatory("Joining Date is Must");
		$this->addField('is_active')->type('boolean')->defaltValue(true);



	}


}