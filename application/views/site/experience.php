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
                                  $empStartDateInput = date("Y-m-d", strtotime($userExperience['emp_start_date']));
                                  $empEndDate = ($userExperience['emp_end_date']) ? date("M Y", strtotime($userExperience['emp_end_date'])) : 'Currently Working';
                                  $empEndDateInput = ($userExperience['emp_end_date']) ? date("Y-m-d", strtotime($userExperience['emp_end_date'])) : null;
                              ?>
                                <a class="job_com1 set_p2d" href="#" id="view-exp-<?=$userExperience['id'];?>">
                                    <div class="com_img">
                                        <img src="<?= site_url('assets/site/'); ?>img/logo-short.png">
                                    </div>
                                    <div class="commodo_de">
                                        <h3 id="view-organization-<?=$userExperience['id'];?>">
                                            <?=$userExperience['organization'];?></h3>
                                        <h4 id="view-position-<?=$userExperience['id'];?>"><i
                                                class="fa fa-briefcase"></i><?=$userExperience['position'];?></h4>
                                        <h4 id="view-emp_duration-<?=$userExperience['id'];?>"><i
                                                class="fa fa-calendar"></i> <?=$empStartDate;?> – <?=$empEndDate;?></h4>
                                        <h4 id="view-emp_location-<?=$userExperience['id'];?>"><i
                                                class="fa fa-map-marker"></i><?=$userExperience['location'];?></h4>
                                    </div>
                                    <span class="bo_btj">
                                        <button class="btn btn-danger" id="remove-btn-<?=$userExperience['id'];?>"
                                            onclick="remove_experience(<?=$userExperience['id'];?>)"><i
                                                class="fa fa-close"></i></button>
                                        <button class="btn btn_theme" id="edit-btn-<?=$userExperience['id'];?>"
                                            onclick="edit_experience(<?=$userExperience['id'];?>)"><i
                                                class="fa fa-edit"></i></button>
                                    </span>
                                </a>
                                <div class=" hidden" id="edit-exp-input-<?=$userExperience['id'];?>">
                                    <form id="updateExperienceForm<?=$userExperience['id'];?>" method="post"
                                        onsubmit="update_experience(event, <?=$userExperience['id'];?>);">
                                        <div class="set_med1">
                                            <input type="hidden" name="update_exp_id"
                                                value="<?=$userExperience['id'];?>">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label
                                                        for="edit-organization-<?=$userExperience['id'];?>">Company</label>
                                                    <input type="text"
                                                        id="edit-organization-<?=$userExperience['id'];?>"
                                                        name="organization" required="" class="form-control"
                                                        value="<?=$userExperience['organization'];?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label
                                                        for="edit-position-<?=$userExperience['id'];?>">Designation</label>
                                                    <input type="text" id="edit-position-<?=$userExperience['id'];?>"
                                                        name="position" required="" class="form-control"
                                                        value="<?=$userExperience['position'];?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="edit-emp_start_date-<?=$userExperience['id'];?>">Start
                                                        Date</label>
                                                    <input type="date"
                                                        id="edit-emp_start_date-<?=$userExperience['id'];?>"
                                                        name="emp_start_date" required="" class="form-control"
                                                        value="<?=$empStartDateInput;?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="edit-emp_end_date-<?=$userExperience['id'];?>">End
                                                        Date</label>
                                                    <input type="date"
                                                        id="edit-emp_end_date-<?=$userExperience['id'];?>"
                                                        name="emp_end_date" class="form-control"
                                                        value="<?=$empEndDateInput;?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label
                                                        for="edit-location-<?=$userExperience['id'];?>">Location</label>
                                                    <input type="text" id="edit-location-<?=$userExperience['id'];?>"
                                                        name="location" required="" class="form-control"
                                                        value="<?=$userExperience['location'];?>">
                                                </div>
                                            </div>
                                            <div class="bo_btj">
                                                <button class="btn btn_theme btn_submit" type="submit"><i
                                                        class="fa fa-check"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <?php
                                }
                              ?>
                            </div>
                        </div>

                        <div class="set_med1">
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

                                </div>
                                <div class="bo_btj">
                                    <button class="btn btn_theme btn_submit" type="submit"><i
                                            class="fa fa-plus"></i></button>
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
const englishMonth = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

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
                $('#experienceForm').trigger("reset")
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
            if (response.status == 1) {
                $("#view-exp-" + id).remove();
                // location.reload();
            }
            $("#responseMessage").html(response.responseMessage);
            $("#responseMessage").show();
        }
    });
}

function append_experience(exp_id) {
    let organization = $("#organization").val();
    let designation = $("#position").val();
    let location = $("#location").val();
    let start_date = format_date($("#emp_start_date").val());
    let end_date = format_date($("#emp_end_date").val());
    return `
    <div class="rii2">
      <a class="job_com1 set_p2d" href="#">
          <div class="com_img">
              <img src="<?= site_url('assets/site/'); ?>img/logo-short.png">
          </div>
          <div class="commodo_de">
              <h3>${organization}</h3>
              <h4><i class="fa fa-briefcase"></i>${designation}</h4>
              <h4><i class="fa fa-calendar"></i>${start_date} – ${end_date}</h4>
              <h4><i class="fa fa-map-marker"></i>${location}</h4>
          </div>
          <span class="bo_btj">
      <button class="btn btn-danger" id="remove-btn-${exp_id}" onclick="remove_experience(${exp_id})"><i class="fa fa-close"></i></button>
      </div>
    </span>
      </a>
      
  `
}

function edit_experience(id) {
    $("#edit-exp-input-" + id).toggleClass("hidden");
    $("#view-exp-" + id).toggleClass("hidden");
}

function update_experience(e, id) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'Modify-Experience',
        data: new FormData($('#updateExperienceForm' + id)[0]),
        dataType: 'JSON',
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function(xhr) {
            $("#responseMessage").html('');
            $("#responseMessage").hide();
        },
        success: function(response) {
            if (response.status == 1) {
                update_experience_ui(id)
                edit_experience(id)
            }
            $("#responseMessage").html(response.responseMessage);
            $("#responseMessage").show();
        }
    });
}

function update_experience_ui(id) {
    let organization = $("#edit-organization-" + id).val();
    let designation = $("#edit-position-" + id).val();
    let location = $("#edit-location-" + id).val();
    let start_date = format_date($("#edit-emp_start_date-" + id).val());
    let end_date = $("#edit-emp_end_date-" + id).val();
    end_date = (end_date.length) ? format_date($("#edit-emp_end_date-" + id).val()) : 'Currently Working';
    $("#view-position-" + id).html(`<i class="fa fa-briefcase"></i>${designation}`);
    $("#view-emp_duration-" + id).html(`<i class="fa fa-calendar"></i> ${start_date} – ${end_date}`);
    $("#view-emp_location-" + id).html(`<i class="fa fa-map-marker"></i>${location}`);
}

function format_date(input) {
    let newDate = new Date(input);
    let month = newDate.getMonth()
    let year = newDate.getFullYear()
    return `${englishMonth[month]} ${year}`
}
</script>

<script type="text/javascript" src="<?=site_url('assets/site/js/document_ready.js');?>"></script>