<?php
class Model_BranchAll extends Model_Table{
	var $table="branches";
	function init(){
		parent::init();
		// $this->hasOne('Member','branchhead_id'); //REMOVED
		$this->addField('name')->mandatory("Branch Name is Must");
		$this->addField('is_active')->type('boolean')->defaultValue(true);
		$this->hasMany('MembersAll','branch_id');

		$this->addExpression('team_count')->set(function($m,$q){
			return $m->refSQL('MembersAll')->count();
		});

		$this->addHook('beforeDelete',$this);
		$this->addHook('beforeSave',$this);
	}

	function beforeSave(){
		if(!$this->loaded()){
			
		}
	}

	function beforeDelete(){
		if($this['team_count'] > 0) throw $this->exception('This Branch has Team Memebrs, Cannot delete');
	}
}