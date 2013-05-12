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
 * EVEAPI RHttpQuery
 *
 * @author VRobin
 * 
 */
class RHttpQuery {

    private $uri;
    private $params;
    private $cacheClass;

    public function __construct($site, $api, $params) {
	$this->uri = $site . $api;
	$cacheSetting = REveApi::config()->system('cache');
	$this->cacheClass = $cacheSetting['class'];
	$this->params = $params;
	$this->_query();
    }

    private function _query() {
	$xmlpraser = new RXMLParser($this->_getData());
	return new RResult($xmlpraser);
    }

    private function _getData() {
	$cache = new $this->cacheClass;
	if ($cache->isExist($this->url . serialize($parmas))) {
	    return $cache->get($this->url . serialize($parmas));
	} else {
	    return $this->_cURLget($this->uri, $this->params);
	}
    }

    private function _cURLget($uri, $params = array(), $options = array()) {
	$dash = strpos($uri, '?') === FALSE ? '?' : '&';
	if (count($params))
	    $url = $uri . $dash . http_build_query($params);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	if (count($options))
	    curl_setopt_array($ch, $options);
	$xml = curl_exec($ch);
	if (curl_error($ch))
	    throw new RException($this->error);
	curl_close($ch);
	return $xml;
    }

}

?>
