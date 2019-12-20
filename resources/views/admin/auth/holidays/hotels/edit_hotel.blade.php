@extends('admin.layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Edit Holiday Hotel</h2>
            <a href="{{ route('admin.all_p_hotel') }}" style="float: right; font-weight: bolder; font-size: 18px;">All Holiday Hotel</a>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"><br />
            <center>
                @if(session()->has('msg'))
                    <strong style="font-size: 16px;">{{ session()->get('msg') }}</strong>
                @endif
            </center>
            <!-- Section For New User registration -->
            <form method="POST" autocomplete="off" action="{{ route('admin.update_p_hotel', ['pHotelId' => $photelsData->id]) }}" class="form-horizontal form-label-left">
                @csrf
                <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Hotel Type : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <select name="hotel_type" class="form-control col-md-7 col-xs-12 form-text-element" autofocus>
                      <option disabled selected>Choose Hotel Type ...</option>
                        @if($photelsData->hotelType == 1)
                            <option value="1" selected class="form-text-element">Budget</option>
                            <option value="2" class="form-text-element">Delux</option>
                        @else
                            <option value="1" class="form-text-element">Budget</option>
                            <option value="2" selected class="form-text-element">Delux</option>
                        @endif
                  </select>
                    @error('hotel_type')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Hotel Name : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text"  name="hotel_name" value="{{ $photelsData->hotelName }}" class="form-control col-md-7 col-xs-12 form-text-element" placeholder="Enter Hotel Name">
                    @error('hotel_name')
                        {{ $message }}
                    @enderror
                </div>
              </div>

               <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Hotel Address : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <textarea name="hotel_address" class="form-control col-md-7 col-xs-12 form-text-element ckeditor_textarea" placeholder="Hotel Address">{{ $photelsData->hotelAddress }}</textarea>
                  @error('hotel_address')
                        {{ $message }}
                    @enderror
                </div>
              </div>

               <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Price: <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="number" name="price" step="0.01" value="{{ $photelsData->price }}" step="0.01" class="form-control col-md-7 col-xs-12 form-text-element" placeholder="Enter Price">
                    @error('price')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="submit" class="btn btn-primary form-text-element">Save Hotel</button>
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