@extends('layouts.app')

@section('content')
<div class="search-top">
  <div class="container searchbarlft">
    <div class="row">
      <div class="col-md-12">
        <div class="search-form">
          <center>
            <form method="POST" autocomplete="off" action="{{ route('package_search') }}">
                @csrf
            <div class="col-md-3">
              <!--   <div class="input-field">
                  <input type="text" id="holidaylistdate">
                  <label>Select date
                  </label>
                </div>  -->
              </div>
              <div class="col-md-3">
               <!--  <div class="input-field">
                  <input type="text" id="select-search" name="location" class="hotelsearch2" required>
                <label for="select-search" class="search-hotel-type serch_location">Search Location
                </label>
                </div> -->
              </div>
              <div class="col-md-3">
                <div class="input-field">
                  <select id="select-duration" name="location" required>
                    <option value="" disabled selected >Location
                    </option>
                    @if(count($packageLocationData) > 0)
                        @foreach($packageLocationData as $key => $value)
                            <option value="{{ $value->location }}">{{ $value->location }}</option>
                        @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="input-field text-center">
                  <a href="#">
                    <input type="submit" value="search" class="waves-effect waves-light tourz-sear-btn">
                  </a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<section>
  <div class="db">
    <!--LEFT SECTION-->
    <div class="db-l">
      <div class="db-l-2">
        <ul>
          <li>
            <a href="#">
              <img src="{{ asset('user/images/icon/dbl6.png') }}" alt="" /> My Profile
            </a>
          </li>
          <li>
            <a href="{{ route('travel_bookings', ['user_id' => Auth::user()->id]) }}">
              <img src="{{ asset('user/images/icon/dbl2.png') }}" alt="" /> Travel Bookings
            </a>
          </li>
          <li>
            <a href="#">
              <img src="{{ asset('user/images/icon/dbl3.png') }}" alt="" /> Hotel Bookings
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-cab" aria-hidden="true" style="font-size:20px; color: gray; width: 27px;"> 
              </i> Cab Bookings
            </a>
          </li>
          <li>
            <a href="{{ route('change_password', ['user_id' => Auth::user()->id ]) }}">
              <i class="fa fa-key" aria-hidden="true" style="font-size:20px; color: gray; width: 27px;"> 
              </i>  Change Password
            </a>
          </li>
          <li>
            <a onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
              <i class="fa fa-sign-out" style="font-size:20px; color: gray; width: 27px;">
              </i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!--CENTER SECTION-->
    <div class="db-2">
      <div class="db-2-com db-2-main">
        <h4>My Travel Booking List 
          <button style="margin-left: 30px;border-radius: 5px;">
            <a href="{{ route('travel_bookings', ['user_id' => Auth::user()->id]) }}" >Show More
            </a> 
          </button>
        </h4>
        <div class="db-2-main-com db-2-main-com-table">
          <table class="responsive-table">
            <thead>
              <tr >
                <th class="text-center">No
                </th>
                <th class="text-center">Package
                </th>
                <th class="text-center">Duration
                </th>
                <th class="text-center">Start Date
                </th>
                <th class="text-center">Price
                </th>
                <th class="text-center">Payment
                </th>
                <th class="text-center">More
                </th>
              </tr>
            </thead>
            <tbody>
                @if(!empty($pbbdetailsData))
              <tr >
                <td class="text-center">1
                </td>
                <td class="text-center">{{ $pbbdetailsData->packageTitle }}
                </td>
                <td class="text-center">{{ $pbbdetailsData->duration }}
                </td>
                <td class="text-center">{{ $pbbdetailsData->startDate }}
                </td>
                <td class="text-center">
                  <i class="fa fa-rupee-sign">
                  </i>
                  {{ $pbbdetailsData->payableAmount }}
                </td>
                <td class="text-center">
                  <span class="db-done">
                    @if($pbbdetailsData->paymentStatus == 1)
                        {{ "Paid" }}
                    @else
                        {{ "Pending" }}
                    @endif
                  </span>
                </td>
                <td class="text-center">
                  <a href="{{ route('travel_booking_details', ['user_id' => Auth::user()->id, 'booking_id' => $pbbdetailsData->id]) }}" class="db-done">view more details
                  </a>
                </td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    {{-- <div class="db-2" style="margin-top: 20px;">
      <div class="db-2-com db-2-main">
        <h4>My Hotel Booking List 
          <button style="margin-left: 30px;border-radius: 5px;">
            <a href="hotel_bookings_detail.php" >Show More
            </a> 
          </button>
        </h4>
        <div class="db-2-main-com db-2-main-com-table">
          <table class="responsive-table">
            <thead>
              <tr>
                <th class="text-center">No
                </th>
                <th >Package
                </th>
                <th class="text-center">Duration
                </th>
                <th class="text-center">Start Date
                </th>
                <th class="text-center">Price
                </th>
                <th class="text-center">Payment
                </th>
                <th class="text-center">More
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">1
                </td>
                <td class="text-center">Honeymoon Tailand
                </td>
                <td class="text-center">6days/5nights
                </td>
                <td class="text-center">12 Aug 2017
                </td>
                <td class="text-center">
                  <i class="fa fa-rupee-sign">
                  </i> 784
                </td>
                <td class="text-center">
                  <span class="db-done">Done
                  </span>
                </td>
                <td class="text-center">
                  <a href="hotel_bookings_more_details.php" class="db-done">view more details
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div> --}}
  </div>
</section>
@endsection

@section('script')

<script type="text/javascript">
    $(document).ready(function(){
        $('#select-search,#select-search-1,#select-search-2.autocomplete').autocomplete({
        data: {

            @php
            if (isset($packageLocationData) && count($packageLocationData) > 0) {
                foreach ($packageLocationData as $key => $value) {
                    print "'".$value->location."':'',";
                }
            }
            @endphp
        },
        onAutocomplete: function(val) {
            // Callback function when value is autcompleted.
        },
        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
    });
    })
</script>

@endsection