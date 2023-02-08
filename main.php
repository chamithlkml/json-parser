<?php
namespace divido;
use Exception;

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'inc.php';

# The main script to get user inputs and return the results

try{

	$options = getopt("", ["action:", "files:", "key:"]);

	print_r($options);

}catch(Exception $e){
	echo "Error occured in running Configuration app: " . $e->getMessage() . "\n";
	echo $e->getTraceAsString();
}