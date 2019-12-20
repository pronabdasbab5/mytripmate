@extends('layouts.app')

@section('content')
<div class="search-top">
  <div class="container searchbarlft">
    <div class="row">
      <div class="col-md-12">
        <div class="search-form">
          <center>
            <form>
              <div class="col-md-3">
                <div class="input-field">
                  <input type="text" id="select-search" class="hotelsearch2">
                <label for="select-search" class="search-hotel-type serch_location">Search Location
                </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="input-field">
                  <input type="text" id="holidaylistdate">
                  <label>Select date
                  </label>
                </div>
              </div>
              <div class="col-md-3" id="duration">
              </div>
              <div class="col-md-3">
                <div class="input-field text-center">
                  <a href="#">
                    <input type="submit" value="search" class="waves-effect waves-light tourz-sear-btn">
                  </a>
                </div>
              </div>
            </form>
            </div>
        </div>
      </div>
    </div>
  </div>

<center>
      <section class="flight_thanks_msg_bg">
        <div class="container">
          <div class="row">
            <div class="col-md-12 flight_thanks_msg">
              <h2> Thank You for Booking
              </h2>
              <br>
              <b>Your Booking ID is: {{ $txtNo }}</b>
            </div>
          </div>
        </div>
      </section>
    </center>
@endsection

@section('script')