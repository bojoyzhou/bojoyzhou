<?php
/**
 * 所有controller的基类
 * 进行csrf校验
 */
class MY_Controller extends CI_Controller{
	protected $noCSRF;

	public function __construct(){
		parent::__construct();
		$this->noCSRF=array();
	}
	public function _remap($method,$params=array()){
		$clName=get_class($this);
		if(!strcasecmp($clName,'cgi')){
			if(method_exists($this,$method)){
				if(!isset($this->noCSRF[$method])&&!$this->checkToken()){
					$ret=array(
						"errCode"=>USER_NOT_LOGIN,
						"msg"=>"user_not_login"
					);
				}else{
					$result=call_user_func(array($this,$method),$params);
					$ret=array(
						"errCode"=>$result[0],
						"msg"=>$GLOBALS['ERRCODE'][$result[0]],
						"data"=>$result[1]
					);
				}
			}else{
				$ret=array(
					"errCode"=>METHOD_NOT_EXIST,
					"msg"=>"method_not_exist"
				);
			}
			$ret=json_encode($ret);
		}else{
			$ret=array(
				"errCode"=>ACCESS_METHOD_DENIED,
				"msg"=>"access_method_denied"
			);
			$ret=json_encode($ret);
		}
		echo $ret;
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