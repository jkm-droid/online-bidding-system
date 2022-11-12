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
<h4>Hello, {{ $details['student_name'] }}</h4>
<p>
    You have been registered to the Advanced Industrial Skills Centre for Africa (AISCA) portal by {{ $details['college_name'] }}.
    Kindly complete the registration process by clicking <a href="{{ route('user.student.register', $details['token']) }}">Complete Registration</a>
</p>
<p>
    Kindest regards,<br>
    <span style="font-style: italic;">Advanced Industrial Skills Centre for Africa (AISCA)</span><br>
</p>

</body>
</html>
