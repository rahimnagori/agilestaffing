
  <!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Agile Staffing</title>
      <link rel="shortcut icon" href="<?= site_url('assets/site/'); ?>img/favi.png" type="image/x-icon">
      <link href="<?= site_url('assets/site/'); ?>css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="<?= site_url('assets/site/'); ?>css/owl.carousel.min.css">
      <link rel="stylesheet" href="<?= site_url('assets/site/'); ?>css/owl.theme.default.min.css">
      <link href="<?= site_url('assets/site/'); ?>css/font-awesome.min.css" rel="stylesheet">
      <link href="<?= site_url('assets/site/'); ?>css/jquery-ui.css" rel="stylesheet">
      <link href="<?= site_url('assets/site/'); ?>css/chosen.css" rel="stylesheet">
      <link href="<?= site_url('assets/site/'); ?>css/jquery.dataTables.min.css" rel="stylesheet">
      <link href="<?= site_url('assets/site/'); ?>css/responsive.dataTables.min.css" rel="stylesheet">
      <link href="<?= site_url('assets/site/'); ?>css/style.css" rel="stylesheet">
   </head>
   <body>
      <div class="main_nav">
         <nav class="navbar navbar-default">
            <div class="container-fluid">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand logo_m" href="<?= site_url('') ?>">
                  <img src="<?= site_url('assets/site/'); ?>img/logo.png">
                  </a>
               </div>
               <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right">
                  <li><a href="<?= site_url('Jobs') ?>">Find jobs</a></li>
                     <li>
                        <a href="<?= site_url('Post_Jobs') ?>">Post jobs</a>
                     </li>

                     

                     <?php
            if ($this->session->userdata('is_user_logged_in')) {
            ?>
            <li class="droup_des">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="img_radiuus">
                        <img src="img/img_9.png">
                        User Name
                        <span class="caret"></span>
                        </span>
                        </a>
                        <ul class="dropdown-menu">
                           <li><a href="profile.php">Profile</a></li>
                           <!-- <li><a href="#">Balance information: <b>0 $</b> </a></li> -->
                           <li><a href="index.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
                     </li>
            <?php
            } else {
            ?>
             <li class="Sign_top"><a href="<?= site_url('Login') ?>" class="btn btn_theme" style="background: transparent; color: var(--blue); border: 1px solid var(--blue);">Login</a></li>
             <li class="Sign_top"><a href="<?= site_url('Sign-Up') ?>" class="btn btn_theme">Sign Up</a></li>
           
           <?php
            }
            ?>
                     
                  </ul>
               </div>
            </div>
         </nav>
      </div>

