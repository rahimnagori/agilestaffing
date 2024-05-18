<?php
class Common_Model extends CI_Model
{
  function join_records($table, $joins, $where = false, $select = '*', $ob = false, $obc = 'DESC', $groupBy = false)
  {
    /* https://github.com/rahimnagori/cheat-sheet/blob/master/ci_dynamic_join.php */
    $this->db->select($select);
    $this->db->from($table);
    foreach ($joins as $join) {
      $this->db->join($join[0], $join[1], $join[2]);
    }
    if ($where)
      $this->db->where($where);
    if ($groupBy)
      $this->db->group_by($groupBy);
    if ($ob)
      $this->db->order_by($ob, $obc);
    $query = $this->db->get();
    return $query->result_array();
  }

  function fetch_records($table, $where = false, $select = false, $singleRecords = false, $orderBy = false, $orderDirection = 'DESC', $groupBy = false, $where_in_key = false, $where_in_value = false, $limit = false, $start = 0)
  {
    if ($where)
      $this->db->where($where);
    if ($where_in_key)
      $this->db->where_in($where_in_key, $where_in_value);
    if ($select)
      $this->db->select($select);
    if ($groupBy)
      $this->db->group_by($groupBy);
    if ($orderBy)
      $this->db->order_by($orderBy, $orderDirection);
    if ($limit)
      $this->db->limit($limit, $start);
    $query = $this->db->get($table);
    return ($singleRecords) ? $query->row_array() : $query->result_array();
  }

  function fetch_jobs($table, $where = false, $orderBy = false, $orderDirection = 'DESC', $like = false, $searchString = false, $limit = false, $start = 0)
  {
    if ($where) $this->db->where($where);
    if ($like) $this->db->like($like);
    if ($orderBy) $this->db->order_by($orderBy, $orderDirection);
    if ($limit) $this->db->limit($limit, $start);
    if($searchString){
      $this->db->group_start()
        ->or_like('title', $searchString)
        ->or_like('description', $searchString)
        ->or_like('position', $searchString)
        ->or_like('company', $searchString)
        ->or_like('address', $searchString)
      ->group_end();
    }
    $query = $this->db->get($table);
    return $query->result_array();
  }

  public function update($table, $where, $updateData)
  {
    $this->db->where($where);
    return $this->db->update($table, $updateData) ? true : false;
  }

  public function insert($table, $data)
  {
    return ($this->db->insert($table, $data)) ? $this->db->insert_id() : false;
  }

  public function delete($table, $where)
  {
    $this->db->where($where);
    $delete = $this->db->delete($table);
    return $delete ? true : false;
  }

  public function success($message)
  {
    return '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $message . '</div>';
  }

  public function error($message)
  {
    return '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $message . '</div>';
  }

  public function history($message)
  {
    $insert['user_id'] = ($this->session->userdata('id')) ? $this->session->userdata('id') : 0;
    $insert['action'] = $message;
    $this->insert('histories', $insert);
  }

  public function get_job_types(){
    $jobTypes = $this->fetch_records('job_types');
    $i  = 1;
    foreach($jobTypes as $id => $jobType){
      $response['jobTypes'][$i] = $jobType['name'];
      $i = $i + 1 ;
    }
    return $response['jobTypes'];
  }

  public function send_mail($to, $subject, $body, $bcc = null, $attachment = false)
  {
    if ($this->config->item('ENVIRONMENT') == 'production') {
      $response['status'] = 0;
      $PROJECT = $this->config->item('PROJECT');
      $fromEmail = 'contact@rahimnagori.com';
      $config = array();
      $config['mailtype'] = "html";
      $config['charset'] = "utf-8";
      $config['newline'] = "\r\n";
      $config['wordwrap'] = TRUE;
      $config['validate'] = FALSE;
  
      $this->load->library('email', $config);
      $this->email->initialize($config);
  
      $this->email->from($fromEmail, 'Admin');
      $this->email->to($to);
      $this->email->set_crlf("\r\n");
      $this->email->subject($subject);
  
      if ($bcc) {
        $this->email->bcc($bcc);
      }
  
      $pageData['body'] = $body;
      $pageData['PROJECT'] = $PROJECT;
      $msg = $this->load->view('site/include/email_template', $pageData, true);
      // $this->load->view('site/include/email_template', $pageData); /* Debug */
  
      if ($attachment) {
        $this->email->attach($attachment);
      }
      $this->email->message($msg);
      try {
        $this->email->send();
        $response['status'] = true;
      } catch (Exception $e) {
        $response['responseMessage'] = $e->getMessage();
        $response['status'] = false;
      }
      return '';
    } else {
      return "<br/>" . $body;
    }
  }

