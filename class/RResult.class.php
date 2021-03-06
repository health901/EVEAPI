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
 * EVEAPI RResult
 *
 * @author VRobin
 * 
 */
class RResult {

    public $until;
    public $result = array();
    private $XMLObject;

    public function __construct($object) {
	$this->XMLObject = $object;
	$this->analyse();
    }

    protected function analyse() {

	$until = strval($this->XMLObject->cachedUntil);
	//UTC
	$date_until = DateTime::createFromFormat('Y-m-d H:i:s', $until, new DateTimeZone('UTC'));
	$this->until = $date_until->getTimestamp();

	$this->analyse_result($this->XMLObject->result, $this->result);
    }

    protected function analyse_result($object, &$result) {
	foreach ($object->children() as $field) {
	    if ($field->getName() == 'rowset') {
		$rowset = $this->rowset($field);
		$result[$rowset['name']] = $rowset['rowset'];
	    } else {
		foreach ($field->attributes() as $key => $value) {
		    $result[$field->getName()][strval($key)] = strval($value);
		}
		if ($field->count()) {
		    foreach ($field->children() as $fieldchild) {
			$root = simplexml_load_string('<result>' . $fieldchild->asXML() . '</result>');
			$this->analyse_result($root, $field_result);
			foreach ($field_result as $key => $value) {
			    $result[$field->getName()][strval($key)] = is_array($value) ? $value : strval($value);
			}
		    }
		}
	    }
	}
    }

    protected function rowset($object) {
	$attrs = $object->attributes();
	$rowset = array();
	foreach ($object->children() as $row) {
	    $row_data = array();
	    if ($row->count()) {
		foreach ($row->children() as $row_child) {
		    $root = simplexml_load_string('<result>' . $row_child->asXML() . '</result>');
		    $this->analyse_result($root, $row_result);
		    foreach ($row_result as $key => $value) {
			$row_data[strval($key)] = is_array($value) ? $value : strval($value);
		    }
		}
	    }
	    $attr_row = $row->attributes();
	    $key = strval($attrs->key);
	    foreach ($attr_row as $k => $v) {
		$row_data[strval($k)] = strval($v);
	    }
	    if ($key) {
		$rowset[$row_data[$key]] = $row_data;
	    } else {
		$rowset[] = $row_data;
	    }
	}
	return array('name' => strval($attrs->name), 'rowset' => $rowset);
    }

}
?>
