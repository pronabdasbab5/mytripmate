<?php

namespace App\Http\Controllers\Email;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\BookEmail;
use Mail;

class EmailController extends Controller
{
    public function send_email(Request $request){

    	$request_info = urldecode("<table border=\"1\">
	<tr>
		<th colspan=\"2\">Enquiry Information</th>
	</tr>
	<tr>
		<td>Where to Go</td>
		<td><b>".$request->input('city')."</b></td>
	</tr>
	<tr>
		<td>Service you want</td>
		<td><b>".$request->input('service_you_want')."</b></td>
	</tr>
	<tr>
		<td>Name</td>
		<td><b>".$request->input('name')."</b></td>
	</tr>
	<tr>
		<td>Email ID</td>
		<td>".$request->input('email')."</b></td>
	</tr>
	<tr>
		<td>Mobile No.</td>
		<td><b>".$request->input('mobile')."</b></td>
	</tr>
	<tr>
		<td>No. of adults</td>
		<td><b>".$request->input('no_of_adult')."</b></td>
	</tr>
	<tr>
		<td>Trip start date</td>
		<td><b>".$request->input('from')."</b></td>
	</tr>
	<tr>
		<td>Trip end date</td>
		<td><b>".$request->input('to')."</b></td>
	</tr>
	<tr>
		<td>Message</td>
		<td><b>".$request->input('queries')."</b></td>
	</tr>
</table>");

    	$data = ['message' => $request_info];

    	Mail::to('booking.mytripmate@gmail.com')->send(new BookEmail($data));

    	return redirect()->back();
    }
}
