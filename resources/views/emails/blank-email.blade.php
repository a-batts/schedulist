<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <title></title>
    <!--[if mso]>
            <noscript>
            <xml>
            <o:OfficeDocumentSettings>
            <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
            </xml>
            </noscript>
        <![endif]-->
    <style>
        table,
        td,
        div,
        h1,
        p {
            font-family: 'Noto Sans', Roboto, Helvetica, Arial, sans-serif;
        }

        table.content {
            border: solid 0.5px #e0e0e0 !important;
            background-color: white
        }

        .logo-image {
            height: 52px;
            padding: 30px 0px;
            margin-left: auto;
            margin-right: auto;
            display: inline-block
        }

        .button:hover {
            filter: brightness(105%);
            transition: all
        }

        td {
            color: black
        }

        a.button {
            background-color: #1674d3;
            color: white
        }

        .footer-text,
        .secondary-text {
            color: #423f3f
        }

        .link {
            text-decoration: none
        }

        .link:hover {
            text-decoration: underline
        }

        @media (prefers-color-scheme: dark) {
            td {
                color: #FFFFFFDE !important
            }

            table.content {
                background-color: #1C1C1C !important
            }

            a.button {
                background-color: #95CFFE !important;
                color: black !important
            }

            .logo-image,
            .icon {
                filter: brightness(0) invert(1) !important
            }

            .footer-text,
            .secondary-text {
                color: #FFFFFF99 !important
            }

            .link {
                color: #95CFFE
            }
        }
    </style>
</head>

<body style="margin:0; padding:0;">
    <table role="presentation" style="width:100%; border-collapse:collapse; border:0; border-spacing:0;">
        <tr>
            <td style="padding:0;" align="center">
                <table class="content" role="presentation"
                    style="width:600px; border-collapse:collapse; border:0px; text-align:left;">
                    <tr>
                        <td style="padding:0; text-align: center">
                            <a href="{{ route('landing') }}" target="_blank" rel="noopener">
                                <img class="logo-image" src="{{ asset('images/logo/logo_dark.png') }}"
                                    title="Schedulist Logo" alt="Schedulist Logo" />
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 25px 45px; text-align: center; font-weight: bold; font-size: 36px;">
                            <span>{{ $data['heading'] }}</span>

                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px 45px;">
                            <table>
                                <tr>
                                    @isset($data['icon'])
                                        <td style="padding-right: 10px;">
                                            <img class="icon"
                                                src="https://material-icons.github.io/material-icons-png/png/black/{{ $data['icon'] }}/outline-4x.png"
                                                alt="{{ $data['icon'] }} icon" style="height: 36px" height="36px">
                                        </td>
                                    @endisset
                                    <td
                                        style="font-size: 16px; @empty($data['icon']) text-align: center @else margin-left: 10px; display: inline-block @endempty">
                                        {{ $data['body'] }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px 0px 60px; text-align: center;">
                            <a class="button" href="{{ $data['link'] }}"
                                style="display: inline-block; padding: 12px 25px; border-radius: 12px; font-weight: bold; cursor: pointer; text-decoration: none; font-size: 16px"
                                target="_blank" rel="noopener">{{ $data['link_title'] }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top: 0.5px solid #e0e0e0;"></td>
                    </tr>
                    <tr>
                        <td style="padding: 45px 60px; text-align: center;">
                            <span style="font-size: 12px; line-height: 20px">{{ $data['footer'] }}<br> You can update
                                notification settings for your account ({{ $data['user_email'] }}) by visiting <a
                                    class="link" href="{{ route('profile') }}"
                                    style="color: #1674d3">{{ route('profile') }}</a></span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
