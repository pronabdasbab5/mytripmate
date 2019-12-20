@extends('admin.layouts.dapp')

@section('content')
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Invoice</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                        <div id="printableArea">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                                          <i class="fa fa-globe"></i> Invoice.
                                          <small class="pull-right">Date: 
                                          	@php
                                          	$ext = explode(" ", $pbbdetailsData[0]->created_at);
                                          	print current($ext);
                                          	@endphp
                                          </small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                      	<div class="col-sm-4 invoice-col">
                          <b>Transaction ID:</b> {{ $pbbdetailsData[0]->txtNo }}
                          <br>
                          <b>Journey Date:</b> {{ $pbbdetailsData[0]->startDate }}
                          <br>
                          <b>Name:</b> {{ $pbbdetailsData[0]->name }}
                          <br>
                          <b>Email:</b> {{ $pbbdetailsData[0]->email }}
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Package ID:</b> {{ $pbbdetailsData[0]->packageId }}
                          <br>
                          <b>Package Title:</b> {{ $pbbdetailsData[0]->packageTitle }}
                          <br>
                          <b>Price:</b> {{ $packagePrice[0]->amount }}
                          <br>
                          <b>Offer:</b> {{ $pbbdetailsData[0]->offer }}
                          <br>
                          <b>Duration:</b> {{ $pbbdetailsData[0]->duration }}
                          <br>
                          <b>Location:</b> {{ $pbbdetailsData[0]->location }}
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Hotel Type:</b> 
                          @php
                          	if ($pbbdetailsData[0]->hotelType == 1) 
                          		print "Budget";
                          	else
                          		print "Delux"
                          @endphp
                          <br>
                          <b>Hotel Name:</b> {{ $pbbdetailsData[0]->hotelName }}
                          <br>
                          <b>Hotel Address:</b> {!! $pbbdetailsData[0]->hotelAddress !!}
                          <br>
                          <b>Price:</b> {{ $pbbdetailsData[0]->h_price }}
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      @if(count($pbtdetailsData) > 0)
                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                              	<th>Sl No</th>
                                <th>Traveller Name</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>Gender</th>
                              </tr>
                            </thead>
                            <tbody>
                            	@php
                            	$cnt = 1;
                            	@endphp
                            	@foreach($pbtdetailsData as $key => $value)
	                              <tr>
	                              	<td>{{ $cnt++ }}</td>
	                                <td>{{ $value['t_name'] }}</td>
	                                <td>{{ $value['t_con_no'] }}</td>
	                                <td>{{ $value['t_email'] }}</td>
	                                <td>{{ $value['t_age'] }}</td>
	                                <td>{{ $value['gender'] }}</td>
	                              </tr>
	                             @endforeach
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                      @endif

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                          {{-- <p class="lead">Payment Methods:</p>
                          <img src="images/visa.png" alt="Visa">
                          <img src="images/mastercard.png" alt="Mastercard">
                          <img src="images/american-express.png" alt="American Express">
                          <img src="images/paypal.png" alt="Paypal">
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                          </p> --}}
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead">Amount Due</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Package Price</th>
                                  <td>{{ ($packagePrice[0]->amount * $packagePrice[0]->totalPersons) }}</td>
                                </tr>
                                <tr>
                                  <th>Offer</th>
                                  <td>
                                  	@php
                                  	$discount = (($packagePrice[0]->amount * $packagePrice[0]->totalPersons) * $pbbdetailsData[0]->offer) / 100;
                                  	@endphp
                                  	{{ $discount }}
                                  </td>
                                </tr>                                
                                <tr>
                                  <th>Subtotal</th>
                                  <td>{{ ($packagePrice[0]->amount * $packagePrice[0]->totalPersons) - $discount }}</td>
                                </tr>
                                <tr>
                                  <th>Hotel Price</th>
                                  <td>{{ $pbbdetailsData[0]->h_price }}</td>
                                </tr>
                                @if($pbbdetailsData[0]->flatAmount != "")
                                <tr>
                                    <th>Coupon Applied</th>
                                    <td>
                                        @php
                                            $coupon_status = 1;
                                            $coupon_amount = (((($packagePrice[0]->amount * $packagePrice[0]->totalPersons) - $discount) + $pbbdetailsData[0]->h_price) * $pbbdetailsData[0]->flatAmount)/100; 
                                        @endphp
                                        {{ ((($packagePrice[0]->amount * $packagePrice[0]->totalPersons) - $discount) + $pbbdetailsData[0]->h_price) - $coupon_amount }}
                                    </td>
                                </tr>
                                @else
                                    @php
                                        $coupon_status = 0;
                                    @endphp
                                @endif
                                <tr>
                                  <th>GST</th>
                                  <td>
                                  	@php
                                        if($coupon_status == 0)
                                  	         $gst = (((($packagePrice[0]->amount * $packagePrice[0]->totalPersons) - $discount) + $pbbdetailsData[0]->h_price) * 5)/100;
                                        else
                                            $gst = (((($packagePrice[0]->amount * $packagePrice[0]->totalPersons) - $discount) + $pbbdetailsData[0]->h_price) - $coupon_amount * 5)/100;
                                  	@endphp
                                  	{{ $gst }}
                                  </td>
                                </tr>
                                <tr>
                                  <th>Total:</th>
                                  <td>
                                    @php
                                        if($coupon_status == 0)
                                             $total = (($packagePrice[0]->amount * $packagePrice[0]->totalPersons) - $discount) + $pbbdetailsData[0]->h_price + $gst;
                                        else
                                            $total = (((($packagePrice[0]->amount * $packagePrice[0]->totalPersons) - $discount) + $pbbdetailsData[0]->h_price) - $coupon_amount) + $gst;
                                    @endphp
                                    {{ $total }}</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      
                      <!-- /.row -->
                        </div>
                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                          <button class="btn btn-primary pull-right" onclick="printDiv('printableArea')" style="margin-right: 5px;"><i class="fa fa-download"></i> Print </button>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
@endsection

@section('script')
<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
@endsection