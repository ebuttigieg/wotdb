<?php

class SiteController extends Controller
{
	public $layout='grid';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{

		$service = Yii::app()->request->getQuery('service');
		if (isset($service)) {
			$authIdentity = Yii::app()->eauth->getIdentity($service);
			$authIdentity->redirectUrl = Yii::app()->user->returnUrl;
			$authIdentity->cancelUrl = $this->createAbsoluteUrl('site/login');

			if ($authIdentity->authenticate()) {
				$identity = new ServiceUserIdentity($authIdentity);

				// Успешный вход
				if ($identity->authenticate()) {
					Yii::app()->user->login($identity);

					// Специальный редирект с закрытием popup окна
					$authIdentity->redirect();
				}
				else {
					// Закрываем popup окно и перенаправляем на cancelUrl
					$authIdentity->cancel();
				}
			}

			// Что-то пошло не так, перенаправляем на страницу входа
			$this->redirect(array('site/login'));
		}


		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionTs()
	{
		$clientProperties=ClientProperties::model()->findAll(array(
			'select'=>'t.*,c.player_id',
			'join'=>'JOIN clients c ON c.client_id=t.id',
			'condition'=>"t.ident='client_description' AND c.player_id IS NOT NULL",
		));
		
		$sql=<<<SQL
UPDATE client_properties cp
  set cp.value=:value
  WHERE cp.id=:id AND cp.ident='client_description'
SQL;
		
		foreach ($clientProperties as $cp) {
			$wotPlayer=WotPlayer::model()->findByPk($cp->player_id);
			$wins=number_format($wotPlayer->wins/$wotPlayer->battles_count*100,2);
			$s="$wotPlayer->player_name\nWins: $wins%\nEffect: $wotPlayer->effect\nWN6: $wotPlayer->wn6";
			$s=mb_convert_encoding($s,'UTF8','CP1252');
			echo $s;
			$cp->dbConnection->createCommand($sql)->execute(array('id'=>$cp->id,'value'=>$s));
		//	break;
		}
	}
}