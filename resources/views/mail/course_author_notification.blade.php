<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>

<h4>Hello, {{ $details['trainer_name'] }}</h4>
<p>
    Your course <strong>{{ $details['course'] }}</strong> has a new subscription from <strong>{{ $details['subscriber'] }}</strong>.<br>
    Kindly <a href="{{ route('user.show.login') }}">login</a> into your portal to access the additional details about the course subscription.
</p>
<p>
    Kindest regards,<br>
    <span style="color: goldenrod;font-weight: bolder">Advanced Industrial Skills Centre for Africa (AISCA)</span><br>
</p>

</body>
</html>
