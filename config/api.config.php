<?php

//
// Copyright (c) 2013 by Viking Robin.  All Rights Reserved.
//
return array(
    //servers
    'server' => array(
	#EVE China
	'Serenity' => array(
	    'uri' => 'https://api.eve-online.com.cn'
	),
	#EVE World
	'Tranquility' => array(
	    'uri' => 'https://api.eveonline.com'
	)
    ),
    'system' => array(
	'server' => 'Tranquility',
	'cache' =>array( 
	    'class'=>'RFileCache',
	    'path'=>'/cache/'
	    )
    ),
    //params can set by class RConfig,
    'params' => array()
);
?>