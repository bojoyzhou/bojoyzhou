<?php
class Test extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}
	public function _remap($method){
		header('Content-Type: text/javascript')
		echo file_get_contents(dirname(__FILE__).'/'.$method.'.test.js');
	}
}