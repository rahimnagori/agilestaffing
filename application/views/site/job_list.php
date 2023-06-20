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
            <!-- <h1>No Jobs Found</h1> -->
            <div class="text-center" style="padding: 0 20%;">
            <img src="<?= site_url('assets/site/'); ?>img/find.jpg" class="img_r" alt="" >
            </div>
            <?php
                }
            ?>
        </div>
    </div>
    
</div>

<div class="pag_des">
<nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?=($fetchedJobs <= 10) ? 'disabled' : '';?>"><a href="javascript:void(0);"
                            onclick="change_page('previous');" class="page-link">Previous</a>
                    </li>
                    <?php
                        for($i = 0; $i <= $pages; $i++){
                    ?>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);"
                            onclick="got_to_page(<?=$i;?>);"><?=$i + 1;?></a></li>
                    <?php
                        }
                    ?>
                    <li class="page-item <?=($fetchedJobs == $totalJobs) ? 'disabled' : '';?>"><a
                            href="javascript:void(0);" onclick="change_page('next');" class="page-link">Next</a></li>
                    
                </ul>
            </nav>
            <p> (<?=$fetchedJobs;?> / <?=$totalJobs;?>)</p>
</div>