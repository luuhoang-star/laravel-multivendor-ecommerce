<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $subject }}</title>
</head>

<body style="margin:0;padding:30px;background:#f4f4f4;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 2px 10px rgba(0,0,0,.08);">

                    <!-- Header -->
                    <tr>
                        <td
                            style="background:#0d6efd;padding:25px;text-align:center;color:white;font-size:26px;font-weight:bold;">
                            Kênh Người Bán ShopX
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:35px;">

                            <h2 style="margin-top:0;color:#333;">
                                {{ $subject }}
                            </h2>

                            <p style="font-size:16px;line-height:1.8;color:#555;">
                                {{ $body }}
                            </p>

                            <div style="margin-top:30px;">
                                <a href="{{ url('/') }}"
                                    style="background:#0d6efd;
                                       color:#fff;
                                       padding:12px 25px;
                                       text-decoration:none;
                                       border-radius:5px;
                                       display:inline-block;">
                                    Truy cập trang web
                                </a>
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="background:#f8f9fa;
                               padding:20px;
                               text-align:center;
                               color:#777;
                               font-size:13px;">

                            <strong>{{ config('app.name') }}</strong><br>

                            Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.<br>

                            © {{ date('Y') }} Tất cả quyền được bảo lưu.

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
