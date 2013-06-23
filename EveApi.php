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

function __classautoload($classname) {
    if ($classname) {
//	echo 'Call: '.dirname(__FILE__) . '/class/' . $classname . '.class.php<br>';
	require_once(dirname(__FILE__) . '/class/' . $classname . '.class.php');
    }
}

spl_autoload_register('__classautoload');

function RExceptionHandler(Exception $e) {
    exit($e->getMessage());
}

set_exception_handler('RExceptionHandler');

define('IN_REVEAPI', TRUE);
define('RDEBUG', TRUE);	#debug 模式

/**
 * EVEAPI REveApi
 *
 * @author VRobin
 * 
 */
class REveApi {

    private $keyID;
    private $vCode;
    private $config;
    private $error;
    private $scope = 'account';

    /**
     * @param string $keyID api Key ID
     * @param string $vCode api Verification Code
     */
    public function __construct($keyID = null, $vCode = null, $scope = null) {
	$this->keyID = $keyID;
	$this->vCode = $vCode;
	if (!is_null($scope))
	    $this->scope = $scope;
	$this->config = new RConfig;
    }

    public function __call($name, $arguments) {
	$apilist = require_once(dirname(__FILE__) . '/apis/apilist.inc.php');
	if (preg_match('/^Api(\w+)$/i', $name, $apiname)) {
	    $ApiFile = dirname(__FILE__) . '/apis/' . $this->scope . '/' . $apiname[1] . '.api.php';
	    if (file_exists($ApiFile) && require_once($ApiFile)) {
		$api = new $name($this->keyID, $this->vCode, $arguments);
	    } else {
		if (isset($apilist[$this->scope][$apiname[1]])) {
		    $api = new RAPI($this->keyID, $this->vCode, $arguments);
		    $api->init($this->scope,$apiname[1]);
		} else {
		    throw new RException('api not exist');
		}
	    }
	    return $api;
	}
    }

    public function scope($scope) {
	$this->scope = $scope;
	return $this;
    }

    public function config($name) {
	return $this->config->$name;
    }

    public function ClearCache() {
	$cache = new RCache;
	return $cache->clear();
    }

    public function init($keyID, $vCode) {
	$this->keyID = $keyID;
	$this->vCode = $vCode;
    }

    public function getError() {
	return $this->error;
    }

}

