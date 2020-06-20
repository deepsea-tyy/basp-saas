# basp saas
遵循yii2规范开发，可直接composer update
后台ui基于elementui，easyui
## Features
- 模块化开发
- 功能模块可独立安装使用
- 可长期迭代，受php版本升级影响低

## 功能结构

```
- 助手类 [basp-helpers]
  - 工具函数类
  - 行为拓展类

- 基础模块 [basp-base]
  - 基础类
  - 全局功能
  	- 文件管理
  	- 标签管理

-功能模块
  - spu模块 [basp-spu]
    - 商品管理
    - 商品属性管理
    - 商品类型管理
    - 商品分类管理
    - 商品参数管理

  - ...模块

- 后台 [basp-admin]
  - 整合 [vue-element-admin]

- 接口文档
  - swagger oa3

```

## 二开说明

- 环境
 - mysql
 - redis
 - php>=7.2

-安装方法

	1、直接安装
	-------------
	Either run
	php composer.phar update


	2、单独安装功能模块
	------------
	php composer.phar require deepsea-basp/basp-spu:"~1.0"

	Configuration
	-------------
	To use this extension, you have to configure the Connection class in your application configuration:
	php
	return [
	    //....
	    'components' => [
	        'spu' => [
	            'class' => 'basp\spu\Module'
	        ],
	    ]
	];



## 开发规范
- CURD规范 具体查看模块controller代码
- 控制器重要方法说明
```bash

#/**
# * 登录可访问 其他需授权
# * @return array
# */
public function allowAction()
#/**
# * 免登录可访问
# * @return array
# */
public function allowNoLoginAction()
```

## 单独使用模块功能
- 使用方法
  - 继承相应控制器
  - 重写控制器行为方法为空 例：public function behaviors(){}

## 接口文档
- http://localhost:8080/site/api-docs

## 后台UI地址
- https://github.com/deepsea-tyy/basp-admin

