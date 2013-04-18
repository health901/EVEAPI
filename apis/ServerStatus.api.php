<?php
/**
* 
*/
class ApiServerStatus extends RAPI
{
	public $api = '/server/ServerStatus.xml.aspx';
	public $CAK = 0;
	
	function test(){
		echo '1';
	}
}
?>