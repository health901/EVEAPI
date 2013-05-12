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
 * EVEAPI RAPI
 *
 * @author VRobin
 * 
 */
abstract class RAPI {

    //http://wiki.eve-id.net/APIv2_Page_Index
    private $api; #API name within scope
    public $CAK;  #CAK Access Mask
    public $GMT = 0;
    private $_uri; #Api Site URI
    private $_param;
    private $config;
    private $error;

    public function __construct($arguments) {
	$this->config = array_shift($arguments);
	$this->_readConfig();
	$this->__init($arguments);
    }

    abstract public function __init($arguments);

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

    public function setTimeZone($offset) {
	$offset = intval($offset);
	if ($offset <= 12 && $offset >= -12)
	    $this->GMT = $offset;
    }

    public function query() {
	$result = new RHttpQuery($this->_uri, $api, $this->_param);
	return $result;
    }

    public function getError() {
	return $this->error;
    }

    private function _readConfig() {
	$server = $this->config->server($this->config->system('server'));
	$this->_uri = $server['uri'];
    }

}

?>