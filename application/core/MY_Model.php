<?php
Class My_Model extends CI_Model {
	private $table;
	private $pk;

	public function __construct()
	{
		parent::__construct();
	}
	
	public function set_table($table = '', $pk = '') 
	{
		$this->table = $table;
		$this->pk = $pk;
		return $this;
	}
	
	public function get_all()
	{
		return $this->_get()->result();
	}
	
	public function get_array()
	{
		return $this->_get()->result_array();
	}
	
	public function get($id = '0')
	{
		$this->db->where($this->pk,$id);
		return $this->_get()->row();
	}
	
	public function get_by($param)
	{
		if (is_array($param)) {
			$this->db->where($param);
			return $this->_get()->row();
		}
		return FALSE;
	}
	
	public function get_many_by($param)
	{
		if (is_array($param)) {
			$this->db->where($param);
			return $this->get_all();
		}
		return FALSE;
	}
	
	protected function _get()
	{
		return $this->db->get($this->table);
	}
}
?>