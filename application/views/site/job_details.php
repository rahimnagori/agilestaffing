<div class="job_img_1">
    <img src="<?= site_url('assets/site/'); ?>img/best-banner.jpg">
</div>
<div class="cont_Payroll">
    <div class="commodo_de commodo_de2">
        <a href="#">
            <h3>
                <?= $jobDetails['title']; ?>
            </h3>
            <h2>
                <?= $jobDetails['company']; ?>
            </h2>
        </a>
        <!-- <div class="star_5">
            <span class="active fa fa-star"></span>
            <span class="active fa fa-star"></span>
            <span class="active fa fa-star"></span>
            <span class="active fa fa-star"></span>
            <span class="fa fa-star"></span>
        </div> -->
        <div class="ayrollh3">
            <a href="#" class="btn btn_theme" data-toggle="modal" data-target="#detail_list">Apply</a>
            <a href="#" class="btn btn_theme2"> <i class="fa fa-heart-o"></i> Save </a>
        </div>
        <hr>
        <h4><i class="fa fa-briefcase"></i>
            <?= $jobDetails['position']; ?>
        </h4>
        <h4><i class="fa fa-map-marker"></i>
            <?= $jobDetails['address']; ?>
        </h4>
        <!-- <h4><i class="fa fa-money"></i>₹30,000 a month</h4> -->
    </div>
    <?= $jobDetails['description']; ?>
</div>