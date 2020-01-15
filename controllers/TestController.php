<?php

namespace app\controllers;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	echo strtotime('2019-10-10');
    	echo "<br>";
    	echo strtotime('2019-10-10 + 1day') - 1;
    	echo "<br>";
    	echo date('Y-m-d H:i:s',1570751999);
    }

}
