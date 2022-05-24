


/*slider1*/
  $('.slider_galler1').owlCarousel({
    loop:true,
    margin:5,
    responsiveClass:true,
    // autoplay:true,
    // autoplayTimeout:1000,
    responsive:{
        0:{
            items:3,
            nav:true
        },
        600:{
            items:4,
            nav:false
        },
        1000:{
            items:6,
            nav:true,
            loop:false
        }
    }
})
/*slider1 close*/

/*input only number*/
  $(document).ready(function () {
  //called when key is pressed in textbox
  $(".quantity").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $(".errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
});

/*input only number close*/


/*scroll*/
// var stickySidebar = new StickySidebar('#sidebar', {
//       topSpacing: 20,
//       bottomSpacing: 20,
//       containerSelector: '.container-fluid',
//       innerWrapperSelector: '.container-fluid'
//     });

/*ttt*/


  $(document).ready(function () {

   

    $(document).on("scroll", onScroll);

   

  $('#sidebar a[href^="#"]').on('click', function (e) {

        e.preventDefault();

          $(document).off("scroll");

           $('a').each(function () {

              $(this).removeClass('active');

          })

          $(this).addClass('active');

           var target = this.hash,

           menu = target;

           $target = $(target);

         $('html, body').stop().animate({

              'scrollTop': $target.offset().top+2

          }, 1000, 'swing', function () {

              window.location.hash = target;

              $(document).on("scroll", onScroll);

          });

      });

  });
  function onScroll(event){

      var scrollPos = $(document).scrollTop();

      $('#sidebar a').each(function () {

          var currLink = $(this);

         var refElement = $(currLink.attr("href"));

          if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {

              $('#sidebar ul li a').removeClass("active");

              currLink.addClass("active");

          }
          else{
              currLink.removeClass("active");

          }

      });

  }


/*scroll*/

/*scroll*/
// var stickySidebar = new StickySidebar('#sidebar2', {
//       topSpacing: 20,
//       bottomSpacing: 20,
//       containerSelector: '.container-fluid',
//       innerWrapperSelector: '.container-fluid'
//     });

/*ttt*/


  $(document).ready(function () {

   

    $(document).on("scroll", onScroll);

   

  $('#sidebar2 a[href^="#"]').on('click', function (e) {

        e.preventDefault();

          $(document).off("scroll");

           $('a').each(function () {

              $(this).removeClass('active');

          })

          $(this).addClass('active');

           var target = this.hash,

           menu = target;

           $target = $(target);

         $('html, body').stop().animate({

              'scrollTop': $target.offset().top+2

          }, 1000, 'swing', function () {

              window.location.hash = target;

              $(document).on("scroll", onScroll);

          });

      });

  });
  function onScroll(event){

      var scrollPos = $(document).scrollTop();

      $('#sidebar2 a').each(function () {

          var currLink = $(this);

         var refElement = $(currLink.attr("href"));

          if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {

              $('#sidebar2 ul li a').removeClass("active");

              currLink.addClass("active");

          }
          else{
              currLink.removeClass("active");

          }

      });

  }


/*scroll*/

/*range*/
  $( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  } );
/*range*/

