@extends('admin.layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Upload Packages Images ( {{ $packageFakeId }} : {{ $packageTitle }} )</h2>
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
                <form method="POST" autocomplete="off" action="{{ route('admin.upload_p_images', ['packageId' => $packageId]) }}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Multiple Images Select (Hold Crtl) : <span class="required">*</span></label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="file" name="package_multiple_file[]" class="form-control col-md-7 col-xs-12 form-text-element" multiple accept="image/*" required>
                        @error('package_multiple_file')
                            {{ $message }}
                        @enderror
                    </div>
                  </div>

                  <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" name="submit" class="btn btn-primary form-text-element">Upload Images</button>
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