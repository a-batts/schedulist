<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet" type="text/css">
        <style type="text/css">
            .logo-image-light-theme{
                display: block;
            }
            .logo-image-dark-theme{
                display: none;
                mso-hide: all;
            }
            @media (prefers-color-scheme: light) {
                .logo-image-dark-theme { display: none; mso-hide: all;}
                .logo-image-light-theme { display: block; } 
            }
            @media (prefers-color-scheme: dark) {
                .logo-image-dark-theme { display: block; mso-hide: none;}
                .logo-image-light-theme { display: none; mso-hide: all;} 
            }
            .logo-image{
                height: 50px;
                margin-left: auto;
                margin-right: auto;
            }
            .outlined-card{
                border-width: 1px;
                border-style: solid;
                border-color: #E0E0E0;
                width: 90vw;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 50px;
                border-radius: 12px;
                padding-bottom: 40px;
            }
            .footer-note{
                width: 90vw;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 10px;
                border-radius: 12px;
                padding-left: 20px;
                padding-right: 20px;
            }
            table{
                padding-left: 15px;
                padding-right: 15px;
            }
            [style*='Noto Sans'] {
                font-family: 'Noto Sans', Roboto, Arial, sans-serif !important;
            }
        </style>
    </head>
    <body>
        <table style="font-family: Roboto, Arial, sans-serif, 'Noto Sans'" class="outlined-card" cellpadding="0" cellspacing="0">
            <tr>
                <td style="text-align: center; padding-top: 20px; padding-bottom: 20px; margin-top:10px">
                    <img class="logo-image logo-image-light-theme" src="https://schedulist.xyz/images/logo/logo_dark.png" alt="Schedulist Logo" title="Schedulist Logo" /> 
                    <img class="logo-image logo-image-dark-theme" src="https://schedulist.xyz/images/logo/logo_light.png" alt="Schedulist Logo" title="Schedulist Logo" />   
                </td>
            </tr>
            <tr>
                <td style="font-weight: 600; font-size: 32px; padding-left: 6px; padding-right: 6px;
                text-align: center; padding-bottom: 20px; margin-top: 10px; text: black">{{$data['heading']}}</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #D2DCDC;"></td>
            </tr>
            @isset($data['icon'])
                <tr>
                        <td style="text-align: center; padding-top: 20px; color: #4B5563;"><img src="https://material-icons.github.io/material-icons-png/png/black/{{$data['icon']}}/outline-4x.png" style="height: 80px"></td>
                    </tr>
            @endisset
            <tr>
                <td style="color: #4B5563; padding-left: 25px; padding-right: 25px; text-align: center; padding-top: 40px; padding-bottom: 60px; font-size: 15px;">{{$data['body']}}</td>
            </tr>
            @isset($data['link'])
            <tr>
                <td style="color: #4B5563; padding-left: 10px; padding-right: 10px; text-align: center">
                    <a style="display: inline-block; background-color: #1674d3; color: white; padding-top: 10px; padding-bottom: 10px; padding-left: 10px; padding-right: 10px; text-transform: uppercase; font-weight: 500; letter-spacing: 1.2px; border-radius: 7px; text-align: center; cursor: pointer; text-decoration: none;" 
                    href="{{$data['link']}}" target="_blank">{{$data['link_title']}}</a>
                </td>
            </tr>
            @endisset
        </table>
        <table class="footer-note" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td style="color: #6b7280; text-align: center; font-size: 12px; padding-top: 40px">{{$data['footer']}}</td>
            </tr>
        </table>
    </body>
</html>