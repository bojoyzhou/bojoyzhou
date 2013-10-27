<?php
/**
 * 错误码定义
 * @var integer
 */
$code=-20000;
/**
 * 所有controller的基类,都继承MY_Controller
 * 进行csrf校验
 */

class MY_Record{
	private $storage;
	private $needSave;
	private $needInsert;
	private $table;

	public function __construct($table,$data=array()){
		$this->table=$table;
		$this->storage=$data;
		$this->needSave=false;
		$this->ci=&get_instance();
		$this->ci->load->database();

		if(!count($data)){
			$this->needInsert=true;
		}
	}

	public function __destruct(){
		if($this->needSave){
			$this->save();
		}else if($this->needInsert){
			$this->insert();
		}
	}

	public function __get($key){
		return $this->storage[$key];
	}

	public function __set($key,$value){
		$this->storage[$key]=$value;
		$this->needSave=true;
	}

	private function save(){
		$this->db->query();
	}
}