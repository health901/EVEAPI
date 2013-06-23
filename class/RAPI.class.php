<?php

/*
 * Copyright (C) <2013> <VRobin,healthlolicon@gmail.com>
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation 
 * the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and 
 * to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO 
 * THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE 
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, 
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
if (!defined('IN_REVEAPI') || IN_REVEAPI != TRUE)
    return;

/**
 * EVEAPI RAPI
 *
 * @author VRobin
 * 
 */
class RAPI {

    //http://wiki.eve-id.net/APIv2_Page_Index
    public $api; #API name with scope
    public $scope; #api scope
    public $CAK;  #CAK Access Mask the Api expect
    public $AccessMark; #ApiKey's AccessMark
    public $GMT;
    public $_uri; #Api Site URI
    protected $_param;
    protected $config;
    protected $error;
    protected $keyID;
    protected $vCode;
    protected $apilist;

    public function __construct($keyID = "", $vCode = "", $arguments = "") {
	$this->config = new RConfig;
	$this->_readConfig();
	$this->apilist = require_once(dirname(__FILE__) . '/../apis/apilist.inc.php');
	$this->GMT = $this->getTimeZone();
	if (!empty($keyID) && !empty($vCode)) {
	    $this->_param['keyID'] = $keyID;
	    $this->_param['vCode'] = $vCode;
	}
	$this->__init($arguments);
    }

    public function __init($arguments) {
	foreach ($arguments as $key => $argument) {
	    $this->_param[$key] = $argument;
	}
    }

    public function init($scope, $api) {
	$this->scope = $scope;
	$this->api = $api;
	$this->CAK = $this->apilist[$this->scope][$this->api];
    }

    public function __set($name, $value) {
	$this->_param[$name] = $value;
    }

    public function __get($name) {
	if (method_exists(__CLASS__, 'get' . $name)) {
	    $func = 'get' . $name;
	    return $this->$func();
	} elseif (array_key_exists($name, $this->_param)) {
	    return $this->_param[$name];
	} else {
	    throw new RException('attribute not exist in class ' . __CLASS__);
	}
    }

    public function getTimeZone() {
	return isset($this->config->GMT) ? $this->config->GMT < 12 ? $this->config->GMT > -12 ? $this->config->GMT : 0  : 0  : 0;
    }

    public function query() {
	if (method_exists($this, '_beforeQuery')) {
	    if (FALSE === $this->_beforeQuery())
		return false;
	}
	$path = '/' . $this->scope . '/' . $this->api . '.xml.aspx';
	$query = new RHttpQuery($this->_uri, $path, $this->_param);
	$result = $query->query();
	if (method_exists($this, '_afterQuery')) {
	    if (FALSE === $this->_afterQuery(&$result))
		return false;
	}
	return $result;
    }

    public function getError() {
	return $this->error;
    }

    public function getAccessMark() {
	$api = new ApiAPIKeyInfo();
    }

    protected function _readConfig() {
	$server = $this->config->server($this->config->system('server'));
	$this->_uri = $server['uri'];
    }

    protected function _beforeQuery() {
	$this->checkAccessMark($this->scope);
	return true;
    }

    protected function _afterQuery(&$result) {
	return true;
    }

    protected function checkAccessMark($type) {
	if ($this->CAK == 0 || is_array($this->CAK)) {
	    return TRUE;
	} else {
	    $this->$this->getAccessMark();
	    return $this->CAK & $this->AccessMark[$type];
	}
    }

}

?>