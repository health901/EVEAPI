<?php
/**
*  
*/
class RXMLParser
{
	private $xmlString;
	public $_x;
	function __construct($string)
	{
		$this->xmlString = $string;
		$this->_parser();
		return $this;
	}
	public function XML(){
		return $this->xmlString;
	}
	private function _parser(){
		$this->_x = new SimpleXMLElement($this->xmlString);
		print_r($this->_x);
	}

}
?>