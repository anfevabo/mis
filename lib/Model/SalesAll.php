<?php
class Model_SalesAll extends Model_Table{
	var $table="sales";
	function init(){
		parent::init();
		$this->hasOne('branchAll','branch_id');
		$this->hasOne('memberAll','member');
		$this->hasOne('productAll','product_id');
		$this->addField('Qty')->mandatory("Qty is Must");
		$this->addField('Amount')->mandatory("Amount");
		$this->addField('Renew')->mandatory("Renew");
		$this->addField('sales_date')->mandatory("Date is Must");
		$this->addField('Renew')->mandatory("Renew");

	}
}