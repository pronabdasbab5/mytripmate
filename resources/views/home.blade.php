@extends('layouts.app')

@section('content')
<section>
  <div class="v2-hom-search">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="v2-ho-se-ri v2-ho-se-ri2">
            <h5>We Make Your Trip Special
            </h5>
            <h1>Tour Package booking now!
            </h1>
            <p>Experience the various exciting tour and travel packages and Make hotel reservations, find vacation packages, search cheap hotels and events
            </p>
            <div class="tourz-hom-ser v2-hom-ser">
              <ul>
                <li>
                  <a href="#" class="waves-effect waves-light btn-large tourz-pop-ser-btn">
                    <img src="{{ asset('user/images/icon/2.png')}}" alt=""> Tour
                  </a>
                </li>
                <li>
                  <a href="#" class="waves-effect waves-light btn-large tourz-pop-ser-btn">
                    <img src="{{ asset('user/images/icon/31.png')}}" alt=""> Flight
                  </a>
                </li>
                <li>
                  <a href="#" class="waves-effect waves-light btn-large tourz-pop-ser-btn">
                    <img src="{{ asset('user/images/icon/30.png')}}" alt=""> Car Rentals
                  </a>
                </li>
                <li>
                  <a href="#" class="waves-effect waves-light btn-large tourz-pop-ser-btn">
                    <img src="{{ asset('user/images/icon/1.png')}}" alt=""> Hotel
                  </a>
                </li>                               
              </ul>
            </div>
          </div>                        
        </div>  
        <div class="col-md-6">
          <div class="">
            <form class="v2-search-form" method="post" action="{{ route('send_email') }}" autocomplete="off">
                @csrf
              <div class="v2-ho-se-ri v2-ho-se-ri1">
                <h2>Let us Help For Your Trip
                </h2>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <input type="text" id="city" name="city" class="autocomplete validate no_border">
                  <label for="city">Where to go?
                  </label> 
                </div>
                <div class="col s6 input-field service_you_want">
                  
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <input type="text" id="name" name="name" class="autocomplete validate no_border" required>
                  <label for="name">Name
                  </label> 
                </div>
                <div class="input-field col s6">
                  <input type="text" id="email" name="email" class="autocomplete validate no_border">
                  <label for="email">Email id
                  </label> 
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <input type="text" id="mobile" name="mobile" class="autocomplete validate no_border" required>
                  <label for="mobile">Mobile number
                  </label> 
                </div>
                <div class="col s6 input-field no_of_adult">
                
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <input type="text" id="from" name="from" class="no_border">
                  <label for="from">Trip start date
                  </label>
                </div>
                <div class="input-field col s6">
                  <input type="text" id="to" name="to" class="no_border">
                  <label for="to">Trip end date
                  </label>
                </div>
              </div>                            
              <div class="row">
                <div class="input-field col s12">
                  <input type="text" id="queries" name="queries" class="autocomplete validate no_border">
                  <label for="queries">Messages
                  </label> 
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input type="submit" value="Submit" name="submit" class="waves-effect waves-light tourz-sear-btn v2-ser-btn">
                </div>
              </div>
            </form>
          </div>                        
        </div>              
      </div>
    </div>
  </div>
