<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>MyTRIPMATE - Best Holidays | Hotel Booking | Cabs | Flight</title>
      
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="shortcut icon" href="{{ asset('user/images/globe.png') }}">
      <link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:400,500,700" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}">
      <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('user/css/materialize.css') }}">
      <link rel="stylesheet" href="{{ asset('user/css/bootstrap.css') }}">
      <link rel="stylesheet" href="{{ asset('user/css/mob.css') }}">
      <link rel="stylesheet" href="{{ asset('user/css/animate.css') }}">
      <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
   <body>
    <section>
         <div class="ed-mob-menu">
            <div class="ed-mob-menu-con">
               <div class="ed-mm-left">
                  <div class="wed-logo"><a href="{{ url('/') }}"><img src="{{ asset('user/img/logo1.jpg') }}"></a></div>
               </div>
               <div class="ed-mm-right">
                  <div class="ed-mm-menu">
                     <a href="#!" class="ed-micon"><i class="fa fa-bars"></i></a>
                     <div class="ed-mm-inn">
                        <a href="#!" class="ed-mi-close"><i class="fa fa-times"></i></a>
                        <ul>
                           <li><a href="{{ url('/') }}">Home</a></li>
                           <li><a href="{{ url('/packages') }}">Holiday</a></li>
                           <li><a href="#">Hotels</a></li>
                           <li><a href="#">Flights</a></li>
                           <li><a href="#">B2B</a></li>
                        </ul>
                        <ul>
                            @guest
                                <li>
                                <a href="{{ route('login') }}">
                                    Login
                                </a>
                              </li>

                               <li>
                                <a href="{{ route('register') }}">Register</a>
                            </li>
                            @else
                               <li>
                                <a href="{{ route('myaccount', ['user_id' => Auth::user()->id]) }}">My Account</a>
                                </li>
                            @endif
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--HEADER SECTION-->
      <section>
         <!-- TOP BAR -->
         <div class="ed-top">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <h6 align="Right"><i class="fa fa-phone"></i> 
                        <a>+91 94353-38100 | 38900</a> 
                          <i class="fa fa-envelope-o"></i> 
                        <a>mail@mytripmate.co</a>
                     </h6>
                  </div>
               </div>
            </div>
         </div>
         <!-- LOGO AND MENU SECTION -->
         <div class="top-logo" data-spy="affix" data-offset-top="250">
            <div class="container menulineheight">
               <div class="row">
                  <div class="col-md-12">
                    <a href="{{ url('/') }}">
                     <div class="wed-logo wed-logoo">
                     <img src="{{ asset('user/img/logo1.jpg') }}" alt=""/>
                    </div>
                  </a>
                     <div class="main-menu">
                        <ul>
                           <li class="about-menu about_menu1">
                            <a href="{{ url('/') }}" class="mm-arr">
                              <i class="fa fa-home" aria-hidden="true"></i>
                            </a>
                          </li>

                           <li class="about-menu about_menu2">
                            <a href="{{ route('packages') }}" class="mm-arr">Holiday</a>
                          </li>

                           <li class="about-menu about_menu3">
                            <a href="#" style="">Hotels</a>
                          </li>

                           <li class="about-menu about_menu4">
                            <a href="#">Cabs</a>
                          </li>

                           <li class="about-menu about-menu2 about_menu5">
                            <a href="#">Flights</a>
                          </li>

                           <li class="about-menu about_menu6">
                            <a href="#hotel">B2B
                            </a>
                          </li>

                        @guest
                            <li class="about_menu7">
                            <a href="{{ route('login') }}">
                              <button class="button1">Login <i class='fa fa-sign-in'></i>
                              </button>
                            </a>
                          </li>

                           <li class="about_menu7">
                            <a href="{{ route('register') }}">
                              <button class="button1">Register <i class='fa fa-user-circle-o'></i>
                              </button></a>
                            </li>
                           <li class="about_menu7">
                            <a href="https://www.instamojo.com/@mytripmate">
                              <button class="button1">Pay Online <i class='fa fa-user-circle-o'></i>
                              </button></a>
                            </li>
                        @else
                           <li class="about_menu7">
                            <a href="{{ route('myaccount', ['user_id' => Auth::user()->id]) }}">
                              <button class="button1">My Account <i class='fa fa-user-circle-o'></i>
                              </button></a>
                            </li>
                        @endif
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--END HEADER SECTION-->
      @yield('content')
      <!--====== FOOTER - SECTION ==========-->
      <section>
        <div class="rows">
          <div class="footer">
            <div class="container">
              <div class="foot-sec2">
                <div class="row footerwidth">
                  <div class="col-sm-3 foot-img foot-com">
                    <img src="{{asset('user/img/logo1.jpg')}}" alt=""/>
                    <p># 63, 2nd floor, Kekuranagar, Ganeshguri, GS Road, Guwahati. Assam. 781006. India</p>
                    <!--======== Phone ===========-->
                    <div class="mail-link">
                      <a><i class="fa fa-phone"></i>&nbsp; 9435338100 | 9435338900 | 9864138100</a><br>
                      <a><i class="fa fa-phone"></i>&nbsp; 9954327693 | 9678245594 | 9678246700</a>
                    </div>
                    <!--======== Mail ===========-->
                    <div class="mail-link">
                      <a><i class="fa fa-envelope-o"></i>&nbsp; mail@mytripmate.co</a><br>
                      <a><i class="fa fa-envelope-o"></i>&nbsp; mail2mytripmate@gmail.com</a>
                    </div>
                  </div>
                  <div class="col-sm-5 foot-spec foot-com"> 
                    <!--====== SUB - SECTION 1 ==========-->                                                       
                    <div>
                      <h4>Navigation...</h4>
                      <ul class="two-columns">
                        <li>
                          <a href="#">Company</a>
                          <a class="dash"> | </a>
                          <a href="#">About Us</a>
                          <a class="dash"> | </a>
                          <a href="#">Career</a>
                          <a class="dash"> | </a>
                          <a href="#">Contact Us</a>
                          <a class="dash"> | </a>
                          <a href="#">Login</a>
                          <a class="dash"> | </a>
                          <a href="#">Register</a>
                        </li>
                      </ul>
                    </div>
                    <!--====== SUB - SECTION 2 ==========-->
                    <div>
                      <h4>Service Offered...</h4>
                      <ul class="two-columns">
                        <li>
                          <a href="#">Holiday Package</a> 
                          <a class="dash"> | </a>
                          <a href="#">Cabs Booking</a> 
                          <a class="dash"> | </a>
                          <a href="#">Hotel Booking</a>
                          <a class="dash"> | </a>
                          <a href="#">Flight Booking</a>
                        </li> 
                      </ul>
                    </div>
                    <!--====== SUB - SECTION 3 ==========-->
                    <div>
                      <h4>Conditions & Policies...</h4>
                      <ul class="two-columns">
                        <li>
                          <a href="#">T&C</a> 
                          <a class="dash"> | </a>
                          <a href="#">Cancellation Policies</a> 
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-sm-3 foot-spec foot-com" >
                    <h4>Keep In Touch</h4>
                    <div class="social-media">
                      <div class="facebook">
                          <div class="icon"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                      </div>
                      <div class="gmail">
                          <div class="icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                      </div>
                      <div class="whatsapp">
                          <div class="icon"><i class="fa fa-whatsapp" aria-hidden="true"></i></div>
                      </div>
                    </div> 
                    <div class="db-pay-card db-pay-card1">
                      <h4>We Accept</h4>
                      <div class="payment">
                      <img src="{{asset('user/images/card/visa.jpg')}}" alt=""/> 
                      <img src="{{asset('user/images/card/rupay.jpg')}}" alt=""/> 
                      <img src="{{asset('user/images/card/instamojo.jpg')}}" alt=""/> 
                      <img src="{{asset('user/images/card/mastercard.jpg')}}" alt=""/> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <!--====== FOOTER - COPYRIGHT ==========-->
    <section>
      <div class="rows copy">
        <div class="container">
          <p>Copyrights © 2019 MyTRIPMATE || All Rights Reserved || Developed By Webinfotech
          </p>
        </div>
      </div>
    </section>
    <section>
      <div class="icon-float">
        <ul>
          <li>
            <a href="#" class="fb1">
              <i class="fa fa-facebook" aria-hidden="true">
              </i>
            </a> 
          </li>
          <li>
            <a href="#" class="wa1">
              <i class="fa fa-whatsapp" aria-hidden="true">
              </i>
            </a> 
          </li>
          <li>
            <a href="#" class="sh1">
              <i class="fa fa-envelope-o" aria-hidden="true">
              </i>
            </a> 
          </li>
        </ul>
      </div>
    </section>
    <!--========= Scripts ===========-->
    <script src="{{ asset('user/js/jquery-latest.min.js') }}">
    </script>
    <script src="{{ asset('user/js/jquery-ui.js') }}">
    </script>
    <script src="{{ asset('user/js/bootstrap.js') }}">
    </script>
    <script src="{{ asset('user/js/wow.min.js') }}">
    </script>
    <script src="{{ asset('user/js/materialize.min.js') }}">
    </script>
    <script src="{{ asset('user/js/custom.js') }}">
    </script>
    
    </body>
  </html>
