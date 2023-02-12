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
                            <span class="form-control">
                                <?= $userDetails['first_name']; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <span class="form-control">
                                <?= $userDetails['email']; ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <label>Resume <strong> (This will update the old resume) </strong></label>
                            <input type="file" name="resume" placeholder="Resume" class="form-control upload"
                                accept=".pdf, .doc. docx">
                        </div>
                        <input type="hidden" name="job_id" id="search-job-id" required="" value="<?= $jobId; ?>">
                        <div class="form-group">
                            <button class="btn btn_theme btn-lg btn-block apply_btn" type="submit">
                                Apply
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