@extends('layouts.app')

@section('content')
<section>
    <div class="rows inner_banner inner_banner_4">
      <div class="container">
        <h2>
          <span>{{ $packageData[0]->location }} -
          </span> {{ $packageData[0]->packageType }}
        </h2>
        <ul>
          <li>
            <a href="{{ url('/') }}">Home
            </a>
          </li>
          <li>
            <i class="fa fa-angle-right" aria-hidden="true">
            </i> 
          </li>
          <li>
            <a href="#inner-page-title" class="bread-acti">{{ $packageData[0]->location }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!--====== TOUR DETAILS - BOOKING ==========-->
  <section>
    <div class="rows banner_book" id="inner-page-title">
      <div class="container">
        <div class="banner_book_1">
          <ul>
            <li class="dl1">Location : {{ $packageData[0]->location }}
            </li>
            <li class="dl2">Package ID : {{ $packageData[0]->packageId }}
            </li>
            <li class="dl3">Duration : {{ $packageData[0]->duration }}
            </li>
           </ul>
        </div>
      </div>
    </div>
  </section>
  <!--====== TOUR DETAILS ==========-->
  <section>
    <div class="rows inn-page-bg com-colo">
      <div class="container inn-page-con-bg tb-space">
        <div class="col-md-9">
          <!--====== TOUR TITLE ==========-->
          <div class="tour_head">
            <h2>The Best of {{ $packageData[0]->location }}
              <span class="tour_star">
                @for($i = 0; $i < 5; $i++)
                    @if($i < $packageData[0]->rating)
                        <i class="fa fa-star" aria-hidden="true"></i>
                    @else
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    @endif
                @endfor
              </span>
              <span class="tour_rat">{{ $packageData[0]->rating }}
              </span>
            </h2> 
          </div>

          <br>
          <div class="col-md-12 holiday_pack_date" style="margin-bottom: 10px;">
            <div class="col-md-2">
                Trip Duration 
            </div>
            
            <div class="col-md-2 holiday_pack_date1 ">
              <input id="datepicker" value="" placeholder="Start Date" required style="margin-top: 8px;height: 25px;">
            </div>
            <div class="col-md-3">
               -  <input id="end_date" value="" placeholder="End Date" required style="width: 90%;margin-top: -4px;border: none;">
            </div>
            <div class="col-md-2">
                  {{-- {{ $packageData['totalDays'] }}D / {{ $packageData['totalNights'] }}N --}}
            </div>
            <div class="col-md-3">
               (Child upto 5 Yrs Free)
            </div>
          </div>
         
          <div class="row">
                <div class="col-md-3 col-sm-3" style="margin-top: 5px; padding-left:8px">
                    Number of Persons : 
                </div>
                <div class="col-md-2 col-sm-2">
                    <select name="total_persons_list" id="total_persons_list" required>
                        @if(count($total_persons_list) > 0)
                            @foreach($total_persons_list as $key => $value)
                              @if ($value->totalPersons == $min_person )
                                <option value="{{ $value->totalPersons }}" selected>{{ $value->totalPersons }}</option>
                              @else
                                <option value="{{ $value->totalPersons }}">{{ $value->totalPersons }}</option>
                              @endif
                            @endforeach
                        @endif
                    </select>
                </div>
          </div>
          <!--====== TOUR DESCRIPTION ==========-->
          <div class="tour_head1">
            <h3>Description
            </h3>
            <p>{!! $packageData[0]->packageDesc !!}
            </p>
          </div>
          <!--====== ABOUT THE TOUR ==========-->
          <div class="tour_head1">
            <h3>About The Tour
            </h3>
            <div class="hot-page2-alp-r-list">
              <div class="col-md-12">
                <p class="asap-filter">{{ $packageData[0]->location }}
                </p>
                <p class="asap-filter">Hotel Included
                </p>
                <div class="col-md-12 tables-bgs">
                  <div class="col-md-3 text-left">
                    <input id="selection1" onclick="update_hotel_type(1);" class="active" type="radio" name="group1" value="charge" checked="checked"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Budget
                  </div>
                  <div class="col-md-3">
                    <input id="selection2" onclick="update_hotel_type(2);" type="radio" name="group1" value="charge1"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delux
                  </div>
                </div>
                @if(!empty($photelsBudgetData))
                    <table id="charge" class="charge-table tables-borders check">
                        @foreach($photelsBudgetData as $key => $item)
                      <tr>
                        <td width="50%" class="tables-pads" >{!! $item->hotelAddress !!}
                        </td>
                        <td width="25%" class="tables-pads">Hotel Pages
                        </td>
                        <td class="tables-pads">{{ $item->rating }}  
                          <span class="fa fa-star">
                          </span>
                        </td>
                        <td class="tables-pads">
                          <div class="star-center">
                            <span class="pull-right">
                                @for($i = 0; $i < 5; $i++)
                                    @if($i < $item->rating)
                                        <span class="fa fa-star asap-star-check"></span>
                                    @else
                                        <span class="fa fa-star"></span>
                                    @endif
                                @endfor
                            </span>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </table>
                @endif
                @if(!empty($photelsDeluxData))
                  <table id="charge1" class="charge-table tables-borders" style="display:none;">
                    @foreach($photelsDeluxData as $key => $item)
                    <tr>
                      <td class="tables-pads" >{!! $item->hotelAddress !!}
                      </td>
                      <td class="tables-pads">Hotel Pages
                      </td>
                      <td class="tables-pads">{{ $item->rating }}  
                        <span class="fa fa-star">
                        </span>
                      </td>
                      <td class="tables-pads">
                        <div class="star-center">
                          <span class="pull-right">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < $item->rating)
                                    <span class="fa fa-star asap-star-check"></span>
                                @else
                                    <span class="fa fa-star"></span>
                                @endif
                            @endfor
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </table>
                @endif
              <p class="asap-filter">Also Included
              </p>
              <button type="button" class="btn btn-default activity-btns">
                <i class="fa fa-check" aria-hidden="true">
                </i> Activity
              </button>
              <button type="button" class="btn btn-default activity-btns">
                <i class="fa fa-check" aria-hidden="true">
                </i> Transfer
              </button>
            </div>
            <div class="trav-ami">
              <h4>
                <b>Itinery 
                </b>
              </h4>
            </div>
            <div class="tab">
              <button class="tablinks" onclick="openCity(event, 'delhi')" id="defaultOpen">Detailed Day Wise
              </button>
              <button class="tablinks" onclick="openCity(event, 'London')" >Include
              </button>
              <button class="tablinks" onclick="openCity(event, 'Paris')">Exclude
              </button>
              <button class="tablinks" onclick="openCity(event, 'Tokyo')">Terms & Condition
              </button>
            </div>
            <div id="delhi" class="tabcontent">
              <br>
              <p>
              <div class="tour_head1 l-info-pack-days days">
                <ul>
                    @if(count($itenaryData) > 0)
                        @foreach($itenaryData as $key => $value)
                            <li class="l-info-pack-plac"> 
                                <i class="fa fa-clock-o" aria-hidden="true">
                                </i>
                                <h4>
                                  <span>{{ $value['day'] }}
                                  </span>{{ $value['title'] }}
                                </h4>
                                <div class="col-md-9">
                                  <p>{!! $value['desc'] !!}
                                  </p>
                                </div>
                                <div class="col-md-3 hot-page2-alp-r-list-re-sp">
                                  <div class="hotel-list-score">{{ $value['rating'] }}
                                  </div>
                                  <p class="trigger1">
                                    <i class="fa fa-search trigger" class=""> 
                                    </i>
                                    <img src="{{ $value['url'] }}" alt="">
                                  </p>
                                  <div class="overlay">
                                    <div id="popup">
                                      <div class="close">x
                                      </div>
                                      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                          <div class="item active">
                                            <img src="{{ $value['url'] }}" alt="First slide">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
              </div>
              </p>
          </div>
          <div id="London" class="tabcontent">
            <br>
            <p>
                {!! $packageData[0]->includeFacility !!}
            </p>
          </div>
          <div id="Paris" class="tabcontent">
            <br>
            <p>{!! $packageData[0]->excludeFacility !!}
            </p> 
          </div>
          <div id="Tokyo" class="tabcontent">
            <br>
            <p>{!! $packageData[0]->termCondition !!}
            </p>
          </div>
        </div>
      </div>
      <!--====== ROOMS: HOTEL BOOKING ==========-->
      <div class="tour_head1 hotel-book-room">
        <h3>Photo Gallery
        </h3>
        <div id="myCarousel1" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <!-- Wrapper for slides -->
          <div class="carousel-inner carousel-inner1" role="listbox">
            @if(count($sliderData) > 0)
                @php
                    $i = 0;
                @endphp
                @foreach($sliderData as $key => $value)
                    @if($i == 0)
                        <div class="item active"> 
                          <img src="{{ $value['url'] }}" alt="Chania" width="460" height="345"> 
                        </div>
                    @else
                        <div class="item"> 
                          <img src="{{ $value['url'] }}" alt="Chania" width="460" height="345"> 
                        </div>
                    @endif
                    @php
                        $i++;
                    @endphp
                @endforeach
            @endif
          </div>
          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev"> 
            <span>
              <i class="fa fa-angle-left hotel-gal-arr" aria-hidden="true">
              </i>
            </span> 
          </a>
          <a class="right carousel-control" href="#myCarousel1" role="button" data-slide="next"> 
            <span>
              <i class="fa fa-angle-right hotel-gal-arr hotel-gal-arr1" aria-hidden="true">
              </i>
            </span> 
          </a>
        </div>
      </div>
      <!--====== TOUR LOCATION ==========-->
      <div class="tour_head1 tout-map map-container">
        <h3>Location
        </h3>
        <iframe src="https://maps.google.com/maps?q={{ $packageData[0]->longitude }},{{ $packageData[0]->latitude }}&hl=en&z=14&amp;output=embed" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
    </div>
    <div class="col-md-3 tour_r">
      <!--====== SPECIAL OFFERS ==========-->
      
      <div class="tour_right tour_offer">
        <h3>Price</h3>
        <h4>
          <span class="n-td">
            <span class="n-td-1 rupee" ><i class="fa fa-rupee"></i><font id="actual_price">{{ ($package_price) }}</font>
            </span>
          </span><br><i class="fa fa-rupee rupee1" id="selling_price">
            @if(!empty($packageData[0]->offer))
                @php
                    $discount      = ($package_price * $packageData[0]->offer) / 100;
                    $selling_price = ($package_price - $discount);

                    $selling_price = $selling_price;
                @endphp
                {{ $selling_price }}
            @else
                {{ ($package_price) }}
            @endif
          </i>
        </h4> 
        <center>(Per Pex.)</center>
        <form action="{{ route('package_booking_form') }}" method="GET" autocomplete="off">
            @csrf
            <input type="hidden" name="package_id" value="{{ $packageData[0]->id }}" required>
            <input type="hidden" name="hotel_type" id="hotel_type" value="1" required>
            <input type="hidden" name="total_persons_list" id="total_person" value="{{ $min_person }}" required>
            <input type="hidden" name="start_date_text" id="start_date_text" required>
            <input type="hidden" name="end_date_text" id="end_date_text" required>
            <a><button type="submit" id="submit">Book Now</button></a> 
        </form>
      </div>
      <!--====== TRIP INFORMATION ==========-->
      <div class="tour_right tour_incl tour-ri-com">
        <h3>Trip Information
        </h3>
        <ul>
          <li>Location : {{ $packageData[0]->location }}
          </li>
          {{-- <li>Arrival Date: Nov 12, 2017
          </li>
          <li>Departure Date: Nov 21, 2017
          </li> --}}
          <li>Free Sightseeing & Hotel
          </li>
        </ul>
      </div>
      <!--====== PACKAGE SHARE ==========-->
      <div class="tour_right head_right tour_social tour-ri-com">
        <h3>Share This Package
        </h3>
        <ul>
          <li>
            <a href="#">
              <i class="fa fa-facebook" aria-hidden="true">
              </i>
            </a> 
          </li>
          <!-- <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a> </li> -->
          <!-- <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>-->
          <li>
            <a href="#">
              <i class="fa fa-linkedin" aria-hidden="true">
              </i>
            </a> 
          </li> 
          <li>
            <a href="#">
              <i class="fa fa-whatsapp" aria-hidden="true">
              </i>
            </a> 
          </li>
        </ul>
      </div>
      <!--====== HELP PACKAGE ==========-->
      <div class="tour_right head_right tour_help tour-ri-com">
        <h3>Help & Support
        </h3>
        <div class="tour_help_1">
          <h4 class="tour_help_1_call">Call Us Now
          </h4>
          <h4>
            <i class="fa fa-phone" aria-hidden="true">
            </i>  +91 94353-38100 
          </h4> 
        </div>
      </div>
      <!--====== PUPULAR TOUR PACKAGES ==========-->
      <div class="tour_right tour_rela tour-ri-com">
        <h3>Popular Packages
        </h3>
            @if(count($popularPackageData) > 0)
                @foreach($popularPackageData as $key => $value)
                    <div class="tour_rela_1"> 
                      <img src="{{ $value['url'] }}" alt="Package Banner" style="width: 225px; height: 115px; border-radius: 5px" />
                      <h4>{{ $value['location'] }} {{ $value['duration'] }}
                      </h4>
                      <p>{!! $value['packageDesc'] !!}
                      </p> 
                      <a href="{{ route('package_details', ['packageId' => $value['id']]) }}" class="link-btn">View this Package
                      </a> 
                    </div>
                @endforeach
            @endif
      </div>
    </div>
    </div>
