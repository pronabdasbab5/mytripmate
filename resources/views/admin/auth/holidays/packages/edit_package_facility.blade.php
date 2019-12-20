@extends('admin.layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Packages Facility ( {{ $packageData->packageId }} : {{ $packageData->packageTitle }} )</h2>
            <div class="clearfix"></div>
          </div>
            <div class="x_content">
                <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content"><br>
                    <center>
                        @if(session()->has('msg'))
                            <strong style="font-size: 16px;">{{ session()->get('msg') }}</strong>
                        @endif
                    </center>
                <form method="POST" autocomplete="off" action="{{ route('admin.update_package_facility', ['packageId' => $packageData->id]) }}" class="form-horizontal form-label-left">
                    @csrf
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Included Facility : <span class="required">*</span></label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <textarea name="package_include_facility" class="form-control col-md-7 col-xs-12 ckeditor_textarea" required>{{ $packageData->includeFacility }}</textarea>
                        @error('package_include_facility')
                            {{ $message }}
                        @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Excluded Facility : <span class="required">*</span></label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <textarea name="package_excluded_facility" class="form-control col-md-7 col-xs-12 ckeditor_textarea" required>{{ $packageData->excludeFacility }}</textarea>
                        @error('package_excluded_facility')
                            {{ $message }}
                        @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Terms and Condition : <span class="required">*</span></label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <textarea name="terms_and_condition" class="form-control col-md-7 col-xs-12 ckeditor_textarea" required>{{ $packageData->termCondition }}</textarea>
                        @error('terms_and_condition')
                            {{ $message }}
                        @enderror
                    </div>
                  </div>

                  <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" name="submit" class="btn btn-primary form-text-element">Update Facility</button>
                        <button type="button" onclick="window.close();" class="btn btn-warning form-text-element">Cancel</button>
                      </div>
                    </div>
                </form>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection