
<h4>Hello, {{ $details['subscriber'] }}</h4>
<p>
    Thank you for subscribing to the course <strong>{{ $details['course'] }}</strong> authored by <strong>{{ $details['trainer_name'] }}</strong>.<br>
<div style="margin: 20px">
    The course entails:<br>
    <strong>Course Name:<br></strong> {{ $details['course'] }}<br>
    <strong>Course Description:<br></strong> {{ \Illuminate\Support\Str::limit($details['description'],100,'...') }}<br>
    @if(count($details['tutorials']) > 0)
        <strong>Course Tutorials:</strong><br>
        @foreach($details['tutorials'] as $tutorial)
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
