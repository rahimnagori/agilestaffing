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
                            <h2>Profile</h2>
                        </div>
                        <div class="pull-right">
                            <a href="<?= site_url('Edit-Profile'); ?>" class="btn btn_theme">Edit</a>
                        </div>
                    </div>
                    <div class="set_whight">
                        <div class="detail_prof">
                            <h4>About</h4>
                            <p><?=$moreUserDetails['user_about'];?></p>
                            <h4>Skills</h4>
                            <?php
                                if(!empty($moreUserDetails['user_skills'])){
                                    $skills = explode(",", $moreUserDetails['user_skills']);
                            ?>
                            <div class="keyii">
                                <?php
                                            foreach($skills as $skill){
                                        ?>
                                <span><?=$skill;?></span>
                                <?php
                                            }
                                        ?>
                            </div>
                            <?php
                                }
                            ?>
                            <div class="rii2">
                                <h4> Experience </h4>
                                <?php
                                foreach($userExperiences as $userExperience){
                                  $empStartDate = date("M Y", strtotime($userExperience['emp_start_date']));
                                  $empEndDate = ($userExperience['emp_end_date']) ? date("M Y", strtotime($userExperience['emp_end_date'])) : 'Currently Working';
                              ?>
                                <a class="job_com1" href="#">
                                    <div class="com_img">
                                        <img src="<?= site_url('assets/site/'); ?>img/logo-short.png">
                                    </div>
                                    <div class="commodo_de">
                                        <h3><?=$userExperience['organization'];?></h3>
                                        <h4><i class="fa fa-briefcase"></i><?=$userExperience['position'];?></h4>
                                        <h4><i class="fa fa-calendar"></i> <?=$empStartDate;?> – <?=$empEndDate;?></h4>
                                        <h4><i class="fa fa-map-marker"></i><?=$userExperience['location'];?></h4>
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