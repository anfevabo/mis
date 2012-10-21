<?php

class page_resetall extends Page {
	function init(){
		parent::init();
		
	}

	function query($q){
		$this->api->db->dsql()->expr($q)->execute();
	}
}