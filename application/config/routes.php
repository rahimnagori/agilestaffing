<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['Login'] = 'Home/login';
$route['Sign-Up'] = 'Home/signup';
$route['Forgot'] = 'Home/forget';

$route['Log-In'] = 'Users';
$route['Register'] = 'Users/register';
$route['Logout'] = 'Users/logout';
$route['Verify'] = 'Users/verify';
$route['Verify/(:any)/(:any)'] = 'Users/email_verification/$1/$2';
$route['Profile'] = 'Users/profile';
$route['Edit-Profile'] = 'Users/edit_profile';
$route['Update-Profile'] = 'Users/update_profile';
$route['Update-Profile-Image'] = 'Users/update_profile_image';
$route['Delete-Profile-Image'] = 'Users/delete_profile_image';
$route['Update-Experience'] = 'Users/update_experience';
$route['Modify-Experience'] = 'Users/modify_experience';
$route['Remove-Experience'] = 'Users/remove_experience';

$route['Resend-Email-Verification'] = 'Users/resend';

$route['Reset-Password'] = 'Users/reset';
$route['Reset/(:any)/(:any)'] = 'Users/reset_password/$1/$2';
$route['Update-Password'] = 'Users/update_new_password';

/* Static Route */
$route['About'] = 'Home/about';
$route['Cookie'] = 'Home/cookie';
$route['Terms'] = 'Home/terms';
$route['Privacy'] = 'Home/privacy';
$route['Legal'] = 'Home/legal';

/* Jobs Routes */
$route['Job_List'] = 'Home/job_list';
$route['Search-Jobs'] = 'JobsController';
$route['Jobs'] = 'JobsController/get_jobs';
$route['Reset-Job/(:any)'] = 'JobsController/get_job_modals/$1';
$route['Job-Details/(:any)'] = 'JobsController/job_details/$1';
$route['Job-Apply'] = 'JobsController/apply_job';
$route['Submit-Otp'] = 'JobsController/submit_otp';
$route['Job-Applications'] = 'JobsController/applied_jobs';
$route['User-Experience'] = 'JobsController/experience';

/* Admin Routes */
$route['Admin'] = 'Admin';
$route['Admin-Login'] = 'Admin/login';
$route['Admin-Logout'] = 'Admin/logout';

$route['Dashboard'] = 'Admin_Dashboard';
$route['Admin-Profile'] = 'Admin_Dashboard/profile';
$route['Update-Admin'] = 'Admin_Dashboard/update_profile';
$route['Update-Admin-Password'] = 'Admin_Dashboard/update_password';

$route['Users-Management'] = 'Admin_Users';
$route['Admin-Jobs'] = 'Admin_Jobs';
$route['Admin-Jobs/Get/(:any)'] = 'Admin_Jobs/get_job/$1';
$route['Admin-Jobs/Add'] = 'Admin_Jobs/add_job';
$route['Admin-Jobs/delete'] = 'Admin_Jobs/delete_job';
$route['Admin-Jobs/Update'] = 'Admin_Jobs/update_job';

$route['Admin-Settings'] = 'Admin_Settings';
$route['Get-Email'] = 'Admin_Settings/get_email';
$route['Update-Email'] = 'Admin_Settings/update_email';
$route['Update-Settings'] = 'Admin_Settings/update_settings';


/*
Archieved routes

## Routes converted to single route [apply_job]
$route['Guest-Apply'] = 'JobsController/apply_guest';
$route['User-Apply'] = 'JobsController/apply_user';


$route['Apply'] = 'Jobs/apply';
$route['Career'] = 'Home/career';
$route['Newses'] = 'Home/newses';
$route['News/(:any)'] = 'Home/news/$1';
$route['Work'] = 'Home/work';
$route['Jobs'] = 'Home/jobs';
$route['Contact'] = 'Home/contact';
$route['Contact/Request'] = 'Home/contact_request';
$route['Contact/Resume'] = 'Home/resume';
$route['Request-Professional'] = 'Home/request_professional';
$route['Post_Jobs'] = 'Home/post_jobs';
$route['Post_Jobs2'] = 'Home/post_jobs2';
$route['Message'] = 'Home/message';
$route['Notification'] = 'Home/notification';
$route['Setting'] = 'Home/setting';
$route['Review'] = 'Home/review';
$route['Candidate'] = 'Home/candidate';
$route['Profile_Company'] = 'Home/profile_company';
$route['Job'] = 'Home/job';
$route['Company_Profile'] = 'Home/company_profile';
$route['Interview'] = 'Home/interview';
$route['Photos'] = 'Home/photos';
$route['Question'] = 'Home/question';

$route['Update-User'] = 'Users/update';
$route['Account'] = 'Users/account';
$route['Add-Post'] = 'Users/post';
$route['My-Posts'] = 'Users/posts';
$route['Change-Password'] = 'Users/password';

$route['Contact-Admin'] = 'Chats';
$route['Message/send'] = 'Chats/add';
$route['Get-Messages'] = 'Chats/get_messages';

$route['Job-Types'] = 'Admin_Jobs/types';
$route['Job-Type/Get/(:any)'] = 'Admin_Jobs/get_job_type/$1';
$route['Job-Type/Add'] = 'Admin_Jobs/add_type';
$route['Job-Type/Update'] = 'Admin_Jobs/update_job_type';
$route['Job-Type/delete'] = 'Admin_Jobs/delete_type';

---- ---- Admin ---- ---- 
$route['Admin-Contact'] = 'Admin_Contacts';

$route['Admin-News'] = 'Admin_News';
$route['Professional-Request'] = 'Admin_News/professionals';
$route['Admin-News/Get/(:any)'] = 'Admin_News/get_news/$1';
$route['Admin-News/Add'] = 'Admin_News/add_news';
$route['Admin-News/Update'] = 'Admin_News/update_news';
$route['Admin-News/delete'] = 'Admin_News/delete_news';

$route['Admin-Chat'] = 'Admin_Chat';
$route['Admin-Message/send'] = 'Admin_Chat/add';
$route['Admin-Get-Messages'] = 'Admin_Chat/get_messages';
*/