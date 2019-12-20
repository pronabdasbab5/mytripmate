@extends('admin.layouts.dapp')

@section('content')
<div class="right_col" role="main">
          <div class="">
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
                    <h2>All Packages</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					
                    <table id="all_packages_table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Package Category</th>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Title</th>
                            <th>Offer</th>
                            <th>Duration</th>
                            <th>Location</th>
                            <th>Offer Applicable</th>
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
        </div>
@endsection

@section('script')
<script type="text/javascript">
    
$(document).ready(function(){

    $('#all_packages_table').DataTable({

        "processing": true,
        "serverSide": true,
        "ajax":{
            "url": "{{ route('admin.all_package_data') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: "{{csrf_token()}}"}
        },
        "columns": [
            { "data": "id" },
            { "data": "package_category" },
            { "data": "package_id" },
            { "data": "type" },
            { "data": "title" },
            { "data": "offer" },
            { "data": "duration" },
            { "data": "location" },
            { "data": "offer_applicable" },
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