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
                    <form method="POST" autocomplete="off" action="{{ route('admin.upload_p_hotel', ['packageId' => $packageData->id]) }}" class="form-horizontal form-label-left">
                    @csrf

                    @if(!empty($package_itenary))
                        @for($i = 0; $i < count($package_itenary); $i++)
                            <p><b>Day {{ $package_itenary[$i]->days }} : {{ $package_itenary[$i]->title }} - {{ $package_itenary[$i]->location }}</b></p>
                            @php
                                $hotel_status = 0;
                            @endphp
                            <input type="hidden" name="itenary_id[]" value="{{ $package_itenary[$i]->id }}">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12"> Budget Hotels : <span class="required">*</span></label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                  <select name="budget_hotels[]" id="budget_hotels" class="form-control form-text-element">
                                      <option selected disabled>Choose Hotels</option>
                                       @if(!empty($budget_hotels))
                                            @foreach($budget_hotels as $key_3 => $item_3)
                                            <option value="{{ $item_3->id }}">{{ $item_3->hotelName }}, {!! $item_3->hotelAddress !!}, Price: {{ $item_3->price }}</option>
                                            @endforeach
                                       @endif
                                  </select>
                                    @error('budget_hotels')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Delux Hotels : <span class="required">*</span></label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                  <select name="delux_hotels[]" class="form-control form-text-element">
                                      <option selected disabled>Choose Hotels</option>
                                      @if(!empty($delux_hotels))
                                            @foreach($delux_hotels as $key_3 => $item_3)
                                            <option value="{{ $item_3->id }}">{{ $item_3->hotelName }}, {!! $item_3->hotelAddress !!}, Price: {{ $item_3->price }}</option>
                                            @endforeach
                                       @endif
                                  </select>
                                    @error('delux_hotels')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        @endfor
                    @endif

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