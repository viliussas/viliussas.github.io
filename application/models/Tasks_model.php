<?php

class Tasks_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database("praktika_uzduotis");
    }

    public function insert_task_to_db($data) {
        return $this->db->insert('tasks', $data);
    }

    public function getById($id) {
        $query = $this->db->get_where('tasks', array('Task_id'=>$id));
        return $query->row_array();
    }

    public function update_info($data, $id) {
        $this->db->where('tasks.Task_id', $id);
        return $this->db->update('tasks', $data);
    }

    public function delete_a_task($id) {
        $this->db->where('tasks.Task_id', $id);
        return $this->db->delete('tasks');
    }

    public function count_tasks() {
        return $this->db->count_all("tasks");
    }

    public function fetch_tasks($limit, $start) {

        $this->db->limit($limit, $start);
        $query = $this->db->get("tasks");

        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function get_descriptions() {
        $this->db->select('Task_description');
        $this->db->from('tasks');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function get_users() {
        $this->db->select('Firstname_lastname');
        $this->db->from('users');
        $this->db->where('users.Admin', FALSE);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function get_TaskId($task_description) {
        $this->db->select('Task_id');
        $this->db->from('tasks');
        $this->db->where('tasks.Task_description', $task_description);
        $query = $this->db->get();
        $result = $query->row();
        return $result->Task_id;
    }

    public function get_UserId($firstname_lastname) {
        $this->db->select('User_id');
        $this->db->from('users');
        $this->db->where('users.Firstname_lastname', $firstname_lastname);
        $query = $this->db->get();
        $result = $query->row();
        return $result->User_id;
    }

    public function insert_assigned_task_to_db($data) {
        return $this->db->insert('tasks_for_users', $data);
    }

    public function count_tasks_for_users() {
        return $this->db->count_all("tasks_for_users");
    }

    public function fetch_tasks_for_users($limit, $start) {

        $this->db->limit($limit, $start);
        $query = $this->db->get("tasks_for_users");

        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function delete_a_task_for_user($id1, $id2) {
        $this->db->where('tasks_for_users.Task_id', $id1);
        $this->db->where('tasks_for_users.User_id', $id2);
        return $this->db->delete('tasks_for_users');
    }

    public function get_users_tasks($id) {
        $this->db->select('*');
        $this->db->from('tasks');
        $this->db->join('tasks_for_users', 'tasks.Task_id = tasks_for_users.Task_id');
        $this->db->where('tasks_for_users.User_id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function change_task_status($id1, $id2, $done) {
        $this->db->where('tasks_for_users.Task_id', $id1);
        $this->db->where('tasks_for_users.User_id', $id2);
        $data = array(
            'Task_id' => $id1,
            'User_id'  => $id2,
            'State'  => $done
        );
        $this->db->delete('tasks_for_users');
        $this->db->replace('tasks_for_users', $data);
    }

}
