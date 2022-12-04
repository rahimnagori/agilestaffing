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
                                  for($i = 0; $i < 4; $i++){
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

<script type="text/javascript">
    
</script>