@extends('admin.layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>

  <!-- Modal -->
            <div class="modal fade" id="all_package_modal" role="dialog" style="margin-top: 50px;">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" id="modal_title"></h4>
                        </div>
                        <div class="modal-body" id="package_details">
                            <center><b style="font-size: 20px;">Loading ....</b></center>
                        </div>
                    </div>
                </div>
            </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>New Package Booking</h2>
            <a href="{{ route('admin.p_booking', ['status' => 2]) }}" style="float: right; font-weight: bolder; font-size: 18px;">Confirm Booking List</a>
            <div class="clearfix"></div>
          </div>
            <div class="x_content"><br />
                <table id="new_package_booking" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Transaction No.</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Journey Date</th>
                            <th>Pacakge Title</th>
                            <th>Duration</th>
                            <th>Location</th>
                            <th>Payable Amount</th>
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

    $('#new_package_booking').DataTable({

        "processing": true,
        "serverSide": true,
        "ajax":{
            "url": "{{ url('/admin/package_booking_data') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ 
                _token  : "{{csrf_token()}}",
                'status': 1
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "transactionNo" },
            { "data": "userName" },
            { "data": "userEmail" },
            { "data": "journeyDate" },
            { "data": "pacakgeTitle" },
            { "data": "duration" },
            { "data": "location" },
            { "data": "price" },
            { "data": "action" },
        ],    
    });
});

function show_package_detail(id) {

    var package_id = $('#package_id'+id).text();

    $('#modal_title').text("Package Details");

    $('#package_details').html("<center><b style=\"font-size: 20px;\">Loading ....</b></center>");

    $('#all_package_modal').modal('show');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });

    $.ajax({
        method: "GET",
        url   : "{{ url('/admin/package_details/') }}/"+package_id+"",
        success: function(response) {

            $(".modal-dialog").css("width", "1000px");
            $('#package_details').html(response);
        }
    });
}

</script>
@endsection