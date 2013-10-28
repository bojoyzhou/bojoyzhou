<?php
class Entry{
	protected function get(){
		return array(METHOD_UNINITIALIZED,implode('/',func_get_args()));
	}

	protected function post($desc){
		return array(METHOD_UNINITIALIZED,$desc);
	}

	protected function put($id,$desc){
		return array(METHOD_UNINITIALIZED,array($id,$desc));
	}

	protected function delete($id){
		return array(METHOD_UNINITIALIZED,$id);
	}

	private function _get(){
		return call_user_func_array(array($this,'get'), func_get_args());
	}

	private function _post(){
		$args[]=isset($_POST['data'])?(array)json_decode($_POST['data']):array();
		return call_user_func_array(array($this,'post'), $args);
	}

	private function _put(){
		$args=func_get_args();
		if($_SERVER['REQUEST_METHOD']==='PUT'){
			$data=file_get_contents('php://input');
			$data=urldecode($data);
			$args[]=(array)json_decode($data);	
		}else{
			$args[]=isset($_POST['data'])?(array)json_decode($_POST['data']):array();
		}
		return call_user_func_array(array($this,'put'), $args);
	}

	private function _delete(){
		return call_user_func_array(array($this,'delete'), func_get_args());
	}

	public function exec(){
		$method=isset($_GET['http_method'])?$_GET['http_method']:$_SERVER['REQUEST_METHOD'];
		return call_user_func_array(array($this,'_'.$method), func_get_args()[0]);
	}
}