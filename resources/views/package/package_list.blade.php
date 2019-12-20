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
              <div class="col-md-1"></div> 
              <div class="col-md-4">
                <!-- <div class="input-field">
                  <input type="text" id="select-search" name="location" class="hotelsearch2" required>
                <label for="select-search" class="search-hotel-type serch_location">Location
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
              <div class="col-md-1"></div>
            </div>
        </div>
      </div>
    </div>
  </div>
 
  <section class="hot-page2-alp hot-page2-pa-sp-top">
    <div class="container">
      <div class="row inner_banner inner_banner_3 bg-none">
        <div class="hot-page2-alp-tit picdown">
          <h1>Holiday Packages 
          </h1>
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
              <a href="#inner-page-title" class="bread-acti">Holiday
              </a> 
            </li>
          </ul>
        </div>
      </div>  
      <div class="row" >
        <div class="hot-page2-alp-con">
          <div class="col-md-3 hot-page2-alp-con-left">
            <div class="hot-page2-alp-con-left-1">
              <h3>Suggesting Packages
              </h3> 
            </div>
            <div class="hot-page2-hom-pre hot-page2-alp-left-ner-notb">
              <ul>
                @if(count($packageSuggessData) > 0)
                    @foreach($packageSuggessData as $key => $value)
                        <li>
                          <a href="#">
                            <div class="hot-page2-hom-pre-1 hot-page2-alp-cl-1-1"> 
                              <img src="{{ $value['url'] }}" alt=""> 
                            </div>
                            <div class="hot-page2-hom-pre-2 hot-page2-alp-cl-1-2">
                              <h5><a href="{{ route('package_details', ['packageId' => $value['packageSId']]) }}">{{ $value['location'] }}</a>
                              </h5> 
                              <span>{!! $value['desc'] !!} 
                              </span> 
                            </div>
                            <div class="hot-page2-hom-pre-3 hot-page2-alp-cl-1-3"> 
                              <span>{{ $value['rating'] }}
                              </span> 
                            </div>
                          </a>
                        </li>
                    @endforeach
                @endif
              </ul>
            </div>
            <div class="hot-page2-alp-l3 hot-page2-alp-l-com">
              <h4>
                <i class="fa fa-rupee" aria-hidden="true">
                </i>Select Price Range
              </h4>
              <div class="hot-page2-alp-l-com1 hot-page2-alp-p5">
                <form>
                  <ul>
                    <li>
                      <div class="checkbox checkbox-info checkbox-circle">
                        <input id="chp51" class="styled" type="checkbox" name="price[]" value="30000&1">
                        <label for="chp51"><i class="fa fa-rupee" aria-hidden="true"></i> 30000 - Above 
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="checkbox checkbox-info checkbox-circle">
                        <input id="chp52" class="styled" type="checkbox" name="price[]" value="30000&20000">
                        <label for="chp52"><i class="fa fa-rupee" aria-hidden="true"></i> 30000 - <i class="fa fa-rupee" aria-hidden="true"></i> 20000 
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="checkbox checkbox-info checkbox-circle">
                        <input id="chp53" class="styled" type="checkbox" name="price[]" value="20000&10000">
                        <label for="chp53"><i class="fa fa-rupee" aria-hidden="true"></i> 20000 - <i class="fa fa-rupee" aria-hidden="true"></i> 10000 
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="checkbox checkbox-info checkbox-circle">
                        <input id="chp54" class="styled" type="checkbox" name="price[]" value="10000&0">
                        <label for="chp54"><i class="fa fa-rupee" aria-hidden="true"></i> 10000 - Below 
                        </label>
                      </div>
                    </li>
                  </ul>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-9 hot-page2-alp-con-right">
            <div class="hot-page2-alp-con-right-1">
                <div class="spe-title holi-title">
                <h2>Recently Booked Holidays...
                </h2>
              </div>
              <div class="row">
                @if(!empty($packageData))
                    @foreach($packageData as $key => $value)
                        <div class="hot-page2-alp-r-list">
                          <div class="col-md-4 hot-page2-alp-r-list-re-sp">
                            <div class="hotel-list-score">{{ $value['rating'] }}
                              </div>
                               <div class="hot-page2-hli-1"> <img src="{{ $value['url'] }}" alt=""> </div>
                              
                          </div>
                          <div class="col-md-6">
                            <div class="trav-list-bod">
                              <a href="#">
                                <h3>{{ $value['packageTitle'] }}
                                </h3>
                              </a>
                              <p style="text-align: justify;">{!! $value['desc'] !!}.
                              </p>
                                <div class="trav-ami">
                                  <h4>Detail and Includes
                                  </h4>
                                  <ul>
                                    @foreach($value['pfrelation'] as $key_1 => $value_1)
                                        @if($value_1['packageFacilityId'] == 9)
                                            <li>
                                              <img src="{{ asset('user/images/icon/a15.png')}}" alt=""> 
                                              <span>Hotel
                                              </span>
                                            </li>
                                        @endif

                                        @if($value_1['packageFacilityId'] == 10)
                                            <li>
                                              <img src="{{ asset('user/images/icon/a16.png')}}" alt=""> 
                                              <span>Transfer
                                              </span>
                                            </li>
                                        @endif
                                    @endforeach
                                    <li>
                                      <img src="{{ asset('user/images/icon/a18.png')}}" alt=""> 
                                      <span>Duration {{ $value['duration'] }}
                                      </span>
                                    </li>
                                    <li>
                                      <img src="{{ asset('user/images/icon/a19.png')}}" alt=""> 
                                      <span>Location : {{ $value['location'] }}
                                      </span>
                                    </li>
                                  </ul>
                                </div>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="hot-page2-alp-ri-p3 tour-alp-ri-p3">
                              <div class="hot-page2-alp-r-hot-page-rat">{{ $value['offer'] }}%Off
                              </div> 
                              <span class="hot-list-p3-1">Prices Starting
                              </span> 
                              <span class="hot-list-p3-2">
                                <i class="fa fa-rupee">{{ $value['price'] }}
                                </i>
                              </span>

                              <span class="hot-list-p3-4">
                                <a href="{{ route('package_details', ['packageId' => $value['packageId']]) }}" class="hot-page2-alp-quot-btn">View Details
                                </a>
                              </span>
                            </div>
                          </div>
                          
                        </div>
                    @endforeach
                @else
                    <center><b>{{ "No Pacakge Available" }}</b></center>
                @endif
                {{-- <div class="hot-page2-alp-r-list">
                  <div class="col-md-4 hot-page2-alp-r-list-re-sp">
                      <div class="hotel-list-score">4.3
                      </div>
                      <div class="hot-page2-hli-1"> <img src="{{ asset('user/images/hotels/l4.jpg')}}" alt=""> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="trav-list-bod">
                      <a href="#">
                        <h3>Kaziranga
                        </h3>
                      </a>
                      <p>India may not be the most ancient city in the world, but is surely one of those that take their history quite seriously.
                      </p>
                      <div class="trav-ami">
                      <h4>Detail and Includes
                      </h4>
                      <ul>
                        <li>
                          <img src="{{ asset('user/images/icon/a15.png')}}" alt=""> 
                          <span>Hotel
                          </span>
                        </li>
                        <li>
                          <img src="{{ asset('user/images/icon/a16.png')}}" alt=""> 
                          <span>Transfer
                          </span>
                        </li>
                        <li>
                          <img src="{{ asset('user/images/icon/a18.png')}}" alt=""> 
                          <span>Duration 8N/9D
                          </span>
                        </li>
                        <li>
                          <img src="{{ asset('user/images/icon/a19.png')}}" alt=""> 
                          <span>Location : Rio,Brazil
                          </span>
                        </li>
                      </ul>
                    </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="hot-page2-alp-ri-p3 tour-alp-ri-p3">
                      <div class="hot-page2-alp-r-hot-page-rat">25%Off
                      </div> 
                      <span class="hot-list-p3-1">Prices Starting
                      </span> 
                      <span class="hot-list-p3-2">
                        <i class="fa fa-rupee">4020
                        </i>
                      </span>
                      <span class="hot-list-p3-4">
                        <a href="#" class="hot-page2-alp-quot-btn">View Details
                        </a>
                      </span> 
                    </div>
                  </div>
                </div>
                <div class="hot-page2-alp-r-list">
                  <div class="col-md-4 hot-page2-alp-r-list-re-sp">
                      <div class="hotel-list-score">4.0
                      </div>
                      <div class="hot-page2-hli-1"> <img src="{{ asset('user/images/hotels/l1.jpg')}}" alt=""> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="trav-list-bod">
                      <a href="#">
                        <h3>Majuli
                        </h3>
                      </a>
                      <p>Explore Dubai in all its glory with Yatra's 'Go Dubai.' From the air-conditioned interior of a 4X4, see the sands of the Arabian Desert.
                      </p>
                    <div class="trav-ami">
                      <h4>Detail and Includes
                      </h4>
                      <ul>
                        <li>
                          <img src="{{ asset('user/images/icon/a15.png')}}" alt=""> 
                          <span>Hotel
                          </span>
                        </li>
                        <li>
                          <img src="{{ asset('user/images/icon/a16.png')}}" alt=""> 
                          <span>Transfer
                          </span>
                        </li>
                        <li>
                          <img src="{{ asset('user/images/icon/a18.png')}}" alt=""> 
                          <span>Duration 8N/9D
                          </span>
                        </li>
                        <li>
                          <img src="{{ asset('user/images/icon/a19.png')}}" alt=""> 
                          <span>Location : Rio,Brazil
                          </span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  </div>
                  <div class="col-md-2">
                    <div class="hot-page2-alp-ri-p3 tour-alp-ri-p3">
                      <div class="hot-page2-alp-r-hot-page-rat">25%Off
                      </div> 
                      <span class="hot-list-p3-1">Prices Starting
                      </span> 
                      <span class="hot-list-p3-2">
                        <i class="fa fa-rupee">7020
                        </i>
                      </span>
                      <span class="hot-list-p3-4">
                        <a href="#" class="hot-page2-alp-quot-btn">View Details
                        </a>
                      </span> 
                    </div>
                  </div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('script')

<!-- <script type="text/javascript">
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
</script> -->

@endsection