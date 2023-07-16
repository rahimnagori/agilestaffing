<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Jobs extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Common_Model');
    if(!$this->check_login()){
      redirect('Admin');
    }
  }

  public function check_login(){
    return ($this->session->userdata('is_admin_logged_in')) ? true : false;
  }

  public function index(){
    $pageData = [];
    $admin_id = $this->session->userdata('id');
    $where['id'] = $admin_id;
    $adminData = $this->Common_Model->fetch_records('admins', $where, false, true);
    $pageData['adminData'] = $adminData;
    // $join[0][] = 'job_types';
    // $join[0][] = 'jobs.job_type = job_types.id';
    // $join[0][] = 'left';
    // $join[1][] = 'job_modes';
    // $join[1][] = 'jobs.job_mode = job_modes.id';
    // $join[1][] = 'left';
    // $whereJoin['jobs.is_deleted'] = 0;
    // $select = 'jobs.*, job_types.job_type_title, job_types.job_type_description, job_modes.mode_title';
    // $pageData['jobs'] = $this->Common_Model->join_records('jobs', $join, $whereJoin, $select, 'jobs.id', 'DESC');
    // $pageData['locations'] = $this->Common_Model->fetch_records('job_locations');
    // $pageData['jobTypes'] = $this->Common_Model->fetch_records('job_types');
    $pageData['jobs'] = $this->Common_Model->fetch_records('jobs', array('is_deleted' => 0), false, false, 'id');

    $this->load->view('admin/jobs_management', $pageData);
  }

  public function add_job(){
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $insert = $this->create_job();
    if($this->Common_Model->insert('jobs', $insert)){
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Job added successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  private function create_job($update = false){
    $insert['title'] = $this->input->post('title');
    $insert['description'] = $this->input->post('description');
    $insert['position'] = $this->input->post('position');
    $insert['job_mode'] = $this->input->post('job_mode');
    $insert['company'] = $this->input->post('company');
    $insert['address'] = $this->input->post('address');
    $insert['salary'] = $this->input->post('salary');
    $insert['user_id'] = $this->session->userdata('id');
    $insert['last_date'] = $this->input->post('last_date');
    $insert['is_deleted'] = 0;
    $insert['updated'] = date("Y-m-d H:i:s");
    if(!$update){
      $insert['created'] = $insert['updated'];
    }
    return $insert;
  }

  public function delete_job(){
    $response['status'] = 0;
    $where['id'] = $this->input->post('delete_job_id');
    $update['is_deleted'] = 1;
    if($this->Common_Model->update('jobs', $where, $update)){
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Job deleted successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function get_job($id){
    // $join[0][] = 'job_types';
    // $join[0][] = 'jobs.job_type = job_types.id';
    // $join[0][] = 'left';
    // $where['jobs.is_deleted'] = 0;
    // $where['jobs.id'] = $id;
    // $select = 'jobs.*, job_types.name';
    // $jobDetails = $this->Common_Model->join_records('jobs', $join, $where, $select, 'jobs.id', 'DESC');
    // $pageData['jobDetails'] = $jobDetails[0];
    $pageData['jobDetails'] = $this->Common_Model->fetch_records('jobs', array('id' => $id), false, true);

    $this->load->view('admin/include/job_details', $pageData);
  }

  public function update_job(){
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong.');
    $update = $this->create_job('update');
    $where['id'] = $this->input->post('job_id');
    if($this->Common_Model->update('jobs', $where, $update)){
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Job updated successfully.');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function applications(){
    $pageData = [];
    $admin_id = $this->session->userdata('id');
    $where['id'] = $admin_id;
    $adminData = $this->Common_Model->fetch_records('admins', $where, false, true);
    $pageData['adminData'] = $adminData;

    $join[0][] = "users";
    $join[0][] = "job_applications.user_id = users.id";
    $join[0][] = "left";
    $join[1][] = "jobs";
    $join[1][] = "job_applications.job_id = jobs.id";
    $join[1][] = "left";
    $where = false;
    $select = "job_applications.status, users.*, jobs.id AS job_id, jobs.title, jobs.job_mode";
    $pageData['jobApplications'] = $this->Common_Model->join_records('job_applications', $join, $where, $select, false, 'job_applications.id');
    // echo "<p>" .$this->db->last_query() ."</p>";
    // echo "<pre>";
    // print_r($pageData);
    // die;

    $this->load->view('admin/job_applications', $pageData);
  }

}
