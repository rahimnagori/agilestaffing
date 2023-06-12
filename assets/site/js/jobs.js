function apply_job(e) {
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: BASE_URL + "Job-Apply",
    data: new FormData($("#jobApplicationForm")[0]),
    dataType: "json",
    processData: false,
    contentType: false,
    cache: false,
    beforeSend: function (xhr) {
      $(".apply_btn").attr("disabled", true);
      $(".apply_btn").html(LOADING);
      $("#responseMessageOtp").hide();
      $("#submitOtpForm").hide();
    },
    success: function (response) {
      $("#responseMessageOtp").html(response.responseMessage);
      $("#responseMessageOtp").show();
      $("#jobApplicationForm").hide();
      $("#submitOtpForm").show();
      if (response.status == 1) {
        if (response.user_id) {
          $("#user_id_input").val(response.user_id);
          $("#job_id_input").val(response.job_id);
          $("#resume_input").val(response.resumePath);
        } else {
          $("#jobApplicationForm").hide();
          $("#job_apply_btn").html("Applied");
          $("#job_apply_btn").attr("disabled", true);
        }
      }
    },
  });
}

function submit_otp(e) {
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: BASE_URL + "Submit-Otp",
    data: new FormData($("#submitOtpForm")[0]),
    dataType: "json",
    processData: false,
    contentType: false,
    cache: false,
    beforeSend: function (xhr) {
      $(".otp_btn").attr("disabled", true);
      $(".otp_btn").html(LOADING);
      $("#responseMessageOtp").hide();
    },
    success: function (response) {
      $("#responseMessageOtp").html(response.responseMessage);
      $("#responseMessageOtp").show();
      if (response.status == 1) {
        $(".otp_btn").html("Applied");
        $("#my-modal").modal("show");
        $("#submitOtpForm").hide();
      } else if (response.status == 3) {
        $(".otp_btn").html("Already applied");
        $("#submitOtpForm").hide();
      } else {
        $(".otp_btn").html("Apply");
        $(".otp_btn").prop("disabled", false);
      }
    },
  });
}

function get_job(e, job_id) {
  $(".sidebar-jobs").removeClass("active");
  $(e).addClass("active");
  $.ajax({
    type: "POST",
    url: BASE_URL + "Job-Details/" + job_id,
    dataType: "html",
    beforeSend: function (xhr) {
      $("#job_details_div").html(LOADING);
    },
    success: function (response) {
      $("#job_details_div").html(response);
      get_job_modal(job_id);
    },
  });
}

function get_job_modal(job_id) {
  $.ajax({
    type: "POST",
    url: BASE_URL + "Reset-Job/" + job_id,
    dataType: "html",
    beforeSend: function (xhr) {
      $("#modals-div").html("");
    },
    success: function (response) {
      $("#modals-div").html(response);
    },
  });
}

function fetch_jobs() {
  let url = new URL(window.location.href);
  let search_location_string = url.searchParams.get("location-string");
  if (search_location_string) {
    $("#search_string").val(search_location_string);
    window.history.replaceState(null, "", window.location.pathname);
  }

  $.ajax({
    type: "POST",
    url: BASE_URL + "Jobs",
    dataType: "json",
    data: new FormData($("#filterForm")[0]),
    processData: false,
    contentType: false,
    cache: false,
    beforeSend: function (xhr) {
      $("#job_details_div").html(LOADING);
    },
    success: function (response) {
      $("#jobs_section").html(response.response);
    },
  });
}

function document_ready() {
  fetch_jobs();
}

function reset_jobs() {
  $("#filterForm")[0].reset();
  fetch_jobs();
}

function update_filters(e) {
  e.preventDefault();
  fetch_jobs();
}
