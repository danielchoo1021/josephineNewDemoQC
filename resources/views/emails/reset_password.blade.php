<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $isChinese ? '重置密码' : 'Reset Your Password' }} - {{ $websiteName }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Arial, Helvetica, sans-serif; color: #333333;">
	<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f4f4; padding: 30px 0;">
		<tr>
			<td align="center">
				<table width="600" cellpadding="0" cellspacing="0" border="0" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 6px;">
					<tr>
						<td style="padding: 30px 40px 10px 40px; border-bottom: 1px solid #eeeeee;">
							<h2 style="margin: 0; font-size: 22px; color: #222222;">{{ $websiteName }}</h2>
						</td>
					</tr>
					<tr>
						<td style="padding: 30px 40px; font-size: 15px; line-height: 24px;">
							@if($isChinese)
								<p style="margin: 0 0 16px 0;">您好 {{ $name }}，</p>
								<p style="margin: 0 0 16px 0;">我们收到了重置您 {{ $websiteName }} 账号密码的请求。请点击下面的按钮设置新密码：</p>
							@else
								<p style="margin: 0 0 16px 0;">Hello {{ $name }},</p>
								<p style="margin: 0 0 16px 0;">We received a request to reset the password for your {{ $websiteName }} account. Click the button below to choose a new password:</p>
							@endif

							<p style="margin: 28px 0; text-align: center;">
								<a href="{{ $resetLink }}" style="background-color: #007bff; color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 4px; font-size: 15px; font-weight: bold; display: inline-block;">
									{{ $isChinese ? '重置密码' : 'Reset Password' }}
								</a>
							</p>

							@if($isChinese)
								<p style="margin: 0 0 16px 0;">此链接将在 {{ $expiresInMinutes }} 分钟后失效，并且只能使用一次。</p>
								<p style="margin: 0 0 16px 0;">如果按钮无法点击，请将以下链接复制到浏览器打开：</p>
							@else
								<p style="margin: 0 0 16px 0;">This link will expire in {{ $expiresInMinutes }} minutes and can only be used once.</p>
								<p style="margin: 0 0 16px 0;">If the button does not work, copy and paste the link below into your browser:</p>
							@endif
							<p style="margin: 0 0 16px 0; word-break: break-all;"><a href="{{ $resetLink }}" style="color: #007bff;">{{ $resetLink }}</a></p>

							@if($isChinese)
								<p style="margin: 0 0 16px 0;">如果您没有请求重置密码，请忽略此邮件，您的密码不会被更改。</p>
								<p style="margin: 24px 0 0 0;">谢谢，<br>{{ $websiteName }} 团队</p>
							@else
								<p style="margin: 0 0 16px 0;">If you did not request a password reset, you can safely ignore this email. Your password will not be changed.</p>
								<p style="margin: 24px 0 0 0;">Thank you,<br>The {{ $websiteName }} Team</p>
							@endif
						</td>
					</tr>
					<tr>
						<td style="padding: 18px 40px; background-color: #fafafa; border-top: 1px solid #eeeeee; font-size: 12px; color: #888888; text-align: center;">
							@if($isChinese)
								这是一封自动发送的邮件，请勿直接回复。
							@else
								This is an automated message, please do not reply to this email.
							@endif
							<br>&copy; {{ date('Y') }} {{ $companyName }}
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
