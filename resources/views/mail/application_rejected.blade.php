Hello, {{ $details['full_name'] }}<br><br>

Thank you for applying to become <strong>{{ $details['player'] }}</strong>. We have reviewed you application
 but unfortunately we cannot accept it due to the following reason:

<div style="margin: 20px 20px 20px 0;">
    Reason:<br><strong>{{ $details['reason'] }}</strong><br>
    Application status:<br><strong style="color: red;"> Declined</strong><br>
</div>

Kindly email our support for further assistance or other queries.<br>

<div style="margin-top:10px">
    Kindest regards,<br>
    <span style="color: goldenrod;font-weight: bolder">Advanced Industrial Skills Centre for Africa (AISCA)</span><br>
</div>
