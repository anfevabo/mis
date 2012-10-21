<?php
class page_actlicense extends Page{
	function init(){
		parent::init();
		$form=$this->add('Form');
		$form->addField('line','license');
		$form->addSubmit('Activate');

		if($form->isSubmitted()){
			if($form->get('license') == 'XBCCS')
			{
				$m=$this->add('Model_License');
				$m->tryLoadAny();
				$m['license']='XBCCS';
				$m->save();
				$form->js()->univ()->successMessage('Licence Activated')->execute();
			}else{
				$form->js()->univ()->errorMessage('Licence Not Valid')->execute();
			}
		}
	}
}