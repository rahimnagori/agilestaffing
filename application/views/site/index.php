<div class="banner ">
    <img src="<?= site_url('assets/site/'); ?>img/img_23.jpg" alt="">
    <div class="banner_con_h">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="box_1">
                        <h1>
                            Welcome to <span class="color1">
                                <?= $this->config->item('PROJECT'); ?>
                            </span>
                        </h1>
                        <p>
                            Unlocking Your Potential Through Innovative Staffing Solutions. Your Trusted Partner in
                            Navigating
                            the Job Market. Career Guidance and Staffing Expertise to Accelerate Your Success.
                        </p>
                    </div>
                    <div class="seac_m">
                        <div class="seac_m2">
                            <form id="searchForm" name="searchForm" method="get" action="Search-Jobs">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="icon_in">
                                            <i class="fa fa-search"></i>
                                            <input type="text" name="location-string" required="" placeholder="Search"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="icon_in">
                                            <i class="fa fa-location-arrow"></i>
                                            <input type="text" name="location" required="" placeholder="Location"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn_theme">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="sec_pad keyyy">
    <div class="container">
        <div class="row d_flex align_center">
            <div class="col-sm-5">
                <div class="box_4">
                    <h1>
                        Find the right job or internship for you
                    </h1>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="keyii">
                    <h4>Suggested Searches</h4>
                    <?php
                     shuffle($filters);
                     foreach($filters as $filter){
                        foreach($filter as $suggestedSearch){
                     ?>
                    <span><?=$suggestedSearch;?></span>
                    <?php
                        }
                     }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="sec_pad how_it_work">
    <div class="container">
        <div class="hedding1">
            <h2>How It Work</h2>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="box_2">
                    <h3 class="text-left">For Employee</h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="icon1">
                                <img src="<?= site_url('assets/site/'); ?>img/img_4.png">
                            </div>
                            <h4>
                                Find Jobs
                            </h4>
                            <p>
                                Discover Your Next Opportunity: Find Jobs That Match Your Skills and Ambitions
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <div class="icon1">
                                <img src="<?= site_url('assets/site/'); ?>img/img_5.png">
                            </div>
                            <h4>
                                Apply Jobs
                            </h4>
                            <p>
                                Take the Next Step: Apply to Exciting Job Opportunities and Start Your Career Journey
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="box_2">
                    <h3 class="text-left">For Employer</h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="icon1">
                                <img src="<?= site_url('assets/site/'); ?>img/img_2.png">
                            </div>
                            <h4>
                                Sign up
                            </h4>
                            <p>Join Our Community: Sign Up for Exclusive Access to Job Opportunities and Career
                                Resources</p>
                        </div>
                        <div class="col-sm-6">
                            <div class="icon1">
                                <img src="<?= site_url('assets/site/'); ?>img/img_3.png">
                            </div>
                            <h4>
                                Track Application
                            </h4>
                            <p>Stay Informed: Track the Progress of Your Job Applications with Ease</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="sec_pad Features">
    <div class="container">
        <div class="hedding1">
            <h2>Features</h2>
        </div>
        <div class="row d_flex align_center">
            <div class="col-sm-6">
                <div class="Feat_img">
                    <img src="<?= site_url('assets/site/'); ?>img/img_6.png" class="img_r">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="box_3">
                    <h3>Personalized Matching</h3>
                    <p>
                        Agile Staffing uses an innovative, data-driven approach to match job seekers with the right
                        employers.
                        We take the time to understand each candidate's unique skills, experience, and preferences, and
                        use
                        advanced algorithms to identify the best job opportunities.
                    </p>
                </div>
                <div class="box_3">
                    <h3>Industry Expertise</h3>
                    <p>
                        Our team of staffing experts has years of experience in the information technology industry, and
                        we
                        have built strong relationships with leading employers in this sector. We understand the
                        specific
                        needs and challenges of IT job seekers, and use our expertise to guide candidates to the best
                        job
                        opportunities.
                    </p>
                </div>
                <div class="box_3">
                    <h3>End-to-End Support</h3>
                    <p>
                        At Agile Staffing, we provide comprehensive support to job seekers throughout the entire
                        recruitment
                        process. From creating a strong resume to preparing for interviews, our team is here to help
                        candidates succeed. We also offer ongoing career guidance to ensure long-term success and
                        professional
                        growth.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>