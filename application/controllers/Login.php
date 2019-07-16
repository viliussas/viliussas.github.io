<?php

class Login extends CI_controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Login_model');
		$this->load->model('Tasks_model');
		$this->load->library('session');
        $this->load->library("pagination");
	}

	public function index() {
		$this->load->view("login.php");
	}

	public function login_user(){

		$user_login=array(
			'User_name'=>$this->input->post('User_name'),
			'Password'=>$this->input->post('Password')
		);

		$data=$this->Login_model->login_user($user_login['User_name'],$user_login['Password']);

		if($data) {
			$this->session->set_userdata('User_id',$data['User_id']);
			$this->session->set_userdata('Firstname_lastname',$data['Firstname_lastname']);
			$this->session->set_userdata('User_name',$data['User_name']);
			$this->session->set_userdata('Password',$data['Password']);
			$this->session->set_userdata('Admin',$data['Admin']);

			if($this->session->userdata('Admin')){

                $config["base_url"] = base_url() . "Tasks/index";
                $config["total_rows"] = $this->Tasks_model->count_tasks();
                $config["per_page"] = 5;

                $choice = $config["total_rows"] / $config["per_page"];
                $config["num_links"] = round($choice);

                $this->pagination->initialize($config);

                $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
                $data["tasks_list"] = $this->Tasks_model->fetch_tasks($config["per_page"], $page);
                $data["links"] = $this->pagination->create_links();

                $this->load->view("Tasks.php", $data);

            }
            else{

                $data["tasks"] = $this->Tasks_model->get_users_tasks($this->session->userdata('User_id'));
                $this->load->view("Homepage.php", $data);
            }

		}
		else{
			$this->session->set_flashdata('error_msg', 'Incorrect username or password!');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function user_logout() {
		$this->session->sess_destroy();
		redirect('Login');
	}

    public function get_back_to_homepage() {
        $data["tasks"] = $this->Tasks_model->get_users_tasks($this->session->userdata('User_id'));
        $this->load->view("Homepage.php", $data);
    }

}