</section>
<section id="holiday">
  <div class="rows pad-bot-redu tb-space">
    <div class="container">
      <div class="spe-title">
        <h2>Domestic <span> Holidays
          </span>
        </h2>
      </div>
      <div>
        @foreach($domesticPackage as $key => $value)
            <div class="col-md-4 col-sm-6 col-xs-12 b_packages">
              {{-- <div class="band"> 
                <img src="{{ asset('user/images/band.png')}}" alt="" /> 
              </div> --}}
              <div class="v_place_img"> 
                <img src="{{ $value['url'] }}" alt="Tour Booking" title="Tour Booking" /> 
              </div>
              <div class="b_pack rows">
                <div class="col-md-8 col-sm-8">
                  <h4>
                    <a href="{{ route('package_details', ['packageId' => $value['packageId']]) }}">{{ $value['packageTitle'] }}
                      <span class="v_pl_name">{{ ($value['duration']) }}
                      </span>
                    </a>
                  </h4>
                  <p class="price"> <span>Starting from  </span>
                  ₹ {{ ($value['price']) }}/-
                  </p> 
                </div>
                <div class="col-md-4 col-sm-4 pack_icon">
                  <ul>
                    <li>
                      <a href="#">
                        <img src="{{ asset('user/images/clock.png')}}" alt="Date" title="Tour Timing" /> 
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="{{ asset('user/images/info.png')}}" alt="Details" title="View more details" /> 
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="{{ asset('user/images/price.png')}}" alt="Price" title="Price" /> 
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="{{ asset('user/images/map.png')}}" alt="Location" title="Location" /> 
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
<section id="holiday">
  <div class="rows pad-bot-redu tb-space">
    <div class="container">
      <div class="spe-title">
        <h2>International <span> Holidays
          </span>
        </h2>
      </div>
      <div>
        @foreach($internationalPackage as $key => $value)
            <div class="col-md-4 col-sm-6 col-xs-12 b_packages">
             {{--  <div class="band"> 
                <img src="{{ asset('user/images/band.png') }}" alt="" /> 
              </div> --}}
              <div class="v_place_img"> 
                <img src="{{ $value['url'] }}" alt="Tour Booking" title="Tour Booking" /> 
              </div>
              <div class="b_pack rows">
                <div class="col-md-8 col-sm-8">
                  <h4>
                    <a href="{{ route('package_details', ['packageId' => $value['packageId']]) }}">{{ $value['packageTitle'] }}
                      <span class="v_pl_name">{{ ($value['duration']) }}
                      </span>
                    </a>
                  </h4>
                  <p class="price"> <span>Starting from  </span>
                  ₹ {{ ($value['price']) }}/-
                  </p> 
                </div>
                <div class="col-md-4 col-sm-4 pack_icon">
                  <ul>
                    <li>
                      <a href="#">
                        <img src="{{ asset('user/images/clock.png') }}" alt="Date" title="Tour Timing" /> 
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="{{ asset('user/images/info.png') }}" alt="Details" title="View more details" /> 
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="{{ asset('user/images/price.png') }}" alt="Price" title="Price" /> 
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="{{ asset('user/images/map.png') }}" alt="Location" title="Location" /> 
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
<section id="car">
  <div class="container">
    <div class="spe-title" >
      <h2>Cabs- 
        <span>Car Rental
        </span>
      </h2>
    </div>
  </div>
  <div class="offer">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="offer-l"> 
            <span class="ol-1">
            </span> 
            <span class="ol-2">
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
            </span> 
            <span class="ol-4" style="color: #555"> Get Best Car fleet
            </span>                            
            <span class="ol-4" style="color: #555">
              <p>Get your driver by handpicked
              </p>
            </span>
          </div>
        </div>                    
        <div class="col-md-6">
          <div class="offer-r">
            <div class="or-2"> 
              <span class="or-21">MAKE
              </span> 
              <span class="or-22">YOUR DRIVE
              </span> 
              <span class="or-23">IN YOUR WAY 
              </span>
              <span class="or-21">TIME
              </span> 
            </div>
            <div class="or-1"> 
              <span class="or-11">BOOK
              </span> 
              <span class="or-12"> Now
              </span> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--<section class="hotelmargin">-->
