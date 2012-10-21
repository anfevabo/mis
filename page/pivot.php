<?php
class page_pivot extends Page {
	function init(){
		parent::init();

		$form=$this->add('Form');
		$form->addField('DatePicker','from_date')->set('01-10-2012');//->set(date('Y-m-d'));
		$form->addField('DatePicker','to_date')->set(date('Y-m-d'));
		if($this->api->auth->model->ref('acl_id')->get('Level') == 100)
			$form->addField('dropdown','branch_id')->setEmptyText("Please, select")->setModel('Branch');
		else
			$form->addField('hidden','branch_id')->set($this->api->auth->model['branch_id']);
		if($this->api->auth->model->ref('acl_id')->get('Level') >= 50){
			$member_m=$this->add('Model_Member');
			if($this->api->auth->model->ref('acl_id')->get('Level') == 50)
				$member_m->addCondition('branch_id',$this->api->auth->model['branch_id']);
			$form->addField('dropdown','member_id')->setEmptyText("Any Members")->setModel($member_m);
		}
		else
			$form->addField('hidden','member_id')->set($this->api->auth->model->id);



		$form->addSubmit("Update");

		$str="select
			    b.name Branch,
			    m.name Member,
			    p.name Product,
			    t.sales_date,";
		foreach($this->add('Model_Product') as $prd){
			$str .= "SUM(if(t.product_id=".$prd['id'].",t.Amount,0)) ".str_replace(" ", "_", $prd['name'])."_Amt,";
			$str .= "SUM(if(t.product_id=".$prd['id'].",t.Qty,0)) ".str_replace(" ", "_", $prd['name'])."_Qty,";
			if($prd['is_renewable'])
				$str .= "SUM(if(t.product_id=".$prd['id'].",t.Renew,0)) ".str_replace(" ", "_", $prd['name'])."_Renew,";
		}

		$str = trim($str,",");
		
		$str .=	"
			FROM
			    (
			        SELECT
			            branch_id,
			            member_id,
			            product_id,	
			            sales_date,
			            SUM(Qty) Qty,
			            SUM(Amount) Amount,
			            SUM(Renew) Renew
			        FROM
			            sales
			        GROUP BY
			            branch_id, member_id, product_id, sales_date
			    ) t
			    JOIN
			        branches b on t.branch_id=b.id
			    JOIN
			        members m on t.member_id=m.id
			    JOIN
			        products p on t.product_id=p.id";
		
		if($_GET['filter']){
			$str .=" WHERE ";
			if($_GET['from_date'])
				$str .= " t.sales_date >= '".$_GET['from_date']."' AND";
			if($_GET['to_date'])
				$str .= " t.sales_date <= '".$_GET['to_date']."' AND";
			if($_GET['branch_id'])
				$str .= " t.branch_id = " . $_GET['branch_id'] ." AND";
			if($_GET['member_id'])
				$str .= " t.member_id = " . $_GET['member_id'] . " AND";
		}else{
			$str .=" WHERE t.branch_id=-1";
		}

		$str=trim($str,"AND");
		$str=trim($str,"WHERE ");


		$str.= " GROUP BY 
			t.branch_id, t.member_id,t.product_id,t.sales_date
			ORDER BY t.sales_date
			";

		$result=$this->api->db->dsql()->expr($str);
		$grid=$this->add('Grid');
		$grid->addColumn('text','sales_date');
		if($this->api->auth->model->ref('acl_id')->get('Level') == 100)
			$grid->addColumn('text','Branch');
		if($this->api->auth->model->ref('acl_id')->get('Level') >= 50)
			$grid->addColumn('text','Member');

		foreach($this->add('Model_Product') as $prd){
			$grid->addColumn('text',str_replace(" ", "_", $prd['name'])."_Qty");
			$grid->addColumn('money',str_replace(" ", "_", $prd['name'])."_Amt");
			if($prd['is_renewable'])
				$grid->addColumn('text',str_replace(" ", "_", $prd['name'])."_Renew");
		}
		$grid->setSource($result);

		if($form->isSubmitted()){
			$grid->js()->reload(array(
							"from_date"=>$form->get('from_date'),
							"to_date"=>$form->get('to_date'),
							'branch_id'=>$form->get('branch_id'),
							'member_id'=>$form->get('member_id'),
							"filter"=>true
							))->execute();
		}


		$chart_generator=$this->add('Button','ch_btn')->set('Generate Chart');
		$cols=$this->add('Columns');
		$lc=$cols->addColumn('span6');
		$rc=$cols->addColumn('span6');

		$ch=$rc->add('chart/Chart')
		->setTitle("Sale Comparision Chart",null,"daily sales comparision")
		->setChartType('bar')
		->setXAxisTitle("Sales date")	
		->setYAxisTitle("Sales")
		->setXAxis(array("Jan","Feb","Mar","Apr","May","jun","july","Aug","sep","oct","nov","dec"))
		->setLegendsOptions(array("layout"=>"vertical","align"=>"right","verticalAlign"=>"top"))
		;

		// $ch->options['plotOptions']['series']['stacking']='normal';
		$ch->options['chart']['type']='column';

		if($chart_generator->isClicked()){
			$ch->js()->univ()->addSeries(
										array(
											"name"=>rand(1000,9999),
											"data"=>array(
														rand(1,100),rand(1,100),rand(1,100),rand(1,100),rand(1,100),rand(1,100)
													)
										)
									)
							->execute();
		}

	}
}