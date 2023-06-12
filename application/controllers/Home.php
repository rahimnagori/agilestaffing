<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Common_Model');
    $this->load->library('session');
  }

  private function check_login()
  {
    return ($this->session->userdata('is_user_logged_in')) ? true : false;
  }

  public function index()
  {
    $pageData = $this->Common_Model->get_userdata();
    $pageData['jobs'] = $this->Common_Model->fetch_records('jobs', array('is_deleted' => 0, 'last_date >=' => date("Y-m-d H:i:s") ));
    $pageData['filters'] = $this->Common_Model->get_filters($pageData['jobs']);

    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/index', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function login()
  {
    if ($this->check_login()) {
      redirect('Profile');
    }
    $pageData = [];
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/login', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function signup()
  {
    if ($this->check_login()) {
      redirect('Profile');
    }
    $this->load->view('site/include/header');
    $this->load->view('site/sign-up');
    $this->load->view('site/include/footer');
  }

  public function forget()
  {
    if ($this->check_login()) {
      redirect('Profile');
    }
    $pageData = [];
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/forget', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  /* Some static pages */

  public function about()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/about', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function cookie()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/cookie', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function terms()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/terms', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function contact()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/contact', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function privacy()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/privacy', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function legal()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/legal', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function post_jobs()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/post_jobs', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function post_jobs2()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/post_jobs2', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function post_jobs3()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/post_jobs3', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function message()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/message', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function notification()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/notification', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function job_list()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/job_list', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function candidate()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/candidate', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function setting()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/setting', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function review()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/review', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function profile_company()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/Profile_Company', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function job()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/job', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function interview()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/interview', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function photos()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/photos', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function question()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/question', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }


  public function company_profile()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/company_profile', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

}