<!--  <div class="container">-->
<!--    <div class="spe-title">-->
<!--      <h2>-->
<!--        <span>Hot Deal -->
<!--        </span>Of the Day-->
<!--      </h2>                -->
<!--      <div class="rows pad-bot-redu tb-space"> -->
<!--        <div class="col-md-4 col-sm-4">                     -->
<!--          <div class="v_place_img">-->
<!--            <img src="{{ asset('user/img/index/hot1.jpg') }}" alt="Tour Booking" title="Tour Booking" />-->
<!--          </div>                        -->
<!--        </div>-->
<!--        <div class="col-md-4 col-sm-4">                    -->
<!--          <div class="v_place_img">-->
<!--            <img src="{{ asset('user/img/index/hot2.jpg') }}" alt="Tour Booking" title="Tour Booking" />-->
<!--          </div>                        -->
<!--        </div>-->
<!--        <div class="col-md-4 col-sm-4">                    -->
<!--          <div class="v_place_img">-->
<!--            <img src="{{ asset('user/img/index/hot3.jpg') }}" alt="Tour Booking" title="Tour Booking" />-->
<!--          </div>                        -->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</section>-->
<section  class="hotelmargin">
    <div class="spe-title">
      <div class="container">
      <h2>Book 
        <span> HOTEL
        </span> Now!
      </h2>
    </div>
    </div>
    <div class="bookhotel bookhotelbg" style="background-image: url({{  asset('user/img/001.jpg') }});background-size: cover;width: 100%;">
      <div class="container">
        <h3 align="left"> <span class="ol-4"> Top Hotel 
            </span> 
        </h3>
        <h3 align="left"> <span class="ol-4" style="margin-left: 36px;"> and Resort</span> 
        </h3>
        <h3 class="spl-offer"><img src="{{ asset('user/img/Offers1.png') }}">
        </h3>
      </div>
    </div>
    <div class="bookhotelbook"> 
      <a href="#" id="3" ><img src="{{ asset('user/img/book.png') }}" style="width: 70%;">
      </a> 
  </div>
  <div class="search-top hidden-xs">
    <div class="container">
      <div class="row hotelsearch">
        <div class="col-md-12 hotel_serch">
          <div class="search-form">
            <form class="row">
              <div class="input-field col-md-3 hotelsearch1">
                <input type="text" id="select-search" class="hotelsearch2">
                <label for="select-search" class="search-hotel-type serch_location">Search Location
                </label>
              </div>
              <div class="input-field col-md-1 childrens1">
                <input type="text" id="from" name="from" >
                <label>Check In
                </label>
              </div>
              <div class="input-field col-md-1 childrens1">
                <input type="text" id="to" name="to" >
                <label>Check Out
                </label>
              </div>
              <div class="input-field col-md-1 childrens1 no_of_adult_hotel">
              </div>
              <div class="input-field col-md-1 childrens1 no_of_children">
              </div>
              <div class="input-field col-md-2 text-center childrens">
                <input type="submit" value="search" class="waves-effect waves-light tourz-sear-btn"> 
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="search-top hidden-lg mobile">
    <div class="container">
      <form class="row">
        <div class="input-field col-md-3 hotelsearch1">
          <input type="text" id="select-search" class="hotelsearch2">
          <label for="select-search" class="search-hotel-type serch_location">Search Location
          </label>
        </div>
        <div class="input-field col-md-1 childrens1">
          <input type="text" id="from" name="from" >
          <label>Check In
          </label>
        </div>
        <div class="input-field col-md-1 childrens1">
          <input type="text" id="to" name="to" >
          <label>Check Out
          </label>
        </div>
        <div class="input-field col-md-1 childrens1 no_of_adult_hotel">
        </div>
        <div class="input-field col-md-1 childrens1 no_of_children">
        </div>
        <div class="input-field col-md-2 text-center childrens">
          <input type="submit" value="search" class="waves-effect waves-light tourz-sear-btn"> 
        </div>
      </form>
    </div>
  </div>
