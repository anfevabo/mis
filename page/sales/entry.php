<?php

class page_sales_entry extends Page {
	function init(){
		parent::init();

		$form=$this->add('Form');
		$branch_m = $this->add('Model_Branch');
		$member_m =$this->add('Model_Member');

		if($this->api->auth->model->ref('acl_id')->get('Level') == 100){
			$form->addField('dropdown','branch_id')->setNotNull()->setEmptyText("Please, select")->setModel($branch_m);
		}else{
			$form->addField('hidden','branch_id')->set($this->api->auth->model['branch_id']);
			$member_m->addCondition('branch_id',$this->api->auth->model['branch_id']);
		}

		if($this->api->auth->model->ref('acl_id')->get('Level') >= 50)
			$form->addField('dropdown','member_id')->setNotNull()->setEmptyText("Please, select")->setModel($member_m);
		else
			$form->addField('hidden','member_id')->set($this->api->auth->model->id);

		$form->addField('dropdown','product_id')->setNotNull()->setEmptyText("Please, select")->setModel('Product');
		$form->addField('line','Qty');
		$form->addField('line','Amount');
		$form->addField('line','Renew');

		if($this->api->auth->model->ref('acl_id')->get('Level') >= 50)
			$form->addField('DatePicker','sales_date')->set(date('Y-m-d'));


		$form->addSubmit("Enter Sales");

		if($form->isSubmitted()){

			$member=$this->add('Model_Member');
			$member->load($form->get('member_id'));


			if($form->get('branch_id') != $member['branch_id']) $form->displayError('member_id',"Member is not under selected branch");


			$s=$this->add('Model_Sale');
			$s['branch_id']=$form->get('branch_id');
			$s['member_id']=$form->get('member_id');
			$s['product_id']=$form->get('product_id');
			$s['Qty']=$form->get('Qty');
			$s['Amount']=$form->get('Amount');
			$s['Renew']=$form->get('Renew');
			$s['sales_date']=$form->get('sales_date');
			$s->save();

			$form->js(null,$form->js()->reload())->univ()->successMessage("Entry Saved")->execute();
		}

	}
}