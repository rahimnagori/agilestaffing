<footer>
    <div class="footer">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 253" preserveAspectRatio="none">
            <path class="elementor-shape-fill vc-shape-fill" d="M0,218c0,0,151-110,279-124s165,101,390,76S999,2,1161,0s280,160,352,156
  s112.3-89,212-92s195,82,195,82v107H0V218z"></path>
        </svg>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="footer_about">
                        <a href="#"><img src="<?= site_url('assets/site/'); ?>img/logo.w.png" class="img_r"></a>
                        <p>Connecting Exceptional Talent with Leading Employers in the IT Sector.</p>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-4 col-xs-4">
                            <h4>Follow Us</h4>
                            <div class="link_1">
                                <a href="https://www.facebook.com" target="_Blank">Facebook </a>
                                <a href="https://www.instagram.com" target="_Blank">Instagram</a>
                                <a href="https://www.linkedin.com" target="_Blank">Linkedin </a>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-4">
                            <h4>Know Link</h4>
                            <div class="link_1">
                                <a href="<?= site_url('About') ?>">About us </a>
                                <a href="<?= site_url('Search-Jobs') ?>">Career</a>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-4">
                            <h4>Policies</h4>
                            <div class="link_1">
                                <a href="<?= site_url('Legal') ?>">Legal </a>
                                <a href="<?= site_url('Privacy') ?>">Privacy Notice</a>
                                <a href="<?= site_url('Terms') ?>">Terms of Use</a>
                                <a href="<?= site_url('Cookie') ?>">Cookie Policy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy_right">
        <div class="container">
            © Copyright
            <?= date('Y'); ?> <?= $this->config->item('PROJECT'); ?>. All Rights Reserved.
        </div>
    </div>
</footer>


<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/jquery.min.js"></script>

<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/owl.carousel.js"></script>

<!-- <script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/sticky-sidebar.js"></script> -->

<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/tags.js"></script>

<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/jquery-ui.js"></script>

<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/chosen.js"></script>

<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/dataTables.responsive.min.js"></script>

<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/custom.js"></script>

<script type="text/javascript">
/*active*/

$(function() {



    $('.sider_barr a').filter(function() {
        return this.href == location.href
    }).parent().addClass('active').siblings().removeClass('active')





})

/*active*/
</script>


<script type="text/javascript">
$(document).ready(function() {
    $(".job_com1").click(function() {
        $(".cover_1").addClass("size1");
        $(".cover_4").removeClass("size6");
        $(".cover_2").addClass("size2");
        $(".cover_4").removeClass("size5");
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $(".job_com4").click(function() {
        $(".cover_3").addClass("size5");
        $(".cover_3").removeClass("size1");
        $(".cover_4").addClass("size6");
        $(".cover_4").removeClass("size2");
    });
});
</script>

<script type="text/javascript">
function openCloseFilters() {
    $(".chann_sall").toggleClass("hidee_1");
}
</script>

<script type="text/javascript">
$(document).ready(function() {
    $(".Cancel2, .Apply3").click(function() {
        $(".chann_sall").addClass("hidee_1");
    });
});
</script>

<script>
const BASE_URL = "<?= site_url(); ?>";
const LOADING = "<i class='fa fa-spin fa-spinner' aria-hidden='true'></i> Processing ... ";

function preview_image(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            let previewImg = $('<img />', {
                src: e.target.result,
                alt: 'Resume',
                width: '50px'
            });
            $('#' + previewId).html(previewImg);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function delete_image(input, previewId) {
    if (confirm("Are you sure want to remove your profile image")) {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'Delete-Profile-Image',
            dataType: 'JSON',
            success: function(response) {
                if (response.status === 1) location.reload();
            }
        });
    }
}

function update_image(e) {
    e.preventDefault();
    let fileUpload = $("#sidebar-profile-image").get(0);
    let files = fileUpload.files;
    if (files.length) {
        let formData = new FormData();
        formData.append("profile_image", files[0]);
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'Update-Profile-Image',
            data: formData,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                if (response.status == 1) location.reload();
            }
        });
    }
}

