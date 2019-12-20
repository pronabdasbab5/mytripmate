@extends('admin.layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Update Price</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"><br />
            <center>
                @if(session()->has('msg'))
                    <b>{{ session()->get('msg') }}</b>
                @endif
            </center>
            <!-- Section For New User registration -->
          <form method="POST" autocomplete="off" action="{{ route('admin.update_package_price', ['packageId' => $packageId]) }}" class="form-horizontal form-label-left">
                @csrf
               
                @if (count($package_price) > 0)
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-10">
                      <button type="button" id="add_row" class="btn btn-success">Add Row</button>
                      <button type="button" id="remove_row" class="btn btn-warning">Remove Row</button>
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="TextBoxDiv"> 
                            @php
                               $cnt = 1; 
                               $flag = count($package_price)
                            @endphp
                            @foreach ($package_price as $item)
                            <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" id="label_total_persons1">Total Persons : <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                      <input type="hidden" value="{{ $item->id }}" id="price_id{{ $cnt }}" name="price_id[]">
                                    <input type="number" min="1" name="total_persons[]" value="{{ $item->totalPersons }}" id="total_persons{{ $cnt }}" class="form-control col-md-4 col-xs-12 form-text-element" placeholder="Total Persons" required>
                                        @error('total_persons')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" id="label_amount1">Amount : <span class="required">*</span></label>
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                      <input type="text" name="amount[]" value="{{ $item->amount }}" id="amount{{ $cnt }}" class="form-control col-md-2 col-xs-12 form-text-element" placeholder="Amount" required>
                                        @error('amount')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                    <a href="{{ route('admin.delete_price', ['price_id' => $item->id, 'packageId' => $packageId]) }}" class="btn btn-danger">Delete</a>
                                    </div>
                                    @php
                                      $cnt++;  
                                    @endphp
                                  </div>
                            @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                @else
                @php
                    $flag = 2;
                @endphp
                <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-10">
                          <button type="button" id="add_row" class="btn btn-success">Add Row</button>
                          <button type="button" id="remove_row" class="btn btn-warning">Remove Row</button>
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12" id="TextBoxDiv"> 
                              <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" id="label_total_persons1">Total Persons : <span class="required">*</span></label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                  <input type="number" min="1" name="total_persons[]" id="total_persons1" class="form-control col-md-4 col-xs-12 form-text-element" placeholder="Total Persons" required>
                                    @error('total_persons')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" id="label_amount1">Amount : <span class="required">*</span></label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                  <input type="text" name="amount[]" id="amount1" class="form-control col-md-4 col-xs-12 form-text-element" placeholder="Amount" required>
                                    @error('amount')
                                        {{ $message }}
                                    @enderror
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                @endif



              <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="submit" class="btn btn-success">Save Price</button>
                    <a href="{{ route('admin.all_package') }}" class="btn btn-warning">Back</a>
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

@section('script')
<script type="text/javascript">

    $(document).ready(function(){
    
        var counter = {{ $flag + 1 }};
        
        $("#add_row").click(function () {  
                        
          $("#TextBoxDiv").append("<div class='form-group'><label class='control-label col-md-2 col-sm-2 col-xs-12' id='label_total_persons"+counter+"'>Total Persons : <span class='required'>*</span></label><div class='col-md-4 col-sm-4 col-xs-12'><input type='hidden' id='price_id"+counter+"' name='price_id[]'><input type='number' min='1' name='total_persons[]' id='total_persons"+counter+"' class='form-control col-md-4 col-xs-12 form-text-element' placeholder='Total Persons' required>@error('total_persons'){{ $message }}@enderror</div><label class='control-label col-md-2 col-sm-2 col-xs-12' id='label_amount"+counter+"'>Amount : <span class='required'>*</span></label><div class='col-md-4 col-sm-4 col-xs-12'><input type='text' name='amount[]' id='amount"+counter+"' class='form-control col-md-4 col-xs-12 form-text-element' placeholder='Amount' required>@error('amount'){{ $message }}@enderror</div></div>");
          counter++;
        });
    
        $("#remove_row").click(function () {
          if(counter > {{ $flag + 1 }}){
            counter--;
            $("#total_persons" + counter).remove();
            $("#amount" + counter).remove();
            $("#label_total_persons" + counter).remove();
            $("#label_amount" + counter).remove();
          }
          else
            alert('Only one left. Cann\'t remove');
        });
      });
  </script>
@endsection