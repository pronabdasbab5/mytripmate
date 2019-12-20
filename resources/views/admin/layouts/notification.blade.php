<li role="presentation" class="dropdown">
    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-envelope-o"></i>
        <span class="badge bg-green">
        	({{ ($newBookingData['newPackageBookingData']) > 0? ($newBookingData['newPackageBookingData']): 0  }})
        </span>
        @if($newBookingData['newPackageBookingData'] > 0)
        	<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
        		@if($newBookingData['newPackageBookingData'] > 0)
        			<li><a href="{{ route('admin.p_booking', ['status' => 1]) }}"><b>({{ $newBookingData['newPackageBookingData'] }}) New Package Booking</b></a></li>
        		@endif
        		{{-- @if($newOrderReviewData['newReviewData'] > 0)
        			<li><a href="{{ route('new_review') }}"><b>({{ $newOrderReviewData['newReviewData'] }}) New Reviews</b></a></li>
        		@endif --}}
        	</ul>
        @endif
    </a>
</li>