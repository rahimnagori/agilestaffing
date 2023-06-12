<div class="inner_cont">
    <div class="container">
        <h4>Forget</h4>
        <p>
            <span><a href="<?= site_url(); ?>">Home</a></span>
            <span>Forget</span>
        </p>
    </div>
</div>

<div class="sign_up">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="sign_box">
                    <h2 class="font_1">Forget</h2>
                    <form id="forgetForm" name="forgetForm" onsubmit="reset_password(event);">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" placeholder="Enter Email" class="form-control" required="">
                        </div>

                        <!-- <p class="already_l form-group text-right">
              <a href="<?= site_url('Login'); ?>">Login</a>
            </p> -->

                        <div class="responseMessage" id="responseMessage">
                            <?= $this->session->flashdata('responseMessage'); ?>
                        </div>
                        <div class="form-group btnloggib">
                            <button class="btn btn_theme btn-lg btn-block btn_submit" type="submit">Reset</button>
                        </div>

                        <h4 class="or_line">
                            <span>OR</span>
                        </h4>

                        <p class="already_l form-group text-center">
                            <a href="<?= site_url('Login'); ?>">Login</a>
                        </p>
                        <form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function reset_password(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'Reset-Password',
        data: new FormData($('#forgetForm')[0]),
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
            $(".btn_submit").html('Reset');
            if (response.status == 1) location.reload();
            $("#responseMessage").html(response.responseMessage);
            $("#responseMessage").show();
        }
    });
}
</script>

<script type="text/javascript" src="<?=site_url('assets/site/js/document_ready.js');?>"></script>