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
                    <input id="selection1" onclick="update_amount(1);" class="active" type="radio" name="group1" value="charge" checked="checked"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Budget
                  </div>
                  <div class="col-md-3">
                    <input id="selection2" onclick="update_amount(2);" type="radio" name="group1" value="charge1"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delux
                  </div>
                </div>
                @if(count($photelsBudgetData) > 0)
                    <table id="charge" class="charge-table tables-borders check">
                      <tr>
                        <td width="50%" class="tables-pads" >{!! $photelsBudgetData[0]->hotelAddress !!}
                        </td>
                        <td width="25%" class="tables-pads">Hotel Pages
                        </td>
                        <td class="tables-pads">{{ $photelsBudgetData[0]->rating }}  
                          <span class="fa fa-star">
                          </span>
                        </td>
                        <td class="tables-pads">
                          <div class="star-center">
                            <span class="pull-right">
                                @for($i = 0; $i < 5; $i++)
                                    @if($i < $photelsBudgetData[0]->rating)
                                        <span class="fa fa-star asap-star-check"></span>
                                    @else
                                        <span class="fa fa-star"></span>
                                    @endif
                                @endfor
                            </span>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <input type="hidden" id="hotel_id1" value="{{ $photelsBudgetData[0]->id }}">
                @endif
                @if(count($photelsDeluxData) > 0)
                  <table id="charge1" class="charge-table tables-borders" style="display:none;">
                    <tr>
                      <td class="tables-pads" >{!! $photelsDeluxData[0]->hotelAddress !!}
                      </td>
                      <td class="tables-pads">Hotel Pages
                      </td>
                      <td class="tables-pads">{{ $photelsDeluxData[0]->rating }}  
                        <span class="fa fa-star">
                        </span>
                      </td>
                      <td class="tables-pads">
                        <div class="star-center">
                          <span class="pull-right">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < $photelsDeluxData[0]->rating)
                                    <span class="fa fa-star asap-star-check"></span>
                                @else
                                    <span class="fa fa-star"></span>
                                @endif
                            @endfor
                        </div>
                      </td>
                    </tr>
                  </table>
                  <input type="hidden" id="hotel_id2" value="{{ $photelsDeluxData[0]->id }}">
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
            <span class="n-td-1 rupee" ><i class="fa fa-rupee"></i><font id="actual_price">{{ ($package_price + $photelsBudgetData[0]->price) }}</font>
            </span>
          </span><br><i class="fa fa-rupee rupee1" id="selling_price">
            @if(!empty($packageData[0]->offer))
                @php
                    $discount      = ($package_price * $packageData[0]->offer) / 100;
                    $selling_price = ($package_price - $discount);

                    $selling_price = $selling_price + $photelsBudgetData[0]->price;
                @endphp
                {{ $selling_price }}
            @else
                {{ ($package_price + $photelsBudgetData[0]->price) }}
            @endif
          </i>
        </h4> 
        <form action="{{ route('package_booking_form') }}" method="GET" autocomplete="off">
            @csrf
            <input type="hidden" name="package_id" value="{{ $packageData[0]->id }}" required>
            <input type="hidden" name="hotel_id" id="hotel_id_form" value="{{ $photelsBudgetData[0]->id }}" required>
            <a><button type="submit">Book Now</button></a> 
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

function update_amount (id) {
    
    var hotel_id = $('#hotel_id'+id).val();

    $('#actual_price').text("Calculating....");
    $('#selling_price').text("Calculating....");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });

    $.ajax({
        url: "{{ url('package_price_change') }}",
        type: "POST",
        data: {
            'packageId': {{ $packageData[0]->id }},
            'hotelId'  :  hotel_id 
        },
        success:function (response) {

            var res = response.split(",");
            $('#actual_price').text(res[0]);
            $('#selling_price').text(res[1]);
            $('#hotel_id_form').val(hotel_id);
        }
    });
}
</script>
@endsection