<?php
namespace divido;
use stdClass;

class Configuration{

	private $config_dictionary;

	public function __construct(){
		$this->config_dictionary = [];
	}

	public function load($file)
	{
		if(!file_exists($file)) throw new Exception("File {$file} path does not exist");

		$content = file_get_contents($file);

		# If the content is json valid encode it
		if($this->is_valid_json($content)){
			$json_content = json_decode($content);

			$this->add_to_dictionary($json_content);
		}
	}

	private function add_to_dictionary(stdClass $json_content, string $parent_path=''){
		
		foreach($json_content as $key=>$value){

			if(gettype($value) == 'string'){
				# load to dictionary
			}else if(gettype($value) == 'object'){
				# call the same method
			}
		}
	}

	private function is_valid_json(string $content)
	{
		if(!empty($content)){
			return is_string($content) && is_array(json_decode($content, true)) ? true : false;
		}

		return false;
	}
}