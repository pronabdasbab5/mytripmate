@extends('admin.layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Update Holiday Package</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"><br />
            <center>
                @if(session()->has('msg'))
                    <strong style="font-size: 16px;">{{ session()->get('msg') }}</strong>
                @endif
            </center>
            <!-- Section For New User registration -->
            <form method="POST" autocomplete="off" action="{{ route('admin.update_package', ['packageId' => $packageData->id]) }}" class="form-horizontal form-label-left">
                @csrf

                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Package Category : <span class="required">*</span></label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        @if($packageData->packageCategory == 1)
                            <input type="radio" name="package_category" value="1" checked>&nbsp;&nbsp;<b>Domestic</b>
                            <input type="radio" name="package_category" value="2">&nbsp;&nbsp;<b>International</b>
                        @else
                            <input type="radio" name="package_category" value="1">&nbsp;&nbsp;<b>Domestic</b>
                            <input type="radio" name="package_category" value="2" checked>&nbsp;&nbsp;<b>International</b>
                        @endif
                        @error('package_category')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Package ID : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" name="package_id" value="{{ $packageData->packageId }}" class="form-control col-md-7 col-xs-12 form-text-element" placeholder="Enter Package ID">
                    @error('package_id')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Package Type : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <select name="package_type" class="form-control col-md-7 col-xs-12 form-text-element">
                      <option disabled selected>Choose Package Type</option>
                      @foreach($ptypeData as $key=>$value)
                        @if($value->id == $packageData->packageType)
                            <option value="{{ $value->id }}" class="form-text-element" selected>{{ $value->packageType }}</option>
                        @else
                            <option value="{{ $value->id }}" class="form-text-element">{{ $value->packageType }}</option>
                        @endif
                      @endforeach
                  </select>
                    @error('package_type')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Package Title : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" name="package_title" value="{{ $packageData->packageTitle }}" class="form-control col-md-7 col-xs-12 form-text-element" placeholder="Enter Package Title">
                    @error('package_title')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Package Description : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <textarea name="package_desc" class="form-control col-md-7 col-xs-12 ckeditor_textarea">{{ $packageData->packageDesc }}</textarea>
                    @error('package_desc')
                        {{ $message }}
                    @enderror
                </div>
              </div>

                <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Offer : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" name="offer" value="{{ $packageData->offer }}" class="form-control col-md-7 col-xs-12 form-text-element" placeholder="Enter Offer">
                    @error('offer')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Duration : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" name="duration" value="{{ $packageData->duration }}" class="form-control col-md-7 col-xs-12 form-text-element" placeholder="Enter Duration">
                    @error('duration')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Total Days : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="number" min="1" name="total_days" value="{{ $packageData->totalDays }}" class="form-control col-md-7 col-xs-12 form-text-element" placeholder="Enter Total Days">
                    @error('total_days')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Total Nights : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="number" min="1" name="total_nights" value="{{ $packageData->totalNights }}" class="form-control col-md-7 col-xs-12 form-text-element" placeholder="Enter Total Nights">
                    @error('total_nights')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Location : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text-" name="location" value="{{ $packageData->location }}" class="form-control col-md-7 col-xs-12 form-text-element" placeholder="Enter Location">
                    @error('location')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Longitude : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text-" name="longitude" value="{{ $packageData->longitude }}" class="form-control col-md-7 col-xs-12 form-text-element" placeholder="Enter Longitude">
                    @error('longitude')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Latitude : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text-" name="latitude" value="{{ $packageData->latitude }}" class="form-control col-md-7 col-xs-12 form-text-element" placeholder="Enter Latitude">
                    @error('latitude')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Coupon Applicable or Not : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    @if($packageData->isApplicable == 1)
                       <b>Yes:</b> <input type="radio" name="is_applicable" value="1" checked />
                       <b>No:</b> <input type="radio" name="is_applicable" value="0" />
                    @else
                        <b>Yes:</b> <input type="radio" name="is_applicable" value="1"/>
                       <b>No:</b> <input type="radio" name="is_applicable" value="0" checked/>
                    @endif
                    @error('is_applicable')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Package Facility : </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                   @if(count($pfacilityData) > 0)
                        @php
                            $i = 0;
                        @endphp
                        @foreach($pfacilityData as $value)

                            @if(isset($pfrelationData[$i]['packageFacilityId']))
                                @if($value->id == $pfrelationData[$i]['packageFacilityId'])
                                    <input type="checkbox" name="package_facility[]" value="{{ $value->id }}" checked>&nbsp;&nbsp;&nbsp;<b>{{ $value->facility }}</b>&nbsp;&nbsp;&nbsp;
                                @else
                                    <input type="checkbox" name="package_facility[]" value="{{ $value->id }}">&nbsp;&nbsp;&nbsp;<b>{{ $value->facility }}</b>&nbsp;&nbsp;&nbsp;
                                @endif
                            @else
                                <input type="checkbox" name="package_facility[]" value="{{ $value->id }}">&nbsp;&nbsp;&nbsp;<b>{{ $value->facility }}</b>&nbsp;&nbsp;&nbsp;
                            @endif

                            @php
                            $i++;
                            @endphp
                        @endforeach
                   @endif
                </div>
              </div>

              <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="submit" class="btn btn-primary form-text-element">Update Package</button>
                    <a href="{{ route('admin.all_package') }}" class="btn btn-warning form-text-element">Back</a>
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