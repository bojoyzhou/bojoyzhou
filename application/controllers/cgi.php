<?php
class Cgi extends MY_Controller{
	public function __construct(){
		require_once 'entry/entry.php';
		parent::__construct();
		$this->noCSRF['']=true;
	}
	public function users(){
		require_once 'entry/users.php';
		return call_user_func_array(array(new Users(),'exec'),func_get_args());
	}
	public function usersOrders(){
		return call_user_func_array(array(new UsersOrders(),'exec'),func_get_args());
	}
	public function shops(){
		return call_user_func_array(array(new Shops(),'exec'),func_get_args());
	}
	public function shopsDishs(){
		return call_user_func_array(array(new ShopsDishs(),'exec'),func_get_args());
	}
	public function shopsOrders(){
		return call_user_func_array(array(new ShopsOrders(),'exec'),func_get_args());
	}
	public function dishs(){
		return call_user_func_array(array(new Dishs(),'exec'),func_get_args());
	}
	public function orders(){
		return call_user_func_array(array(new Orders(),'exec'),func_get_args());
	}
}