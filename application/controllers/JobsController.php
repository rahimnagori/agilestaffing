<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JobsController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Common_Model');
        $this->load->model('Jobs_Model');
        $this->load->library('session');
    }

    public function index()
    {
        $pageData = $this->Common_Model->get_userdata();
        $pageData['jobs'] = $this->Common_Model->fetch_records('jobs', array('is_deleted' => 0, 'last_date >=' => date("Y-m-d H:i:s") ));
        $pageData['filters'] = $this->Common_Model->get_filters($pageData['jobs']);

        $this->load->view('site/include/header', $pageData);
        $this->load->view('site/search_jobs', $pageData);
        $this->load->view('site/include/footer', $pageData);
    }
    
    public function get_jobs(){
        $pageData = $this->Common_Model->get_userdata();
        $where['is_deleted'] = 0;
        $where['last_date >='] = date("Y-m-d H:i:s");
        $like = [];
        $start = 0;
        $orderBy = false;
        $orderDirection = 'DESC';
        $limit = 10;
        if($_POST['location'] && !empty($_POST['location'])) $like['address'] = $_POST['location'];
        if($_POST['position'] && !empty($_POST['position'])) $like['position'] = $_POST['position'];
        if($_POST['company'] && !empty($_POST['company'])) $like['company'] = $_POST['company'];
        if($_POST['job_type'] && !empty($_POST['job_type'])) $where['job_mode'] = $_POST['job_type'];
        if($_POST['date_posted'] && !empty($_POST['date_posted'])) $where['created'] = $_POST['date_posted'];
        if($_POST['pageNo'] && !empty($_POST['pageNo'])) $start = $_POST['pageNo'];

        if($_POST['selected_job_id'] && !empty($_POST['selected_job_id'])) $where['id'] = $_POST['selected_job_id'];

        $searchString = ($_POST['search_string'] && !empty($_POST['search_string'])) ? $_POST['search_string'] : false;
        if($_POST['sort_by'] && !empty($_POST['sort_by'])){
            $orderBy = $_POST['sort_by'];
            $orderDirection = $_POST['sort_by_direction'];
        }
        if($_POST['date_posted'] && !empty($_POST['date_posted'])){
            $where['created >='] = $_POST['date_posted'];
        }
        $totalJobs = $this->Common_Model->fetch_jobs('jobs', $where, $orderBy, $orderDirection, $like, $searchString);
        $pageData['jobs'] = $this->Common_Model->fetch_jobs('jobs', $where, $orderBy, $orderDirection, $like, $searchString, $limit, $start);
        $pageData['totalJobs'] = count($totalJobs);
        $pageData['fetchedJobs'] = count($pageData['jobs']) + $start;
        $response['pages'] = $pageData['pages'] = $pageData['totalJobs'] / $limit;

        $response['response'] = $this->load->view('site/job_list', $pageData, true);
        echo json_encode($response);
    }

    private function check_login()
    {
        return ($this->session->userdata('is_user_logged_in')) ? true : false;
    }

    public function apply_job(){
        ($this->check_login()) ? $this->apply_user() : $this->apply_guest();
    }

    public function apply_user()
    {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
        $jobApplication['user_id'] = $this->session->userdata('id');
        $jobApplication['job_id'] = $this->input->post('job_id');
        $isJobExist = $this->Common_Model->fetch_records('job_applications', $jobApplication, false, true);
        if (!$isJobExist) {
            if ($_FILES['resume']['error'] == 0) {
                $resume = $this->update_doc($jobApplication['user_id']);
                $this->Common_Model->update('user_details', array('user_id' => $jobApplication['user_id']), array('resume' => $resume));
            }
            $jobApplication['status'] = 1;
            $jobApplication['created'] = date("Y-m-d H:i:s");
            $jobApplicationId = $this->Common_Model->insert('job_applications', $jobApplication);
            $emailResponse = $this->send_job_application_confirmation($jobApplicationId);
            $response['status'] = 1;
            $response['responseMessage'] = $this->Common_Model->success('Job applied successfully.' . $emailResponse);
        } else {
            $response['status'] = 2;
            $response['responseMessage'] = $this->Common_Model->error('Job already applied.');
        }
        echo json_encode($response);
    }

    public function apply_guest()
    {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
        $this->form_validation->set_rules('first_name', 'first_name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('job_id', 'job_id', 'required');
        if ($this->form_validation->run()) {
            $jobId = $this->input->post('job_id');
            $userdata['first_name'] = $this->input->post('first_name');
            $userdata['email'] = $this->input->post('email');
            $response['otp'] = $userdata['token'] = $token = rand(100000, 999999);
            $isUserExist = $this->Common_Model->fetch_records('users', array('email' => $userdata['email']), false, true);
            $appendContent = '';
            if (!$isUserExist) {
                $guestUserData = $this->register_guest_user($userdata);
                $tempPassword = $guestUserData['password'];
                $appendContent = "<p>To track your application status, <a href='" . site_url('Login') . "' >Login</a> with your email and below temporary password.</p>";
                $appendContent .= "<p><strong>" . $tempPassword . "</strong></p>";
                $guestUserId = $guestUserData['id'];
            } else {
                $this->Common_Model->update('users', array('id' => $isUserExist['id']), array('token' => $token));
                $guestUserId = $isUserExist['id'];
            }
            $response['status'] = 1;
            $emailResponse = $this->send_guest_application_code($guestUserId, $appendContent, $token);
            // $this->Common_Model->send_verification_email($guestUserId);
            ($_FILES['resume']['error'] == 0) ? $this->update_doc($guestUserId) : 0;
            $response['status'] = 1;
            $response['responseMessage'] = $this->Common_Model->success('We have sent you a code. Enter it here to apply successfully.' . $emailResponse);
            $response['user_id'] = $guestUserId;
            $response['job_id'] = $jobId;
        } else {
            $response['status'] = 2;
            $response['responseMessage'] = $this->Common_Model->error(validation_errors());
        }
        $this->session->set_flashdata('responseMessage', $response['responseMessage']);
        echo json_encode($response);
    }

    private function register_guest_user($userdata)
    {
        $tempPassword = $this->Common_Model->generate_password(8);
        $userdata['password'] = md5($tempPassword);
        $userdata['is_email_verified'] = 0;
        $userdata['is_logged_in'] = 0;
        $userdata['user_ip'] = $_SERVER['REMOTE_ADDR'];
        $userdata['created'] = $userdata['updated'] = date('Y-m-d H:i:s');
        $userdata['id'] = $this->Common_Model->insert('users', $userdata);
        $userdata['password'] = $tempPassword;
        return $userdata;
    }

    private function send_guest_application_code($userId, $appendContent, $token)
    {
        $userdata = $this->Common_Model->fetch_records('users', array('id' => $userId), false, true);
        if ($userdata) {
            $subject = 'Job application pending';
            $body = '<p>Hello ' . $userdata['first_name'] . ',</p>';
            $body .= $this->Common_Model->get_email_content('guest_job_apply');
            $body .= "<p><strong>" . $token . "</strong></p>";
            $body .= $appendContent;
            return $this->Common_Model->send_mail($userdata['email'], $subject, $body);
        }
    }

    public function submit_otp()
    {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
        $this->form_validation->set_rules('job_id', 'job_id', 'required');
        $this->form_validation->set_rules('user_id', 'user_id', 'required');
        $this->form_validation->set_rules('otp', 'otp', 'required');
        if ($this->form_validation->run()) {
            $insertJob['user_id'] = $this->input->post('user_id');
            $resume = $this->input->post('resume');
            $token = $this->input->post('otp');
            $isCorrectOtp = $this->Common_Model->fetch_records('users', array('id' => $insertJob['user_id'], 'token' => $token), false, true);
            if ($isCorrectOtp) {
                $insertJob['job_id'] = $this->input->post('job_id');
                $isAlreadyApplied = $this->Common_Model->fetch_records('job_applications', $insertJob, false, true);
                if (empty($isAlreadyApplied)) {
                    $insertJob['status'] = 1;
                    $insertJob['created'] = date("Y-m-d H:i:s");
                    $jobApplicationId = $this->Common_Model->insert('job_applications', $insertJob);
                    if ($jobApplicationId) {
                        $emailResponse = $this->send_job_application_confirmation($jobApplicationId);
                        if (strlen($resume) > 1) {
                            $userDetails['user_id'] = $insertJob['user_id'];
                            $userDetails['resume'] = $resume;
                            $this->Common_Model->insert('user_details', $userDetails);
                        }
                        $response['status'] = 1;
                        $response['responseMessage'] = $this->Common_Model->success('Job applied successfully.' . $emailResponse);

                        $userDetails = $this->Common_Model->fetch_records('users', array('id' => $insertJob['user_id']));
                        $update['is_logged_in'] = 1;
                        $update['last_login'] = date("Y-m-d H:i:s");
                        $this->Common_Model->update('users', array('id' => $insertJob['user_id']), $update);
                        $this->session->set_userdata(array('id' => $userDetails[0]['id'], 'is_user_logged_in' => true, 'userdata' => $userDetails[0]));
                    }
                } else {
                    $response['status'] = 3;
                    $response['responseMessage'] = $this->Common_Model->success('You have already applied for this job. <a href="' . site_url('Login') . '">Login</a> to check application status.');
                }
            } else {
                $response['status'] = 2;
                $response['responseMessage'] = $this->Common_Model->error('Invalid code. Please enter correct code.');
            }
        } else {
            $response['status'] = 2;
            $response['responseMessage'] = $this->Common_Model->error(validation_errors());
        }

        $this->session->set_flashdata('responseMessage', $response['responseMessage']);
        echo json_encode($response);
    }

    private function send_job_application_confirmation($jobApplicationId)
    {
        $join[0][] = 'users';
        $join[0][] = 'job_applications.user_id = users.id';
        $join[0][] = 'left';
        $join[1][] = 'jobs';
        $join[1][] = 'job_applications.job_id = jobs.id';
        $join[1][] = 'left';
        $select = 'users.first_name, users.last_name, users.email, users.is_email_verified, jobs.title, jobs.description';
        $jobApplicationsDetails = $this->Common_Model->join_records('job_applications', $join, array('job_applications.id' => $jobApplicationId), $select, 'job_applications.id', 'DESC');
        $jobApplicationsDetails = $jobApplicationsDetails[0];

        $body = "<p>Hello " . $jobApplicationsDetails['first_name'] . " " . $jobApplicationsDetails['last_name'] . ",</p>";
        $subject = "Job applied successfully.";
        $body .= $this->Common_Model->get_email_content('job_apply_confirmation');
        if ($jobApplicationsDetails['is_email_verified'] == 0) {
            $body .= $this->Common_Model->get_email_content('application_track');
        }
        return $this->Common_Model->send_mail($jobApplicationsDetails['email'], $subject, $body);
    }

    public function job_details($id)
    {
        $pageData = $this->Common_Model->get_userdata();
        $pageData['isLoggedIn'] = $this->session->userdata('id');
        $where = [
            'id' => $id
        ];
        $pageData['jobDetails'] = $this->Common_Model->fetch_records('jobs', $where, false, true);
        if (empty($pageData['jobDetails'])) {
            $response['responseMessage'] = $this->Common_Model->error("Job not found or invalid job!!");
            $this->session->set_flashdata('responseMessage', $response['responseMessage']);
            redirect('Jobs');
        }
        if ($pageData['isLoggedIn']) {
            $whereJobApplication = [
                'user_id' => $pageData['isLoggedIn'],
                'job_id' => $id
            ];
            $pageData['isJobApplied'] = $this->Common_Model->fetch_records('job_applications', $whereJobApplication, false, true);

            $this->load->view('site/user_job_details', $pageData);
        } else {
            $this->load->view('site/job_details', $pageData);
        }
    }

    public function get_job_modals($id)
    {
        $pageData = $this->Common_Model->get_userdata();
        $pageData['jobId'] = $id;
        $pageData['isLoggedIn'] = $this->session->userdata('id');
        if ($pageData['isLoggedIn']) {
            $this->load->view('site/user_job_modals', $pageData);
        } else {
            $this->load->view('site/job_modals', $pageData);
        }
    }

    public function experience()
    {
        $pageData = $this->Common_Model->get_userdata();
        if(empty($pageData)) redirect('');
        $where['user_id'] = $pageData['userDetails']['id'];
        $pageData['userExperiences'] = $this->Common_Model->fetch_records('user_experiences', $where);

        $this->load->view('site/include/header', $pageData);
        $this->load->view('site/experience', $pageData);
        $this->load->view('site/include/footer', $pageData);
    }

    public function applied_jobs()
    {
        $pageData = $this->Common_Model->get_userdata();
        $join[0][] = 'jobs';
        $join[0][] = 'job_applications.job_id = jobs.id';
        $join[0][] = 'left';
        $select = 'jobs.id, jobs.title, job_applications.created, jobs.position, jobs.company, jobs.address, jobs.salary, jobs.last_date';
        $where['job_applications.user_id'] = $this->session->userdata('id');
        $pageData['jobApplications'] = $this->Common_Model->join_records('job_applications', $join, $where, $select, 'job_applications.id', 'DESC');

        $this->load->view('site/include/header', $pageData);
        $this->load->view('site/job_applications', $pageData);
        $this->load->view('site/include/footer', $pageData);
    }

    private function update_doc($userId){
        $config['upload_path'] = "assets/site/resume/";
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['encrypt_name'] = true;
        $this->load->library("upload", $config);
        if ($this->upload->do_upload('resume')) {
            $resume = $config['upload_path'] . $this->upload->data("file_name");
            $update['user_id'] = $userId;
            $update['resume'] = $resume;
            $this->db->replace('user_details', $update);
        }
    }
}