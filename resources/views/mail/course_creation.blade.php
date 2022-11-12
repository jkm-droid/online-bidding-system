Hello, {{ $details['workforce_name'] }}<br><br>

A new course <strong>{{ $details['course_name'] }}</strong> has been added by <strong>{{ $details['course_author'] }}</strong>.<br>

<div style="margin:20px;">
    The course details are as follows:<br>
    Title:<br> <strong>{{ $details['course_name'] }}</strong><br>
    Duration:<br> <strong>{{ $details['duration'] }} months</strong><br>
    Method of Delivery: <br><strong>{{ $details['method_of_delivery'] }}</strong><br>
    Description: <br><strong>{{ \Illuminate\Support\Str::limit($details['description'], 100, '...') }}</strong><br>
</div>

Kindly <a href="{{ route('user.show.login') }}">login</a> into your portal to access the additional details about the course.<br>

<div style="margin-top:10px">
    Kindest regards,<br>
    <span style="color: goldenrod;font-weight: bolder">Advanced Industrial Skills Centre for Africa (AISCA)</span><br>
</div>
