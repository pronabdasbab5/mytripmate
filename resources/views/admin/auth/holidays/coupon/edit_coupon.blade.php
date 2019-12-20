@extends('admin.layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Edit Holiday Coupon</h2>
            <a href="{{ route('admin.all_p_coupon') }}" style="float: right; font-weight: bolder; font-size: 18px;">All Holiday Coupon</a>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"><br />
            <center>
                @if(session()->has('msg'))
                    <strong style="font-size: 16px;">{{ session()->get('msg') }}</strong>
                @endif
            </center>
            <!-- Section For New User registration -->
            <form method="POST" autocomplete="off" action="{{ route('admin.update_package_coupon', ['pCouponId' => $pcouponData->id]) }}" class="form-horizontal form-label-left">
                @csrf

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Coupon Number : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" name="coupon_number" value="{{ $pcouponData->couponNumber }}" class="form-control col-md-7 col-xs-12 form-text-element" placeholder="Enter Coupon Number">
                    @error('coupon_number')
                        {{ $message }}
                    @enderror
                </div>
              </div>

               <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Percentage (%) : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" name="flat_amount" value="{{ $pcouponData->flatAmount }}" class="form-control col-md-7 col-xs-12 form-text-element" placeholder="Flat Amount">
                  @error('flat_amount')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="submit" class="btn btn-primary form-text-element">Save Coupon</button>
                  </div>
                </div>
            </form>
            <!-- End New User registration -->
            </div>
          </div>
        </div>
      </div>
</div>
@endsection