<script>
  var tables = $('.charge-table');
  $('input[name="group1"]').on('change', function() {
    tables.hide();
    $('#' + $(this).val()).show();
  }
                              );
</script>
<script>
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();
</script>
<script>
  $(document).ready(function() {
    $('.trigger').click(function() {
      $('.overlay').fadeIn(300);
    }
                       );
    $('.close').click(function() {
      $('.overlay').fadeOut(300);
    }
                     );
  }
                   );
</script>
<script type="text/javascript">
  var Tawk_API=Tawk_API|| {},
 Tawk_LoadStart=new Date();
 (function() {
  var s1=document.createElement("script"), s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/5c377faa361b3372892f7cc0/default';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin', '*');
  s0.parentNode.insertBefore(s1, s0);
 }
 
 )();
</script>
<script>
var slideIndex = 0;
showSlides();
function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1}
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 3000);
}
</script>
<script>
  $(document).ready(function() {
    $('#trigger1').click(function() {
      $('#overlay').fadeIn(300);
    }
                       );
    $('#close').click(function() {
      $('#overlay').fadeOut(300);
    }
                     );
  }
                   );
</script>

<script>
  $(document).ready(function() {
    $('#trigger2').click(function() {
      $('#overlay').fadeIn(300);
    }
                       );
    $('#close').click(function() {
      $('#overlay').fadeOut(300);
    }
                     );
  }
                   );
</script>
<script>
  $(document).ready(function() {
    $('#trigger3').click(function() {
      $('#overlay').fadeIn(300);
    }
                       );
    $('#close').click(function() {
      $('#overlay').fadeOut(300);
    }
                     );
  }
                   );
</script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#holidaylistdate').datepicker({
      uiLibrary: 'bootstrap'
    });
});
</script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#datepicker').datepicker({
      uiLibrary: 'bootstrap'
    });
});
</script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#datepicker1').datepicker({
      uiLibrary: 'bootstrap'
    });
});
</script>
<script type="text/javascript">
  $(function(){
    $('.increment').click(function() {
      var valueElement = $('#'+$(this).siblings('input').attr('id'));
      if($(this).hasClass('plus')) 
      {
        valueElement.val(Math.max(parseInt(valueElement.val()) + 1));
      }
      else if (valueElement.val() > 0) // Stops the value going into negatives
      {
        valueElement.val(Math.max(parseInt(valueElement.val()) - 1));
      }
      return false;
    }
                         );
  }
   );
</script>

 @yield('script')