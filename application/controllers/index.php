<?php
class Index extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->load->view('welcome.shtml');
	}

	public function _remap($method){
		if($method!=='index'){
			echo file_get_contents(dirname(dirname(dirname(__FILE__))).'/static/shtml/'.$method);
		}
	}
}