  public function send_mail_with_smtp($to, $subject, $body, $bcc = null, $attachment = false)
  {
    $config = $this->get_smtp_configuration();
    $this->load->library('email');
    $this->email->set_mailtype("html");
    $this->email->from('rahimnagori47@gmail.com', 'Rahim');
    $this->email->to('rahim.nagori@gmail.com');
    $this->email->subject('Test email from CI and Gmail ooooooo ');
    $pageData['PROJECT'] = 'Test project';
    $pageData['body'] = 'This is the body';
    $message = $this->load->view('site/archive/include/email_template_new', $pageData, true);
    $this->email->message($message);

  }

  private function get_smtp_configuration()
  {
    //$config['mailpath'] = '/usr/sbin/sendmail';
    // $config['wordwrap'] = TRUE;
    // $config['mailtype'] = 'text/html';
    $config['useragent'] = 'CodeIgniter';
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.googlemail.com';
    $config['smtp_user'] = '';
    $config['smtp_pass'] = '';
    $config['smtp_port'] = 465;
    $config['smtp_timeout'] = 5;
    $config['wrapchars'] = 76;
    $config['charset'] = 'utf-8';
    $config['validate'] = FALSE;
    $config['priority'] = 3;
    $config['crlf'] = "\r\n";
    $config['newline'] = "\r\n";
    return $config;
  }

  public function update_user_login($table, $user_id, $action_type = 0)
  {
    if ($action_type) {
      $update['last_login'] = date('Y-m-d H:i:s');
    }
    $update['ip_address'] = $_SERVER['REMOTE_ADDR'];
    $update['is_online'] = $action_type;
    $this->update($table, array('id' => $user_id), $update);
    $insert['user_id'] = $user_id;
    $insert['ip_address'] = $update['ip_address'];
    $insert['is_organization'] = ($table == 'organizations') ? 1 : 0;
    $insert['action_type'] = $action_type;
    $insert['created'] = $update['last_login'];

    $this->insert('user_ips', $insert);
  }

  public function get_userdata()
  {
    $pageData = [];
    $where['id'] = $this->session->userdata('id');
    if ($where['id']) {
      $pageData['userDetails'] = $this->fetch_records('users', $where, false, true);
      $pageData['moreUserDetails'] = $this->fetch_records('user_details', array('user_id' => $where['id']), false, true);
      $pageData['editPage'] = false;
    }

    return $pageData;

  }

  public function get_payment_types()
  {
    /* Not in use */
    $formattedPaymentTypes = [];
    $paymentTypes = $this->fetch_records('payment_types');
    foreach ($paymentTypes as $paymentType) {
      $formattedPaymentTypes[$paymentType['id']] = ucfirst($paymentType['payment_type']);
    }
    return $formattedPaymentTypes;
  }

  public function get_email_content($email_type)
  {
    $where['email_type'] = $email_type;
    $email = $this->fetch_records('emails', $where, 'id, content', true);
    return $email['content'];
  }

  public function getAdmin($adminId)
  {
    $where['id'] = $adminId;
    $pageData['adminData'] = $this->fetch_records('admins', $where, false, true);
    // $pageData['defaultPermissions'] = $this->fetch_records('permissions');
    // if (!empty($pageData['adminData'])) {
    //   $pageData['permissions'] = $this->is_admin_authorized($adminId);
    // }
    return $pageData;
  }

  public function generate_password($passwordLength)
  {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i <= $passwordLength; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
    }
    return implode($pass);
  }

  public function get_filters($jobs){
    $location = [];
    $position = [];
    $company = [];
    foreach($jobs as $job){
      if(!in_array($job['address'], $location)) $location[] = $job['address'];
      if(!in_array($job['position'], $position)) $position[] = $job['position'];
      if(!in_array($job['company'], $company)) $company[] = $job['company'];
    }
    $filters = [
      'location' => $location, 'position' => $position, 'company' => $company
    ];
    return $filters;
  }

  public function send_verification_email($userId, $resend = false)
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
        $body .= $this->Common_Model->get_email_content('registration');
        $body .= "<p><a href='" . $verificationLink . "'>Verify Now</a></p>";
        $body .= "<p>If the above link doesn't work, you may copy paste the below link in your browser also.</p>";
        $body .= "<p>" . $verificationLink . "</p>";
        return $this->Common_Model->send_mail($userdata['email'], $subject, $body);
      }
    } else {
      /* User does not exist */
    }
  }

  public function generate_final_email($email){
    $pattern = '/\[([^}]+)\]/';
    $params = $this->Common_Model->fetch_records('email_params');
    echo "<pre>";
    echo "<p>Original email</p>";
    print_r($email);
    foreach($params as $param){
      $replacementString = ' --wow-- ';
      $email = preg_replace($pattern, $replacementString, $email, 1);
      print_r($email);
      echo "<br/> ---- <br/><br/><br/>-------- ";
    }
    print_r($email);
    die;
    return $finalEmail;
  }

}