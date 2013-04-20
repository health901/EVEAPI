<?php
//
// Copyright (c) 2013 by Viking Robin.  All Rights Reserved.
//
abstract class RAPI {
	//http://wiki.eve-id.net/APIv2_Page_Index
	public $api;	#API URI
	public $CAK; 	#CAK Access Mask
	public $GMT = 0;
	public $_uri;
	private $_param;

	public function __construct() {
		$config = require_once('/../config/api.config.php');
		$this->_uri = $config['server'][$config['default']]['uri'];
	}
	public function __set($name,$value) {
		$this->_param[$name] = $value;
	}
	public function __get($name) {
		return $this->_param[$name];
	}
	public function setTimeZone($offset){
		$offset = intval($offset);
		if($offset <= 12 && $offset >= -12)	$this->GMT = $offset;
	}
	public function query(){
		$url = $this->_uri . $this->api;
		if(sizeof($this->_param)) $url .= '?' . http_build_query($this->_param);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$html = curl_exec($ch);
		if(!$html){
			$this->error = curl_error($ch);
			curl_close($ch);
			return false;
		}
		curl_close($ch);
		return new RXMLParser($html);
	}
	// public function 
}
?>