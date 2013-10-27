<?php
class Shop extends MY_Model{
	public function __construct(){
		parent::__construct();
	}

	public function getAll(){
		return $this->db->get('shop');
	}
}