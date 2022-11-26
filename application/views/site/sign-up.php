<style>
   .sign_box {
      max-width: 800px;
      margin: 0 auto;
   }
</style>
<div class="inner_cont">
   <div class="container">
      <h4>Sign Up</h4>
      <p>
         <span><a href="<?= site_url(); ?>">Home</a></span>
         <span>Sign Up</span>
      </p>
   </div>
</div>
<div class="sign_up">
   <div class="container">
      <div class="sign_box">
         <div class="login_box1">

            <h2 class="font_1"></h2>
            <div class="formn_me">
               <form id="signUpForm" name="signUpForm" onsubmit="sign_up_user(event);">
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>First Name </label>
                           <input type="text" name="first_name" placeholder="First Name" class="form-control" required="">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Last Name </label>
                           <input type="text" name="last_name" placeholder="Last Name" class="form-control" required="">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Email Address </label>
                           <input type="email" name="email" placeholder="Email Address" class="form-control" required="">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Phone </label>
                           <input type="text" name="phone" placeholder="Phone" class="form-control" required="">
                        </div>
                     </div>
                  </div>
                  <!-- <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Username </label>
                           <input type="text" name="username" placeholder="Username" class="form-control" required="" >
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Job Title </label>
                           <input type="text" name="job_title" placeholder="Job Title" class="form-control" required="" >
                        </div>
                     </div>
                  </div> -->
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Password</label>
                           <input type="password" name="password" placeholder="Password" class="form-control" required="">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Confirm Password</label>
                           <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required="">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>CV </label>
                           <input type="file" accept=".pdf" name="resume" />
                        </div>
                     </div>
                  </div>

                  <div class="responseMessage" id="responseMessage">
                     <?= $this->session->flashdata('responseMessage'); ?>
                  </div>
                  <div class="btnloggib">
                     <button class="btn btn_theme btn-lg btn-block btn_submit" type="submit">Register</button>
                  </div>
               </form>
            </div>
         </div>
         <div class="donit">
            <p>
               If you already have an account, <a href="<?= site_url('Login'); ?>">Login</a>
            </p>
         </div>
      </div>
   </div>
</div>

<script>
   function sign_up_user(e) {
      e.preventDefault();
      $.ajax({
         type: 'POST',
         url: BASE_URL + 'Register',
         data: new FormData($('#signUpForm')[0]),
         dataType: 'JSON',
         processData: false,
         contentType: false,
         cache: false,
         beforeSend: function(xhr) {
            $(".btn_submit").attr('disabled', true);
            $(".btn_submit").html(LOADING);
            $("#responseMessage").html('');
            $("#responseMessage").hide();
         },
         success: function(response) {
            $(".btn_submit").prop('disabled', false);
            $(".btn_submit").html(' Register ');
            if (response.status == 1) location.reload();
            $("#responseMessage").html(response.responseMessage);
            $("#responseMessage").show();
         }
      });
   }
</script>