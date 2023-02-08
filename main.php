<?php
namespace divido;
use Exception;

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'inc.php';

# The main script to get user inputs and return the results

try{
	$configuration = new Configuration();
	$configuration->load("/Users/chamith/projects/php/divido/json-parser/fixtures/config.json");

}catch(Exception $e){
	echo "Error occured in running Configuration app: " . $e->getMessage() . "\n";
	echo $e->getTraceAsString();
}