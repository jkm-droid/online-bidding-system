Hello, {{ $details['full_name'] }}<br><br>

Thank you for applying to become <strong>{{ $details['player'] }}</strong>. We have reviewed you application
and we are excited to inform that you have been selected to become one of our players.

<div style="margin:20px;">
    Application status:<strong style="color: green"> Accepted</strong><br>
</div>

Kindly <a href="{{ route('user.show.login') }}">login</a> into your portal to get started. For any queries contact our support staff.

<div style="margin-top:10px">
    Kindest regards,<br>
    <span style="color: goldenrod;font-weight: bolder">Advanced Industrial Skills Centre for Africa (AISCA)</span><br>
</div>
