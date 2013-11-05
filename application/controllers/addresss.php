<?php
class Addresss extends MY_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function get($id='-1'){
		return array(SUCCESS,$this->model->select(array('name','phone','address'),$id));
	}

	public function post($desc){
		$ret=$this->model->insert($desc);
		if($ret){
			return array(SUCCESS,null);
		}
		return array(DATABASE_INSERT_ERR,mysql_error());
	}

	public function put($id,$data){
		$ret=$this->model->update($id,$data);
		if($ret){
			return array(SUCCESS,null);
		}
		return array(DATABASE_UPDATE_ERR,mysql_error());
	}

	public function delete($id=0){
		$id=intval($id);
		if($id){
			if($this->model->delete($id)){
				return array(SUCCESS,null);
			}
		}
		return array(DATABASE_UPDATE_ERR,mysql_error());
	}
}