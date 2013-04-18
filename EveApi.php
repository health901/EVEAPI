<?php
//
// Copyright (c) 2013 by Viking Robin.  All Rights Reserved.
//
/**
*  
*/
class REveApi
{
	private $keyID;
	private $vCode;
	private $AccessMask;

	/**
	*@param string $keyID api Key ID
	*@param string $vCode api Verification Code
	*/
	function __construct($keyID = null, $vCode = null)
	{
		$this->keyID = $keyID;
		$this->vCode = $vCode;
	}

	function init($keyID,$vCode){
		$this->keyID = $keyID;
		$this->vCode = $vCode;		
	}

	function checkAccessMask(){
		$api = new APIKeyInfoApi;
		$api->test();
	}
}

function __classautoload($clssname){
	if(preg_match('/^Api(\w+)$/', $clssname,$api)){
		require_once('./apis/'.$api[1].'.api.php');
	}else{
		require_once('./class/'.$clssname.'.class.php');
	}
}
spl_autoload_register('__classautoload');
?>