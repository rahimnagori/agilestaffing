<?php include 'include/header.php'; ?>

<div class="conten_web">
    <h2 class="heading">Settings</h2>

    <div class="ddd">
        <!-- <div class="row">
      <div class="col-sm-12">
        <h4 class="heading">Permissions</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <?= $this->session->flashdata('responseMessage'); ?>
        <div id="responseMessage"></div>
        <div class="row">
          <form method="post" id="permission_form" onsubmit="update_permission(event)" ;>
            <?php
            foreach ($permissions as $permission) {
            ?>
              <div class="form-group col-sm-4">
                <input type="text" class="form-control" name="<?= $permission['permission']; ?>" value="<?= $permission['comment']; ?>" required="" />
              </div>
            <?php
            }
            ?>
            <div class="form-group col-sm-2">
              <button type="submit" class="btn btn-success btn_submit_permission"> Update</button>
            </div>
          </form>
        </div>
      </div>
    </div> -->
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <h4 class="heading">Emails</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <?php
          foreach ($emails as $email) {
          ?>
                    <div class="col-sm-4 form-group">
                        <button onclick="get_email_content(<?= $email['id']; ?>);" type="button"
                            class="btn btn-info"><?= ucwords(str_replace('_', ' ', $email['comment'])); ?></button>
                    </div>
                    <?php
          }
          ?>
                </div>
            </div>
        </div>
        <!-- <div class="row">
      <div class="col-sm-12">
        <h4 class="heading">Documents</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <form id="settingsForm" name="settingsForm" method="post" onsubmit="update_settings(event);">
          <div class="row">
            <?php
              foreach($settings as $key => $setting){
                if($key == 'id' || $key == 'doc_expire_days') continue;
            ?>
                <div class="form-group col-sm-4">
                  <label><?= ucwords(str_replace('_', ' ', $key)); ?></label>
                  <input type="text" class="form-control" name="<?= $key ?>" value="<?= $setting; ?>" required="" />
                </div>
            <?php
              }
            ?>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div id="documentResponseMessage"></div>
              <button type="submit" class=" btn btn-success btn-lg">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div> -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade " id="email_content_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="updateEmailContentForm" name="updateEmailContentForm" onsubmit="update_email_content(event);">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update permissions</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-times-circle"></i></span></button>
                </div>

                <div class="modal-body" id="email-content">
                    <!-- email-content.php -->
                    <!-- <div class="row">
                        <div class="col-sm-4">
                            <?php
                            foreach($params as $param){
                          ?>
                            <p><button class="btn btn-info" type="button"
                                    onclick="update_editor('[<?=$param?>]');">[<?=$param?>]</button></p>
                            <?php
                            }
                          ?>
                        </div>
                        <div class="col-sm-8">
                        </div>
                    </div> -->
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal close-->

<?php include 'include/footer.php'; ?>
<?php include 'include/tinymce.php'; ?>

<script>
function update_permission(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'Update-Default-Permissions',
        data: new FormData($('#permission_form')[0]),
        dataType: 'JSON',
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function(xhr) {
            $(".btn_submit_permission").attr('disabled', true);
            $(".btn_submit_permission").html(LOADING);
            $("#responseMessage").html('');
            $("#responseMessage").hide();
        },
        success: function(response) {
            $(".btn_submit_permission").prop('disabled', false);
            $(".btn_submit_permission").html('Update');
            $("#responseMessage").html(response.responseMessage);
            $("#responseMessage").show();
        }
    });
}

function get_email_content(email_id) {
    $.ajax({
        type: 'GET',
        url: BASE_URL + 'Get-Email',
        data: {
            email_id: email_id
        },
        dataType: 'HTML',
        beforeSend: function(xhr) {
            $("#email-content").html("<i class='fa fa-spin fa-spinner' aria-hidden='true'></i>");
            $("#email_content_modal").modal("show");
        },
        success: function(response) {
            $("#email-content").html(response);
            update_tiny('textarea-edit');
        }
    });
}


// function get_admin_permissions(adminId) {
//   $.ajax({
//     type: 'GET',
//     url: BASE_URL + 'Get-Permissions',
//     data: {
//       admin_id: adminId
//     },
//     dataType: 'HTML',
//     beforeSend: function(xhr) {
//       $("#email-content").html("<i class='fa fa-spin fa-spinner' aria-hidden='true'></i>");
//       $("#email_content_modal").modal("show");
//     },
//     success: function(response) {
//       $("#email-content").html(response);
//     }
//   });
// }

function update_email_content(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'Update-Email',
        data: new FormData($('#updateEmailContentForm')[0]),
        dataType: 'JSON',
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function(xhr) {
            $(".btn_submit").attr('disabled', true);
            $(".btn_submit").html(LOADING);
            $("#editResponseMessage").html('');
            $("#editResponseMessage").hide();
        },
        success: function(response) {
            $(".btn_submit").prop('disabled', false);
            $(".btn_submit").html('Update');
            $("#editResponseMessage").html(response.responseMessage);
            $("#editResponseMessage").show();
        }
    });
}

function update_settings(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'Update-Settings',
        data: new FormData($('#settingsForm')[0]),
        dataType: 'JSON',
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function(xhr) {
            $(".btn_submit").attr('disabled', true);
            $(".btn_submit").html(LOADING);
            $("#documentResponseMessage").html('');
            $("#documentResponseMessage").hide();
        },
        success: function(response) {
            $(".btn_submit").prop('disabled', false);
            $(".btn_submit").html('Update');
            $("#documentResponseMessage").html(response.responseMessage);
            $("#documentResponseMessage").show();
        }
    });
}
</script>