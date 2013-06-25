EVE OL PHP 类库
---
Copyright (C) 2013 by Viking Robin All rights reserved.

适用于v2版API

#LICENSE
本项目以MIT协议发布，协议条款见文件 _license-mit_

#REQUIREMENTS
* PHP 5.3+ (低版本未测试)
* CURL

#INSTALLATION
1. 拷贝库至任意目录，保持库文件结构不变
2. 在类库根目录下创建`Runtime`和`cache` 文件夹，并设置 _读取，写入，删除，创建_ 权限. (目录会自动创建，但以防万一，最好手动创建)

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

    $response1 = $characters->query();
    $response2 = $api->scope('char')->ApKilllog($params)->query();

**查询结果**
查询结果为数组

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

#Files
Dir:	`Runtime`	运行时文件夹，保存config的序列化<br>
Dir:	`apis`		api接口文件文件夹，当接口有额外操作需求时，可创建api类，api类文件被优先d调用。以scope为子目录。<br>
Dir:	`cache`		缓存文件夹<br>
Dir:	`class`		核心类文件夹<br>
Dir:	`config`	配置文件夹文件夹<br>
File:	`EveApi.php`	类库主文件<br>
File:	`license-mit`	MIT许可协议<br>