@extends('admin.layouts.dapp')
@section('content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>{{ $packageData->packageId }} : {{ $packageData->packageTitle }}</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      </div>

                      <div class="clearfix"></div>

                      @if(count($packageImagesData) > 0)

                            @foreach($packageImagesData as $value)

                                <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                                    <div class="well profile_view">
                                      <div class="col-sm-12">
                                        <div class="left col-xs-7">
                                            <img src="{{ route('admin.slider_image', ['filename' => $value['image']]) }}" style="width: 300px; height: 170px;" id="img">
                                        </div>
                                      </div>
                                      <div class="col-xs-12 bottom text-center">
                                        <form method="POST" autocomplete="off" action="{{ route('admin.update_slider_image', ['fileName' => $value['image'], 'packageId' => $packageData->id]) }}" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="col-xs-12 col-sm-8 emphasis">
                                          <p class="ratings">
                                            <input type="file" name="package_slider_file" id="package_slider_file" accept="image/*" required>
                                          </p>
                                        </div>
                                        <div class="col-xs-12 col-sm-4 emphasis">
                                          <button type="submit" class="btn btn-primary btn-xs">
                                            Upload Image
                                          </button>
                                        </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>

							@endforeach
						@else
						<form method="POST" autocomplete="off" action="{{ route('admin.upload_p_images', ['packageId' => $packageData->id]) }}" class="form-horizontal form-label-left" enctype="multipart/form-data">
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
							  </div>
							</div>
						</form>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection
@section('script')
<script type="text/javascript">
$('#package_slider_file').change(function(e){

    var url = URL.createObjectURL(e.target.files[0]);
    $('#img').attr('src', url);
});
</script>
@endsection

