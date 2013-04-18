<?php
require 'Eveapi.php';
// $a = new REveApi;
// $a->checkAccessMask();

// $b = new RXMLParser('AAAA');
// echo $b->_x;

$c = new ApiServerStatus;
$xp = $c->query();
echo $xp->XML();
?>