function accept_cookie() {
    localStorage.setItem('isCookieAccepted', true);
    hide_cookie_notification()
}

function hide_cookie_notification() {
    $(".cokis").hide();
}

function scroll_to_bottom(div) {
    $("" + div).animate({
        scrollTop: $("" + div)[0].scrollHeight
    }, 1000);
}

if (localStorage.getItem('isCookieAccepted')) {
    hide_cookie_notification();
}
</script>


<script>
function request_professional(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'Request-Professional',
        data: new FormData($('#requestProfessionalForm')[0]),
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
            $("#requestProfessionalForm")[0].reset();
            $(".btn_submit").prop('disabled', false);
            $(".btn_submit").html(' Submit ');
            $("#responseMessage").html(response.responseMessage);
            $("#responseMessage").show();
        }
    });
}
</script>


<script type="text/javascript">
// document.getElementById('output').innerHTML = location.search;

// $(".chosen-select").chosen();
</script>
<script type="text/javascript">
/*tabel*/

$('#extent_tbl1').DataTable();

/*tabel close*/
</script>

<script type="text/javascript">
/*range*/

$(function() {

    $("#slider-range2").slider({

        range: true,

        min: 0,

        max: 500,

        values: [75, 300],

        slide: function(event, ui) {

            $("#amount2").val("$" + ui.values[0] + " - $" + ui.values[1]);

        }

    });

    $("#amount2").val("$" + $("#slider-range2").slider("values", 0) +

        " - $" + $("#slider-range2").slider("values", 1));

});

/*range*/
</script>



<!-- Message -->

<script type="text/javascript">
$(document).ready(function() {

});
</script>



<script type="text/javascript">
$(document).ready(function() {
    $(".mesaage1").click(function() {
        $(".cover_1").addClass("size1");
        $(".cover_4").removeClass("size6");
        $(".cover_2").addClass("size2");
        $(".cover_4").removeClass("size5");
    });
    $(".mesaage2").click(function() {
        $(".cover_3").addClass("size5");
        $(".cover_3").removeClass("size1");
        $(".cover_4").addClass("size6");
        $(".cover_4").removeClass("size2");
    });
    $(".Company_Logo").click(function() {
        $(".uploadd_bii").addClass("Company_Logo3");
        $(".Company_Logo").addClass("Company_Logo4");
    });
    $(".Company_Logo5").click(function() {
        $(".Company_Logo6").addClass("Company_Logo7");
        $(".Company_Logo5").addClass("Company_Logo8");
    });
    $(".Company_Logo9").click(function() {
        $(".Company_Logo10").addClass("Company_Logo11");
        $(".Company_Logo9").addClass("Company_Logo12");
    });
    $(".Company_Logo13").click(function() {
        $(".Company_Logo14").addClass("Company_Logo15");
        $(".Company_Logo13").addClass("Company_Logo16");
    });
    $(".Company_Logo17").click(function() {
        $(".Company_Logo18").addClass("Company_Logo19");
        $(".Company_Logo17").addClass("Company_Logo20");
    });
    $(".Company_Logo21").click(function() {
        $(".Company_Logo22").addClass("Company_Logo23");
        $(".Company_Logo21").addClass("Company_Logo24");
    });
    document_ready();
});
</script>

<!-- Message -->


<!-- setting -->
<link href="<?= site_url('assets/site/'); ?>css/cropper.min.css" rel="stylesheet">
<link href="<?= site_url('assets/site/'); ?>css/main.css" rel="stylesheet">
<script src="<?= site_url('assets/site/'); ?>js/cropper.min.js"></script>
<script src="<?= site_url('assets/site/'); ?>js/main.js"></script>
<script type="text/javascript">
$(document).ready(function() {});
</script>

<script>
function onClick(e) {
    e.preventDefault();
    grecaptcha.ready(function() {
        grecaptcha.execute('reCAPTCHA_site_key', {
            action: 'submit'
        }).then(function(token) {
            // Add your logic to submit to your backend server here.
        });
    });
}
</script>
</body>

</html>