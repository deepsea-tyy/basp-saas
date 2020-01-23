<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    /*'bricksasp.configs' => [
    	'web_url'=>'http://www.bricksasp.com',
    	'file_base_path'=>'/usr/share/nginx/html/basp/web',
    	// 'file_temp_path'=>'',
    	// 'file_path'=>'',
    ],*/

	'workerConfig' =>[
		'registerAddress' => '127.0.0.1:1238'
	],
    // 固定参数
    'fixedParameter' => [
        'goodsVip' => [
            //商品id
            'id' => 21,
            // 单品id
            34 => strtotime('+ 1 year 1 day') - time(),
            35 => strtotime('+ 3 month 1 day') - time(),
            36 => strtotime('+ 1 month 1 day') - time(),
        ],
    ]
];
