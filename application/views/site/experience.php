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
                            <h2>Experience</h2>
                        </div>
                        <div class="pull-right">
                            <a href="<?= site_url('Profile'); ?>" class="btn btn_theme">Back</a>
                        </div>
                    </div>
                    <div class="set_whight">
                        <div class="detail_prof">
                            <div class="rii2">
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
                                <button class="btn btn-danger" id="remove-btn-<?=$userExperience['id'];?>"
                                    onclick="remove_experience(<?=$userExperience['id'];?>)"><i
                                        class="fa fa-close"></i></button>
                                <?php
                                }
                              ?>
                            </div>
                        </div>
                    </div>
                    <div class="set_whight">
                        <div class="detail_prof">
                            <form id="experienceForm" name="experienceForm" method="post"
                                onsubmit="add_experience(event);">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="image">Company</label>
                                            <input type="text" id="organization" name="organization" required=""
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="image">Designation</label>
                                            <input type="text" id="position" name="position" required=""
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="image">Start Date</label>
                                            <input type="date" id="emp_start_date" name="emp_start_date" required=""
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="image">End Date</label>
                                            <input type="date" id="emp_end_date" name="emp_end_date"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="image">Location</label>
                                            <input type="text" id="location" name="location" required=""
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-info btn_submit" type="submit"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="responseMessage" id="responseMessage"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function add_experience(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'Update-Experience',
        data: new FormData($('#experienceForm')[0]),
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
            $(".btn_submit").html('<i class="fa fa-plus"></i>');
            if (response.status == 1) {
                $(".rii2").append(append_experience(response.exp_id));
                // location.reload();
            }
            $("#responseMessage").html(response.responseMessage);
            $("#responseMessage").show();
        }
    });
}


function remove_experience(id) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'Remove-Experience',
        data: {
            exp_id: id
        },
        dataType: 'JSON',
        beforeSend: function(xhr) {
            $("#responseMessage").html('');
            $("#responseMessage").hide();
        },
        success: function(response) {
            // if (response.status == 1) location.reload();
            $("#responseMessage").html(response.responseMessage);
            $("#responseMessage").show();
        }
    });
}

function append_experience(exp_id) {
    let organization = $("#organization").val();
    let designation = $("#position").val();
    let location = $("#location").val();
    let start_date = $("#emp_start_date").val();
    let end_date = $("#emp_end_date").val();
    return `
    <div class="rii2">
      <a class="job_com1" href="#">
          <div class="com_img">
              <img src="<?= site_url('assets/site/'); ?>img/logo-short.png">
          </div>
          <div class="commodo_de">
              <h3>${organization}</h3>
              <h4><i class="fa fa-briefcase"></i>${designation}</h4>
              <h4><i class="fa fa-calendar"></i>${start_date} – ${end_date}</h4>
              <h4><i class="fa fa-map-marker"></i>${location}</h4>
          </div>
      </a>
      <button class="btn btn-danger" id="remove-btn-${exp_id}" onclick="remove_experience(${exp_id})"><i class="fa fa-close"></i></button>
    </div>
  `
}
</script>