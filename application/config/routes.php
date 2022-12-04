<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['Login'] = 'Home/login';
$route['Sign-Up'] = 'Home/signup';
$route['Register'] = 'Users/register';
$route['Verify/(:any)/(:any)'] = 'Users/email_verification/$1/$2';
$route['Verify'] = 'Users/verify';
$route['Log-In'] = 'Users';
$route['Profile'] = 'Users/profile';
$route['Edit-Profile'] = 'Users/edit_profile';
$route['Update-Profile'] = 'Users/update_profile';
$route['Logout'] = 'Users/logout';

$route['Resend-Email-Verification'] = 'Users/resend';

$route['Forgot'] = 'Home/forget';
$route['Reset-Password'] = 'Users/reset';
$route['Reset/(:any)/(:any)'] = 'Users/reset_password/$1/$2';
$route['Update-Password'] = 'Users/update_new_password';
/* Static Route */
// $route['About'] = 'Home/about';
// $route['Legal'] = 'Home/legal';
// $route['Career'] = 'Home/career';
// $route['Newses'] = 'Home/newses';
// $route['News/(:any)'] = 'Home/news/$1';
// $route['Work'] = 'Home/work';

// $route['Jobs'] = 'Home/jobs';
$route['Search-Jobs'] = 'JobsController';
// $route['Job-Details/(:any)'] = 'Jobs/job_details/$1';
// $route['Apply'] = 'Jobs/apply';

// $route['Contact'] = 'Home/contact';
// $route['Contact/Request'] = 'Home/contact_request';
// $route['Contact/Resume'] = 'Home/resume';
// $route['Request-Professional'] = 'Home/request_professional';

// $route['Terms'] = 'Home/terms';
// $route['Privacy'] = 'Home/privacy';
// $route['Policy'] = 'Home/policy';
// $route['Post_Jobs'] = 'Home/post_jobs';
// $route['Post_Jobs2'] = 'Home/post_jobs2';
// $route['Post_App'] = 'Home/post_app';
// $route['Message'] = 'Home/message';
// $route['Notification'] = 'Home/notification';
 $route['Job_List'] = 'Home/job_list';
// $route['Candidate'] = 'Home/candidate';
// $route['Setting'] = 'Home/setting';
// $route['Review'] = 'Home/review';
// $route['Profile_Company'] = 'Home/profile_company';
// $route['Job'] = 'Home/job';
// $route['Company_Profile'] = 'Home/company_profile';
// $route['Interview'] = 'Home/interview';
// $route['Photos'] = 'Home/photos';
// $route['Question'] = 'Home/question';

// $route['Update-User'] = 'Users/update';
// $route['Account'] = 'Users/account';
// $route['Contact-Admin'] = 'Chats';
// $route['Message/send'] = 'Chats/add';
// $route['Get-Messages'] = 'Chats/get_messages';

// $route['Add-Post'] = 'Users/post';
// $route['My-Posts'] = 'Users/posts';
// $route['Change-Password'] = 'Users/password';

/* Admin Routes */
$route['Admin'] = 'Admin';
$route['Admin-Logout'] = 'Admin/logout';
$route['Update-Admin'] = 'Admin_Dashboard/update_profile';
$route['Update-Admin-Password'] = 'Admin_Dashboard/update_password';
$route['Admin-Login'] = 'Admin/login';
$route['Dashboard'] = 'Admin_Dashboard';
$route['Admin-Profile'] = 'Admin_Dashboard/profile';

$route['Users-Management'] = 'Admin_Users';

// $route['Job-Types'] = 'Admin_Jobs/types';
// $route['Job-Type/Get/(:any)'] = 'Admin_Jobs/get_job_type/$1';
// $route['Job-Type/Add'] = 'Admin_Jobs/add_type';
// $route['Job-Type/delete'] = 'Admin_Jobs/delete_type';
// $route['Job-Type/Update'] = 'Admin_Jobs/update_job_type';

$route['Admin-Jobs'] = 'Admin_Jobs';
$route['Admin-Jobs/Get/(:any)'] = 'Admin_Jobs/get_job/$1';
$route['Admin-Jobs/Add'] = 'Admin_Jobs/add_job';
$route['Admin-Jobs/delete'] = 'Admin_Jobs/delete_job';
$route['Admin-Jobs/Update'] = 'Admin_Jobs/update_job';

// $route['Admin-Contact'] = 'Admin_Contacts';

// $route['Admin-News'] = 'Admin_News';
// $route['Professional-Request'] = 'Admin_News/professionals';

// $route['Admin-News/Get/(:any)'] = 'Admin_News/get_news/$1';
// $route['Admin-News/Add'] = 'Admin_News/add_news';
// $route['Admin-News/delete'] = 'Admin_News/delete_news';
// $route['Admin-News/Update'] = 'Admin_News/update_news';
// $route['Job-Applications'] = 'Admin_Applications';
// $route['Admin-Chat'] = 'Admin_Chat';
// $route['Admin-Message/send'] = 'Admin_Chat/add';
// $route['Admin-Get-Messages'] = 'Admin_Chat/get_messages';