</section>
<section style="background: #f1f1f1;">
  <div class="rows tips tips-home tb-space home_title" >
    <div class="col-12">
      <div class="col-md-12 Happy1">
        <div class="container tips_1"> 
          <div class="col-lg-5 col-md-12">
            <div class="spe-title flex-center">
              <h2>Happy
                <span> Moments
                </span>
              </h2>
            </div>
            <!-- Slider 1 -->
            <div class="slider new-slider" id="slider3">
                <div style="background-image:url('user/images/Happy Moments/1.jpg')">
                  <span>
                      <h5>Mr. Hemant Agarkar & family @ Living RootBridge Moulynong.Meghalaya</h5>
                  </span>
                </div>
                <div style="background-image:url('user/images/Happy Moments/2.jpg')">
                  <span>
                      <h5>Mr. & Mrs Atul Saini</h5>
                  </span>
                </div>
                <div style="background-image:url('user/images/Happy Moments/3.jpg')">
                  <span>
                      <h5>Mr. & Mrs Atul Saini</h5>
                  </span>
                </div>
                <div style="background-image:url('user/images/Happy Moments/4.jpg')">
                  <span>
                      <h5>Mr. Hemant Agarkar & family Boating @ Umngot River, Dawki.Meghalaya</h5>
                  </span>
                </div>
                <div style="background-image:url('user/images/Happy Moments/5.jpg')">
                  <span>
                      <h5>Mr. Hemant Agarkar & family enjoying @ Cherapunjee.Meghalaya</h5>
                  </span>
                </div>
                <!-- The Arrows -->
                <i class="left" class="arrows" style="z-index:2; position:absolute;"><svg viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z"></path></svg></i>
                <i class="right" class="arrows" style="z-index:2; position:absolute;">
                <svg viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" transform="translate(100, 100) rotate(180) "></path></svg></i>
            </div>
          </div>
          <div class="col-lg-7 col-md-12">
            <div class="spe-title flex-center">
              <h2>Review
                <span> & Rating
                </span>
              </h2>
            </div>
            <div class="rbd-core-ui">
              <div class="rbd-review-slider">
                <div class="rbd-review-container">
                  <div class="rbd-review review1.1 rbd-curr">
                    <div class="rbd-footing">
                      <p class="rbd-button rbd-small"> Ram Merani</p>
                    </div>
                    <h3 class="rbd-heading">Extremely Professional</h3><br>
                    <span class="tour_star">
                      <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                    </span>
                    <i class="renderSVG" data-icon="star" data-repeat="5"></i>
                    <div class="rbd-content">I traveled to Guwahati last month with my family. Mr Nilay from Mytripmate was very helpful and provided us with good services within our budget…</div>
                    <div class="rbd-review-meta">Written by Ram Merani on Feb. 18, 2018</div>
                  </div>
                  <div class="rbd-review review1.2 rbd-next">
                    <div class="rbd-footing">
                      <p class="rbd-button rbd-small"> Naresh Meel</p>
                    </div>
                    <h3 class="rbd-heading">Such Great Service!</h3><br>
                    <span class="tour_star">
                      <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </span>
                    <i class="renderSVG" data-icon="star" data-repeat="5"></i>
                    <div class="rbd-content">Excellent cab services provided by Mytripmate. Our company Piramal Foundation For Education Leadership using Mytripmate cab services from 2014 to continue. All Staff of Mytripmate is very supportive…</div>
                    <div class="rbd-review-meta">Written by Naresh Meel on Feb. 19, 2018</div>
                  </div>
                  <div class="rbd-review review1.3">
                    <div class="rbd-footing">
                      <p class="rbd-button rbd-small"> Debangshu sen</p>
                    </div>
                    <h3 class="rbd-heading">Love It...</h3><br>
                    <span class="tour_star">
                      <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </span>
                    <i class="renderSVG" data-icon="star" data-repeat="5"></i>
                    <div class="rbd-content">As per my recent experience last few months back at shillong, arunachal & guwahati towards family tour..I would say every body to contact this service provider cum tour co-ordinator " Mytrip Mate" if u have a plan to travel entire north-east…</div>
                    <div class="rbd-review-meta">Written by Debangshu sen on Feb. 18, 2018</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>   
  </div>
</section>
<!--====== APP - SECTION ==========-->
<section>
  <div class="foot-mob-sec tb-space">
    <div class="rows container">
      <!-- FAMILY IMAGE(YOU CAN USE ANY PNG IMAGE) -->
      <div class="col-md-6 col-sm-6 col-xs-12 family"> <img src="{{asset('user/images/mobile.png')}}" alt=""> </div>
      <!-- REQUEST A QUOTE -->
      <div class="col-md-6 col-sm-6 col-xs-12">
        <!-- THANK YOU MESSAGE -->
        <div class="foot-mob-app">
          <h2>Have you tried our mobile app?</h2>
          <p>World's leading tour and travels Booking website,Over 30,000 packages worldwide. Book travel packages and enjoy your holidays with distinctive experience</p>
          <ul>
            <li><i class="fa fa-check" aria-hidden="true"></i> Easy Hotel Booking</li>
            <li><i class="fa fa-check" aria-hidden="true"></i> Tour and Travel Packages</li>
            <li><i class="fa fa-check" aria-hidden="true"></i> Flight Booking & Cab Rental Services</li>
            <li><i class="fa fa-check" aria-hidden="true"></i> Manage your Bookings, Enquiry and Exciting Offers</li>
          </ul>
          <div class="play-store"><img src="{{asset('user/images/android.png')}}" alt="PLAY STORE"></div>
        </div>
      </div>
    </div>
  </div>        
