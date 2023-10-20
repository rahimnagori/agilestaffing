<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Users extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Common_Model');
    if(!$this->check_login()){
      redirect('Admin');
    }
  }

  public function index(){
    $pageData = [];
    $admin_id = $this->session->userdata('id');
    $where['id'] = $admin_id;
    $adminData = $this->Common_Model->fetch_records('admins', $where, false, true);
    $pageData['adminData'] = $adminData;

    $join[0][] = 'user_details';
    $join[0][] = 'users.id = user_details.user_id';
    $join[0][] = 'left';
    $select = '*';
    $whereUsers = ['users.is_deleted' => 0];
    $pageData['users'] = $this->Common_Model->join_records('users', $join, $whereUsers, $select);

    $this->load->view('admin/users_management', $pageData);
  }

  public function check_login(){
    return ($this->session->userdata('is_admin_logged_in')) ? true : false;
  }

  public function delete_user(){
    $response['status'] = 0;
    $where['id'] = $this->input->post('delete_user_id');
    $update['is_deleted'] = 1;
    if($this->Common_Model->update('users', $where, $update)){
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('User deleted successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

}