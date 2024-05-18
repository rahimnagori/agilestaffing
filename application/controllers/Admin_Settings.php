<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Settings extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Common_Model');
    if (!$this->check_login()) {
      redirect('Admin');
    }
  }

  public function index()
  {
    redirect('Admin');
    $pageData = $this->Common_Model->getAdmin($this->session->userdata('id'));
    $pageData['permissions'] = $this->Common_Model->fetch_records('permissions', array('is_active' => 1), false, false, 'type', 'ASC');
    $pageData['emails'] = $this->Common_Model->fetch_records('emails', array('is_active' => 1));
    // $pageData['settings'] = $this->Common_Model->fetch_records('settings', false, 'smtp_user, smtp_pass, contact_email, admin_email, doc_expire_days, cv_expire_days', true);
    $pageData['settings'] = $this->Common_Model->fetch_records('settings', false, false, true);
    $params = $this->Common_Model->fetch_records('email_params');
    foreach($params as $param){
      $pageData['params'][] = $param['view_param'];
    }

    // $this->testing();

    $this->load->view('admin/settings', $pageData);
  }

  private function testing(){
    $emailContent = $this->Common_Model->get_email_content('testing');
    $newEmailContent = $this->Common_Model->generate_final_email($emailContent);
    echo "<pre>";
    print_r($newEmailContent);
    die;
  }

  public function update_admin_permissions()
  {
    $response['responseMessage'] = $this->Common_Model->error('Server error, please try again later');
    $response['status'] = 0;
    $defaultPermissions = $this->Common_Model->fetch_records('permissions', array('is_active' => 1));
    foreach ($defaultPermissions as $defaultPermission) {
      $this->form_validation->set_rules($defaultPermission['permission'], $defaultPermission['permission'], 'required');
    }
    if ($this->form_validation->run()) {
      foreach ($defaultPermissions as $defaultPermission) {
        $wherePermission['permission'] = $defaultPermission['permission'];
        $update['comment'] = $this->input->post($defaultPermission['permission']);
        $this->Common_Model->update('permissions', $wherePermission, $update);
      }
      $response['responseMessage'] = $this->Common_Model->success('Permissions updated successfully.');
      $response['status'] = 1;
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }

    echo json_encode($response);
  }

  public function get_email()
  {
    $emailContentId = $this->input->get('email_id');
    $pageData['emailData'] = $this->Common_Model->fetch_records('emails', array('id' => $emailContentId), false, true);
    $this->load->view('admin/include/email-content', $pageData);
  }

  public function update_email()
  {
    $response['responseMessage'] = $this->Common_Model->error('Server error, please try again later');
    $response['status'] = 0;

    $update['content'] = $this->input->post('content');
    $where['id'] = $this->input->post('email_id');
    if ($this->Common_Model->update('emails', $where, $update)) {
      $response['responseMessage'] = $this->Common_Model->success('Email content updated successfully.');
      $response['status'] = 1;
    }

    echo json_encode($response);
  }

  public function update_settings()
  {
    $response['responseMessage'] = $this->Common_Model->error('Server error, please try again later');
    $response['status'] = 0;

    $settings = $this->Common_Model->fetch_records('settings', false, false, true);

    $update = [];
    $update['smtp_user'] = ($this->input->post('smtp_user')) ? $this->input->post('smtp_user') : $settings['smtp_user'];
    $update['smtp_pass'] = ($this->input->post('smtp_pass')) ? $this->input->post('smtp_pass') : $settings['smtp_pass'];
    $update['contact_email'] = ($this->input->post('contact_email')) ? $this->input->post('contact_email') : $settings['contact_email'];
    $update['admin_email'] = ($this->input->post('admin_email')) ? $this->input->post('admin_email') : $settings['admin_email'];
    $update['doc_expire_days'] = ($this->input->post('doc_expire_days')) ? $this->input->post('doc_expire_days') : $settings['doc_expire_days'];
    $update['cv_expire_days'] = ($this->input->post('cv_expire_days')) ? $this->input->post('cv_expire_days') : $settings['cv_expire_days'];
    if ($this->Common_Model->update('settings', array('id' => 1), $update)) {
      $response['responseMessage'] = $this->Common_Model->success('Settings updated successfully.');
      $response['status'] = 1;
    }

    echo json_encode($response);
  }

  public function check_login()
  {
    return ($this->session->userdata('is_admin_logged_in')) ? true : false;
  }
}