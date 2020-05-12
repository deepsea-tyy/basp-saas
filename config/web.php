<?php

require __DIR__ . '/bootstrap.php';
$params = require __DIR__ . '/params.php';
$modules = require __DIR__ . '/modules.php';
$route = require __DIR__ . '/route.php';
$translations = require __DIR__ . '/translations.php';

$config = [
	'id' => 'bricksasp',
	'basePath' => dirname(__DIR__),
	'language' => 'zh-CN',
	'bootstrap' => ['log'],
	'aliases' => [
		'@bower' => '@vendor/bower-asset',
		'@npm' => '@vendor/npm-asset',
	],
	'components' => [
		'authManager' => [
			'class' => 'bricksasp\rbac\components\DbManager',
			'defaultRoles' => [],
		],
		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'enableCsrfValidation' => false,
			'cookieValidationKey' => 'KX9LImlfspRCg6eiNJ5pUQ1Mu5ltFvp0',
			'parsers' => [
				'application/json' => 'yii\web\JsonParser',
				'text/json' => 'yii\web\JsonParser',
			],
		],
		'user' => [
			'identityClass' => 'bricksasp\rbac\models\User',
			'enableAutoLogin' => false,
			'enableSession' => false,
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure a transport
			// for the mailer to send real emails.
			'useFileTransport' => true,
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
				/*[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning', 'info'],
					'logVars' => [],
					//表示以yii\db\或者app\models\开头的分类都会写入这个文件
					'categories' => ['yii\db\*', '*'],
					//表示写入到文件
					'logFile' => '@runtime/logs/YIISQL_' . date('y_m_d') . '.log',
				],*/
			],
		],
		'db' => [
			'class' => 'yii\db\Connection',

			// 'username' => 'root',
			// 'password' => '123456',
			// 'dsn' => 'mysql:host=127.0.0.1;dbname=basp',

			'username' => 'root',
			'password' => '649909457@qq.com',
			'dsn' => 'mysql:host=120.79.223.217;dbname=basp',

			'charset' => 'utf8',
			'tablePrefix' => 'basp_',
			// Schema cache options (for production environment)
			//'enableSchemaCache' => true,
			//'schemaCacheDuration' => 60,
			//'schemaCache' => 'cache',
		],
		'redis' => [ //token
            'class' => 'yii\redis\Connection',
            'hostname' => '120.79.223.217',
            'port' => 6379,
            'database' => 0,
			'password' => '649909457@qq.com',
        ],
		'mongodb' => [
	        'class' => '\yii\mongodb\Connection',
	        'dsn' => 'mongodb://@localhost:27017/spider',
	        'options' => [
	            "username" => "bricksasp",
	            "password" => "123456"
	        ]
	    ],
		'cache' => [
			// 'class' => 'yii\caching\FileCache',
			'class' => 'yii\redis\Cache',
            'redis' => [
	            'hostname' => '120.79.223.217',
	            'port' => 6379,
	            'database' => 1,
				'password' => '649909457@qq.com',
            ],
        	'keyPrefix' => 'bricksasp',
		],
		// 'queue' => [
		//     'class' => \yii\queue\file\Queue::class,
		//     'as log' => \yii\queue\LogBehavior::class,
		//     // Other driver options
            // 'class' => \yii\queue\amqp\Queue::class,
            // 'host' => 'localhost',
            // 'port' => 5672,
            // 'user' => 'guest',
            // 'password' => 'guest',
            // 'queueName' => 'queue',
		// ],
		'urlManager' => $route,
		'i18n' => $translations,
		
		'devicedetect' => [
			'class' => 'alexandernst\devicedetect\DeviceDetect'
		],
	],
	'params' => $params,
	'modules' => $modules,

];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		//'allowedIPs' => ['127.0.0.1', '::1'],
	];

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		//'allowedIPs' => ['127.0.0.1', '::1'],
		'generators' => [
			// 'job' => [
			//     'class' => \yii\queue\gii\Generator::class,
			// ],
			'mongoDbModel' => [
				'class' => \yii\mongodb\gii\model\Generator::class,
			],
		],
	];
}

return $config;
