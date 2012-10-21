<?php
class page_report extends Page {
		function init(){
			parent::init();
			$allow_edit=false;
			$allow_add=false;
			$allow_delete=false;

			// $this->add('H2')->set($this->api->auth->model->ref('acl_id')->get('Level'));

			if($this->api->auth->model->ref('acl_id')->get('Level') == 100){
				$allow_add=true;
				$allow_edit=true;
				$allow_delete=true;
			}elseif($this->api->auth->model->ref('acl_id')->get('Level') > 25){
				$allow_edit=true;
			}

			$form=$this->add('Form');
			$crud=$this->add('CRUD',array('allow_add'=>false,'allow_edit'=>$allow_edit,'allow_del'=>$allow_delete));

			$m=$this->add('Model_Sale');

			if($_GET['filter']){
				$this->api->stickyGET('filter');
				$this->api->stickyGET('branch_id');
				$this->api->stickyGET('member_id');
				$this->api->stickyGET('product_id');
				$this->api->stickyGET('from_date');
				$this->api->stickyGET('to_date');

				$m->addCondition('branch_id','like',$_GET['branch_id']);
				$m->addCondition('member_id','like',$_GET['member_id']);
				$m->addCondition('product_id','like',$_GET['product_id']);
				if($_GET['from_date'] != "")
					$m->addCondition('sales_date' ,'>=', $_GET['from_date']);
				
				if($_GET['to_date'] != "")
					$m->addCondition('sales_date' ,'<=', $_GET['to_date']);

				// $m->debug();

			}else{
				$m->addCondition('branch_id',$this->api->auth->model['branch_id']);
				$m->addCondition('member_id',$this->api->auth->model->id);
			}
			
			$crud->setModel($m,array('member','product','Qty','Amount','Renew','sales_date'),array('branch', 'member','product','Qty','Amount','Renew','sales_date'));

			if($this->api->auth->model->ref('acl_id')->get('Level') >= 100){
				$branch_field=$form->addField('dropdown','branch_id')->setEmptyText("All branch");
				$branch_field->setModel('Branch');
			}else{
				$branch_field=$form->addField('hidden','branch_id')->set($this->api->auth->model['branch_id']);
			}
				
			if($this->api->auth->model->ref('acl_id')->get('Level') >= 50){
				$form_member=$this->add('Model_Member');
				if($this->api->auth->model->ref('acl_id')->get('Level') == 50){
					$form_member->addCondition('branch_id',$this->api->auth->model['branch_id']);
				}
				$member_field=$form->addField('dropdown','member_id')->setEmptyText("All Members");
				$member_field->setModel($form_member);
			}else{
				$form->addField('hidden','member_id')->set($this->api->auth->model->id);
			}

			$form->addField('dropdown','product_id')->setEmptyText("All Products")->setModel('Product');
			$form->addField('DatePicker','from_date')->set(date('Y-m-d'));
			$form->addField('DatePicker','to_date')->set(date('Y-m-d'));
			$form->addSubmit("Search Sales");

			$crud->add('misc/Export');

			if($form->isSubmitted()){
				$branch = ($form->get('branch_id') == null) ? "%": $form->get('branch_id');
				$member = ($form->get('member_id') == null) ? "%": $form->get('member_id');
				$product = ($form->get('product_id') == null) ? "%" : $form->get('product_id');

				$crud->js()->reload(array(
								"branch_id"=>$branch,
								'member_id'=>$member,
								'product_id' => $product,
								'from_date'=> $form->get('from_date'),
								'to_date'=> $form->get('to_date'),
								'filter'=>1
								))->execute();


				$form->js(null,$form->js()->reload())->univ()->successMessage("Entry Saved")->execute();
			}
		}
	}	