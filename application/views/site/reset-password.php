<div class="inner_cont">
  <div class="container">
    <h4>Reset Password</h4>
    <p>
      <span><a href="<?= site_url(); ?>">Home</a></span>
      <span>Reset Password</span>
    </p>
  </div>
</div>

<div class="sign_up">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <div class="sign_box">
          <h2 class="font_1">Reset Password</h2>
          <form id="newPasswordForm" name="newPasswordForm" onsubmit="update_password(event);">
            <div class="form-group">
              <label>New Password</label>
              <input type="password" name="password" placeholder="Enter new password" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>Confirm New Password </label>
              <input type="password" name="confirm_password" placeholder="Confirm new password" class="form-control" required="">
            </div>

            <?= $this->session->flashdata('responseMessage'); ?>
            <div class="responseMessage" id="responseMessage"></div>
            <div class="form-group btnloggib">
              <button class="btn btn_theme btn-lg btn-block btn_submit" type="submit">Update</button>
            </div>
            <form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
   function update_password(e) {
      e.preventDefault();
      $.ajax({
         type: 'POST',
         url: BASE_URL + 'Update-Password',
         data: new FormData($('#newPasswordForm')[0]),
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
            $(".btn_submit").html('Update');
            $("#newPasswordForm")[0].reset();
            $("#responseMessage").html(response.responseMessage);
            $("#responseMessage").show();
         }
      });
   }
</script>