<?php
/**
 * 所有controller的基类,都继承MY_Controller
 * 进行csrf校验
 */
class MY_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database(ENVIRONMENT);
		$this->table=get_class($this);
	}

	public function __set($key,$value){
		$this->$key=$value;
	}

	public function insert($record=array()){
	    $values = array_map('mysql_real_escape_string', array_values($record));
	    $keys = array_keys($inserts);
	    return mysql_query('INSERT INTO `'.$table.'` (`'.implode('`,`', $keys).'`) VALUES (\''.implode('\',\'', $values).'\')');
	}
}