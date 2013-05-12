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

/**
 * EVEAPI REveApi
 *
 * @author VRobin
 * 
 */
class REveApi {

    private $keyID;
    private $vCode;
    private $AccessMask;
    private $config;

    /**
     * @param string $keyID api Key ID
     * @param string $vCode api Verification Code
     */
    public function __construct($keyID = null, $vCode = null) {
	$this->keyID = $keyID;
	$this->vCode = $vCode;
	$this->config = new RConfig;
    }

    public function __call($name, $arguments) {
	if (preg_match('/^Api(\w+)$/i', $name, $api)) {
	    array_unshift($arguments, $this->config);
	    if (require_once(dirname(__FILE__) . '/apis/' . $api[1] . '.api.php')) {
		return new $name($arguments);
	    } else {
		throw new RException('api not exist');
	    }
	}
    }

    public function init($keyID, $vCode) {
	$this->keyID = $keyID;
	$this->vCode = $vCode;
    }

    static public function config() {
	if (is_object($this->config)) {
	    return $this->config;
	} else {

	    return new RConfig();
	}
    }

    public function checkAccessMask() {
	$api = new ApiAPIKeyInfoApi;
	$api->test();
    }

}

function __classautoload($classname) {
    if ($classname) {
	require_once(dirname(__FILE__) . '/class/' . $classname . '.class.php');
    }
}

spl_autoload_register('__classautoload');