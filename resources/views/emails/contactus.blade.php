<!DOCTYPE html>
<html>
  <head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
    body{
      font-family: 'Roboto';
    }
    .intmess{
      color: #000000;
      background-color: #f8f0c5;
      padding-left: 15px;
      padding-top: 12px;
      padding-bottom: 8px;
      font-size: 14px;
    }
    .messagespan{
      margin-left: 6px;
      vertical-align: 3px;
    }

    /*.inputbox{
      height: 25px;
      font-size: 16px;
      width: 200px;
      outline: 2px solid;
      outline-color: #0180FF;
      padding: 10px;
    }*/
    </style>
  </head>
  <body>
    <div class="intmess">
      <img src="{{ asset('images/icon/security.png') }}" height="18px" width="18px" alt="Security icon">
      <span class="messagespan">This email has been internally sent from feedback@schedulist.xyz</span>
    </div>
    <br>
    <p>From: {{$mail_data['name']}}</p>
    <p>Message: {{$mail_data['message']}}</p>

  </body>
</html>
