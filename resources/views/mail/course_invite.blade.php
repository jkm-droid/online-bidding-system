
<h4>Hello, {{ $details['username'] }}</h4>
<p>

<p>
    {!! $details['message'] !!}
</p>

<div style="margin: 20px">
    The course entails:<br>
    <strong>Course Name:<br></strong> {{ $details['course']->course_name }}<br>
    <strong>Course Description:<br></strong> {{ \Illuminate\Support\Str::limit($details['course']->description,100,'...') }}<br>
    @if(count($details['course']->tutorials) > 0)
        <strong>Course Tutorials:</strong><br>
        @foreach($details['course']->tutorials as $tutorial)
            <ul>
                <li>{{ $tutorial->tutorial_name }}</li>
            </ul>
        @endforeach
    @endif
</div>

For more details kindly <a href="{{ route('user.show.login') }}">login</a> into your portal.
</p>
<p>
    Kindest regards,<br>
    <span style="color: goldenrod; font-weight: bolder;">Advanced Industrial Skills Centre for Africa (AISCA)</span><br>
</p>
