@extends('layouts.app')

@section('content')
<div class="search-top">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="search-form">
          <center>
            <form method="POST" autocomplete="off" action="{{ route('package_search') }}">
                @csrf
            <div class="col-md-3">
                <!-- <div class="input-field">
                  <input type="text" id="holidaylistdate">
                  <label>Select date
                  </label>
                </div> -->
              </div>
              <div class="col-md-3">
                <!-- <div class="input-field">
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
        <h4>Travel Details
        </h4>
        <div class="db-2-main-com db-2-main-com-table">
          <table class="responsive-table">
            <tbody>
              <tr>
                <td>Package Name
                </td>
                <td>:
                </td>
                <td>{{ $pbbdetailsData[0]->packageTitle }}
                </td>
              </tr>
              <tr>
                <td>Duration
                </td>
                <td>:
                </td>
                <td>{{ $pbbdetailsData[0]->duration }}
                </td>
              </tr>
              <tr>
                <td>Price
                </td>
                <td>:
                </td>
                <td>
                  <i class="fa fa-rupee-sign">
                  </i> 
                  {{ $pbbdetailsData[0]->payableAmount }}
                </td>
              </tr>
              <tr>
                <td>Start Date
                </td>
                <td>:
                </td>
                <td>
                    @php
                        $dateEx     = explode('/', $pbbdetailsData[0]->startDate );
                        $start_date = $dateEx[2]."-".$dateEx[0]."-".$dateEx[1];
                    @endphp
                    {{ $start_date }}
                </td>
              </tr>
              <tr>
                <td>End Date
                </td>
                <td>:
                </td>
                <td>
                    @php
                        $date = strtotime("+".$pbbdetailsData[0]->totalDays." day", strtotime($start_date));
                        print date("Y-m-d", $date);
                    @endphp
                </td>
              </tr>
              <tr>
                <td>Total Members
                </td>
                <td>:
                </td>
                <td>{{ $pbbdetailsData[0]->totalPersons }}
                </td>
              </tr>
              <tr>
                <td>Places
                </td>
                <td>:
                </td>
                <td>{{ $pbbdetailsData[0]->location }}
                </td>
              </tr>
              <tr>
                <td>Payment Status
                </td>
                <td>:
                </td>
                <td>
                  <span class="db-not-done">
                    @if($pbbdetailsData[0]->paymentStatus == 1)
                        {{ "Paid" }}
                    @else
                        {{ "Pending" }}
                    @endif
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="db-mak-pay-bot">
            <a href="#" class="waves-effect waves-light btn-large">Make Paymeny Now
            </a> 
            <a href="#" class="waves-effect waves-light btn-large" style="background-color: red;">Cancellation Policy
            </a>
          </div>
        </div>
      </div>
    </div>
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