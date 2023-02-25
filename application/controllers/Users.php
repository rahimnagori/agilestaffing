<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
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
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');

    $this->form_validation->set_rules('email', 'email', 'required|trim');
    $this->form_validation->set_rules('password', 'password', 'required');
    if ($this->form_validation->run()) {
      $isUserExist = false;
      $where['phone'] = $this->input->post('email');
      $where['password'] = md5($this->input->post('password'));
      $userDetailsWithPhone = $this->Common_Model->fetch_records('users', $where);
      if (!empty($userDetailsWithPhone)) {
        $isUserExist = true;
        $userDetails = $userDetailsWithPhone;
      }
      $where['email'] = $this->input->post('email');
      unset($where['phone']);
      $userDetailsWithEmail = $this->Common_Model->fetch_records('users', $where);
      if (!empty($userDetailsWithEmail)) {
        $isUserExist = true;
        $userDetails = $userDetailsWithEmail;
      }
      if ($isUserExist) {
        $update['is_logged_in'] = 1;
        $update['last_login'] = date("Y-m-d H:i:s");
        $this->Common_Model->update('users', $where, $update);
        $this->session->set_userdata(array('id' => $userDetails[0]['id'], 'is_user_logged_in' => true, 'userdata' => $userDetails[0]));
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Logged in successfully.');
      } else {
        $response['status'] = 2;
        $response['responseMessage'] = $this->Common_Model->error('User does not exists. Please check your credentials.');
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function register()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');

    $this->form_validation->set_rules('first_name', 'first_name', 'required');
    $this->form_validation->set_rules('last_name', 'last_name', 'required');
    $this->form_validation->set_rules('email', 'email', 'required|valid_email|trim|is_unique[users.email]', array('is_unique' => 'This email is already taken. Please provide another email.'));
    $this->form_validation->set_rules('password', 'password', 'required');
    $this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[password]', array('matches' => 'Password and Confirm password does not match.'));
    $this->form_validation->set_rules('phone', 'phone', 'required');
    // $this->form_validation->set_rules('username', 'username', 'required|is_unique[users.username]|trim');
    if ($this->form_validation->run()) {
      $insert = $this->create_user();
      if ($_FILES['resume']['error'] === 0) {
        $config['upload_path'] = "assets/site/resume/";
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['encrypt_name'] = true;
        $this->load->library("upload", $config);
        if ($this->upload->do_upload('resume')) {
          $insert['resume'] = $config['upload_path'] . $this->upload->data("file_name");
          $response['resumeUpload'] = true;
        }
      }
      $userId = $this->Common_Model->insert('users', $insert);
      if ($userId) {
        $emailResponse = $this->send_verification_email($userId);
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Check your email to complete registration. If you have not found mail in Inbox please check your junk folder.' . $emailResponse);
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function profile()
  {
    if (!$this->check_login()) {
      $responseMessage = $this->Common_Model->error('Please login to continue.');
      $this->session->set_flashdata('responseMessage', $responseMessage);
      redirect('Login');
    }
    $pageData = $this->Common_Model->get_userdata();
    if ($pageData['userDetails']['is_email_verified'] != 1) {
      redirect('Verify');
    }

    $where['user_id'] = $pageData['userDetails']['id'];
    $pageData['userExperiences'] = $this->Common_Model->fetch_records('user_experiences', $where);

    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/profile', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function edit_profile()
  {
    if (!$this->check_login()) {
      $responseMessage = $this->Common_Model->error('Please login to continue.');
      $this->session->set_flashdata('responseMessage', $responseMessage);
      redirect('Login');
    }
    $pageData = $this->Common_Model->get_userdata();
    if ($pageData['userDetails']['is_email_verified'] != 1) {
      redirect('Verify');
    }
    $pageData['editPage'] = true;

    $where['user_id'] = $this->session->userdata('id');
    $isUserDetailsExist = $this->Common_Model->fetch_records('user_details', $where, false, true);
    if (empty($isUserDetailsExist)) {
      $insertOrUpdate['user_id'] = $where['user_id'];
      $this->Common_Model->insert('user_details', $insertOrUpdate);
    }

    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/edit-profile', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function update_profile()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong');
    $updateProfile['current_job_role'] = $this->input->post('current_job_role');
    $updateProfile['expected_job_role'] = $this->input->post('expected_job_role');
    $updateProfile['current_job_type'] = $this->input->post('current_job_type');
    $updateProfile['current_payment_type'] = $this->input->post('current_payment_type');
    $updateProfile['city'] = $this->input->post('city');
    $updateProfile['post_code'] = $this->input->post('post_code');
    $updateProfile['job_preference'] = $this->input->post('job_preference');
    $updateProfile['sex'] = $this->input->post('sex');
    $updateProfile['notice_period'] = $this->input->post('notice_period');
    $updateProfile['user_about'] = $this->input->post('user_about');
    $updateProfile['user_skills'] = $this->input->post('user_skills');
    $updateProfile['availability_for_meeting'] = date('Y-m-d H:i:s', strtotime($this->input->post('availability_for_meeting')));
    if (isset($_FILES) && $_FILES['profile_image']['error'] == 0) {
      $config['upload_path'] = "assets/site/img/profile/";
      $config['allowed_types'] = 'jpeg|gif|jpg|png';
      $config['encrypt_name'] = true;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('profile_image')) {
        $profileImage = $this->upload->data("file_name");

        $updateProfile['profile_image'] = $config['upload_path'] . $profileImage;
      } else {
        $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
      }
    }

    if (isset($_FILES) && $_FILES['resume']['error'] == 0) {
      $config['upload_path'] = "assets/site/resume/";
      $config['allowed_types'] = 'doc|pdf|docx';
      $config['encrypt_name'] = true;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('resume')) {
        $resume = $this->upload->data("file_name");

        $updateProfile['resume'] = $config['upload_path'] . $resume;
      } else {
        $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
      }
    }

    if (isset($_FILES) && $_FILES['cover_letter']['error'] == 0) {
      $config['upload_path'] = "assets/site/cover_letter/";
      $config['allowed_types'] = 'doc|pdf|docx';
      $config['encrypt_name'] = true;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('cover_letter')) {
        $cover_letter = $this->upload->data("file_name");

        $updateProfile['cover_letter'] = $config['upload_path'] . $cover_letter;
      } else {
        $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
      }
    }

    $where['user_id'] = $this->session->userdata('id');
    if ($this->Common_Model->update('user_details', $where, $updateProfile)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Profile updated successfully');
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function update_experience(){
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong');
    if (!$this->check_login()) {
      redirect('Login');
    }
    $this->form_validation->set_rules('position', 'position', 'required');
    $this->form_validation->set_rules('organization', 'organization', 'required');
    $this->form_validation->set_rules('emp_start_date', 'emp_start_date', 'required');
    $this->form_validation->set_rules('location', 'location', 'required');
    if ($this->form_validation->run()) {
      $insert['user_id'] = $this->session->userdata('id');
      $insert['position'] = $this->input->post('position');
      $insert['organization'] = $this->input->post('organization');
      $insert['location'] = $this->input->post('location');
      $insert['emp_start_date'] = date('Y-m-d', strtotime($this->input->post('emp_start_date')));
      $insert['emp_end_date'] = ($this->input->post('emp_end_date')) ? date('Y-m-d', strtotime($this->input->post('emp_end_date'))) : null;
      $response['exp_id'] = $this->Common_Model->insert('user_experiences', $insert);
      if($response['exp_id']){
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Experience added successfully.');
      }
    }else{
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }

    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function remove_experience(){
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong');
    $where['id'] = $this->input->post('exp_id');
    if($this->Common_Model->delete('user_experiences', $where)){
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Experience removed successfully.');
      $response['exp_id'] = $where['id'];
    }

    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function verify()
  {
    if (!$this->check_login()) {
      $responseMessage = $this->Common_Model->error('Please login to continue.');
      $this->session->set_flashdata('responseMessage', $responseMessage);
      redirect('Login');
    }
    $pageData = $this->Common_Model->get_userdata();
    if ($pageData['userDetails']['is_email_verified'] == 1) {
      $responseMessage = $this->Common_Model->success('Email verified successfully.');
      $this->session->set_flashdata('responseMessage', $responseMessage);
      redirect('Profile');
    }
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/email-verification', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function resend()
  {
    $pageData = $this->Common_Model->get_userdata();

    $response['responseMessage'] = $this->Common_Model->error('Server error, please try again later');
    $response['status'] = 0;

    if ($pageData['userDetails']['id']) {
      $emailResponse = $this->send_verification_email($pageData['userDetails']['id'], true);
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Verification email sent successfully.' . $emailResponse);
    }
    echo json_encode($response);
  }

  private function send_verification_email($userId, $resend = false)
  {
    $userdata = $this->Common_Model->fetch_records('users', array('id' => $userId), false, true);
    if ($userdata) {
      if ($userdata['is_email_verified'] == 0) {
        $token = rand(100000, 999999);
        $update['token'] = $token;
        $this->Common_Model->update('users', array('id' => $userId), $update);
        $verificationLink = $this->config->item('base_url');
        $verificationLink .= 'Verify/' . $userdata['id'] . '/' . $token;

        $subject = ($resend) ? 'Re: Verify you email address.' : 'Verify your email address.';
        $body = "<p>Hello " . $userdata['first_name'] . " " . $userdata['last_name'] . ",</p>";
        $body .= "<p>Please verify your account to continue using our services by clicking the link below.</p>";
        $body .= "<p><a href='" . $verificationLink . "'>Verify Now</a></p>";
        $body .= "<p>If the above link doesn't work, you may copy paste the below link in your browser also.</p>";
        $body .= "<p>" . $verificationLink . "</p>";
        if ($this->config->item('ENVIRONMENT') == 'production') {
          $this->Common_Model->send_mail($userdata['email'], $subject, $body);
          return '';
        } else {
          return "<br/>" . $body;
        }
      }
    } else {
      /* User does not exist */
    }
  }

  public function email_verification($user_id, $token)
  {
    $where['token'] = $token;
    $where['id'] = $user_id;
    $userdata = $this->Common_Model->fetch_records('users', $where, false, true);
    if ($userdata) {
      if ($userdata['is_email_verified'] != 1) {
        $update['token'] = null;
        $update['last_login'] = date("Y-m-d H:i:d");
        $update['is_email_verified'] = 1;
        if ($this->Common_Model->update('users', array('id' => $userdata['id']), $update)) {
          $to = $userdata['email'];
          $subject = 'Email successfully verified.';
          $body = '<p>Hello ' . $userdata['first_name'] . ' ' . $userdata['last_name'] . ',</p>';
          $body .= '<p>Congratulations!! your email has been verified successfully. You may now continue using our services.</p>';
          if ($this->config->item('ENVIRONMENT') == 'production') {
            $this->Common_Model->send_mail($to, $subject, $body);
          }
          if ($this->session->userdata('is_logged_id')) {
            redirect('Verify');
          } else {
            $message = $this->Common_Model->success('Thank you: Your email has been verified successfully. Please login to continue.');
            $this->session->set_flashdata('responseMessage', $message);
            redirect('Login');
          }
        }
      } else {
        $message = $this->Common_Model->success('Email already verified.');
        $this->session->set_flashdata('responseMessage', $message);
        redirect('Login');
      }
    } else {
      $message = $this->Common_Model->error('This link has been expired.');
      $this->session->set_flashdata('responseMessage', $message);
      redirect('');
    }
  }

  public function update()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
    $response['isResumeUploaded'] = 0;

    if (!$this->check_login()) {
      $responseMessage = $this->Common_Model->error('Please login to continue.');
      $this->session->set_flashdata('responseMessage', $responseMessage);
      redirect('Login');
    }
    if ($_FILES['resume']['error'] == 0) {
      $config['upload_path'] = "assets/site/resume/";
      $config['allowed_types'] = 'doc|docx|pdf';
      $config['encrypt_name'] = true;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('resume')) {
        $resume = $this->upload->data("file_name");

        $update['resume'] = $config['upload_path'] . $resume;
        $oldResume = $this->input->post('old_resume');
        $response['isResumeUploaded'] = 1;
        $response['resume'] = $update['resume'];
        if (!empty($oldResume)) {
          if (file_exists($oldResume)) {
            unlink($oldResume);
          }
        }
      } else {
        $response['responseMessage'] = $this->Common_Model->error($this->upload->display_errors());
      }
    }
    $update['address'] = $this->input->post('address');
    $update['phone'] = $this->input->post('phone');
    $update['national_insurance_number'] = $this->input->post('national_insurance_number');
    $update['uk_work_permit'] = ($this->input->post('uk_work_permit')) ? 1 : 0;
    $where['id'] = $this->session->userdata('id');
    if ($this->Common_Model->update('users', $where, $update)) {
      $response['status'] = 1;
      $response['responseMessage'] = $this->Common_Model->success('Profile updated successfully.');
    }
    echo json_encode($response);
  }

  public function reset()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
    $this->form_validation->set_rules('email', 'email', 'required|valid_email|trim');
    if ($this->form_validation->run()) {
      $where['email'] = $this->input->post('email');
      $userdata = $this->Common_Model->fetch_records('users', $where, false, true);
      if ($userdata) {
        $emailResponse = $this->send_reset_mail($userdata['id']);
        $response['status'] = 1;
        $response['responseMessage'] = $this->Common_Model->success('Check your email to complete password reset. If you have not found mail in Inbox please check your junk folder.' . $emailResponse);
      } else {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('You are not registered with us. Click on <a href="' . site_url('Sign-Up') . '">Sign Up</a> to register.');
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    $this->session->set_flashdata('responseMessage', $response['responseMessage']);
    echo json_encode($response);
  }

  public function reset_password($user_id, $token)
  {
    $where['token'] = $token;
    $where['id'] = $user_id;
    $userdata = $this->Common_Model->fetch_records('users', $where, false, true);
    if ($userdata) {
      $pageData = [];
      $this->session->set_userdata(array('resetPasswordId' => $user_id));
      $this->load->view('site/include/header', $pageData);
      $this->load->view('site/reset-password', $pageData);
      $this->load->view('site/include/footer', $pageData);
    } else {
      $message = $this->Common_Model->error('You are not authorized.');
      $this->session->set_flashdata('responseMessage', $message);
      redirect('Login');
    }
  }

  private function send_reset_mail($userId)
  {
    $userdata = $this->Common_Model->fetch_records('users', array('id' => $userId), false, true);
    if ($userdata) {
      $token = rand(100000, 999999);
      $update['token'] = $token;
      $this->Common_Model->update('users', array('id' => $userId), $update);
      $verificationLink = $this->config->item('base_url');
      $verificationLink .= 'Reset/' . $userdata['id'] . '/' . $token;
      $emailContent = $this->Common_Model->get_email_content('password_reset');

      $subject = 'Password reset request received';
      $body = "<p>Dear " . $userdata['first_name'] . " " . $userdata['last_name'] . ",</p>";
      $body .= $emailContent;
      $body .= "<p><a href='" . $verificationLink . "'>Reset Now</a></p>";
      $body .= "<p>If the above link doesn't work, you may copy paste the below link in your browser also.</p>";
      $body .= "<p>" . $verificationLink . "</p>";
      if ($this->config->item('ENVIRONMENT') == 'production') {
        $this->Common_Model->send_mail($userdata['email'], $subject, $body);
        return '';
      } else {
        return "<br/>" . $body;
      }
    } else {
      /* User does not exist */
    }
  }

  public function update_new_password()
  {
    $response['status'] = 0;
    $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
    $this->form_validation->set_rules('password', 'password', 'required|trim');
    $this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[password]', array('matches' => 'Password and Confirm password does not match.'));
    if ($this->form_validation->run()) {
      $userId = $this->session->userdata('resetPasswordId');
      if ($userId) {
        $update['token'] = null;
        $update['password'] = md5($this->input->post('password'));
        if ($this->Common_Model->update('users', array('id' => $userId), $update)) {
          $emailResponse = $this->send_password_change_confirmation($userId);
          $response['status'] = 1;
          $response['responseMessage'] = $this->Common_Model->success('Password updated successfully. You may now <a href="' . site_url('Login') . '">Login</a> and start applying for jobs.' . $emailResponse);
        }
      } else {
        $response['status'] = 2;
        $response['responseMessage'] = $this->Common_Model->error('You are not authorized.');
      }
    } else {
      $response['status'] = 2;
      $response['responseMessage'] = $this->Common_Model->error(validation_errors());
    }
    echo json_encode($response);
  }

  private function send_password_change_confirmation($user_id)
  {
    $userdata = $this->Common_Model->fetch_records('users', array('id' => $user_id), false, true);
    if ($userdata) {
      $to = $userdata['email'];
      $subject = 'Password reset successfully.';
      $body = '<p>Hello ' . $userdata['first_name'] . ' ' . $userdata['last_name'] . ',</p>';
      $body .= '<p>Congratulations!! your password has been reset successfully. You may now continue using our services.</p>';
      if ($this->config->item('ENVIRONMENT') == 'production') {
        $this->Common_Model->send_mail($userdata['email'], $subject, $body);
        return '';
      } else {
        return "<br/>" . $body;
      }
    }
  }

  public function account()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/account', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function post()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/add-post', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function posts()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/my-posts', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function password()
  {
    $pageData = $this->Common_Model->get_userdata();
    $this->load->view('site/include/header', $pageData);
    $this->load->view('site/change-password', $pageData);
    $this->load->view('site/include/footer', $pageData);
  }

  public function logout()
  {
    $where['id'] = $this->session->userdata('id');
    $update['is_logged_in'] = 0;
    $this->Common_Model->update('users', $where, $update);
    $this->session->sess_destroy();
    return redirect('');
  }

  private function create_user($update = false)
  {
    $user['first_name'] = $this->input->post('first_name');
    $user['last_name'] = $this->input->post('last_name');
    $user['email'] = $this->input->post('email');
    $user['phone'] = $this->input->post('phone');
    $user['password'] = $this->input->post('password');
    $user['password_n'] = $user['password'];
    $user['password'] = md5($user['password']);
    $user['is_email_verified'] = 0;
    $user['token'] = rand(1000, 99999);
    $user['is_logged_in'] = 0;
    $user['user_ip'] = $_SERVER['REMOTE_ADDR'];
    $user['is_deleted'] = 0;
    $user['updated'] = date("Y-m-d H:i:s");
    if (!$update) {
      $user['created'] = date("Y-m-d H:i:s");
    }
    return $user;
  }

}