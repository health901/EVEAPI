<?php //
require 'Eveapi.php';
// $a = new REveApi;
// $a->checkAccessMask();

// $b = new RXMLParser('AAAA');
// echo $b->_x;

$api = new REVEAPI;
echo $api->ApiAPIKeyInfo()->_uri;
//echo $xp->XML();
?>