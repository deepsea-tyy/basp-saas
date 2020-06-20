<?php

$params = require __DIR__ . '/params.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',

            'username' => 'root',
            'password' => '123456',
            'dsn' => 'mysql:host=127.0.0.1;dbname=basp',

            // 'username' => 'root',
            // 'password' => '649909457@qq.com',
            // 'dsn' => 'mysql:host=120.79.223.217;dbname=basp',

            'charset' => 'utf8',
            'tablePrefix' => 'basp_',
            // Schema cache options (for production environment)
            //'enableSchemaCache' => true,
            //'schemaCacheDuration' => 60,
            //'schemaCache' => 'cache',
        ],
        'queue' => [
            'as log' => \yii\queue\LogBehavior::class,
            // Other driver options
            'class' => \yii\queue\amqp_interop\Queue::class,
            'host' => 'localhost',
            'port' => 5672,
            'user' => 'guest',
            'password' => 'guest',
            'queueName' => 'testqueue',
        ],
        'redis' => [
            'class' => \yii\redis\Connection::class,
            'class' => 'yii\redis\Connection',
            'hostname' => '120.79.223.217',
            'port' => 6379,
            'database' => 0,
            'password' => '649909457@qq.com',

        ],
        'rdeisqueue' => [
            'class' => \yii\queue\redis\Queue::class,
            'redis' => 'redis', // 连接组件或它的配置
            'channel' => 'queue', // Queue channel key
        ],
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
