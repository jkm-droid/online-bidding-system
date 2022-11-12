<h4>Hello, {{ $details['username'] }}</h4>
<p>
    You account with Advanced Industrial Skills Centre for Africa (AISCA) have been successfully created.<br>
    You need to verify your email by clicking <a style="color: red;" href="{{ route('user.verify.email',$details['token'] )}}">HERE</a> <br>
    or
    copy this link to your browser's tab<br>
    {{ route('user.verify.email',$details['token'] )}}
</p>
<p>
    Kindest regards,<br>
    <span style="font-weight: bolder;color: goldenrod;">Advanced Industrial Skills Centre for Africa (AISCA)</span><br>
</p>