</section>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function () {
    var html = '<select class="no_border " style="display: block;margin-top: 12px;">'+
                  '<option value="" disabled selected>No of adults</option>'+
                  '<option value="1">1</option>'+
                  '<option value="2">2</option>'+
                  '<option value="3">3</option>'+
                  '<option value="4">4</option>'+
                  '<option value="5">5</option>'+
                  '<option value="6+">6+</option>'+
                '</select>'
    $(".no_of_adult").html(html);
  })
</script>
<script type="text/javascript">
  $(document).ready(function () {
    var html = '<select class="no_border " style="display: block; margin-top: 12px;">'+
                  '<option value="" disabled selected>Service you want</option>'+
                  '<option value="Holiday Pakage">Holiday pakage</option>'+
                  '<option value="Cab service">Cab service</option>'+
                  '<option value="Flight">Flight</option>'+
                  '<option value="Hotel rooms">Hotel rooms</option>'+
                '</select>'
    $(".service_you_want").html(html);
  })
</script>
<script type="text/javascript">
  $(document).ready(function () {
    var html = '<select  style="display: block; height:42px;">'+
                  '<option value="" disabled selected>No of adults</option>'+
                  '<option value="1">1</option>'+
                  '<option value="2">2</option>'+
                  '<option value="3">3</option>'+
                  '<option value="4">4</option>'+
                  '<option value="5">5</option>'+
                  '<option value="6">6</option>'+
                  '<option value="7">7</option>'+
                  '<option value="8">8</option>'+
                  '<option value="9">9</option>'+
                '</select>'
    $(".no_of_adult_hotel").html(html);
  })
</script>
<script type="text/javascript">
  $(document).ready(function () {
    var html = '<select  style="display: block; height:42px;">'+
                  '<option value="" disabled selected>No of childrens</option>'+
                  '<option value="1">1</option>'+
                  '<option value="2">2</option>'+
                  '<option value="3">3</option>'+
                  '<option value="4">4</option>'+
                  '<option value="5">5</option>'+
                  '<option value="6">6</option>'+
                '</select>'
    $(".no_of_children").html(html);
  })
</script>
<script>
  /*Review Slider*/
  let options = {
  'speed': 3000,
  'pause': true,
}

window.addEventListener('DOMContentLoaded', function() {
  let slider = document.querySelector('.rbd-review-slider');
  let slides = slider.querySelectorAll('.rbd-review');
  let total  = slides.length;
  let pause  = false;
  
  function pauseSlide(){
    slider.onmouseleave = function(){ pause = false; };
    slider.onmouseenter = function(){ pause = true; };
    return pause;
  }
  
  function slide(){
    if( options.pause && pauseSlide() ) return;
    
    let activeSlide = document.querySelector('.rbd-review-slider .rbd-review.rbd-curr');
    let prev, curr, next, soon;   
    
    curr = activeSlide;
    prev = activeSlide.previousElementSibling;
    next = activeSlide.nextElementSibling;
    
    if( next != null ){
      soon = next.nextElementSibling == null ? slides[0] : next.nextElementSibling;
    } else {
      next = slides[0];
      soon = slides[1];
    }
    
    if( prev != null ) prev.classList.remove('rbd-prev', 'rbd-curr', 'rbd-next');
    if( curr != null ) curr.classList.remove('rbd-prev', 'rbd-curr', 'rbd-next'); curr.classList.add('rbd-prev');
    if( next != null ) next.classList.remove('rbd-prev', 'rbd-curr', 'rbd-next'); next.classList.add('rbd-curr');
    if( soon != null ) soon.classList.remove('rbd-prev', 'rbd-curr', 'rbd-next'); soon.classList.add('rbd-next');
  }
  
  let slideTimer = setInterval(function(){
    slide();
  }, options.speed);
}, true);
  /*Image Slider*/

