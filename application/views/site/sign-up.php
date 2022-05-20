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
               <form id="signUpForm" name="signUpForm" onsubmit="sign_up_user(event);" >
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>First Name </label>
                              <input type="text" name="first_name" placeholder="First Name" class="form-control" required="" >
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
                              <input type="text" name="Phone" placeholder="Phone" class="form-control" required="">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>CV </label>
                              <input type="file" name="" placeholder="CV" class="form-control upload">
                         
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>Skills </label>
                           <input id="form-tags-1" name="tags-1" type="text" value="jQuery,Script,Net">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     
                     <div class="col-sm-6">
                     <div class="form-group">

<label>Experience</label>



<input type="text" name="" placeholder="Experience" class="form-control">

</div>
                     </div>
                     <div class="col-sm-6">
                     <div class="form-group">
            <label>Employer </label><br>
            <label class="radio-inline"><input name="tks_yes" type="radio" value="1" checked="checked">Yes</label>
            <label class="radio-inline"><input name="tks_yes" type="radio" value="2">No</label>

           </div>
                     </div>
                  </div>
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
                  
                  <div class="form-group responseMessage" id="otherJobField"></div>
                  
                  <?=$this->session->flashdata('responseMessage');?>
                  <div class="responseMessage" id="responseMessage" ></div>
                  <div class="btnloggib">
                     <button class="btn btn_theme btn-lg btn-block btn_submit" type="submit">Submit</button>
                  </div>
               </form>
            </div>
         </div>
         <div class="donit">
            <p>
               if you have account? <a href="<?= site_url('Login'); ?>">Login</a>
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
        $(".btn_submit").html(' Add ');
        if (response.status == 1) location.reload();
        $("#responseMessage").html(response.responseMessage);
        $("#responseMessage").show();
      }
    });
  }

  function change_job_title(job_title){
   if(job_title == 'other'){
      $("#otherJobField").html(`
         <div class="icon_us">
            <i class="la la-briefcase"></i>
            <input type="text" name="other_job_title" placeholder="Other Job..." class="form-control" required="">
         </div>
      `);
      $("#otherJobField").show();
   }else{
      $("#otherJobField").html('');
      $("#otherJobField").hide();
   }
  }
</script>