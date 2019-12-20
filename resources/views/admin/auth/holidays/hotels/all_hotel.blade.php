@extends('admin.layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>All Holiday Hotel</h2>
            <a href="{{ route('admin.p_hotel') }}" style="float: right; font-weight: bolder; font-size: 18px;">New Holiday Hotel</a>
            <div class="clearfix"></div>
          </div>
            <div class="x_content"><br />
                <table id="all_package_hotels" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Hotel Type</th>
                            <th>Hotel Name</th>
                            <th>Hotel Address</th>
                            <th>Price</th>
                            <th>Rating</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    
$(document).ready(function(){

    var position = 0;

    $('#all_package_hotels').DataTable({

        "processing": true,
        "serverSide": true,
        "ajax":{
            "url": "{{ url('/admin/package_hotel_data') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: "{{csrf_token()}}"}
        },
        "columns": [
            { "data": "id" },
            { "data": "hotelType" },
            { "data": "hotelName" },
            { "data": "hotelAddress" },
            { "data": "price" },
            { "data": "rating" },
            { "data": "action" },
        ],    
    });
});

</script>
@endsection