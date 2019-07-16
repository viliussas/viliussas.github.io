<?php

class Login_model extends CI_model {

	function __construct() {
		parent::__construct();
		$this->load->database("praktika_uzduotis");
	}

	public function login_user($username,$pass) {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('User_name', $username);
		$this->db->where('Password', $pass);
		if ($query = $this->db->get()) {
			return $query->row_array();
		}
		else {
			return false;
		}
	}

}
