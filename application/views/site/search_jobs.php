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
                            <div class="scroll_1">
                                <?php include_once('job_details.php'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 siz_col2 cover_2 cover_4">
                        <!-- Left sidebar -->
                        <div class="scroll_1">
                            <div class="job_com2">
                                <?php
                                for ($i = 0; $i < 4; $i++) {
                                ?>
                                    <!-- loop -->
                                    <a class="job_com1 active" href="#">
                                        <div class="com_img">
                                            <img src="<?= site_url('assets/site/'); ?>img/img_7.png">
                                        </div>
                                        <div class="commodo_de">
                                            <h3>Capvision</h3>
                                            <div class="star_5">
                                                <span class="active fa fa-star"></span>
                                                <span class="active fa fa-star"></span>
                                                <span class="active fa fa-star"></span>
                                                <span class="active fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                            </div>
                                            <h4><i class="fa fa-briefcase"></i> Facilities Officer</h4>
                                            <h4><i class="fa fa-map-marker"></i>Indore</h4>
                                        </div>
                                    </a>
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

<!-- Modal -->
<div class="modal fade modal_desus modal_md detail_modal" id="detail_list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                <h4 class="modal-title" id="myModalLabel">Apply </h4>
            </div>
            <div class="modal-body">
                <div class="modal_foo">
                    <form>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="" placeholder="Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="" placeholder="Email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Resume</label>
                            <input name="" placeholder="Resume" class="form-control upload" type="file">
                        </div>
                        <div class="form-group">
                            <label>Skills</label>
                            <input id="form-tags-1" name="tags-1" type="text" value="jQuery,Script,Net">
                        </div>
                        <div class="form-group">
                            <label>Experience</label>

                            <input type="text" name="" placeholder="Experience" class="form-control">
                        </div>
                        <div class="form-group">
                            <a class="btn btn_theme btn-lg btn-block" href="#" data-toggle="modal" data-target="#adddl" data-dismiss="modal">
                                Click apply
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal_desus modal_md detail_modal" id="adddl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                <h4 class="modal-title" id="myModalLabel">Thank you </h4>
            </div>
            <div class="modal-body">
                <div class="modla_thekk text-center">
                    <div class="img_fff">
                        <img src="<?= site_url('assets/site/'); ?>img/icon_right.png">
                    </div>
                    <h3>Thank you for the application</h3>
                    <div class="btn_all2">
                        <a href="<?=site_url('Sign-Up');?>" class="btn btn_theme">Sign up</a>
                        <a href="<?=site_url('Search-Jobs');?>" class="btn btn_theme">Continue Searching
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal_desus modal_lg detail_modal" id="adddl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
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

<script type="text/javascript">
    function apply() {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'Apply',
            data: {
                id: 3
            },
            dataType: 'json',
            beforeSend: function(xhr) {
                $(".btn_submit").attr('disabled', true);
                $(".btn_submit").html(LOADING);
                $("#job-listings").html(LOADING);
                $("#responseMessage").hide();
            },
            success: function(response) {
                $("#responseMessage").html(response.responseMessage);
                $("#responseMessage").show();
                if (response.status == 1) {
                    $(".btn_submit").html(' Applied ');
                } else if (response.status == 3) {
                    $(".btn_submit").html(' Already applied ');
                } else {
                    $(".btn_submit").html(' Apply ');
                    $(".btn_submit").prop('disabled', false);
                }
            }
        });
    }
</script>