(function($) {
  "use strict";
  $.fn.sliderResponsive = function(settings) {
    
    var set = $.extend( 
      {
        slidePause: 5000,
        fadeSpeed: 1200,
        autoPlay: "on",
        showArrows: "off", 
        hideDots: "off", 
        hoverZoom: "on",
        titleBarTop: "off"
      },
      settings
    ); 
    
    var $slider = $(this);
    var size = $slider.find("> div").length; //number of slides
    var position = 0; // current position of carousal
    var sliderIntervalID; // used to clear autoplay
      
    // Add a Dot for each slide
    $slider.append("<ul></ul>");
    $slider.find("> div").each(function(){
      $slider.find("> ul").append('<li></li>');
    });
      
    // Put .show on the first Slide
    $slider.find("div:first-of-type").addClass("show");
      
    // Put .showLi on the first dot
    $slider.find("li:first-of-type").addClass("showli")

     //fadeout all items except .show
    $slider.find("> div").not(".show").fadeOut();
    
    // If Autoplay is set to 'on' than start it
    if (set.autoPlay === "on") {
        startSlider(); 
    } 
    
    // If showarrows is set to 'on' then don't hide them
    if (set.showArrows === "on") {
        $slider.addClass('showArrows'); 
    }
    
    // If hideDots is set to 'on' then hide them
    if (set.hideDots === "on") {
        $slider.addClass('hideDots'); 
    }
    
    // If hoverZoom is set to 'off' then stop it
    if (set.hoverZoom === "on") {
        $slider.addClass('hoverZoomOff'); 
    }
    
    // If titleBarTop is set to 'on' then move it up
    if (set.titleBarTop === "on") {
        $slider.addClass('titleBarTop'); 
    }

    // function to start auto play
    function startSlider() {
      sliderIntervalID = setInterval(function() {
        nextSlide();
      }, set.slidePause);
    }
    
    // on mouseover stop the autoplay
    $slider.mouseover(function() {
      if (set.autoPlay === "on") {
        clearInterval(sliderIntervalID);
      }
    });
      
    // on mouseout starts the autoplay
    $slider.mouseout(function() {
      if (set.autoPlay === "on") {
        startSlider();
      }
    });

    //on right arrow click
    $slider.find("> .right").click(nextSlide)

    //on left arrow click
    $slider.find("> .left").click(prevSlide);
      
    // Go to next slide
    function nextSlide() {
      position = $slider.find(".show").index() + 1;
      if (position > size - 1) position = 0;
      changeCarousel(position);
    }
    
    // Go to previous slide
    function prevSlide() {
      position = $slider.find(".show").index() - 1;
      if (position < 0) position = size - 1;
      changeCarousel(position);
    }

    //when user clicks slider button
    $slider.find(" > ul > li").click(function() {
      position = $(this).index();
      changeCarousel($(this).index());
    });

    //this changes the image and button selection
    function changeCarousel() {
      $slider.find(".show").removeClass("show").fadeOut();
      $slider
        .find("> div")
        .eq(position)
        .fadeIn(set.fadeSpeed)
        .addClass("show");
      // The Dots
      $slider.find("> ul").find(".showli").removeClass("showli");
      $slider.find("> ul > li").eq(position).addClass("showli");
    }

    return $slider;
  };
})(jQuery);


 
//////////////////////////////////////////////
// Activate each slider - change options
//////////////////////////////////////////////
$(document).ready(function() {
  
  $("#slider1").sliderResponsive({
  // Using default everything
    // slidePause: 5000,
    // fadeSpeed: 800,
    // autoPlay: "on",
    // showArrows: "off", 
    // hideDots: "off", 
    // hoverZoom: "on", 
    // titleBarTop: "off"
  });
  
  $("#slider2").sliderResponsive({
    fadeSpeed: 300,
    autoPlay: "off",
    showArrows: "on",
    hideDots: "on"
  });
  
  $("#slider3").sliderResponsive({
    hoverZoom: "off",
    hideDots: "on"
  });
  
}); 
</script>
@endsection
