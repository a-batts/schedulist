<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
    <link type="text/css" href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <title></title>
    <style>
        .intmess {
            color: #000000;
            background-color: #f8f0c5;
            padding-left: 15px;
            padding-top: 12px;
            padding-bottom: 8px;
            font-size: 14px;
        }

        .message-span {
            margin-left: 6px;
            vertical-align: 3px;
        }
    </style>
</head>

<body>
    <div class="intmess" style="font-family: 'Noto Sans', Roboto, Helvetica, Arial, sans-serif;">
        <img src="{{ asset('images/icon/security.png') }}" alt="Security icon" height="18px" width="18px">
        <span class="message-span">This email has been internally sent from feedback@schedulist.xyz</span>
    </div>
    <br>
    <p>From: {{ $data['name'] }}</p>
    <p>Message: {{ $data['message'] }}</p>

</body>

</html>
