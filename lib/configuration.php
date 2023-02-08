<?php
namespace divido;
use stdClass;

class Configuration{

	private $config_dictionary = [];

	public function __construct(){
	}

	/**
	 * Read the content of given file and sanitize the file and invoke add_to_dictionary method internally
	 * @param  mixed (string/array)
	 * @return void
	 */
	public function load($files)
	{
		$file_array = is_array($files) ? $files : array($files);

		foreach($file_array as $file)
		{
			if(!file_exists($file)) throw new Exception("File {$file} path does not exist");

			$content = file_get_contents($file);

			# If the content is json valid encode it
			if($this->is_valid_json($content)){
				$json_content = json_decode($content);

				$this->add_to_dictionary($json_content);
			}
		}

	}

	/**
	 * Return the value for the given json path
	 * @param  string
	 * @return mixed
	 */
	public function get(string $key){
		
		if(!isset($this->config_dictionary[$key])){
			throw new Exception("Path not found!");
		}

		return $this->config_dictionary[$key];
	}

	/**
	 * Process a given json object and add values to dictionary
	 * @param stdClass
	 * @param string
	 */
	private function add_to_dictionary(stdClass $json_content, string $parent_path=''){
		
		foreach($json_content as $key=>$value){

			$total_path = ($parent_path == '') ? $key : $parent_path . '.' . $key;

			if(gettype($value) == 'object'){
				
				#
				$this->config_dictionary[$total_path] = $value;

				# call the same method
				$this->add_to_dictionary($value, $total_path);
			}else{
				$this->config_dictionary[$total_path] = $value;
			}
		}
	}

	/**
	 * Checks whether a given string is a valid json string. Ref: https://www.geeksforgeeks.org/how-to-validate-json-in-php/
	 * @param  string
	 * @return boolean
	 */
	private function is_valid_json(string $content)
	{
		if(!empty($content)){
			return is_string($content) && is_array(json_decode($content, true)) ? true : false;
		}

		return false;
	}
}