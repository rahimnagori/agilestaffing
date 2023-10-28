<?php include 'include/header.php'; ?>

<div class="conten_web">
    <h4 class="heading">Users <small>Management</small></h4>
    <div class="white_box">
        <?= $this->session->flashdata('responseMessage'); ?>
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
                        echo "No resume uploaded yet";
                  }
                  ?>
                            </td>
                            <td><?= ($user['last_login']) ? date("d M, Y", strtotime($user['last_login'])) : 'Not logged in yet'; ?>
                            </td>
                            <td><?= date("d M, Y", strtotime($user['created'])); ?></td>
                            <td><?= date("d M, Y", strtotime($user['updated'])); ?></td>
                            <td><?php include 'include/user_buttons.php'; ?></td>
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


<!-- Modal -->
<div class="modal fade" id="deleteUserModel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="deleteForm" name="deleteForm" onsubmit="delete_user(event);">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"><i class="la la-times-circle"></i></span></button>
                </div>

                <div class="modal-body">
                    <div class="optio_raddipo">
                        <div class="form-group">
                            <label> Are you sure you want to delete this User? </label>
                            <input type="hidden" name="delete_user_id" id="delete_user_id" />
                        </div>
                        <div class="row">
                            <div class="col-sm-12" class="responseMessage" id="responseMessage"></div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn_theme2 btn-lg btn_submit">Yes</button>
                            <button class="btn btn-lg btn-info" class="close" data-dismiss="modal"
                                aria-label="Close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal close-->

<?php include 'include/footer.php'; ?>

<script>
function open_delete_modal(id) {
    $("#delete_user_id").val(id);
    $("#deleteUserModel").modal("show");
}

function delete_user(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'Admin-Users/Delete',
        data: new FormData($('#deleteForm')[0]),
        dataType: 'JSON',
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function(xhr) {
            $(".btn_submit").attr('disabled', true);
            $(".btn_submit").html(LOADING);
            $("#responseMessage").html('');
            $("#responseMessage").hide();
        },
        success: function(response) {
            $(".btn_submit").prop('disabled', false);
            $(".btn_submit").html(' Yes ');
            if (response.status == 1) location.reload();
        }
    });
}
</script>