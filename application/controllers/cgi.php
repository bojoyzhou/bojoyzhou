<?php
class Cgi extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->noCSRF['']=true;
	}
	public function getUserName(){
		$data=array();
		return array(SUCCESS,$data);
	}
	public function getShops(){
		$data=array('shop1','shop1','shop1','shop1');
		return array(SUCCESS,$data);
	}
}