<?php include 'include/header.php'; ?>

<div class="conten_web">
    <h4 class="heading">Dashboard</h4>
    <div class="ddd">
        <div class="row">
            <div class="col-sm-3">
                <div class="dashboard-tile1 detail1 ">
                    <div class="content1">
                        <p><a href="Admin-Jobs">Jobs</a></p>
                        <h1><?=count($jobs);?></h1>
                    </div>
                    <div class="ussicon">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="dashboard-tile1 detail1 ">
                    <div class="content1">
                        <p><a href="Users-Management">Users</a></p>
                        <h1><?=count($users);?></h1>
                    </div>
                    <div class="ussicon">
                        <i class="fa fa-briefcase"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="dashboard-tile1 detail1 ">
                    <div class="content1">
                        <p><a href="Admin-Job-Applications">Job Applications</a></p>
                        <h1><?=count($jobApplications);?></h1>
                    </div>
                    <div class="ussicon">
                        <i class="fa fa-graduation-cap"></i>
                    </div>
                </div>
            </div>
            <!-- <div class="col-sm-3">
        <div class="dashboard-tile1 detail1 ">
          <div class="content1">
            <p>Bookings</p>
            <h1>480</h1>
          </div>
          <div class="ussicon">
            <i class="fa fa-user-o"></i>
          </div>
        </div>
      </div> -->
        </div>
    </div>
</div>

<?php include 'include/footer.php'; ?>