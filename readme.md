EVE OL PHP 类库
---
Copyright (C) 2010-2012 by Viking Robin Petermann All rights reserved.

适用于v2版API

#LICENSE
本项目以MIT协议发布，协议条款见文件 _license-mit_

#REQUIREMENTS
* PHP 5.3+ (低版本未测试)
* CURL

#Usage
**引入库文件：**

`require_once 'Eveapi.php';`


**实例化API类**

    /**
    * class	REVEAPI ($KeyID = NULL, $vCode = NULL, $scope = NULL);
    * method	init($KeyID, $vCode)	用于实例化后传递keyid 和 vCode
    * method	scope($scope)		用于实例化后设定scope，默认 'account'
    */

    $KeyID = '2305084';
    $vCode = 'QsnHFao8ZhVjOR14B8lYBSS1hbuBKGIkrwP9EUhgt3WrZV3LZDxdYoXca6zsT3SQ';

    //实例化时不传递参数，可用于无须权限的api：
    $api = new REVEAPI;
    //实例化后传递参数：
    $api->ini($KeyID,$vCode);

    //实例化时传递参数
    $api2 = new REVEAPI($KeyID,$vCode);

    //<若无指定范围,scope 默认为"account">
    //带限定范围的实例化
    $api_with_scope = new REVEAPI($KeyID,$vCode,'char');

    //在实例化后进行范围限定
    $api2->scope('char');


**实例化具体API**

    /**
    * api调用方法名为	'Api'+ <API接口名>
    * 使用数组传递API所需参数	Api<APINAME>($array_params)
    * <所须传递的额外参数指除 $KeyID,$vCode 之外的参数。
    */
    //无额外参数的接口
    $characters = $api->ApiCharacters();
    $alliancelist = $api->scope('eve')->ApiAllianceList();
    //须传递额外参数的接口
    $params = array(
	'BeforeKillID'=>'12345',
	'characterID'=>'12345678';
    );
    $killmail = $api->scope('char')->ApKilllog($params);
    

**执行查询**

    $respone1 = $characters->query();
    $respone2 = $api->scope('char')->ApKilllog($params);

#CONFIG
配置文件位于：  `/config/api.config.php`

    return array(
	//服务器设置
	'server' => array(
	    #国服
	    'Serenity' => array(
		'uri' => 'https://api.eve-online.com.cn'
	    ),
	    #欧服
	    'Tranquility' => array(
		'uri' => 'https://api.eveonline.com'
	    )
	),
	//系统设置
	'system' => array(
	    //设置api使用的服务器
	    'server' => 'Tranquility',
	    //设置api使用的缓存类型
	    'cache' =>array( 
		'class'=>'RFileCache',	    #缓存类名，目前仅有 RFileCache 文件缓存
		'path'=>'/cache/'	    #文件缓存存储位置，以库主文件"EveApi.php" 为根目录
		)
	),
	//保留参数 params 目前尚无使用,
	'params' => array()
    );