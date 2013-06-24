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
if(!defined('IN_REVEAPI') || IN_REVEAPI!=TRUE)
    return;
/**
 * EVEAPI RFileCache
 *
 * @author VRobin
 * 
 */
class RFileCache implements RCacheInterface {

    public $path;

    public function __construct() {
        $config = new RConfig;
        $cacheSetting = $config->system('cache');
        if (!array_key_exists('path', $cacheSetting)) {
            $this->path = dirname(__FILE__).'/../cache/';
        } else {
            $this->path = dirname(__FILE__).'/..'.$cacheSetting['path'];
        }
        if (!file_exists($this->path)) {
            if (!mkdir($this->path, '0777'))
                throw new RException('cache folder not exist');
        }elseif (!is_writable($this->path)) {
            throw new RException('cache folder is not writable');
        }
    }

    public function isExist($name) {
        return is_readable($this->path . $name);
    }

    public function set($name, $value, $expired) {
        $data = serialize(array('expired' => $expired, 'data' => serialize($value)));
        return file_put_contents($this->path . $name, $data);
    }

    public function get($name) {
        $data = unserialize(file_get_contents($this->path . $name));
        if (!$data || $data['expired'] < time()){
	     return false;
	}
           
        return unserialize($data['data']);
    }

    public function clear() {
        $handle = opendir($this->path);
        while (FALSE !== ($file = readdir($handle))) {
            unlink($file);
        }
    }

}

?>
