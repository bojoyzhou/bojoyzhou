<?php
/**
 * 所有controller的基类,都继承MY_Controller
 * 进行csrf校验
 */
class Model{
	private $table;
	private $fields;
	private $record;
	public function __construct($table){
		$CI=&get_instance();
		$CI->load->database(ENVIRONMENT);
		$this->table=$table;
	}

	public function setFields($fields){
		$this->fields=$fields;
	}

	public function __set($key,$value){
		$this->$key=$value;
	}

	private function getData($res){
		$ret=array();
		while(($row=mysql_fetch_assoc($res))!==false){
			$ret[]=$row;
		}
		return $ret;
	}

	public function select($id='-1'){
		$id=intval($id,10);
		if(!isset($this->fields)){
			return array();
		}else{
			$fields=implode('`,`',$this->fields);
			$cond='';
			if($id!==-1){
				$cond=' WHERE id='.$id;
			}
			return $this->getData(mysql_query('SELECT `'.$fields.'` FROM `'.$this->table.'`'.$cond));
		}
	}

	public function delete($id){
		$id=intval($id,10);
		return mysql_query('DELETE FROM `'.$this->table.'` WHERE `id`='.$id);
	}

	public function update($id,$record){
		$id=intval($id,10);
		$set=array();
		foreach ($record as $key => $value) {
			$set[]='`'.$key.'`=\''.mysql_real_escape_string($value).'\'';
		}
		return mysql_query('UPDATE `'.$this->table.'` SET '.implode(',',$set).' WHERE `id`='.$id);
	}

	public function insert($record=array()){
	    $values = array_map('mysql_real_escape_string', array_values($record));
	    $keys = array_keys($record);
	    if(count($keys)<1){
	    	return false;
	    }
	    return mysql_query('INSERT INTO `'.$this->table.'` (`'.implode('`,`', $keys).'`) VALUES (\''.implode('\',\'', $values).'\')');
	}
}