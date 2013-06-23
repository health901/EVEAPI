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
 * EVEAPI RConfig
 *
 * @author VRobin
 * 
 */
class RConfig {

    private $config;

    public function __construct() {
	if (RDEBUG || !file_exists(dirname(__FILE__) . '/../Runtime/~runtime') || !$wakeup = unserialize(file_get_contents(dirname(__FILE__) . '/../Runtime/~runtime'))) {
	    $this->config = require(dirname(__FILE__) . '/../config/api.config.php');
	    $this->save();
	} else {
	    $this->config = $wakeup;
	}
	return $this;
    }

    private function save() {
	if (!file_exists(dirname(__FILE__) . '/../Runtime'))
	    mkdir(dirname(__FILE__) . '/../Runtime', '0777');
	file_put_contents(dirname(__FILE__) . '/../Runtime/~runtime', serialize($this->config));
    }

    //couston configs,readonly
    public function __get($param) {
	if (array_key_exists($param, $this->config['params'])) {
	    return $this->config['params'][$param];
	} else {
	    return NULL;
	}
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
