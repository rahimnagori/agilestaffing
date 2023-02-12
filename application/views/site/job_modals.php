<!-- Modal -->
<div class="modal fade modal_desus modal_md detail_modal" id="detail_list" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
                            class="fa fa-times"></i></span></button>
                <h4 class="modal-title" id="myModalLabel">Apply </h4>
            </div>
            <div class="modal-body">
                <div class="modal_foo">
                    <form id="jobApplicationForm" name="jobApplicationForm" method="post" onsubmit="apply_job(event);">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="first_name" placeholder="Name" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" placeholder="Email" class="form-control" required="">
                        </div>

                        <div class="form-group">
                            <label>Resume</label>
                            <input type="file" name="resume" placeholder="Resume" class="form-control upload"
                                accept=".pdf, .doc. docx">
                        </div>
                        <input type="hidden" name="job_id" id="search-job-id" required="" value="<?= $jobId; ?>">
                        <!-- <div class="form-group">
                            <label>Skills</label>
                            <input id="form-tags-1" name="tags-1" type="text" value="jQuery,Script,Net">
                        </div>
                        <div class="form-group">
                            <label>Experience</label>

                            <input type="text" name="" placeholder="Experience" class="form-control">
                        </div> -->
                        <div class="form-group">
                            <button class="btn btn_theme btn-lg btn-block apply_btn" type="submit">
                                Apply
                            </button>
                        </div>
                    </form>
                    <form id="submitOtpForm" name="submitOtpForm" method="post" onsubmit="submit_otp(event);">
                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" name="otp" placeholder="Code" class="form-control" required="">
                            <input type="hidden" name="job_id" id="job_id_input" required="" value="0">
                            <input type="hidden" name="user_id" id="user_id_input" required="" value="0">
                            <input type="hidden" name="resume" id="resume_input" required="" value="0">
                        </div>
                        <div class="form-group">
                            <button class="btn btn_theme btn-lg btn-block otp_btn" type="submit">
                                Submit
                            </button>
                        </div>
                    </form>
                    <div class="responseMessage" id="responseMessageOtp"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal_desus modal_md detail_modal" id="adddl" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
                            class="fa fa-times"></i></span></button>
                <h4 class="modal-title" id="myModalLabel">Thank you </h4>
            </div>
            <div class="modal-body">
                <div class="modla_thekk text-center">
                    <div class="img_fff">
                        <img src="<?= site_url('assets/site/'); ?>img/icon_right.png">
                    </div>
                    <h3>Thank you for the application</h3>
                    <div class="btn_all2">
                        <a href="<?= site_url('Sign-Up'); ?>" class="btn btn_theme">Sign up</a>
                        <a href="<?= site_url('Search-Jobs'); ?>" class="btn btn_theme">Continue Searching
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal_desus modal_lg detail_modal" id="adddl" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
                            class="fa fa-times"></i></span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <!-- Apply Job  -->
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="box_member">
                            <div class="member_hh">
                                <h5>Starter</h5>
                            </div>
                            <div class="contt_tab">
                                <h1>
                                    $51<span>/ For 1 Month</span>
                                </h1>
                                <ul class="ul_set">
                                    <li>
                                        Lorem Ipsum is simply dummy.
                                    </li>
                                    <li>
                                        Lorem Ipsum dummy.
                                    </li>
                                    <li>
                                        Lorem Ipsum is simply dummy.
                                    </li>
                                    <li>
                                        Lorem Ipsum dummy.
                                    </li>
                                </ul>
                                <a href="#" class="btn btn_theme Upgrade_btn">Upgrade</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="box_member active">
                            <div class="member_hh">
                                <h5>Starter</h5>
                            </div>
                            <div class="contt_tab">
                                <h1>
                                    $51<span>/ For 1 Month</span>
                                </h1>
                                <ul class="ul_set">
                                    <li>
                                        Lorem Ipsum is simply dummy.
                                    </li>
                                    <li>
                                        Lorem Ipsum dummy.
                                    </li>
                                    <li>
                                        Lorem Ipsum is simply dummy.
                                    </li>
                                    <li>
                                        Lorem Ipsum dummy.
                                    </li>
                                </ul>
                                <a href="#" class="btn btn_theme Upgrade_btn">Upgrade</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>