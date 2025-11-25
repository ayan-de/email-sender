<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $subject }}</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, Helvetica, sans-serif; background-color:#f7f7f7;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f7f7f7; padding:20px 0;">
        <tr>
            <td>
                <table 
                    cellpadding="0" 
                    cellspacing="0" 
                    width="100%" 
                    style="max-width:600px; margin:0 auto; background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.08);"
                >
                    <tr>
                        <td style="background:#4F46E5; padding:20px; text-align:center;">
                            <h2 style="color:#ffffff; margin:0; font-weight:600;">
                                {{ $subject }}
                            </h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:25px; color:#333333; font-size:15px; line-height:1.6;">
                            {!! nl2br(e($mailmessage)) !!}
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:20px; text-align:center; color:#888888; font-size:13px;">
                            © {{ date('Y') }} Your Company Name. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
