<script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                            <label>Email or Phone</label>
                            <input type="text" name="email" placeholder="Enter email or phone" class="form-control"
                                required="">
                        </div>
                        <div class="form-group">
                            <label>Password </label>
                            <input type="password" name="password" placeholder="Enter password" class="form-control"
                                required="">
                        </div>

                        <p class="already_l form-group text-right">
                            <a href="<?= site_url('Forgot'); ?>">Forgot password?</a>
                        </p>

                        <div class="responseMessage" id="responseMessage">
                            <?= $this->session->flashdata('responseMessage'); ?>
                        </div>
                        <div class="form-group btnloggib">
                            <div class="g-recaptcha" data-sitekey="<?=$this->config->item("GCAPTCHAKEY");?>"></div>
                            <input type="hidden" id="g-captcha-response" name="g-captcha-response">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function log_user_in(e) {
    e.preventDefault();
    let gcaptchaResponse = grecaptcha.getResponse();
    if (gcaptchaResponse === '') {
        let captchaError = `<div class="text-danger">Solve captcha to continue</div>`;
        $("#responseMessage").html(captchaError);
        $("#responseMessage").show();
        return;
    } else {
        $("#g-captcha-response").val(gcaptchaResponse);
    }
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