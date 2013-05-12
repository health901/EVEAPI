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
 * EVEAPI RConfig
 *
 * @author VRobin
 * 
 */
class RConfig {

    private $config;

    public function __construct() {
	$this->config = require_once(dirname(__FILE__) . '/../config/api.config.php');
	return $this;
    }

    //couston configs,read and write
    public function __get($param) {
	if (array_key_exists($param, $this->config['params'])) {
	    return $this->config['params'][$param];
	} else {
	    throw new RException('config param not exist');
	}
    }

    public function __set($param, $value) {
	$this->config[$param] = $value;
    }

    //system configs,readonly
    public function system($name) {
	if (isset($this->config['system'][$name])) {
	    return $this->config['system'][$name];
	}
    }

    //server info,readonly
    public function server($name) {
	if (isset($this->config['server'][$name])) {
	    return $this->config['server'][$name];
	}
    }

}

?>
