@extends('admin.layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Packages Itenary ( {{ $packageData->packageId }} : {{ $packageData->packageTitle }} )</h2>
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
                <form method="POST" autocomplete="off" action="{{ route('admin.update_package_itenarys', ['packageId' => $packageData->id]) }}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                  @for($i = 0; $i < $packageData->totalDays; $i++)

                        <input type="hidden" name="old_itenary_img[]" value="{{ !empty($packageItenaryData[$i]->image)? $packageItenaryData[$i]->image : "" }}" required readonly>
                        <input type="hidden" name="itenary_id[]" value="{{ !empty($packageItenaryData[$i]->id)? $packageItenaryData[$i]->id: "" }}" required readonly>

                        <center>

                            @if(!empty($packageItenaryData[$i]->image))
                                <img src="{{ route('admin.itenary_image', ['filename' => $packageItenaryData[$i]->image]) }}" width="200px" height="200px" id="package_itenary_img"><br><br>
                            @endif
                        </center>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12 form-text-element">Day {{ $i + 1 }} (Title) : <span class="required">*</span></label><input type="hidden" name="day[]" value="{{ $i + 1 }}" readonly required>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              <input type="text" name="title[]" class="form-control col-md-7 col-xs-12 form-text-element" value="{{ !empty($packageItenaryData[$i]->title)? $packageItenaryData[$i]->title: "" }}" required>
                              @error('title')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12 form-text-element">Location : <span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              <input type="text" name="location[]" class="form-control col-md-7 col-xs-12 form-text-element" value="{{ !empty($packageItenaryData[$i]->location)? $packageItenaryData[$i]->location: "" }}" required>
                              @error('location')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12 form-text-element">Itenary Banner Image : <span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              <input type="file" id="icon" name="itenary_banner_file[]" class="form-control col-md-7 col-xs-12 form-text-element">
                              @error('itenary_banner_file')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12 form-text-element">Description : <span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              <textarea name="itenary_desc[]" class="form-control col-md-7 col-xs-12 ckeditor_textarea" required>{{ !empty($packageItenaryData[$i]->desc)? $packageItenaryData[$i]->desc: "" }}</textarea>
                                @error('itenary_desc')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                  @endfor

                  <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" name="submit" class="btn btn-primary form-text-element">Update Itenary</button>
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

@section('script')
<script type="text/javascript">
$('#icon').change(function(e){

    var url = URL.createObjectURL(e.target.files[0]);
    $('#package_itenary_img').attr('src', url);
});
</script>
@endsection