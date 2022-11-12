<h4>Hello, {{ $details['name'] }}</h4>

<strong>{{ $details['trainer_name'] }}</strong> {{ $details['message'] }} <strong>{{ $details['course_name'] }}</strong> course.<br>
Meeting details are:<br>

<div style="margin: 20px;">
    <strong class="put-black">Title :</strong> {{ $details['title'] }}<br>
    <strong class="put-black"> Start Time :</strong> {{ $details['start_time'] }}<br>
    <strong class="put-black"> End Time :</strong> {{ $details['end_time'] }}<br>
    <strong class="put-black"> Meeting Description: </strong>{{ $details['description'] }}<br>
</div>

{{--Kindly <a href="{{ route('user.show.login') }}">login</a> into your portal to access the additional details about the meeting.--}}

<div style="margin-top: 5px;">
    Kindest regards,<br>
    <span style="font-weight: bolder; color: goldenrod">Advanced Industrial Skills Centre for Africa (AISCA)</span><br>
</div>
