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
	require_once(dirname(__FILE__) . '/class/' . $classname . '.class.php');
    }
}

spl_autoload_register('__classautoload');

function RExceptionHandler(RException $e) {
    exit($e->getMessage());
}

set_exception_handler('RExceptionHandler');

define('IN_REVEAPI', TRUE);

/**
 * EVEAPI REveApi
 *
 * @author VRobin
 * 
 */
class REveApi {

    private $keyID;
    private $vCode;
    private $AccessMask = NULL;
    private $config;
    private $error;

    /**
     * @param string $keyID api Key ID
     * @param string $vCode api Verification Code
     */
    public function __construct($keyID = null, $vCode = null) {
	$this->keyID = $keyID;
	$this->vCode = $vCode;
	$this->config = new RConfig;
	$this->getAccessMask();
    }

    public function __call($name, $arguments, $extra = NULL) {
	if (preg_match('/^Api(\w+)$/i', $name, $api)) {
	    if (require_once(dirname(__FILE__) . '/apis/' . $api[1] . '.api.php')) {
		$api = new $name($this->keyID, $this->vCode, $arguments, $extra);
		if ($this->checkAccessMask($api->CAK))
		    return $api;
		else {
		    $this->error = 'permission denied';
		    return false;
		}
	    } else {
		throw new RException('api not exist');
	    }
	}
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

    public function getAccessMask() {
	if (!is_null($this->AccessMask))
	    return $this->AccessMask;
	if (empty($this->keyID) || empty($this->vCode)) {
	    $this->AccessMask = 0;
	    return $this->AccessMask;
	}
	$api = $this->ApiAPIKeyInfo()->query();
	$api->test();
    }

    public function getError() {
	return $this->error;
    }

    /**
     *
     * @param int $CAK Api's CAK
     * @return mixed 
     */
    public function checkAccessMask($CAK) {
	if ($CAK == 0)
	    return TRUE;
	return $CAK & $this->AccessMask;
    }

}

