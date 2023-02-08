# json-parser

## _JSON config Dictionary_


JSON config dictionary can load single or multiple json files so that it loads all paths (including sections) with their respective values into an internal associative array so that any valid json path returns the respective json value.

## Use the library

- Check `main.php` file
```sh
try{
	$configuration = new Configuration();
	$configuration->load("/Users/chamith/projects/php/divido/json-parser/fixtures/config.json");
	print_r($configuration->get('database.host'));
	
	$configuration->load("/Users/chamith/projects/php/divido/json-parser/fixtures/config.local.json");
	print_r($configuration->get('database.host'));

}catch(Exception $e){
	echo "Error occured in running Configuration app: " . $e->getMessage() . "\n";
	echo $e->getTraceAsString();
}
```
## Run tests
```sh
cd unittests
../vendor/phpunit/phpunit/phpunit ConfigurationTest.php
```