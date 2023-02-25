<div class="left_side">
    <div class="img_usee" id="previewImage">
        <?php
        $profileImage = (!empty($moreUserDetails) && $moreUserDetails['profile_image']) ? $moreUserDetails['profile_image'] : 'assets/site/img/img_9.png';
        ?>
        <img src="<?= site_url($profileImage); ?>" alt="Profile Image">
    </div>
    <h4>
        <?= $userDetails['first_name'] . ' ' . $userDetails['last_name']; ?>
    </h4>
    <?php
    if ($editPage == true) {
        ?>

        <?php
    }
    ?>
    <p>
        <?=(!empty($moreUserDetails)) ? $moreUserDetails['current_job_role'] : 'Please add job role'; ?>
    </p>
    <ul class="ul_set sider_barr">
        <li>
            <a href="<?= site_url('Profile'); ?>"><i class="fa fa-user"></i> Profile</a>
        </li>
        <li>
            <a href="<?= site_url('Edit-Profile'); ?>"><i class="fa fa-user"></i> Edit Profile</a>
        </li>
        <li>
            <a href="<?= site_url('Job-Applications'); ?>"><i class="fa fa-file-text-o"></i> Job Applications</a>
        </li>
        <li>
            <a href="<?= site_url('User-Experience'); ?>"><i class="fa fa-file-text-o"></i> Experience</a>
        </li>
        <!-- <li>
            <a href="<?= site_url('Message'); ?>"><i class="fa fa-comments-o"></i> Message </a>
        </li>
        <li>
            <a href="<?= site_url('Notification'); ?>"><i class="fa fa-bell-o"></i> Notification</a>
        </li>
        <li>
            <a href="<?= site_url('Job_List'); ?>"><i class="fa fa-briefcase"></i> Jobs</a>
        </li>
        <li>
            <a href="<?= site_url('Candidate'); ?>"><i class="fa fa-vcard-o"></i> Candidates</a>
        </li>
        <li class="Section">
            <a href="<?= site_url('Setting'); ?>"><i class="fa fa-cog"></i>Settings</a>
        </li>
        <li>
            <a href="<?= site_url('Review'); ?>"><i class="fa fa-star-o"></i> Review</a>
        </li> -->
    </ul>
</div>