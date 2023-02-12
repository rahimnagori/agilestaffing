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
        $pageData['jobs'] = $this->Common_Model->fetch_records('jobs');

        $this->load->view('site/include/header', $pageData);
        if ($this->session->userdata('id')) {
            $this->load->view('site/user_search_jobs', $pageData);
        } else {
            $this->load->view('site/search_jobs', $pageData);
        }
        $this->load->view('site/include/footer', $pageData);
    }

    private function check_login()
    {
        return ($this->session->userdata('is_user_logged_in')) ? true : false;
    }

    public function apply_job()
    {
        $response['status'] = 0;
        $response['responseMessage'] = $this->Common_Model->error('Something went wrong, please try again later.');
        if ($_FILES['resume']['error'] == 0) {
            $config['upload_path'] = "assets/site/resume/";
            $config['allowed_types'] = 'pdf|doc|docx';
            $config['encrypt_name'] = true;
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('resume')) {
                $userDetails['resume'] = $config['upload_path'] . $this->upload->data("file_name");
            }
        }
        $jobApplication['user_id'] = $this->session->userdata('id');
        $jobApplication['job_id'] = $this->input->post('job_id');
        $isJobExist = $this->Common_Model->fetch_records('job_applications', $jobApplication, false, true);
        if (!$isJobExist) {
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
            if ($_FILES['resume']['error'] == 0) {
                $config['upload_path'] = "assets/site/resume/";
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['encrypt_name'] = true;
                $this->load->library("upload", $config);
                if ($this->upload->do_upload('resume')) {
                    $response['resumePath'] = $config['upload_path'] . $this->upload->data("file_name");
                }
            } else {
                $response['resumePath'] = 0;
            }
            $response['status'] = 1;
            $response['responseMessage'] = $this->Common_Model->success('Job applied successfully.' . $emailResponse);
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
            if ($this->config->item('ENVIRONMENT') == 'production') {
                $this->Common_Model->send_mail($userdata['email'], $subject, $body);
                return '';
            } else {
                return "<br/>" . $body;
            }
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
                            $userDocs['user_id'] = $insertJob['user_id'];
                            $userDocs['doc_type'] = 1;
                            $userDocs['document'] = $resume;
                            $userDocs['created'] = date("Y-m-d H:i:s");
                            $this->Common_Model->insert('user_docs', $userDocs);
                        }
                        $response['status'] = 1;
                        $response['responseMessage'] = $this->Common_Model->success('Job applied successfully.' . $emailResponse);
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
        $body .= $this->Common_Model->get_email_content('job_apply_confirmation');
        if ($jobApplicationsDetails['is_email_verified'] == 0) {
            $body .= $this->Common_Model->get_email_content('application_track');
        }
        if ($this->config->item('ENVIRONMENT') == 'production') {
            $subject = "Job applied successfully.";
            $this->Common_Model->send_mail($jobApplicationsDetails['email'], $subject, $body);
            return '';
        } else {
            return "<br/>" . $body;
        }
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
}