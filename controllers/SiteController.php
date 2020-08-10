<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use yii\httpclient\Client;
use yii\helpers\Url;

class SiteController extends Controller {
	/**
	 * {@inheritdoc}
	 */
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['logout'],
				'rules' => [
					[
						'actions' => ['logout'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function actions() {
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'serror' => [
				'class' => 'bricksasp\base\actions\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
			'api-docs' => [
				'class' => 'genxoft\swagger\ViewAction',
				'apiJsonUrl' => \yii\helpers\Url::to(['/site/api-json'], true),
			],
			'api-json' => [
				'class' => 'genxoft\swagger\JsonAction',
				'dirs' => [
                    Yii::getAlias('@bricksasp/base'),
					Yii::getAlias('@bricksasp/spu'),
					Yii::getAlias('@bricksasp/cms'),
					Yii::getAlias('@bricksasp/shop'),
					Yii::getAlias('@bricksasp/order'),
					Yii::getAlias('@bricksasp/rbac'),
					Yii::getAlias('@bricksasp/worker'),
					Yii::getAlias('@bricksasp/api'),
					Yii::getAlias('@bricksasp/member'),
					Yii::getAlias('@bricksasp/promotion'),
				],
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex() {
		return $this->render('index');
	}

	/**
	 * Login action.
	 *
	 * @return Response|string
	 */
	public function actionLogin() {
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		}

		$model->password = '';
		return $this->render('login', [
			'model' => $model,
		]);
	}

	/**
	 * Logout action.
	 *
	 * @return Response
	 */
	public function actionLogout() {
		Yii::$app->user->logout();

		return $this->goHome();
	}

	/**
	 * Displays contact page.
	 *
	 * @return Response|string
	 */
	public function actionContact() {
		$model = new ContactForm();
		if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
			Yii::$app->session->setFlash('contactFormSubmitted');

			return $this->refresh();
		}
		return $this->render('contact', [
			'model' => $model,
		]);
	}

	/**
	 * Displays about page.
	 *
	 * @return string
	 */
	public function actionAbout() {
		return $this->render('about');
	}

	/**
	 * 下单接口
	 * @return json
	 */
	public function actionCreateOrder()
	{
		$baseurl = 'http://8.210.135.205:30103';
		$AppID = '88894a63b2b24e26803780021889c7a4';
		$Secret = 'a171b3a88b5d926d4b1bcdbfa3bd3f6c01881da61bccedc267398e92c13e0052';
		$data = [
			'Amount'=>'50000',
			'PayChannel'=>'XY',
			'ApplyAmt'=>'50000', 
			'AppID'=>$AppID, 
			'OrderCode'=>'testa-002' ,
			'CreateTime'=>'2020-07-07 17:40:00' , 
			'NotifyUrl' => Url::to('site/callback','http'), 
			'OutUserId'=>'88888'
		];
		$signdata = $data;
		
		krsort($signdata);
		$signdata = array_values($signdata);
		$signdata[] = $Secret;
		$data['Sign'] = strtolower(md5(implode('', $signdata)));
		// var_export($data);exit();
		$url = $baseurl . '/api/BzApi/OrderCreate';

		$client = new Client();
		$response = $client->createRequest()
		    ->setMethod('POST')
    		->setFormat(Client::FORMAT_JSON)
		    ->setUrl($url)
		    ->setData($data)
		    ->send();
		if ($response->isOk) {
		    $res = $response->data;
		    echo "<pre>";
		    var_export($res);
		}
	}
}
