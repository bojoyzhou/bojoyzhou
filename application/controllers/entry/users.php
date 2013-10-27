<?php
class Users extends Entry{
	private $storage;

	public function __construct(){
		$this->storage=array(
			'-1'=>'null',
			'1'=>'bojoyzhou1',
			'2'=>'bojoyzhou2',
			'3'=>'bojoyzhou3',
			'4'=>'bojoyzhou4'
		);
	}

	public function get($id='-1'){
		return array(SUCCESS,$id==='-1'?$this->storage:isset($this->storage[$id])?$this->storage[$id]:null);
	}

	public function post(){

	}

	public function put($data){

	}

	public function delete($userId='*'){

	}
}