@extends('admin.layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Packages Hotels Mapping ( {{ $packageFakeId }} : {{ $packageTitle }} )</h2>
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
                <form method="POST" autocomplete="off" action="{{ route('admin.upload_p_hotel', ['packageId' => $packageId]) }}" class="form-horizontal form-label-left">
                    @csrf
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Select Hotels : <span class="required">*</span></label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="pacakge-hotel-div col-md-7 col-xs-12  form-control form-text-element">
                            @if(count($photelsData) > 0)
                                @foreach($photelsData as $value)
                                    <input type="checkbox" name="hotel_id[]" value="{{ $value->id }}">&nbsp;&nbsp;&nbsp;<b>{{ ($value->hotelType == 1)? "Budget": "Delux" }}, <a href="{{ route('admin.p_hotel_edit_form', ['pHotelId' => $value->id]) }}" title="Click Me for Details" target="_blank">{{ $value->hotelName }}</a> , Rs. {{ $value->price }}</b><br>
                                @endforeach
                            @endif
                        </div>
                        @error('hotel_id')
                            {{ $message }}
                        @enderror
                    </div>
                  </div>

                  <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" name="submit" class="btn btn-primary form-text-element">Add Hotels</button>
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