@extends('admin.layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>New Holiday Package</h2>
            <a href="{{ route('admin.all_p_type') }}" style="float: right; font-weight: bolder; font-size: 18px;">All Holiday Package</a>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"><br />
            <center>
                @if(session()->has('msg'))
                    <strong style="font-size: 16px;">{{ session()->get('msg') }}</strong>
                @endif
            </center>
            <!-- Section For New User registration -->
            <form method="POST" autocomplete="off" action="{{ route('admin.add_p_basic_info') }}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                @method('PUT')
                @csrf

            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Package Category : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="radio" name="package_category" value="1" checked>&nbsp;&nbsp;<b>Domestic</b>
                  <input type="radio" name="package_category" value="2">&nbsp;&nbsp;<b>International</b>
                    @error('package_category')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Package ID : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="package_id" class="form-control col-md-4 col-xs-12 form-text-element" placeholder="Enter Package ID">
                    @error('package_id')
                        {{ $message }}
                    @enderror
                </div>
            </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Package Type : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <select name="package_type" class="form-control col-md-4 col-xs-12 form-text-element">
                      <option disabled selected>Choose Package Type</option>
                      @foreach($ptypeData as $key=>$value)
                        <option value="{{ $value->id }}" class="form-text-element">{{ $value->packageType }}</option>
                      @endforeach
                  </select>
                    @error('package_type')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Package Title : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="package_title" class="form-control col-md-4 col-xs-12 form-text-element" placeholder="Enter Package Title">
                    @error('package_title')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Package Description : <span class="required">*</span></label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <textarea name="package_desc" class="form-control col-md-10 col-xs-12 ckeditor_textarea"></textarea>
                    @error('package_desc')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Banner Image : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="file" name="cover_img" id="cover_img" class="form-control col-md-10 col-xs-12" accept="image/*">
                    @error('cover_img')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Offer : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="offer" class="form-control col-md-4 col-xs-12 form-text-element" placeholder="Enter Offer">
                    @error('offer')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Duration : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="duration" class="form-control col-md-4 col-xs-12 form-text-element" placeholder="Enter Duration">
                    @error('duration')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Location : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text-" name="location" class="form-control col-md-4 col-xs-12 form-text-element" placeholder="Enter Location">
                    @error('location')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Total Days : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="number" min="1" name="total_days" class="form-control col-md-4 col-xs-12 form-text-element" placeholder="Enter Total Days">
                    @error('total_days')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Total Nights : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="number" min="1" name="total_nights" class="form-control col-md-4 col-xs-12 form-text-element" placeholder="Enter Total Nights">
                    @error('total_nights')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Longitude : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text-" name="longitude" class="form-control col-md-4 col-xs-12 form-text-element" placeholder="Enter Longitude">
                    @error('longitude')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Latitude : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text-" name="latitude" class="form-control col-md-4 col-xs-12 form-text-element" placeholder="Enter Latitude">
                    @error('latitude')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Coupon Applicable or Not : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                   <b>Yes:</b> <input type="radio" name="is_applicable" value="1" required checked />
                   <b>No:</b> <input type="radio" name="is_applicable" value="0" />
                    @error('is_applicable')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Package Facility : </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                   @if(count($pfacilityData) > 0)
                        @foreach($pfacilityData as $value)
                            <input type="checkbox" name="package_facility[]" value="{{ $value->id }}">&nbsp;&nbsp;&nbsp;<b>{{ $value->facility }}</b>&nbsp;&nbsp;&nbsp;
                        @endforeach
                   @endif
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <button type="button" id="add_row" class="btn btn-success">Add Row</button>
                  <button type="button" id="remove_row" class="btn btn-warning">Remove Row</button>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" id="TextBoxDiv"> 
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" id="label_total_persons1">Total Persons : <span class="required">*</span></label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="number" min="1" name="total_persons[]" id="total_persons1" class="form-control col-md-4 col-xs-12 form-text-element" placeholder="Total Persons" required>
                            @error('total_persons')
                                {{ $message }}
                            @enderror
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" id="label_amount1">Amount : <span class="required">*</span></label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="amount[]" id="amount1" class="form-control col-md-4 col-xs-12 form-text-element" placeholder="Amount" required>
                            @error('amount')
                                {{ $message }}
                            @enderror
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="submit" class="btn btn-primary form-text-element">Add Package</button>
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

@section('script')
<script type="text/javascript">

  $(document).ready(function(){
  
      var counter = 2;
      
      $("#add_row").click(function () {  
                      
        $("#TextBoxDiv").append("<div class='form-group'><label class='control-label col-md-2 col-sm-2 col-xs-12' id='label_total_persons"+counter+"'>Total Persons : <span class='required'>*</span></label><div class='col-md-4 col-sm-4 col-xs-12'><input type='number' min='1' name='total_persons[]' id='total_persons"+counter+"' class='form-control col-md-4 col-xs-12 form-text-element' placeholder='Total Persons' required>@error('total_persons'){{ $message }}@enderror</div><label class='control-label col-md-2 col-sm-2 col-xs-12' id='label_amount"+counter+"'>Amount : <span class='required'>*</span></label><div class='col-md-4 col-sm-4 col-xs-12'><input type='text' name='amount[]' id='amount"+counter+"' class='form-control col-md-4 col-xs-12 form-text-element' placeholder='Amount' required>@error('amount'){{ $message }}@enderror</div></div>");
        counter++;
      });
  
      $("#remove_row").click(function () {
        if(counter > 2){
          counter--;
          $("#total_persons" + counter).remove();
          $("#amount" + counter).remove();
          $("#label_total_persons" + counter).remove();
          $("#label_amount" + counter).remove();
        }
        else
          alert('Only one left. Cann\'t remove');
      });
    });
</script>
@endsection