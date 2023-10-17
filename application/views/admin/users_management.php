<?php include 'include/header.php'; ?>

<div class="conten_web">
    <h4 class="heading">Users <small>Management</small></h4>
    <div class="white_box">
        <div class="card_bodym">
            <div class="table-responsive">
                <table id="extent_tbl1" class="table display">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Current Job Role</th>
                            <th>Expected Job Role</th>
                            <th>Current Job Type</th>
                            <th>Current Payment Type</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Resume</th>
                            <th>Last Login</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
            foreach ($users as $serialNumber => $user) {
              $emailStatus = ($user['is_email_verified'] == 1) ? 'Verified' : 'Not verified';
              $statusClass = ($user['is_email_verified'] == 1) ? 'success' : 'danger';
            ?>
                        <tr>
                            <td><?= $serialNumber + 1; ?></td>
                            <td>
                                <?= $user['email']; ?>
                                <strong><span class="text-<?= $statusClass; ?>">
                                        (<?= $emailStatus; ?>)
                                    </span></strong>
                            </td>
                            <td>
                                <?php
                                  if(file_exists($user['profile_image'])){
                                ?>
                                <img src="<?=site_url($user['profile_image']);?>" width="100">
                                <?php
                                  }
                                ?>
                                <?= $user['first_name'] . ' ' . $user['last_name']; ?>
                            </td>
                            <td><?= $user['current_job_role']; ?></td>
                            <td><?= $user['expected_job_role']; ?></td>
                            <td><?= $user['current_job_type']; ?></td>
                            <td><?= $user['current_payment_type']; ?></td>
                            <td><?= $user['city']; ?></td>
                            <td><?= $user['phone']; ?></td>
                            <td>
                                <?php
                  if (!empty($user['resume'])) {
                    ?>
                                <a href="<?= $user['resume']; ?>" download> View </a>
                                <?php
                  } else {
                    ?>
                                'No resume uploaded yet';
                                <?php
                  }
                  ?>
                            </td>
                            <td><?= ($user['last_login']) ? date("d M, Y", strtotime($user['last_login'])) : 'Not logged in yet'; ?>
                            </td>
                            <td><?= date("d M, Y", strtotime($user['created'])); ?></td>
                            <td><?= date("d M, Y", strtotime($user['updated'])); ?></td>
                            <td>
                                Action
                                <!-- <a href="#" class="btn btn-info btn-xs">Send Mail</a>
                  <a href="#" class="btn btn-info btn-xs">Edit</a>
                  <a href="#" class="btn btn-danger btn-xs">Delete</a> -->
                            </td>
                        </tr>
                        <?php
            }
            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'include/footer.php'; ?>