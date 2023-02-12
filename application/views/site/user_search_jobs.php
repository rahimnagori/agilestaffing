<style>
    #submitOtpForm {
        display: none;
    }
</style>
<div class="search2 search_row_nw cover_2 cover_4">
    <?php include_once('job_filters.php'); ?>
</div>
<div class="jobbb12">
    <div class="container-fluid">
        <div class="job-main4">
            <div class="job-filter">
                <div class="row">
                    <div class="col-sm-5 siz_col4 cover_1 cover_3">
                        <!-- Right details box -->
                        <div class="baccckk">
                            <a href="#" class="job_com4"><i class="fa fa-long-arrow-left"></i> Back</a>
                        </div>
                        <div class="">
                            <div class="scroll_1" id="job_details_div">
                                <?php //include_once('job_details.php'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 siz_col2 cover_2 cover_4">
                        <!-- Left sidebar -->
                        <div class="scroll_1">
                            <div class="job_com2">
                                <?php
                                foreach ($jobs as $job) {
                                    ?>
                                    <!-- loop -->
                                    <button class="job_com1 sidebar-jobs" type="button"
                                        onclick="get_job(this, <?= $job['id']; ?>);">
                                        <div class="com_img">
                                            <img src="<?= site_url('assets/site/'); ?>img/img_7.png">
                                        </div>
                                        <div class="commodo_de">
                                            <h3>
                                                <?= $job['title']; ?>
                                            </h3>
                                            <!-- <div class="star_5">
                                                            <span class="active fa fa-star"></span>
                                                            <span class="active fa fa-star"></span>
                                                            <span class="active fa fa-star"></span>
                                                            <span class="active fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        </div> -->
                                            <h4><i class="fa fa-briefcase"></i>
                                                <?= $job['position']; ?>
                                            </h4>
                                            <h4><i class="fa fa-map-marker"></i>
                                                <?= $job['address']; ?>
                                            </h4>
                                        </div>
                                    </button>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modals-div">
    <?php include_once('user_job_modals.php'); ?>
</div>

<script type="text/javascript">
    function apply_job(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'User-Apply',
            data: new FormData($('#jobApplicationForm')[0]),
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function (xhr) {
                $(".apply_btn").attr('disabled', true);
                $(".apply_btn").html(LOADING);
                $("#responseMessageOtp").hide();
            },
            success: function (response) {
                $("#responseMessageOtp").html(response.responseMessage);
                $("#responseMessageOtp").show();
                if (response.status == 1) {
                    $("#jobApplicationForm").hide();
                    $("#job_apply_btn").html('Applied');
                    $("#job_apply_btn").attr('disabled', true);
                }
            }
        });
    }

    function submit_otp(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'Submit-Otp',
            data: new FormData($('#submitOtpForm')[0]),
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function (xhr) {
                $(".otp_btn").attr('disabled', true);
                $(".otp_btn").html(LOADING);
                $("#responseMessageOtp").hide();
            },
            success: function (response) {
                $("#responseMessageOtp").html(response.responseMessage);
                $("#responseMessageOtp").show();
                if (response.status == 1) {
                    $(".otp_btn").html('Applied');
                    $("#my-modal").modal("show");
                    $("#submitOtpForm").hide();
                } else if (response.status == 3) {
                    $(".otp_btn").html('Already applied');
                    $("#submitOtpForm").hide();
                } else {
                    $(".otp_btn").html('Apply');
                    $(".otp_btn").prop('disabled', false);
                }
            }
        });
    }

    function get_job(e, job_id) {
        $(".sidebar-jobs").removeClass('active');
        $(e).addClass('active');
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'Job-Details/' + job_id,
            dataType: 'html',
            beforeSend: function (xhr) {
                $("#job_details_div").html(LOADING);
            },
            success: function (response) {
                $("#job_details_div").html(response);
                get_job_modal(job_id);
            }
        });
    }

    function get_job_modal(job_id) {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'Reset-Job/' + job_id,
            dataType: 'html',
            beforeSend: function (xhr) {
                $("#modals-div").html('');
            },
            success: function (response) {
                $("#modals-div").html(response);
            }
        });
    }
</script>