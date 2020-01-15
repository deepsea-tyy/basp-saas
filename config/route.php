<?php
return [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        // 'suffix'          => '.html',
        'rules' => [
            'user/register'	=> 'rbac/user/signup',
            'user/login'	=> 'rbac/user/login',
            'user/logout'	=> 'rbac/user/logout',
            'user/info'		=> 'rbac/user/info',
            'user/captcha'  => 'rbac/user/captcha',
            'user/qrlogin'  => 'rbac/user/qrlogin',
            'user/qrscan'   => 'rbac/user/qrscan',
        ],
    ];