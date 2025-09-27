Hello @if ($data1['gender'] == 'male')
    Mr.
@else
    Ms.
@endif{{ $data1['name'] }},

Thank you for creating an account with us. Please verify your email by clicking the link below:

<a href="http://localhost:8000/verifyAccount/{{ urlencode($data1['email']) }}/{{ $data1['token'] }}">
    Verify Email
</a>

