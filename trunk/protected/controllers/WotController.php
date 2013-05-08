<?php

class WotController extends Controller
{
	public $layout='grid';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
	//		'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('index','jqgriddata'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to access all actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionPlayers()
	{
	//	$this->layout='column1';
		$this->render('players');
	}

	public function actionMedals()
	{
		$this->render('medals');
	}

	public function actionTanks()
	{
		$this->render('tanks');
	}


	public function actionJqgrid() {
		$this->render('testjqgrid');
	}

	public function actionJqgriddata() {
		$rowsCount=$_GET['rows']==0?10:$_GET['rows'];
		$page=$_GET['page']==0?1:$_GET['page'];
		$dataProvider=new CActiveDataProvider('WotPlayer', array(
			'pagination'=>array(
				'pageSize'=>$rowsCount,
				'currentPage'=>$page-1,
			),
		));
		$responce->page = $page;
		$responce->records = $dataProvider->getTotalItemCount();
		$responce->total = ceil($responce->records / $rowsCount);
		$rows = $dataProvider->getData();
		foreach ($rows as $i=>$row) {
			$responce->rows[$i]['id']=$row->getPrimaryKey();
			$responce->rows[$i]['cell']=array($row->player_id,$row->player_name);
		}
		echo json_encode($responce);
	}
}
