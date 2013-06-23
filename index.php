<?php //

require_once 'Eveapi.php';

// $a = new REveApi;
// $a->checkAccessMask();

// $b = new RXMLParser('AAAA');
// echo $b->_x;
//echo "2";
$api = new REVEAPI;
$re=$api->scope('eve')->ApiErrorList()->query();
var_dump($re);
//echo $api->ApiAPIKeyInfo()->_uri;
//echo $xp->XML();
?>