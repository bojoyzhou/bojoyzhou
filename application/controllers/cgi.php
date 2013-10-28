<?php
class Cgi extends MY_Controller{
	public function __construct(){
		parent::__construct();
		include_once 'entry/entry.php';
		include_once '/application/core/Model.php';
		require_once '/system/core/Model.php';
		$this->noCSRF['']=true;
	}
	public function users(){
		include_once 'entry/users.php';
		return call_user_func_array(array(new Users($this),'exec'),func_get_args());
	}
	public function usersOrders(){
		return call_user_func_array(array(new UsersOrders($this),'exec'),func_get_args());
	}
	public function shops(){
		return call_user_func_array(array(new Shops($this),'exec'),func_get_args());
	}
	public function shopsDishs(){
		return call_user_func_array(array(new ShopsDishs($this),'exec'),func_get_args());
	}
	public function shopsOrders(){
		return call_user_func_array(array(new ShopsOrders($this),'exec'),func_get_args());
	}
	public function dishs(){
		return call_user_func_array(array(new Dishs($this),'exec'),func_get_args());
	}
	public function orders(){
		return call_user_func_array(array(new Orders($this),'exec'),func_get_args());
	}
}