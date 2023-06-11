<div class="col-sm-5 siz_col4 cover_1 cover_3">
    <!-- Right details box -->
    <div class="baccckk">
        <a href="#" class="job_com4"><i class="fa fa-long-arrow-left"></i> Back</a>
    </div>
    <div class="">
        <div class="scroll_1" id="job_details_div">
            <!-- Job details section -->
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
            <button class="job_com1 sidebar-jobs" type="button" onclick="get_job(this, <?= $job['id']; ?>);">
                <div class="com_img">
                    <img src="<?= site_url('assets/site/'); ?>img/img_7.png">
                </div>
                <div class="commodo_de">
                    <h3>
                        <?= $job['title']; ?>
                    </h3>
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
            <?php
                if(empty($jobs)) {
            ?>
            <h1>No Jobs Found</h1>
            <?php
                }
            ?>
        </div>
    </div>
</div>