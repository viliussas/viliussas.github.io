<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Tasks extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Tasks_model');
        $this->load->library("pagination");
    }

    public function index() {

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

    public function add_form() {
        $this->load->view('insert_tasks');
    }

    public function assign_task() {

        $udata['descriptions'] = $this->Tasks_model->get_descriptions();
        $udata['users'] = $this->Tasks_model->get_users();

        $this->load->view('assign_tasks.php', $udata);
    }

    public function insert_task_db() {

        $udata['Task_description'] = $this->input->post('Task_description');

        $res = $this->Tasks_model->insert_task_to_db($udata);

        if($res) {
            header('location:'.base_url()."Tasks/".$this->index());
			$this->session->set_flashdata('success_msg1', 'Task successfully created!');
        }
    }

    public function assign_task_db() {

        $udata['Task_description'] = $this->input->post('Task_description');
        $udata['Firstname_lastname'] = $this->input->post('Firstname_lastname');

        $mdata['Task_id'] = $this->Tasks_model->get_TaskId($udata['Task_description']);
        $mdata['User_id'] = $this->Tasks_model->get_UserId($udata['Firstname_lastname']);
        $mdata['State'] = "In progress";

        $res = $this->Tasks_model->insert_assigned_task_to_db($mdata);

        if($res) {
            header('location:'.base_url()."Tasks/".$this->index());
            $this->session->set_flashdata('success_msg1', 'Task successfully assigned!');
        }
    }

    public function update() {

		$mdata['Task_description'] = $_POST['Task_description'];

        $res = $this->Tasks_model->update_info($mdata, $_POST['id']);

        if($res) {
            header('location:'.base_url()."Tasks/".$this->index());
			$this->session->set_flashdata('success_msg1', 'Task successfully updated!');
        }
    }

    public function delete($id) {
        $this->Tasks_model->delete_a_task($id);
        header('location:' . base_url() . "Tasks/".$this->index());
		$this->session->set_flashdata('success_msg1', 'Task successfully deleted!');
    }

    public function edit() {
        $id = $this->uri->segment(3);
        $data['task'] = $this->Tasks_model->getById($id);
        $this->load->view('edit_tasks', $data);
    }

    public function show_assigned_tasks() {

        $config["base_url"] = base_url() . "Tasks/show_assigned_tasks";
        $config["total_rows"] = $this->Tasks_model->count_tasks_for_users();
        $config["per_page"] = 5;

        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
        $data["tasks_for_users_list"] = $this->Tasks_model->fetch_tasks_for_users($config["per_page"], $page);

        $data["links"] = $this->pagination->create_links();

        $this->load->view("tasks_for_users.php", $data);

    }

    public function delete_task_for_user() {
        $id1 = $this->uri->segment(3);
        $id2 = $this->uri->segment(4);
        $this->Tasks_model->delete_a_task_for_user($id1, $id2);
        header('location:' . base_url() . "Tasks/show_assigned_tasks".$this->index());
        $this->session->set_flashdata('success_msg1', 'Task for the user successfully deleted!');
    }

    public function change_status() {
        $id1 = $this->uri->segment(3);
        $id2 = $this->uri->segment(4);
        $done = "Done";
        $this->Tasks_model->change_task_status($id1, $id2, $done);
        header('location:' . base_url() . "Login/get_back_to_homepage");
        $this->session->set_flashdata('success_msg1', 'Task state successfully changed!');
    }

}
