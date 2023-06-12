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

  public function test($data = false){
    if($data == 'Insert'){
      $title = ["Marketing Coordinator", "Customer Service Representative", "Sales Associate", "Graphic Designer"];
      $description = ["We are seeking a motivated Marketing Coordinator to join our dynamic marketing team. In this role, you will assist in the implementation and execution of marketing campaigns, conduct market research, and support various marketing initiatives to drive brand awareness and customer engagement.", "We are hiring a Customer Service Representative to join our dedicated team. As a Customer Service Representative, you will be the first point of contact for our customers, providing exceptional service and support to ensure their satisfaction and maintain strong customer relationships.", "We are looking for a proactive and motivated Sales Associate to join our team. As a Sales Associate, you will play a key role in driving sales and delivering exceptional customer service. Your goal will be to provide a positive shopping experience and meet or exceed sales targets.", "We are seeking a talented Graphic Designer to join our creative team. As a Graphic Designer, you will be responsible for creating visually appealing designs that communicate our brand message effectively. Your designs will be used across various marketing channels and materials, including digital and print media."];
      $position = $title;
      $company = ["GlobalTech Solutions", "Stellar Services Ltd.", "Alpha Retail Solutions", " CreativeWorks Agency"];
      $address = ["Techland", "Supportland", "Salesland", "Creativia"];
  
      foreach($title as $titl){
        $insert = [
          'title' => $title[rand(0,3)],
          'description' => $description[rand(0,3)],
          'job_mode' => rand(1,3),
          'user_id' => 1,
          'is_deleted' => 0,
          'position' => $position[rand(0,3)],
          'company' => $company[rand(0,3)],
          'address' => $address[rand(0,3)],
          'salary' => rand(500, 1000),
          'last_date' => date("Y-m-d H:i:s", strtotime("now + " .rand(100, 500) ."day")),
          'created' => date("Y-m-d H:i:s"),
          'updated' => date("Y-m-d H:i:s")
        ];
        $this->Common_Model->insert('jobs', $insert);
        echo "<p>" .$this->db->last_query() ."</p>";
      }
    }else {
      redirect('');
    }
  }

}