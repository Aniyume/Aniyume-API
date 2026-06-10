<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сброс пароля AniYume</title>
</head>
<body style="margin:0;padding:0;background:#0f0f0f;font-family:Arial,Helvetica,sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#0f0f0f;padding:32px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="440" cellpadding="0" cellspacing="0" style="background:#161616;border:1px solid rgba(46,196,182,0.3);border-radius:16px;overflow:hidden;">
                    <tr>
                        <td style="padding:32px 32px 8px;text-align:center;">
                            <h1 style="margin:0;color:#2EC4B6;font-size:22px;font-weight:900;text-transform:uppercase;letter-spacing:1px;">AniYume</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:8px 32px;text-align:center;">
                            <p style="margin:0 0 16px;color:#cbd5e1;font-size:14px;">Вы запросили сброс пароля. Введите этот код в приложении:</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 32px;text-align:center;">
                            <div style="display:inline-block;background:#0f0f0f;border:1px solid rgba(46,196,182,0.4);border-radius:12px;padding:16px 28px;color:#2EC4B6;font-size:34px;font-weight:900;letter-spacing:10px;">{{ $code }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:24px 32px 32px;text-align:center;">
                            <p style="margin:0;color:#94a3b8;font-size:12px;">Код действует {{ $ttlMinutes }} минут. Если вы не запрашивали сброс пароля — просто проигнорируйте это письмо.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
