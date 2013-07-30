<?php 
/**
 * Test API Keys
 * Key ID:2305084
 * vCode:QsnHFao8ZhVjOR14B8lYBSS1hbuBKGIkrwP9EUhgt3WrZV3LZDxdYoXca6zsT3SQ
 * Access Mark:
 */
require_once 'Eveapi.php';
//define('RDEBUG', TRUE);	#debug  runtime will be renewed 

$api = new REVEAPI('2305084','QsnHFao8ZhVjOR14B8lYBSS1hbuBKGIkrwP9EUhgt3WrZV3LZDxdYoXca6zsT3SQ');
$response=$api->APIKeyInfo()->query();
print_r($response);
?>