</div>
</section>
@endsection

@section('script')
<script type="text/javascript">
function update_hotel_type (type) {
    
    $('#hotel_type').val(type);
}

$(document).ready(function() {

    $("#submit").click(function(){
      if($("#datepicker").val() == "") {
          alert('Please ! Select Start Date');
          return false;
      }
  });

  var total_days = {{ $packageData[0]->totalDays }};

  $("#datepicker").on("change",function(){
    var selected = $(this).val();
    var date_object = new Date();
    var strDate = (date_object.getMonth()+1) + "/" + date_object.getDate() + "/" + date_object.getFullYear(); 

    var selected_date = selected.split('/');
    var new_selected_date = new Date(selected_date[0],selected_date[1],selected_date[2]);

    var today_date = strDate.split('/');
    var new_today_date= new Date(today_date[0],today_date[1],today_date[2]);
    
    if(new_selected_date < new_today_date){
      $("#datepicker").val('');
      alert("Please ! Select right date");
    } else {
      var result = new Date(selected);
      result.setDate(result.getDate() + total_days);
      let date = JSON.stringify(result)
      date = date.slice(1,11);
      var res = date.split("-");
      $("#end_date").val(res[2]+"/"+res[1]+"/"+res[0]);
      $("#start_date").val(selected);
     $("#end_date_text").val(res[2]+"/"+res[1]+"/"+res[0]);
      $("#start_date_text").val(selected);
    }
  });

  $('#total_persons_list').change(function(){

    $('#total_person').val($('#total_persons_list').val());
  });
});
</script>
@endsection