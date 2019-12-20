@extends('admin.layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Fillup the package full details ( {{ $packageFakeId }} : {{ $packageTitle }} )</h2>
            <a href="{{ route('admin.p') }}" style="float: right; font-weight: bolder; font-size: 18px;">New Holiday Package</a>
            <div class="clearfix"></div>
          </div>
            <div class="x_content">
                <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

                    <table class="table">
                      <thead>
                        <tr>
                          <th>Sections</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">Package Images</th>
                          <td><a href="{{ route('admin.upload_p_images_form', ['packageId' => $packageId]) }}" class="btn btn-primary form-text-element" target="_blank">Upload Image Form</a></td>
                        </tr>
                        <tr>
                          <th scope="row">Package Facility</th>
                          <td><a href="{{ route('admin.upload_p_facility_form', ['packageId' => $packageId]) }}" class="btn btn-warning form-text-element" target="_blank">Select Facility Form</a></td>
                        </tr>
                        <tr>
                          <th scope="row">Package Hotel</th>
                          <td><a href="{{ route('admin.upload_p_hotel_form', ['packageId' => $packageId]) }}" target="_blank" class="btn btn-info form-text-element">Select Hotel Form</a></td>
                        </tr>
                        <tr>
                          <th scope="row">Package Itenary</th>
                          <td><a href="{{ route('admin.upload_p_itenary_form', ['packageId' => $packageId]) }}" class="btn btn-success form-text-element" target="_blank">Package Itenary Form</a></td>
                        </tr>
                      </tbody>
                    </table>

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