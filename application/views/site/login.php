<div class="inner_cont">
  <div class="container">
    <h4>Login</h4>
    <p>
      <span><a href="<?= site_url(); ?>">Home</a></span>
      <span>Login</span>
    </p>
  </div>
</div>

<div class="sign_up">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <div class="sign_box">
          <h2 class="font_1">Login</h2>
          <form id="loginForm" name="loginForm" onsubmit="log_user_in(event);">
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" placeholder="Enter email" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>Password </label>
              <input type="password" name="password" placeholder="Enter password" class="form-control" required="">
            </div>

            <p class="already_l form-group text-right">
              <a href="<?= site_url('Forgot'); ?>">Forgot password?</a>
            </p>

            <?= $this->session->flashdata('responseMessage'); ?>
            <div class="responseMessage" id="responseMessage"></div>
            <div class="form-group btnloggib">
              <button class="btn btn_theme btn-lg btn-block btn_submit" type="submit">Login</button>
            </div>

            <h4 class="or_line">
              <span>OR</span>
            </h4>

            <p class="already_l form-group">
              Don't have an account? <a href="<?= site_url('Sign-Up'); ?>">Sign Up</a>
            </p>

            <div class="fb_g+" style="display:none;">
              <div class="row">
                <div class="col-xs-6">
                  <a href="#" class="btn btn-lg btn-block btn_fb">
                    <i class="fa fa-facebook"></i> facebook
                  </a>
                </div>
                <div class="col-xs-6">
                  <a href="#" class="btn btn-lg btn-block btn_gp">
                    <i class="fa fa-google-plus"></i> google+
                  </a>
                </div>
              </div>
            </div>
            <form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function log_user_in(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: BASE_URL + 'Log-In',
      data: new FormData($('#loginForm')[0]),
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
        $(".btn_submit").html(' Login ');
        if (response.status == 1) location.reload();
        $("#responseMessage").html(response.responseMessage);
        $("#responseMessage").show();
      }
    });
  }
</script>