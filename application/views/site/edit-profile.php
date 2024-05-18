<div class="desboard_m">
    <div class="container-fluid">
        <div class="row row_sp1">
            <div class="col-sm-3">
                <?php include 'include/sidebar.php'; ?>
            </div>
            <div class="col-sm-9">
                <div class="right_side">
                    <div class="edifft">
                        <div class="pull-left">
                            <h2>Edit Profile</h2>
                        </div>
                        <div class="pull-right">
                            <a href="<?= site_url('Profile'); ?>" class="btn btn_theme">Back</a>
                        </div>
                    </div>
                    <div class="set_whight">
                        <div class="detail_prof">
                            <form id="profileForm" name="profileForm" method="post" onsubmit="update_profile(event);">
                                <div class="row">
                                    <!-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="image">Profile Image</label>
                                            <input type="file" name="profile_image" accept="image/*"
                                                onchange="preview_image(this, 'previewImage');">
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="user_about">About</label>
                                            <textarea name="user_about" id="user_about" rows="5"
                                                class="form-control"><?= $moreUserDetails['user_about']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="jobRole">Current Job Role</label>
                                            <input type="text" name="current_job_role" placeholder="Current Job Role"
                                                class="form-control" required=""
                                                value="<?= $moreUserDetails['current_job_role']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="jobRole">Expected Job Role</label>
                                            <input type="text" name="expected_job_role" placeholder="Expected Job Role"
                                                class="form-control" required=""
                                                value="<?= $moreUserDetails['expected_job_role']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="jobRole">Current Job Type</label>
                                            <input type="text" name="current_job_type" placeholder="Current Job Type"
                                                class="form-control" required=""
                                                value="<?= $moreUserDetails['current_job_type']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="jobRole">Current Payment Type</label>
                                            <input type="text" name="current_payment_type"
                                                placeholder="Current Payment Type" class="form-control" required=""
                                                value="<?= $moreUserDetails['current_payment_type']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="jobRole">City</label>
                                            <input type="text" name="city" placeholder="Enter City" class="form-control"
                                                required="" value="<?= $moreUserDetails['city']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="jobRole">Post Code</label>
                                            <input type="text" name="post_code" placeholder="Post Code"
                                                class="form-control" required=""
                                                value="<?= $moreUserDetails['post_code']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="jobPreference">Job Preference</label>
                                            <input type="text" name="job_preference" placeholder="Job Preference"
                                                class="form-control" required=""
                                                value="<?= $moreUserDetails['job_preference']; ?>">
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="sex">Sex</label>
                                            <input type="radio" name="sex" value="1" checked> Male
                                            <input type="radio" name="sex" value="0"> Female
                                        </div>
                                    </div> -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="user_about">Skills (Comma separated)</label>
                                            <input type="text" name="user_skills" class="form-control"
                                                value="<?= $moreUserDetails['user_skills']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="noticePeriod">Notice Period (in days)</label>
                                            <input type="number" name="notice_period"
                                                placeholder="Enter number of notice period days" class="form-control"
                                                required="" value="<?= $moreUserDetails['notice_period']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="availability">Availability For Meeting</label>
                                            <input type="date" name="availability_for_meeting" class="form-control"
                                                min="<?=date("Y-m-d");?>"
                                                value="<?= date("Y-m-d", strtotime($moreUserDetails['availability_for_meeting'])); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="cover_letter">
                                                Cover Letter
                                                <?php
                                                    if($moreUserDetails['cover_letter'] && file_exists($moreUserDetails['cover_letter'])){
                                                ?>
                                                <a href="<?=site_url($moreUserDetails['cover_letter']);?>"
                                                    target="_blank"> (View) </a>
                                                <?php
                                                    }
                                                ?>
                                            </label>
                                            <input type="file" name="cover_letter" accept=".pdf, .doc, .docx">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="coverLetter">
                                                Resume
                                                <?php
                                                    if($moreUserDetails['resume'] && file_exists($moreUserDetails['resume'])){
                                                ?>
                                                <a href="<?=site_url($moreUserDetails['resume']);?>" target="_blank">
                                                    (View) </a>
                                                <?php
                                                    }
                                                ?>
                                            </label>
                                            <input type="file" name="resume" accept=".pdf, .doc, .docx">
                                        </div>
                                    </div>
                                </div>
                                <div class="responseMessage" id="responseMessage"></div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-info btn_submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function update_profile(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'Update-Profile',
        data: new FormData($('#profileForm')[0]),
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
            if (response.status == 1) location.reload();
            $("#responseMessage").html(response.responseMessage);
            $("#responseMessage").show();
        }
    });
}

function preview_image(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            let previewImg = $('<img />', {
                src: e.target.result,
                alt: 'Profile Image',
                width: '50px'
            });
            $('#' + previewId).html(previewImg);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<script type="text/javascript" src="<?=site_url('assets/site/js/document_ready.js');?>"></script>