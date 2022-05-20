


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
                  <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.</p>
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
                        <a href="<?= site_url('Career') ?>">Career</a>
                     </div>
                  </div>
                  <div class="col-sm-4 col-xs-4">
                     <h4>Policies</h4>
                     <div class="link_1">
                        <a href="<?= site_url('Legal') ?>">Legal </a>
                        <a href="<?= site_url('Privacy') ?>">Privacy Notice</a>
                        <a href="<?= site_url('Terms') ?>">Terms of Use</a>
                        <a href="<?= site_url('Policy') ?>">Cookie Policy</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="copy_right">
      <div class="container">
         © Copyright 2022 rahimnagori Software Solutions. All Rights Reserved.
      </div>
   </div>
</footer>


  <script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/jquery.min.js"></script>

  <script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/bootstrap.min.js"></script>

  <script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/owl.carousel.js"></script>

  <script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/sticky-sidebar.js"></script>

  <script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/tags.js"></script>

  <script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/jquery-ui.js"></script>

  <script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/chosen.js"></script>

  <script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/dataTables.responsive.min.js"></script>

  <script type="text/javascript" src="<?= site_url('assets/site/'); ?>js/custom.js"></script>

  <script type="text/javascript">

    /*active*/

$(function(){



        $('.sider_barr a').filter(function(){return this.href==location.href}).parent().addClass('active').siblings().removeClass('active')





    })

/*active*/

  </script>

  
<script type="text/javascript">
  $(document).ready(function(){
  $(".job_com1").click(function(){
    $(".cover_1").addClass("size1");
    $(".cover_4").removeClass("size6");
    $(".cover_2").addClass("size2");
    $(".cover_4").removeClass("size5");
  });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
  $(".job_com4").click(function(){
    $(".cover_3").addClass("size5");
    $(".cover_3").removeClass("size1");
    $(".cover_4").addClass("size6");
    $(".cover_4").removeClass("size2");
  });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
  $(".filss_me a").click(function(){
    $(".chann_sall").toggleClass("hidee_1");
  });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
  $(".Cancel2, .Apply3").click(function(){
    $(".chann_sall").addClass("hidee_1");
  });
});
</script>



  </body>

</html>