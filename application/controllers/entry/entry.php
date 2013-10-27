<?php
class Entry{

	protected function get(){
		return array(METHOD_UNINITIALIZED,implode('/',func_get_args()));
	}

	protected function post($desc){
		return array(METHOD_UNINITIALIZED,$desc);
	}

	protected function put($id,$desc){
		return array(METHOD_UNINITIALIZED,array('id'=>$id,'desc'=>$desc));
	}

	protected function delete($id){
		return array(METHOD_UNINITIALIZED,$id);
	}

	private function _get(){
		return call_user_func_array(array($this,'get'), func_get_args());
	}

	private function _post(){
		$args[]=json_decode($_POST['data']);
		return call_user_func_array(array($this,'post'), $args);
	}

	private function _put(){
		$args=func_get_args();
		$args=json_decode($_POST['data']);
		return call_user_func_array(array($this,'put'), func_get_args());
	}

	private function _delete(){
		return call_user_func_array(array($this,'delete'), func_get_args());
	}

	public function exec(){
		$method=isset($_GET['http_method'])?$_GET['http_method']:$_SERVER['REQUEST_METHOD'];
		return call_user_func_array(array($this,'_'.$method), func_get_args()[0]);
	}
}