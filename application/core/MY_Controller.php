<?php
class MY_Controller extends CI_Controller{
	protected $noCSRF;

	public function __construct(){
		parent::__construct();
		$this->noCSRF=array();
		$model=get_class($this).'_model';
		$this->load->model($model);
		$this->model=$this->$model;
	}
	
	public function _remap(){
		$http_method=$this->input->get('http_method');
		if(!$http_method){
			$http_method=$_SERVER['REQUEST_METHOD'];
		}
		$ret=null;
		if(!isset($this->noCSRF[get_class($this).'_'.$http_method])&&!$this->checkToken()){
			$ret=array(
				"errCode"=>ACCESS_METHOD_DENIED,
				"msg"=>"access_method_denied"
			);
		}else{
			$result=call_user_func_array(array($this,'_'.$http_method), func_get_args());
			if(count($result)!==2){
					$result=array(METHOD_UNINITIALIZED,null);
			}else{
				$ret=array(
					"errCode"=>$result[0],
					"msg"=>$GLOBALS['ERRCODE'][$result[0]],
					"data"=>$result[1]
				);
			}
		}
		$ret=json_encode($ret);
		echo $ret;
	}

	public function get(){
		return array(METHOD_UNINITIALIZED,implode('/',func_get_args()));
	}

	public function post($desc){
		return array(METHOD_UNINITIALIZED,$desc);
	}

	public function put($id,$desc){
		return array(METHOD_UNINITIALIZED,array($id,$desc));
	}

	public function delete($id){
		return array(METHOD_UNINITIALIZED,$id);
	}

	protected function _get(){
		return call_user_func_array(array($this,'get'), func_get_args());
	}

	protected function _post(){
		$args=array();
		$data=file_get_contents('php://input');
		$data=urldecode($data);
		$args[]=(array)json_decode($data);
		return call_user_func_array(array($this,'post'), $args);
	}

	protected function _put($id){
		$args=array($id);
		$data=file_get_contents('php://input');
		$data=urldecode($data);
		$args[]=(array)json_decode($data);
		return call_user_func_array(array($this,'put'), $args);
	}

	protected function _delete(){
		return call_user_func_array(array($this,'delete'), func_get_args());
	}
	private function checkToken(){
		return true;
		$tk=$this->input->get('tk');
		$key=$_COOKIE['key'];
		if(time33($key)===$tk){
			return true;
		}
		return false;
	}
	private static function time33($str){
		$hash=5381;
		for($i=0,$l=strlen($str);$i<$l;$i++){
			$hash|=$hash<<5+ord($str[$i]);
		}
		return $hash&0x7fffffff;
	}
}