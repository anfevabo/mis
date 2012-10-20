<?php
class Model_BranchAll extends Model_Table{
	var $table="branches";
	function init(){
		parent::init();
		$this->hasOne('member','branchhead_id');
		$this->addField('name')->mandatory("Branch Name is Must");
		$this->addField('is_active')->type('boolean')->defaultValue(true);
	}
}