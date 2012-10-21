<?php
class Model_SalesAll extends Model_Table{
	var $table="sales";
	function init(){
		parent::init();
		$this->hasOne('BranchAll','branch_id');
		$this->hasOne('MembersAll','member_id');
		$this->hasOne('ProductsAll','product_id')->mandatory("Product is must to select");
		$this->addField('Qty')->defaultValue(0);
		$this->addField('Amount')->defaultValue(0);
		$this->addField('Renew')->defaultValue(0);
		$this->addField('sales_date')->type('date')->defaultValue(date('Y-m-d'))->mandatory("Date is Must");
		$this->addField('is_active')->type('boolean')->defaultValue(true);

	}
}