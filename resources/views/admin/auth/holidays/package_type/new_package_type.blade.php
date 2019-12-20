@extends('admin.layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>New Holiday Package Type</h2>
            <a href="{{ route('admin.all_p_type') }}" style="float: right; font-weight: bolder; font-size: 18px;">All Holiday Package Type</a>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"><br />
            <center>
                @if(session()->has('msg'))
                    <strong style="font-size: 16px;">{{ session()->get('msg') }}</strong>
                @endif
            </center>
            <!-- Section For New User registration -->
            <form method="POST" autocomplete="off" action="{{ route('admin.add_p_type') }}" class="form-horizontal form-label-left">
                @csrf

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Package Type : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" name="package_type" class="form-control col-md-7 col-xs-12 form-text-element" placeholder="Enter Package Type">
                    @error('package_type')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="submit" class="btn btn-primary form-text-element">Add Package Type</button>
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