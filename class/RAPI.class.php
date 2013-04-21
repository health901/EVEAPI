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
    public $api; #API URI
    public $CAK;  #CAK Access Mask
    public $GMT = 0;
    public $_uri;
    private $_param;
    private $config;

    public function __construct($arguments) {
	$this->config = array_shift($arguments);
	$this->__init($arguments);
	$this->_readConfig();
    }

    public function __init($arguments) {
	
    }

    public function __set($name, $value) {
	$this->_param[$name] = $value;
    }

    public function __get($name) {
	return $this->_param[$name];
    }

    public function setTimeZone($offset) {
	$offset = intval($offset);
	if ($offset <= 12 && $offset >= -12)
	    $this->GMT = $offset;
    }

    public function query() {
	$url = $this->_uri . $this->api;
	if (sizeof($this->_param))
	    $url .= '?' . http_build_query($this->_param);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$html = curl_exec($ch);
	if (!$html) {
	    $this->error = curl_error($ch);
	    curl_close($ch);
	    return false;
	}
	curl_close($ch);
	return new RXMLParser($html);
    }

    private function _readConfig() {
	$server = $this->config->server($this->config->system('server'));
	$this->_uri = $server['uri'];
    }

}

?>