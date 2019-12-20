@extends('layouts.app')

@section('content')
<div class="search-top">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="search-form">
          <form class="tourz-search-form">
            <h2 class="whitetxt">Review Package
            </h2>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!--====== TOUR DETAILS ==========-->
<section>
  <div class="rows inn-page-bg com-colo">
    <div class="container inn-page-con-bg tb-space">
      <div class="col-md-8">
        <div>
          <h3>{{ $packageData['location'] }} - Value Added
          </h3>
          <!-- <h5>Water Fall . 1N Thekkady . 1N Allepey
          </h5> -->
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
                  {{ $packageData['totalDays'] }}D / {{ $packageData['totalNights'] }}N
            </div>
            <div class="col-md-3">
               (Child upto 5 Yrs Free)
            </div>
          </div>
         
          <div class="row">
            <form method="GET" autocomplete="off" action="{{ route('package_booking_form') }}">
              @csrf
              <input type="hidden" name="package_id" value="{{ $packageData['packageId'] }}">
              <input type="hidden" name="hotel_id" value="{{ $photelsData['hotelId'] }}">
                <div class="col-md-3 col-sm-3" style="margin-top: 5px; padding-left:8px">
                    Number of Persons : 
                </div>
                <div class="col-md-2 col-sm-2">
                    {{ $packageData['adults'] }}
                </div>
                <div class="col-md-2 col-sm-2">
                    <select name="total_persons_list" id="total_persons_list" required>
                        @if(count($total_persons_list) > 0)
                            @foreach($total_persons_list as $key => $value)
                              @if ($value->totalPersons == $packageData['adults'])
                                <option value="{{ $value->totalPersons }}" selected>{{ $value->totalPersons }}</option>
                              @else
                                <option value="{{ $value->totalPersons }}">{{ $value->totalPersons }}</option>
                              @endif
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-2 col-sm-2">
                   <button type="submit" name="submit" class="btn btn-success">Submit</button>
                </div>
                <div class="col-md-2 col-sm-2">
                    <a href="{{ route('packages') }}" class="btn btn-primary">Modify Trip</a>
                 </div>
            </form>
          </div>
          
          <h5 class="holiday_inclusions">Inclusions:
            <a href="#"> Hotels
            </a>   /  
            <a href="#">Transfers
            </a>  /  
            <a href="#">Activities
            </a>
          </h5>
          <br>
        </div>
        <div>
          <h4>Traveller Information
          </h4>
          <div>
              <form method="POST" action="{{ route('package_booking') }}" autocomplete="off">
                  @csrf
              <input type="hidden" name="start_date" id="start_date" required>
              <input type="hidden" name="total_persons" value="{{ $packageData['adults'] }}">
            <input type="hidden" name="packageId" value="{{ $packageData['packageId'] }}">
            <input type="hidden" name="hotelId" value="{{ $photelsData['hotelId'] }}">
              <div id="dynamic_field">
               @for($i = 0; $i < $packageData['adults']; $i++)
                    @if($i == 0)
                    <h4 class="sizetxt">{{ $i + 1 }} Traveller
                    </h4>
                    <div class="col-md-6 form-group">
                      <!--<label>-->
                      <!--  <h5 class="travellerclr">Name-->
                      <!--  </h5>-->
                      <!--</label>-->
                      <input type="text" class="form-control" name="t_name[]" placeholder="Name" required autocomplete="off">
                    </div>
                    <div class="col-md-6 form-group">
                      <!--<label>-->
                      <!--  <h5 class="travellerclr">Contact Number-->
                      <!--  </h5>-->
                      <!--</label>-->
                      <input type="number" min="0" name="t_con_no[]" class="form-control" placeholder="Contact Number" required>
                    </div>
                    <div class="col-md-4 form-group" >
                      <!--<label>-->
                      <!--  <h5 class="travellerclr">Email-->
                      <!--  </h5>-->
                      <!--</label>-->
                      <input type="email" class="form-control" name="t_email[]" placeholder="Email" required>
                    </div>
                    <div class="col-md-4 form-group" >
                      <!--<label>-->
                      <!--  <h5 class="travellerclr">Age-->
                      <!--  </h5>-->
                      <!--</label>-->
                      <input type="number" min="0" class="form-control" name="t_age[]" placeholder="Age" required>
                    </div>
                    <div class="col-md-4 form-group">
                      <!--<label>-->
                      <!--  <h5 class="travellerclr">Gender-->
                      <!--  </h5>-->
                      <!--</label> -->
                      <select name="gender[]"  required style="border: 1px solid #ddd">
                          <option selected>Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                         </select>
                    </div>
                    @else
                    <h4 class="sizetxt">{{ $i + 1 }} Traveller
                    </h4>
                    <div class="col-md-4 form-group">
                      <!--<label>-->
                      <!--  <h5 class="travellerclr">Name-->
                      <!--  </h5>-->
                      <!--</label>-->
                      <input type="text" class="form-control" name="t_name[]" placeholder="Name" required autocomplete="off">
                    </div>
                    <div class="col-md-4 form-group" >
                      <!--<label>-->
                      <!--  <h5 class="travellerclr">Age-->
                      <!--  </h5>-->
                      <!--</label>-->
                      <input type="number" min="0" class="form-control" name="t_age[]" placeholder="Age" required>
                    </div>
                    <div class="col-md-4 form-group">
                      <!--<label>-->
                      <!--  <h5 class="travellerclr">Gender-->
                      <!--  </h5>-->
                      <!--</label> -->
                      <select name="gender[]"  required style="border: 1px solid #ddd" required>
                          <option selected>Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                         </select>
                    </div>
                    @endif
                <style>.select-wrapper{border: 1px solid #ddd}.select-wrapper input[type=text]{width: 99%}</style>
               @endfor
                <br>
              </div>
            {{-- <div>
              <button type="button" name="add" id="add" class="btn btn-success">Add More
              </button>
            </div> --}}
          </div>
        </div>
      </div>
      <div class="col-md-4 tour_r">
        <div class="total_basic_cost">
          <div class="total_basic_cost1">
            <span class="total_basic_cost2">
              <b>Total Basic Cost
              </b>
            </span>
            <span class="total_basic_cost3">
              <i class="fa fa-rupee">
              </i> 
              <b>{{ ($packageData['packagePrice'] * $packageData['adults']) }}
              </b>
            </span>
          </div>
          <div class="price_after_discount">
            <span class="price_after_discount1">
              <b>Price after Discount
              </b>
            </span>
            <span class="price_after_discount2">
              <b>
                <i class="fa fa-rupee">
                </i> 
                @php
                     $totalDiscount = (($packageData['packagePrice'] * $packageData['adults']) * $packageData['offer']) / 100;

                     $sellingAmount = ($packageData['packagePrice'] * $packageData['adults']) - $totalDiscount;
                @endphp
                {{ $sellingAmount }}
              </b>
            </span>
          </div>
          <div class="price_after_discount">
            <span class="price_after_discount1">
              <b>Hotel Price
              </b>
            </span>
            <span class="price_after_discount2">
              <b>
                <i class="fa fa-rupee">
                </i> 
                {{ $photelsData['hotelPrice'] }}
              </b>
            </span>
          </div>
           <div class="total_payable1">
              <span class="total_payable2">
                <b>TOTAL AMOUNT
                </b>
              </span>
              <span class="total_payable3">
                <b>
                  <i class="fa fa-rupee">
                  </i> <font id="total_amount">{{ ($sellingAmount + $photelsData['hotelPrice']) }}</font>
                  <font id="old_total_amount" style="display: none;">{{ ($sellingAmount + $photelsData['hotelPrice']) }}</font>
                </b>
              </span>
            </div>
          <div class="GST">
            <span class="GST1">
              <b>GST
              </b>
            </span>
            <span class="GST2">
              <i class="fa fa-rupee">
              </i> 
              @php
              $gstAmount = (($sellingAmount + $photelsData['hotelPrice']) * 5) / 100;
              @endphp
              <font id="gst_amount">{{ $gstAmount }}</font>
              <font id="old_gst_amount" style="display: none;">{{ $gstAmount }}</font>
            </span>
          </div>
          <div class="total_payable">
            <div class="total_payable1">
              <span class="total_payable2">
                <b>TOTAL PAYBLE
                </b>
              </span>
              <span class="total_payable3">
                <b>
                  <i class="fa fa-rupee">
                  </i> <font id="total_payable_amount">{{ ($sellingAmount + $photelsData['hotelPrice'] + $gstAmount) }}</font>
                  <font id="old_total_payable_amount" style="display: none;">{{ ($sellingAmount + $photelsData['hotelPrice'] + $gstAmount) }}</font>
                  <input type="hidden" name="payableAmount" value="{{ ($sellingAmount + $photelsData['hotelPrice'] + $gstAmount) }}">
                </b>
              </span>
            </div>
            <div class="apply_coupon">
              <h3 class="apply_coupon1">
                <b>Apply Coupon
                </b>
                <br>
                Best coupon for you
              </h3>
              <div class="checkbox checkbox-info checkbox-circle MMN56">
                <input id="chp41" name="couponId" class="styled" type="checkbox" value="{{ $packageData['couponId'] }}">
                <label for="chp41" >
                  <h5 class="MMN56f">
                    <b>{{ $packageData['couponNumber'] }}
                    </b>
                  </h5>
                </label><br>
                {{-- <span class="MMN56l">
                  <b> - 
                    <i class="fa fa-rupee">
                    </i> 45,000
                  </b>
                </span> --}}
                <span class="coupon_applied_successfully" id="coupon_status">
                  
                </span>
                {{-- <span class="remove">
                  <a href="">REMOVE
                  </a>
                </span> --}}
                <br>
                <br>
                <h3>
                  <a href="">VIEW MORE COUPONS
                  </a>
                </h3>
              </div>
            </div>
            <div class="pay_full_amount">
              <div class="toggle">
                <div class="hs_pricing_toggle__wrapper pay_full_amount1" id="toggle__wrapper">
                  <input type="radio" name="payment_radio" id="payment_radio_full" value="1" checked required>
                    {{-- <i class="far fa-circle">
                    </i>
                    <i class="far fa-dot-circle">
                    </i> --}}
                    <div class="hs_pricing_toggle__text">
                      <h5>
                        <b>Pay full amount now
                        </b>
                      </h5>
                      <p>The entire amount will be deducted in a 
                        <b>one time payment
                        </b> 
                      </p>
                    </div> 
                  </button>
                  <input type="radio" name="payment_radio" id="payment_radio_half" value="0" required>
                    {{-- <i class="far fa-circle">
                    </i>
                    <i class="far fa-dot-circle">
                    </i> --}}
                    <div class="hs_pricing_toggle__text">
                      <h5><b>Half Amount</b>
                      </h5>
                      <p>
                      </p>
                    </div>
                  </button>
                </div>
              </div>
            </div>
            <div class="perperson">
              <span class="perperson1">
                <span class="n-td" >
                  <span class="n-td-1 perperson2">
                    {{-- <i class="fa fa-rupee" >
                    </i> 50,000 --}}
                  </span>
                </span>
              </span>
            </div>
            <div class="perperson3">
              <span class="perperson4">
                <i class="fa fa-rupee">
                </i> <font id="payable_amount">{{ ($sellingAmount + $photelsData['hotelPrice'] + $gstAmount) }}</font>
                {{-- <span>per person
                </span>  --}}
              </span>
              <span class="continue">
                  <button type="submit" class="btn" id="submit">CONTINUE
                  </button>
              </span>
              
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection

@section('script')
<script type="text/javascript">
  (function() {
    $(function() {
      var toggle;
      return toggle = new Toggle('.toggle');
    }
     );
    this.Toggle = (function() {
      class Toggle {
        constructor(toggleClass) {
          this.el = $(toggleClass);
          this.tabs = this.el.find(".hs_pricing_toggle");
          this.panels = this.el.find(".panel");
          this.bind();
        }
        show(index) {
          var activePanel, activeTab;
          //update tabs
          this.tabs.removeClass('activate');
          activeTab = this.tabs.get(index);
          $(activeTab).addClass('activate');
          //update panels
          this.panels.hide();
          activePanel = this.panels.get(index);
          return $(activePanel).show();
        }
        bind() {
          return this.tabs.unbind('click').bind('click', (e) => {
            return this.show($(e.currentTarget).index());
          }
                                               );
        }
      };
      Toggle.prototype.el = null;
      Toggle.prototype.tabs = null;
      Toggle.prototype.panels = null;
      return Toggle;
    }
                  ).call(this);
  }
  ).call(this);
</script>

<script type="text/javascript">
$(document).ready(function() {

  var total_days = {{ $packageData['totalDays'] }};
  
  $("#submit").click(function(){
      if($("#datepicker").val() == "") {
          alert('Please ! Select Start Date');
          return false;
      }
  });

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
    }
  });

    $('#chp41').change(function() {

        if(this.checked) {

            $('#total_amount').text('Calculating...');
            $('#gst_amount').text('Calculating...');
            $('#total_payable_amount').text('Calculating...');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });

            $.ajax({
                url: "{{ url('package_coupon_price_calculating') }}",
                type: "POST",
                data: {
                    'packageId': {{ $packageData['packageId'] }},
                    'total_persons_list': $('#total_persons_list').val(),
                    'hotelId'  : {{ $photelsData['hotelId'] }}
                },
                success:function (response) {

                    var res = response.split(",");

                    $('#total_amount').text(res[0]);
                    $('#gst_amount').text(res[1]);
                    $('#total_payable_amount').text(res[2]);

                    if(res[3] == 1)
                        $('#coupon_status').text("Coupon applied successfully");
                    else
                        $('#coupon_status').text("Coupon is not valid");

                    if ($("#payment_radio_full").is(":checked")) {

                        var total_payable_amount = $('#total_payable_amount').text(); 
                        $('#payable_amount').text(total_payable_amount);
                    }

                    if ($("#payment_radio_half").is(":checked")) {

                        var total_payable_amount = parseInt($('#total_payable_amount').text()) / 2; 
                        $('#payable_amount').text(total_payable_amount);
                    }
                }
            });
        } else {

            $('#total_amount').text($('#old_total_amount').text());
            $('#gst_amount').text($('#old_gst_amount').text());
            $('#total_payable_amount').text($('#old_total_payable_amount').text());
            $('#coupon_status').text("");
        }       
    }); 

    $('#payment_radio_full').click(function() {

        var total_payable_amount = $('#total_payable_amount').text(); 
        $('#payable_amount').text(total_payable_amount);
    });

    $('#payment_radio_half').click(function() {

        var total_payable_amount = parseInt($('#total_payable_amount').text()) / 2; 
        $('#payable_amount').text(total_payable_amount);
    });
});
</script>
@endsection