<style>
.sign_box {
    max-width: 800px;
    margin: 0 auto;
}

  .navbar-default .navbar-nav > li.signup-menu a{
    background-color: #33ccff;
    color: #fff;
  }
  #passwordError, #serverError, .int-phone-input{
    display:none;
  }
  .iti.iti--allow-dropdown.iti--separate-dial-code {
  width: 100%;
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
                                    <input type="text" name="first_name" placeholder="First Name" class="form-control"
                                        required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Last Name </label>
                                    <input type="text" name="last_name" placeholder="Last Name" class="form-control"
                                        required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email Address </label>
                                    <input type="email" name="email" placeholder="Email Address" class="form-control"
                                        required="">
                                </div>
                            </div>
                            <!-- <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone </label>
                                    <input id="phone" type="tel" name="phone" placeholder="Phone" class="form-control"
                                        required="">
                                </div>
                                <h5 class="int-phone-input"></h5>
                            </div> -->
                            <div class="col-sm-6 nopadding">
                              <div class="input-group">
                              <input type="tel" class="form-control" name="phone" required="" id="phone" >
                              <span id="valid-msg" class="hide">✓ Valid</span>
                              <span id="error-msg" class="hide"></span>
                              <span class="input-group-btn">
                                 <button class="btn " type="button"><i class="glyphicon glyphicon-phone"></i></button>
                              </span>
                              </div>
                              <h5 class="int-phone-input"></h5>
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
                                    <input type="password" name="password" placeholder="Password" class="form-control"
                                        required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" placeholder="Confirm Password"
                                        class="form-control" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>CV </label>
                                    <input type="file" accept=".pdf" name="resume" class="form-control upload" />
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

<?php include ('include/footer.php') ?>

<script src="<?=site_url();?>assets/site/intl-tel-input/js/intlTelInput.js"></script>

<script>
   var number_invalid = false;
   var input = document.querySelector("#phone");
   var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
   var iti = window.intlTelInput(input, {
      hiddenInput: "full_number",
      utilsScript: BASE_URL + "assets/site/intl-tel-input/js/utils.js",
      initialCountry: "auto",
      separateDialCode: true,
      placeholderNumberType: "aggressive",
      allowDropdown: true,
      geoIpLookup: function(success, failure) {
         $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
               var countryCode = (resp && resp.country) ? resp.country : "us";
               success(countryCode);
         });
      },
   });
   input.addEventListener('blur', function() {
      reset();
      if (input.value.trim()) {
         if (iti.isValidNumber()) {
               // $(".int-phone-input").removeClass('text-danger');
               $(".int-phone-input").addClass('text-success');
               $(".int-phone-input").html('Phone number valid');
               $(".int-phone-input").show();
               // validMsg.classList.remove("hide");
               number_invalid = false;
         } else {
               // $(".int-phone-input").removeClass('text-success');
               $(".int-phone-input").addClass('text-danger');
               $(".int-phone-input").html('Phone number is invalid');
               $(".int-phone-input").show();
               number_invalid = true;
         }
      }
   });
   var reset = function() {
      $(".int-phone-input").hide();
      $(".int-phone-input").removeClass('text-danger');
      $(".int-phone-input").removeClass('text-success');
      $(".int-phone-input").html('');
   };
   input.addEventListener('change', reset);
   input.addEventListener('keyup', reset);

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