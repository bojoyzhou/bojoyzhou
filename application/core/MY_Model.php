<?php
class MY_Model extends CI_Model{
	private $table;

	public function __construct(){
		$this->load->database(ENVIRONMENT);
		$this->table=preg_replace('/s_(.*)/','',get_class($this));
	}

	private function getData($res){
		$ret=array();
		while(($row=mysql_fetch_assoc($res))!==false){
			$ret[]=$row;
		}
		return $ret;
	}

	public function select($fields=array(),$id=0){
		$id=intval($id,10);
		if(!count($fields)){
			return array();
		}else{
			$fields=implode('`,`',$fields);
			$cond='';
			if($id){
				$cond=' WHERE id='.$id;
			}
			$sql='SELECT `'.$fields.'` FROM `'.$this->table.'`'.$cond;
			return $this->getData(mysql_query($sql));
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