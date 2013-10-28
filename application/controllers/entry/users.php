<?php
class Users extends Entry{
	private $userModel;

	public function __construct(){
		$this->userModel=new Model('consumer');
	}

	public function get($id='-1'){
		$this->userModel->setFields(array('name'));
		return array(SUCCESS,$this->userModel->select($id));
	}

	public function post($desc){
		$ret=$this->userModel->insert($desc);
		if($ret){
			return array(SUCCESS,null);
		}
		return array(DATABASE_INSERT_ERR,mysql_error());
	}

	public function put($id,$data){
		$ret=$this->userModel->update($id,$data);
		if($ret){
			return array(SUCCESS,null);
		}
		return array(DATABASE_UPDATE_ERR,mysql_error());
	}

	public function delete($userId='*'){
		$userId=intval($userId);
		if($userId){
			if($this->userModel->delete($userId)){
				return array(SUCCESS,null);
			}
		}
		return array(DATABASE_UPDATE_ERR,mysql_error());
	}
}